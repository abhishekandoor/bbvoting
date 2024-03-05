<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QualificationLib
 *
 * @author Akhila
 */
class SFLib {

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->model('CommonModel', 'CM');
        $this->ci->load->model('CommonModel', 'CM');
        $this->ci->load->model('School/List_Staff_Model');
        $this->ci->load->model('School/School_Model', 'SM');
        $this->ci->load->helper('general_helper');
    }

     function process_data($data,$type = '') {
        $i = 1;
        $temp_data = array();
        $AQ = "";
        $PQ = "";
        $EQ = "";
//print('<pre>');print_r($data);print('</pre>');die;
        foreach ($data as $row) {
            $AQ = "";
            $PQ = "";
            $EQ = "";
            $temp_data[$row['PRIM']]['Slno']        = $i++;
            $temp_data[$row['PRIM']]['Name']        = $row['Name'];
            $temp_data[$row['PRIM']]['Designation'] = $row['Designation'];
            $temp_data[$row['PRIM']]['PEN']         = $row['PEN'];
            $temp_data[$row['PRIM']]['DOB']         = dateFormat_dmY($row['DOB']);
            $temp_data[$row['PRIM']]['un_approved'] = $row['un_approved'];
            if($type=='e'){ //e excel w word 
                if($row['D_prev_service_from_date'] != "0000-00-00"){
                    $temp_data[$row['PRIM']]['Prev_Service'] = $row['Prev_Designation']." From " . dateFormat_dmY($row['D_prev_service_from_date']) . " To " . dateFormat_dmY($row['D_prev_service_to_date']);
                }else{
                    $temp_data[$row['PRIM']]['Prev_Service'] = $row['Prev_Designation'];
                }
            }else if($type == 'w'){
                if($row['D_prev_service_from_date'] != "0000-00-00"){
                    $temp_data[$row['PRIM']]['Prev_Service'] = $row['Prev_Designation']." <br> (" . dateFormat_dmY($row['D_prev_service_from_date']) . " to " . dateFormat_dmY($row['D_prev_service_to_date']).")";
                }else{
                    $temp_data[$row['PRIM']]['Prev_Service'] = $row['Prev_Designation'];
                }
            }
           $temp_data[$row['PRIM']]['Pres_Service'] = dateFormat_dmY($row['D_appntmnt_pres_school']);
            if(isset($row['qualification']['AQ'])){
                if (count($row['qualification']['AQ']) > 0) {
                    foreach($row['qualification']['AQ'] as $arow) {
                        if($type=="e"){
                             $AQ .= "[" . $arow['academic_qualification'] . " - " . $arow['subject'] . "]";
                        }else if ($type == "w"){
                             $AQ .= $arow['academic_qualification'];
                             if($arow['subject']!= ""){ $AQ .= " - " . $arow['subject'];}
                             $AQ .= "#";
                        }
                    }
                }
            }
            if(isset($row['qualification']['PQ'])){
                if (count($row['qualification']['PQ']) > 0) {
                    foreach ($row['qualification']['PQ'] as $prow) {
                         if($type=="e"){
                             $PQ .= "[" . $prow['academic_qualification'] . " - " . $prow['subject'] . "]";
                         }else if ($type == "w"){
                             $PQ .= $prow['academic_qualification'];
                             if($prow['subject'] != ""){ $PQ .= " - " . $prow['subject']; }
                             $PQ .= "#";
                         }
                    }
                }
            }
            if(isset($row['qualification']['EQ'])){
                if (count($row['qualification']['EQ']) > 0) {
                    foreach ($row['qualification']['EQ'] as $erow) {
                        if($type=="e"){
                           $EQ .= "[" . $erow['academic_qualification'] . " - " . $erow['subject'] . "]";
                        }else if ($type == "w"){
                            $EQ .= $erow['academic_qualification'];
                            if($erow['subject']!=""){ $EQ .= " - " . $erow['subject'];}
                            $EQ .= "#";
                        }
                    }
                }
            }
            $temp_data[$row['PRIM']]['AQ'] = $AQ;
            $temp_data[$row['PRIM']]['PQ'] = $PQ;
            $temp_data[$row['PRIM']]['EQ'] = $EQ;
        }
        return $temp_data;
    }
    
    

}
