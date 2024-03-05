<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class QrCode extends MY_Auth {
    
    private $table_draft_notes          = 'AASF_Draft_Notes';

    function __construct() {
        parent::__construct();
        //$this->load->helper(array('form', 'url'));
        //$this->load->library('form_validation');
        //$this->load->library('security');
        $this->load->library('tank_auth');
        $this->load->library('AdminLib');
        $this->load->library('itschool_rbac');
        $this->load->library('encryption');
        $this->encryption->initialize(
                array(
                    'cipher' => 'aes-256',
                    'mode' => 'ctr',
                    'key' => 'it@school_2020'
                )
        );
        $this->encryption->initialize(array('driver' => 'mcrypt'));
        $this->load->model('General','GM');
        $this->load->model('DraftNotesModel','DM');
        // $this->load->library('qrcodes/ciqrcode');
    }
    
    function download_pdf($enc_draft_id,$type=NULL){//@param : draft id,@param : type 1=Draft Note
        $dec_draft_id               = $this->decrypt_id($enc_draft_id);
        if($type == 1){
            $result = $this->getDraftDetails($dec_draft_id);
        }
        $this->generatePdf($result);
    }

    function decrypt_id($enc_draft_id){
        $draft_id = strtr($enc_draft_id, array('.' => '+', '-' => '=', '~' => '/'));
        $draft_id = $this->encryption->decrypt($draft_id);
        return $draft_id;
    }

    function getDraftDetails($dec_draft_id){
        $req_id  = $this->GM->getrow('qr_code_ref','request_id',array("draft_id"=>$dec_draft_id))->request_id;
        $results = $this->DM->get_draft_by_id($req_id, $dec_draft_id);
        return $results;
    }

    function generatePdf($result){
        ob_end_clean();
        $this->load->library('m_pdf');
        $mpdf = new mPDF('utf-8');
        // $mpdf->falseBoldWeight = 0;
        // $mpdf->useSubstitutions = true;
        $mpdf->autoScriptToLang = true;
        $mpdf->baseScript = 1;
        $mpdf->keep_table_proportions = false;

        // $mpdf->autoVietnamese = true;
        // $mpdf->autoArabic = true;
        $mpdf->autoLangToFont = true;
        $mpdf->useAdobeCJK = true;
        // $mpdf->SetAutoFont(AUTOFONT_ALL);
        $mpdf->debug = false;
        $mpdf->autoPageBreak = true;
        $mpdf->setAutoTopMargin='stretch';

      


        /////////////
        // $mpdf->defaultheaderfontsize = 10;	/* in pts */
        // $mpdf->defaultheaderfontstyle = B;	/* blank, B, I, or BI */
        // $mpdf->defaultheaderline = 1; 	/* 1 to include line below header/above footer */

        $mpdf->defaultfooterfontsize = 8;	/* in pts */
        $mpdf->defaultfooterfontstyle = I;	/* blank, B, I, or BI */
        $mpdf->defaultfooterline = 1; 	/* 1 to include line below header/above footer */
        $request_id = $result[0]['request_id'];
        $draftId    = $result[0]['id'];
        $req_type = getRequestType($request_id);
        $enc_draft_id = strtr($this->encryption->encrypt($draftId), array('+' => '.', '=' => '-', '/' => '~'));
        $draft_type = $this->General->getrow($this->table_draft_notes,'draft_template',array('id'=>$draftId))->draft_template;
        $qr_code     = $this->adminlib->getDraftQrCode($enc_draft_id,$req_type,$draft_type);
        $draft_ucode = $this->General->getrow('qr_code_ref','ref_code',array("draft_id"=>$draftId,"request_id"=>$request_id))->ref_code;
        if($draft_ucode == NULL || $draft_ucode == ''){
            $draft_ucode = $this->adminlib->getDraftUnicode($request_id,$draftId);
            $this->General->insert('qr_code_ref',array("draft_id"=>$draftId,"request_id"=>$request_id,"req_type"=>$req_type,"base_table_ref"=>1,"ref_code"=>$draft_ucode));
        }
        $footer_qr    = '';
        $footer_ucode = '';
        $data = $result[0];//array();
        $cond = '<div id="qrcode_img';
        if( strpos( $data['draft_note'], $cond ) == true) {
            if(hasDigitallySigned($draftId) == 1){
                $doc = @simplexml_load_string($data['draft_note']);
                if ($doc) {
                    $xml_note = new SimpleXMLElement($data['draft_note']);
                    foreach( $xml_note->xpath('//*/div[@id="qrcode_img"]') as $t ) {
                        $t->p=$qr_code;
                    }
                    // foreach( $xml_note->xpath('//*/div[@id="ref_unicode"]') as $t ) { 
                    //     $t->p=$draft_ucode;
                    // } 
                    $data['draft_note'] =  htmlspecialchars_decode($xml_note->asXML());
                } else {
                    $is_valid = 0; //this is not valid
                    $data = str_replace('QRCODE_HERE', $qr_code, $data);
                }
                    
                // echo $data['draft_note']; die;
                $data['draft_note'] = str_replace('<?xml version="1.0" encoding="UTF-8" standalone="no"?>', '', $data['draft_note']);
                // echo $data['draft_note']; die;
                $footer_ucode = $draft_ucode;
            }else{
                $data = str_replace('<div id="qrcode_img">.</div>', '<div id="qrcode_img">'.$qr_code.'</div>', $data);
                $data = str_replace('<div id="ref_unicode">.</div>', '<div id="ref_unicode" style="color:red;font-family: Inconsolata, monospace;margin-left: 15px;margin-top: -20px;">'.$draft_ucode.'</div>', $data);  
            }
        }elseif($req_type == REQ_TYPE_AA || $req_type == REQ_TYPE_APL_AA || $req_type == REQ_TYPE_AUD ){
            $footer_qr    = $qr_code;
            $footer_ucode = $draft_ucode;
        }
        $data['draft_note'] = str_replace('<?xml version="1.0" encoding="UTF-8" standalone="no"?>', '', $data['draft_note']);
        $data['draft_note'] = str_replace('<?xml version="1.0"?>', '', $data['draft_note']);
        // $data = str_replace('<table border="0" cellpadding="3" cellspacing="3" style="border:none; width:100%">', '<table class="special" border="0" cellpadding="3" cellspacing="3" style="border:none; width:100%">', $data); 
        // print_r($data['draft_note']); die;
        // $mpdf->SetHeader('{DATE j-m-Y}|{PAGENO}/{nb}|My document');
        // $mpdf->SetHTMLFooter('<img src="'.base_url().'assets/images/favcon.png'.'" height="12" width="12">');
        date_default_timezone_set("Asia/Kolkata");
        // <img src="'.base_url().'/assets/images/favcon.png'.'" height="10" width="15" align="top" style="margin-top:3px;">
        $mpdf->SetHTMLFooter('
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border:none; border-top:thin solid; ">
        <tr>
        <td><span style="font-family: Inconsolata, monospace;color:#ff0000;font-size:14px;">'.@$footer_ucode.'</span></td>
        
        <td style="width:45%; text-align:right; font-weight:100; ; color:#c1c0c0; font-size:10px; ">
            
            SAMANWAYA
        </td>
        <td style="width:10%; text-align:center; font-weight:100; ; color:#000000; font-size:10px; ">{PAGENO}/{nb}</td>
        <td style="width:45%; text-align:right; font-weight:100; ; color:#c1c0c0; font-size:10px; ">Printed on {DATE d/m/Y h:i:s A}</td>
        </tr>
        </table>');


        $mpdf = new mPDF('utf-8');
        // $mpdf->falseBoldWeight = 0;
        // $mpdf->useSubstitutions = true;
        $mpdf->autoScriptToLang = true;
        $mpdf->baseScript = 1;
        $mpdf->keep_table_proportions = false;

        // $mpdf->autoVietnamese = true;
        // $mpdf->autoArabic = true;
        $mpdf->autoLangToFont = true;
        $mpdf->useAdobeCJK = true;
        // $mpdf->SetAutoFont(AUTOFONT_ALL);
        $mpdf->debug = false;
        $mpdf->autoPageBreak = true;
        $mpdf->setAutoTopMargin='stretch';

      


        /////////////
        // $mpdf->defaultheaderfontsize = 10;	/* in pts */
        // $mpdf->defaultheaderfontstyle = B;	/* blank, B, I, or BI */
        // $mpdf->defaultheaderline = 1; 	/* 1 to include line below header/above footer */

        $mpdf->defaultfooterfontsize = 8;	/* in pts */
        $mpdf->defaultfooterfontstyle = I;	/* blank, B, I, or BI */
        $mpdf->defaultfooterline = 1; 	/* 1 to include line below header/above footer */

        $enc_draft_id = strtr($this->encryption->encrypt($draftId), array('+' => '.', '=' => '-', '/' => '~'));
        $draft_type = $this->General->getrow($this->table_draft_notes,'draft_template',array('id'=>$draftId))->draft_template;
        $qr_code     = $this->adminlib->getDraftQrCode($enc_draft_id,$req_type,$draft_type);
        $draft_ucode = $this->General->getrow('qr_code_ref','ref_code',array("draft_id"=>$draftId,"request_id"=>$request_id))->ref_code;
        if($draft_ucode == NULL || $draft_ucode == ''){
            $draft_ucode = $this->adminlib->getDraftUnicode($request_id,$draftId);
            $this->General->insert('qr_code_ref',array("draft_id"=>$draftId,"request_id"=>$request_id,"req_type"=>$req_type,"base_table_ref"=>1,"ref_code"=>$draft_ucode));
        }
        $footer_qr    = '';
        $footer_ucode = '';
        $data = $result[0];//array();
        $cond = '<div id="qrcode_img';
        if( strpos( $data['draft_note'], $cond ) == true) {
            if(hasDigitallySigned($draftId) == 1){
                $doc = @simplexml_load_string($data['draft_note']);
                if ($doc) {
                    $xml_note = new SimpleXMLElement($data['draft_note']);
                    foreach( $xml_note->xpath('//*/div[@id="qrcode_img"]') as $t ) {
                        $t->p=$qr_code;
                    }
                    // foreach( $xml_note->xpath('//*/div[@id="ref_unicode"]') as $t ) { 
                    //     $t->p=$draft_ucode;
                    // } 
                    $data['draft_note'] =  htmlspecialchars_decode($xml_note->asXML());
                } else {
                    $is_valid = 0; //this is not valid
                    $data = str_replace('QRCODE_HERE', $qr_code, $data);
                }
                    
                // echo $data['draft_note']; die;
                $data['draft_note'] = str_replace('<?xml version="1.0" encoding="UTF-8" standalone="no"?>', '', $data['draft_note']);
                // echo $data['draft_note']; die;
                $footer_ucode = $draft_ucode;
            }else{
                $data = str_replace('<div id="qrcode_img">.</div>', '<div id="qrcode_img">'.$qr_code.'</div>', $data);
                $data = str_replace('<div id="ref_unicode">.</div>', '<div id="ref_unicode" style="color:red;font-family: Inconsolata, monospace;margin-left: 15px;margin-top: -20px;">'.$draft_ucode.'</div>', $data);  
            }
        }elseif($req_type == REQ_TYPE_AA || $req_type == REQ_TYPE_APL_AA || $req_type == REQ_TYPE_AUD ){
            $footer_qr    = $qr_code;
            $footer_ucode = $draft_ucode;
        }
        $data['draft_note'] = str_replace('<?xml version="1.0" encoding="UTF-8" standalone="no"?>', '', $data['draft_note']);
        $data['draft_note'] = str_replace('<?xml version="1.0"?>', '', $data['draft_note']);
        // $data = str_replace('<table border="0" cellpadding="3" cellspacing="3" style="border:none; width:100%">', '<table class="special" border="0" cellpadding="3" cellspacing="3" style="border:none; width:100%">', $data); 
        // print_r($data['draft_note']); die;
        // $mpdf->SetHeader('{DATE j-m-Y}|{PAGENO}/{nb}|My document');
        // $mpdf->SetHTMLFooter('<img src="'.base_url().'assets/images/favcon.png'.'" height="12" width="12">');
        date_default_timezone_set("Asia/Kolkata");
        // <img src="'.base_url().'/assets/images/favcon.png'.'" height="10" width="15" align="top" style="margin-top:3px;">
        $mpdf->SetHTMLFooter('
        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="border:none; border-top:thin solid; ">
        <tr>
        <td><span style="font-family: Inconsolata, monospace;color:#ff0000;font-size:14px;">'.@$footer_ucode.'</span></td>
        
        <td style="width:45%; text-align:right; font-weight:100; ; color:#c1c0c0; font-size:10px; ">
            
            SAMANWAYA
        </td>
        <td style="width:10%; text-align:center; font-weight:100; ; color:#000000; font-size:10px; ">{PAGENO}/{nb}</td>
        <td style="width:45%; text-align:right; font-weight:100; ; color:#c1c0c0; font-size:10px; ">Printed on {DATE d/m/Y h:i:s A}</td>
        </tr>
        </table>');



        $enc_draft_id = strtr($this->encryption->encrypt($draftId), array('+' => '.', '=' => '-', '/' => '~'));

        $url = base_url()."index.php/QrCode/download_pdf/".$enc_draft_id."/1";
        $qr_code = "<img style='margin-left:100px;' src='https://chart.googleapis.com/chart?chs=120x120&cht=qr&chl=$url&choe=UTF-8'/>";

        $html= $this->load->view('secured_user/pdf', $data,true);
        $mpdf->WriteHTML($html);
        $pdfFilePath = "Proceedings_".$data['drafft_no'].'.pdf';
        $mpdf->Output($pdfFilePath, "D"); //D-Download; I-Inline; F-Save to file

    }

    function download_receipt($request_id='', $draftId=''){
        $result = $this->DM->get_draft_by_id($request_id, $draftId);
        ob_end_clean();
        $this->load->library('m_pdf');
        $mpdf=new mPDF('utf-8');

        $mpdf->autoScriptToLang = true;
        $mpdf->baseScript = 1;
        // $mpdf->autoVietnamese = true;
        // $mpdf->autoArabic = true;
        $mpdf->autoLangToFont = true;
        $mpdf->useAdobeCJK = true;
        // $mpdf->SetAutoFont(AUTOFONT_ALL);
        $mpdf->debug = false;
        $mpdf->autoPageBreak = true;
        $mpdf->setAutoTopMargin='stretch';
        $mpdf->defaultfooterfontsize = 8;	/* in pts */
        $mpdf->defaultfooterfontstyle = I;	/* blank, B, I, or BI */
        $mpdf->defaultfooterline = 1; 	/* 1 to include line below header/above footer */
        $data = $result[0];//array();
        $html= $this->load->view('secured_user/pdf', $data,true);
        $mpdf->WriteHTML($html);
        $pdfFilePath = "Receipt_".$data['drafft_no'].'.pdf';
        $mpdf->Output($pdfFilePath, "D"); //D-Download; I-Inline; F-Save to file
    
    }

    
}

?>