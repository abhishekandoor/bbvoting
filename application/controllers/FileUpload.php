<?php
class FileUpload extends MY_Controller {
private $fview = "fileUp/";
  function __construct() {
      parent::__construct();
      $this->load->library('AdminLib');
//      $this->template->write_view('header', 'secured_user/default/header');
      //$this->template->write_view('menu', 'secured_user/default/menu');
      $this->load->helper('url');
      $this->load->library('form_validation','general_helper');
      $this->load->helpers('form_helper');
      $this->load->model('FileUpload_Model','FM');
      $this->load->model('ApplicationModel','AM');
  }
  
  function fileupload($rqids='', $school_id){
      $data = array();
      $checkIdisValid = $this->General->get_single_column_value('AASF_Request','id','id="'.$rqids.'" and school_id="'.$school_id.'"');//created_by="'.$this->session->userdata('user_id').'"');
      
      //Line added for resolve the office resubmitted file issue(Start)
      $is_resubmitted = $this->General->getrow('AASF_Request','is_resubmitted',array('id'=>$rqids))->is_resubmitted;
      $is_office_resubmit = $this->General->find_record_exists('application_resubmit_log','id','req_id='.$rqids);
      if($is_resubmitted == 1 && $is_office_resubmit == 1)
        $checkIdisValid = $rqids;
      //Line added for resolve the office resubmitted file issue(End)

      if($checkIdisValid!=0){

      $this->form_validation->set_rules('certificateType', 'Username', 'required');
      $file_nameF = @$_FILES["userfile"]["name"];
      $temp = explode(".", $file_nameF);
      $extension = end($temp);
      if(isset($_FILES['userfile']['name'])){
      if($extension != "pdf" && $extension != "PDF" ){
        $this->session->set_flashdata('warning', 'Not Allowed '.$extension.' Files. Please upload  PDF Files!');
         $ret_data['success'] = 0;
         $ret = json_encode($ret_data);
         return $ret;
      } else {
              if($this->form_validation->run() == true)
              {
                $docids = $this->input->post('certificateType');
                $fileExists = $this->General->find_record_exists('AASF_Doc_Uploaded','id','req_id="'.$rqids.'" and doc_id="'.$docids.'" ');// and created_by="'.$this->session->userdata('user_id').'"');
                if($fileExists!=0){
                  $this->session->set_flashdata('warning', 'File Already Exists!');
                } else {
                  $this->FM->uploadDocuments($rqids);
                  //$this->session->userdata('selTab')='3';
                  $this->session->set_flashdata('selTab', 3);
                  $ret_data['success'] = 1;
                  $ret = json_encode($ret_data);
                  return $ret;
                }
              }
      }
    } 
      $data['requestIds'] = $rqids;
      $data['schoolId']   = get_school_id_from_request($rqids);
      $user_id = $this->session->userdata('user_id');
      if($is_resubmitted == 1 && $is_office_resubmit == 1)
        $user_id = '';
      $data['files']  = $this->FM->getGeneralDocumentsFiles($rqids);//, $user_id);
      $data['delete'] = base_url().'index.php/fileUpload/deleteDocuments/';
      $data['certificateType']       = $this->General->prepare_select_box_data_new('AASF_Documents','id,doc_name','','','id');

      $designation               = @$this->General->getrow('AASF_Request', 'desig_id', array('id'=>$rqids)) ;
      $desig_id                  = $designation->desig_id;  

      $appointment               = @$this->General->getrow('AASF_Request', 'appointment_type', array('id'=>$rqids)) ;
      $appointment_type          = $appointment->appointment_type;


      if((($desig_id == 85) || ($desig_id == 87) || ($desig_id == 88)) && ($appointment_type == 3)){

        $data['mandatory_upload']  = $this->FM->getGeneralDocumentMandatoryOnPromotion();
        $data['mandatory_docs_uploaded']  = $this->FM->getGeneralDocumentMandatoryRecordsOnPromotion($rqids); 
      } else {
        $data['mandatory_upload']  = $this->FM->getGeneralDocumentMandatory();
        $data['mandatory_docs_uploaded']  = $this->FM->getGeneralDocumentMandatoryRecords($rqids); 
      }
      $file_status_array = $this->FM->getFileStatus($rqids);
      $file_status  = $file_status_array[0]['file_status'];
      $data['file_status']     = $file_status;
        $tab_permissions       = $this->AM->getTabPermissionOnRequest($rqids);
        $thirdTabPermission    = $tab_permissions[2]['permission']?$tab_permissions[2]['permission']:0; 
        if($thirdTabPermission == 0 && isMANAGEROffice()){
          echo $thirdTabPermission; 
          return;
        }
        $data['thirdTabPermission'] = $thirdTabPermission;
        $this->load->view($this->fview . 'home', $data);
      
    }
  }
  function saveDocuments($rqids='', $school_id){
            $checkIdisValid = $this->General->get_single_column_value('AASF_Request','id','id="'.$rqids.'" and school_id="'.$school_id.'"');//created_by="'.$this->session->userdata('user_id').'"');
          
            //Line added for resolve the office resubmitted file issue(Start)
      $is_resubmitted = $this->General->getrow('AASF_Request','is_resubmitted',array('id'=>$rqids))->is_resubmitted;
      $is_office_resubmit = $this->General->find_record_exists('application_resubmit_log','id','req_id='.$rqids);
      if($is_resubmitted == 1 && $is_office_resubmit == 1)
        $checkIdisValid = $rqids;
      //Line added for resolve the office resubmitted file issue(End)
        
        if($checkIdisValid!=0){
            $this->form_validation->set_rules('certificateType', 'Type', 'required');
            $file_nameF = @$_FILES["userfile"]["name"];
            $temp = explode(".", $file_nameF);
            $extension = end($temp);
            if(isset($_FILES['userfile']['name'])){
            if($extension != "pdf" && $extension != "PDF" ){
              // $this->session->set_flashdata('warning',);
               $ret_data['success'] = 0;
               $ret_data['message'] =  'Not Allowed '.$extension.' Files. Please upload  PDF Files!';

              header('Content-Type: application/x-json; charset=utf-8');
              echo json_encode($ret_data);

            } else {
                    if($this->form_validation->run() == true)
                     {

                      $docids = $this->input->post('certificateType');

                      if($docids!= 32){
                      $mandatoryCheck = $this->FM->checkGeneralDocumentMandatory($docids);

                      $mandatoryField = $mandatoryCheck[0]['is_mandatory'];
                      } else {
                        $mandatoryField = 'Y' ;
                      }

                      $fileExists = $this->General->find_record_exists('AASF_Doc_Uploaded','id','req_id="'.$rqids.'" and doc_id="'.$docids.'" ');//and created_by="'.$this->session->userdata('user_id').'"');
                     
                      if($mandatoryField == 'Y'){
                            if($fileExists!=0){
                              
                                $ret_data['success'] = 0;
                                $ret_data['message'] =  'File Already Exists!';
                                 header('Content-Type: application/x-json; charset=utf-8');
                                 echo json_encode($ret_data);

                            } else {
                                $upload_check = 0;
                                $upload_check =  $this->FM->uploadDocuments($rqids);
                                if($upload_check == 1){
                                  $ret_data['success'] = 1;
                                  $ret_data['message'] =  'General Documents Saved Successfully';
                                } else {
                                  $ret_data['success'] = 0;
                                  $ret_data['message'] =  'Cannot Upload File,Size above 10MB';
                                }
                                 
                                  header('Content-Type: application/x-json; charset=utf-8');
                                  echo json_encode($ret_data);
                            }

                       } else {
                          $upload_check = 0;
                          $upload_check =  $this->FM->uploadDocuments($rqids);
                          if($upload_check == 1){
                            $ret_data['success'] = 1;
                            $ret_data['message'] =  'General Documents Saved Successfully';
                          } else {
                            $ret_data['success'] = 0;
                            $ret_data['message'] =  'Cannot Upload File,Size above 10MB';
                          }
                          header('Content-Type: application/x-json; charset=utf-8');
                          echo json_encode($ret_data);

                      }
                    }
                }
              } else {

                 $ret_data['success'] = 0;
                 $ret_data['message'] =  'Upload Pdf Documents';
                 $ret = json_encode($ret_data);
                 return $ret;

              }

        }

  }

