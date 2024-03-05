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
class QualificationLib {

    private $table_AASF_Qlfn_Dtls = 'AASF_Qlfn_Dtls'; //For qualification details 
    private $table_AASF_Qualification = 'AASF_Qualification'; // qualification type master
    private $table_Request = 'AASF_Request'; //table Application Request 
    private $table_schools = 'schools'; // For schools
    private $table_AASF_DocumentManager = 'AASF_DocumentManager'; //table for Documents  

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->model('Qualification_Model', 'QM');
        $this->ci->load->model('FileUpload_Model', 'FM');
        $this->ci->load->helper('general_helper');
    }

    /**
     * Function for getting  qualification array
     * @param type $request_id
     * @param type $user_id
     * @return type
     */
    public function get_qualification_data($request_id, $user_id, $qlfid = NULL) {

            $val = $this->validation_qualification_details();
        if ($val->run()) {//if form validation run true
            $created_date = date('Y-m-d');
            $qualification_id = $val->set_value('qualification');
            $qlfn_type_id = $val->set_value('course');
            $qlfn_subject = $val->set_value('subject');
            $reg_no = $val->set_value('reg');
            $mgrRemarks = $val->set_value('mgrRemarks');
            $file_status_array = $this->ci->FM->getFileStatus($request_id);
            $file_status = $file_status_array[0]['file_status'];

            if (($qlfn_type_id == 1 || $qlfn_type_id == 2 || $qlfn_type_id == 3) && $qlfid == '') {
                @$qal = $this->ci->General->getrow($this->table_AASF_Qlfn_Dtls, 'qlfn_type_id', array('request_id' => $request_id, 'qlfn_type_id' => @$qlfn_type_id))->qlfn_type_id;
            }
            if (@$qal == '') {
                if ($qualification_id == 1 || $qualification_id == 2) {
                    $uni_board = $val->set_value('university');
                    $year_passing = $val->set_value('year');
                    $perc = $val->set_value('percentage');

                    $qlf_acc = array(
                        'request_id'  => $request_id,
                        'qlfn_type_id'=> $qlfn_type_id,
                        'qlfn_subject'=> $qlfn_subject,
                        'uni_board'   => $uni_board,
                        'reg_no'      => $reg_no,
                        'year_passing'=> $year_passing,
                        'perc'        => $perc,
                        'created_by ' => $user_id,
                        'mgrRemarks'  => $mgrRemarks,
                        'created_at'  => $created_date);


                    if ($file_status == 'Open') {
                        $qlf_acc['is_late_addition'] = 1;
                    } else {
                        $qlf_acc['is_late_addition'] = 0;
                    }
                    $rtn_arr = $qlf_acc;
                } else if ($qualification_id == 3 || $qualification_id == 4) {
                    $doc_date = $this->getDbDate($val->set_value('doc_date'));
                    $doc_month_yr = $val->set_value('doc_month_yr');
                    $certificate_no = $val->set_value('certificate_no');
                    $name_test_dp = $val->set_value('name_test_dp');
                    if ($doc_month_yr != '') {
                        $elig = explode("/", $doc_month_yr);
                        $eligib_month = $elig[0];
                        $eligib_year = $elig[1];
                    } else {
                        $eligib_month = '';
                        $eligib_year = '';
                    }

                    $qlf_elg = array(
                        'request_id'  => $request_id,
                        'qlfn_type_id'=> $qlfn_type_id,
                        'qlfn_subject'=> $certificate_no,
                        'uni_board'   => $qlfn_subject,
                        'reg_no'      => $reg_no,
                        'year_passing'=> $eligib_year,
                        'Month'       => $eligib_month,
                        'Year'        => $eligib_year,
                        'Date'        => $doc_date,
                        'mgrRemarks'  => $mgrRemarks,
                        'created_by ' => $user_id,
                        'created_at'  => $created_date);

                    if ($file_status == 'Open') {
                        $qlf_elg['is_late_addition'] = 1;
                    } else {
                        $qlf_elg['is_late_addition'] = 0;
                    }


                    $qlf_dep = array(
                        'request_id'   => $request_id, 
                        'qlfn_type_id' => 13,
                        'qlfn_name'    => $name_test_dp,
                        'qlfn_subject' => $certificate_no,
                        'uni_board'    => $qlfn_subject,
                        'reg_no'       => $reg_no,
                        'year_passing' => $eligib_year,
                        'Month'        => $eligib_month,
                        'Year'         => $eligib_year,
                        'Date'         => $doc_date,
                        'mgrRemarks'   => $mgrRemarks,
                        'created_by '  => $user_id,
                        'created_at'   => $created_date);

                    if ($file_status == 'Open') {
                        $qlf_dep['is_late_addition'] = 1;
                    } else {
                        $qlf_dep['is_late_addition'] = 0;
                    }

                    if ($qualification_id == 3) {
                        $rtn_arr = $qlf_elg;
                    } else if ($qualification_id == 4) {
                        $rtn_arr = $qlf_dep;
                    }
                }
                $data['status'] = true;
                $data['data'] = $rtn_arr;
            } else {
                $data['status'] = false;
                $data['data'] = 'Already Exist';
            }
        } else {
            $data['status'] = false;
            $data['data'] = validation_errors();
        }
        return $data;
    }

    /**
     * Form validation qualification details
     * @return type
     */
    public function validation_qualification_details() {
        $val = $this->ci->form_validation;
        $val->set_rules('qualification', 'Select Qualification', 'trim|xss_clean');
        $val->set_rules('course', 'Select courses', 'trim|xss_clean');
        $val->set_rules('subject', 'Enter optional subject', 'trim|xss_clean');
        $val->set_rules('reg', 'Enter Reg No', 'trim|xss_clean');
        $val->set_rules('university', 'Enter University/Board', 'trim|xss_clean');
        $val->set_rules('year', 'Enter Year Of Passing', 'trim|xss_clean');
        $val->set_rules('percentage', 'Enter % of mark', 'trim|xss_clean');
        $val->set_rules('doc_date', 'doc date', 'trim|xss_clean');
        $val->set_rules('doc_month_yr', 'Month and year of passing', 'trim|xss_clean');
        $val->set_rules('certificate_no', 'certificate no', 'trim|xss_clean');
        $val->set_rules('name_test_dp', 'Name of Test', 'trim|xss_clean');
        $val->set_rules('mgrRemarks', 'Remarks', 'trim|xss_clean');
        return $val;
    }

    /**
     * Upload documents 
     * @param type $request_id
     * @param type $uploadpath
     * @param type $filepath
     * @return type
     */
    function uploadDocuments($request_id, $uploadpath, $filepath) {
        ini_set('upload_max_filesize', '15M');
        ini_set('post_max_size', '20M');
        ini_set('max_input_time', 300);
        ini_set('max_execution_time', 300);

        //print_r($this->ci->session->userdata());die;
        $current_time = date('Y-m-d H:i:s');
        $rqid = $request_id;
        $file_name = $this->get_file_name();
        $fileUps['upload_path'] = $uploadpath;
        $fileUps['allowed_types'] = 'pdf|PDF';
        $fileUps['max_size'] = '10240';
        $fileUps['file_name'] = $file_name;
        $this->ci->load->library('upload', $fileUps);
        $this->ci->upload->initialize($fileUps);
 
        if (isset($_FILES['userfile'])) {
            if ($this->ci->upload->do_upload()) {
                $fileup_return = array('upload_data' => $this->ci->upload->data());
                $uploadedpath = $fileup_return['upload_data']['full_path'];
                $new_file_path = get_document_file_path($request_id).$file_name;
                       // $this->get_file_path($uploadedpath); old- incorret url when project in subfolder
                if (!($uploadedpath)) {
                    $this->ci->session->set_flashdata('message', ' Error in file uploading! ');
                } else {
                    $watermark = addWatermark($new_file_path);
                    $upload_date = date("Y-m-d H:i:s");
                    $uploaded_array = array(
                        "request_id" => $request_id,
                        "file_url" => $new_file_path,
                        "date_of_upload" => $upload_date,
                        "date_of_upload" => $upload_date,
                        "created_by" => $this->ci->session->userdata('user_id'),
                        "created_role" => $this->ci->session->userdata('designation_id'),
                        "date_of_upload" => $current_time,
                        "created_at" => $current_time,
                        "updated_at" => $current_time,
                    );
                    return $uploaded_array;
                }
            } else {
                //     return $this->ci->upload->display_errors();
                $this->ci->session->set_flashdata('message', $this->ci->upload->display_errors());
                return 2;
            }
        } else {
            return 0;
        }
    }

    /**
     * Upload documents for edit
     * @param type $request_id
     * @param type $uploadpath
     * @param type $filepath
     * @return boolean
     */
    function uploadDocuments_edit($request_id, $uploadpath, $filepath) {
        if (isset($_FILES['userfile'])) {
            $this->uploadDocuments($request_id, $uploadpath, $filepath);
        } else {
            return false;
        }
    }

    /**
     * For getting file path
     * @param type $uploadedpath
     * @return type
     */
    function get_file_path($uploadedpath) {
        $path = explode('/', $uploadedpath);
        unset($path[1]);
        unset($path[2]);
        unset($path[3]);
        unset($path[4]);
        $new_file_path = implode('/', $path);
        $new_file_path = ltrim($new_file_path, '/');
        $upload_date = date("Y-m-d H:i:s");
        return $new_file_path;
    }

    /**
     * For getting file name
     * @return type
     */
    function get_file_name() {
        $file_nameF = $_FILES['userfile']['name'];
        $allowedExts = array('pdf', 'PDF');
        $temp = explode(".", $file_nameF);
        $extension = end($temp);
        $text = substr($file_nameF, 0, 50);
        $text = clean($text);
        return $text . '_' . date('Y_d_h_i_s') . '.' . $extension;
    }

    function getDbDate($displaydate) {

        $date = DateTime::createFromFormat('d/m/Y', $displaydate);
        $date = $date->format('Y-m-d');
        return $date;
    }

    function getDisplayDate($dbdate) {
        $date = DateTime::createFromFormat('Y-m-d', $dbdate);
        $date = $date->format('d/m/Y');
        return $date;
    }

}