  function getUploadedList($requestId){

      $designation               = @$this->General->getrow('AASF_Request', 'desig_id', array('id'=>$requestId)) ;
      $desig_id                  = $designation->desig_id;  

      $appointment               = @$this->General->getrow('AASF_Request', 'appointment_type', array('id'=>$requestId)) ;
      $appointment_type          = $appointment->appointment_type;


      if((($desig_id == 85) || ($desig_id == 87) || ($desig_id == 88)) && ($appointment_type == 3)){

        $mandatory_upload        = $this->FM->getGeneralDocumentMandatoryOnPromotion();
        $mandatory_docs_uploaded = $this->FM->getGeneralDocumentMandatoryRecordsOnPromotion($requestId); 
      } else {
        $mandatory_upload         = $this->FM->getGeneralDocumentMandatory();
        $mandatory_docs_uploaded  = $this->FM->getGeneralDocumentMandatoryRecords($requestId); 
      }

       $s1=1;
       $i = 0;
       $tabledis =" <label>Please Upload the mandatory documents for Application Submit</label><table class='table-responsive'>";

     foreach(@$mandatory_upload as $md){
           if(in_array($md['id'], array_column($mandatory_docs_uploaded, 'id'))){

             $tabledis .=" <tr><td><label class='green-font-color bold-text'>
                       ".@$s1.'. '. @$md['doc_name']."</label></td></tr>";

           }else {
          $tabledis .=" <tr><td>".@$s1.'. '. @$md['doc_name']."</td></tr>";
           }
       $i++;
       $s1++;

     }
      $tabledis .= "<tr>";
      $tabledis .= "</tr>";
      $tabledis .= "</table>";
      header('Content-Type: application/x-json; charset=utf-8');
      echo json_encode($tabledis);
  }
  function deleteDocuments($rqids,$docids,$fileupids) {
    $resubmitted = isReSubmittedRequest($rqids);
      $checkIdisValid = $this->General->get_single_column_value('AASF_Doc_Uploaded','id','req_id="'.$rqids.'" and doc_id="'.$docids.'"  and file_upload_id="'.$fileupids.'" and created_by="'.$this->session->userdata('user_id').'"');
    if($checkIdisValid!=0){
      $this->db->trans_start();
      $filePath = $this->General->get_single_column_value('AASF_DocumentManager','file_url','request_id="'.$rqids.'" and id="'.$fileupids.'"');
      if($filePath!="" && !$resubmitted){
        unlinkfile($filePath);
      }
      $this->General->delete('AASF_Doc_Uploaded','req_id="'.$rqids.'" and doc_id="'.$docids.'"  and file_upload_id="'.$fileupids.'" and created_by="'.$this->session->userdata('user_id').'"');
      $this->General->delete('AASF_DocumentManager','id="'.$fileupids.'" and request_id="'.$rqids.'"');
      $this->db->trans_complete();
      if($this->db->trans_status() === FALSE){
        $this->db->trans_rollback();
        $this->session->set_flashdata('message', 'Something went Wrong!');
        $ret_data['error'] = 1;
        $ret_data['success'] = 0;
      }else{
        $this->session->set_flashdata('message', 'Successfully Deleted!');
        $ret_data['success'] = 1;
        $ret_data['error'] = 0;
    }
    }else{
        $this->session->set_flashdata('message', 'Something went Wrong!');
        $ret_data['error'] = 1;
        $ret_data['success'] = 0;
    }
    //redirect('fileUpload/fileupload/'.$rqids);
      $this->session->set_flashdata('selTab', 3);
      $ret = json_encode($ret_data);
      echo $ret;
    //redirect('secured_user/Application');//.$rqids);
  }

  

}
?>
