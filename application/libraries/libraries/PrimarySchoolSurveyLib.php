<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of primarySchoolSurveyLib
 *
 * @author user
 */
class PrimarySchoolSurveyLib {

    private $tbl_primary_class_room_req_master = 'primary_survey_class_room_req_master';
    private $tbl_primary_class_master = 'primary_survey_class_master';
    private $tbl_primary_class_room_req_dtls = 'primary_survey_class_room_req_dtls';
    private $tbl_primary_itlab_dtls_master = 'primary_survey_itlab_dtls_master';
    private $tbl_primary_itlab_dtls = 'primary_survey_itlab_dtls';
    private $tbl_primary_hwc_dtls = 'primary_survey_hwc_dtls';
    private $tbl_primary_hwc_item_dtl_master = 'primary_survey_hwc_item_dtl_master';
    private $tbl_primary_hwc_item_master = 'primary_survey_hwc_item_master';
    private $tbl_primary_additional_dtls = 'primary_survey_additional_dtls';
    private $tbl_primary_additional_dtl_master = 'primary_survey_additional_dtl_master';
    private $tbl_primary_additional_req_dtls = 'primary_survey_additional_req_dtls';

    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->model('PrimarySchoolSurvey_model', 'PM');
        $this->ci->load->model('PrimarySchoolSurveyReports_model', 'PRM');
    }

    public function get_classroom_details($school_id) {

        $data['cls_room'] = $this->ci->PM->classroom_req_data($school_id);
        $data['class_dtls'] = $this->ci->General->getdata($this->tbl_primary_class_room_req_master, 'cls_room_req_id,cls_room_req', '', 'cls_room_req_id');
        return $data;
    }
public function get_classroom_details_con() {

        $data['cls_room'] = $this->ci->PRM->classroom_req_data();
        $data['class_dtls'] = $this->ci->General->getdata($this->tbl_primary_class_room_req_master, 'cls_room_req_id,cls_room_req', '', 'cls_room_req_id');
        return $data;
    }
    public function get_itemlab_data($school_id) {

        $data['itemdetail'] = $this->ci->PM->get_itemlab_data($school_id);
        return $data;
    }
     public function get_itemlab_data_con() {

        $data['itemdetail'] = $this->ci->PRM->get_itemlab_data();
        return $data;
    }

    public function get_hwc_details($school_id) {

        $data['hwc_details'] = $this->ci->PM->hwc_req_data($school_id);
        $data['hwc_dtls'] = $this->ci->General->getdata($this->tbl_primary_hwc_item_dtl_master, 'hwc_dtl_id,hwc_dtls', '', 'hwc_dtl_id');
        return $data;
    }
      public function get_hwc_details_con() {

        $data['hwc_details'] = $this->ci->PRM->hwc_req_data();
        $data['hwc_dtls'] = $this->ci->General->getdata($this->tbl_primary_hwc_item_dtl_master, 'hwc_dtl_id,hwc_dtls', '', 'hwc_dtl_id');
        return $data;
    }

    public function get_additional_data($school_id) {

        $data['addlnldata'] = $this->ci->PM->get_additional_data($school_id);
        return $data;
    }

    public function save_primary_school_survey($school_id) {


        $val = $this->validation_primary_school_survey();
        if ($val->run()) {

            $data_sch = array('assembly_constituency_id' => $val->set_value('assembly'));
            $data_basic = array('school_id' => $school_id,
                'assembly_constituency_id' => $val->set_value('assembly'),
                'principal_name' => $val->set_value('txtname_principal'),
                'principal_phoneno' => $val->set_value('txtphone_principal'),
                'principal_email' => $val->set_value('txtemail_principal'),
                'smc_name' => $val->set_value('txtname_chairman'),
                'smc_phoneno' => $val->set_value('txtphone_chairman'),
                'smc_email' => $val->set_value('txtemail_chairman'),
                'psitc_name' => $val->set_value('txtname_hitc'),
                'psitc_phoneno' => $val->set_value('txtphone_hitc'),
                'psitc_email' => $val->set_value('txtemail_hitc'));

            $cls = $this->ci->General->getdata($this->tbl_primary_class_master, 'cls_room_id', '', 'cls_room_id');
            $clshd = $this->ci->General->getdata($this->tbl_primary_class_room_req_master, 'cls_room_req_id', '', 'cls_room_req_id');
            foreach ($cls as $rw1) {
                foreach ($clshd as $rw2) {


                    $data_std[] = array('school_id' => $school_id,
                        'cls_room_id' => $rw1['cls_room_id'],
                        'cls_room_req_id' => $rw2['cls_room_req_id'],
                        'room_cnt' => $val->set_value('txtroom_cnt_' . $rw2['cls_room_req_id'] . '_' . $rw1['cls_room_id']),
                    );
                }
            }


            $lab = $this->ci->General->getdata($this->tbl_primary_itlab_dtls_master, 'dtl_id', '', 'dtl_id');
            foreach ($lab as $rw) {
                $data_lab[] = array('school_id' => $school_id,
                    'dtl_id' => $rw['dtl_id'],
                    'quantity' => $val->set_value('no_lab_items_' . $rw['dtl_id']),
                );
            }


            $hwc = $this->ci->General->getdata($this->tbl_primary_hwc_item_master, 'hwc_item_id', '', 'hwc_item_id');
            $hd = $this->ci->General->getdata($this->tbl_primary_hwc_item_dtl_master, 'hwc_dtl_id', '', 'hwc_dtl_id');
            foreach ($hwc as $rw1) {
                foreach ($hd as $rw2) {

                    $data_hwc[] = array('school_id' => $school_id,
                        'hwc_item_id' => $rw1['hwc_item_id'],
                        'hwc_dtl_id' => $rw2['hwc_dtl_id'],
                        'quantity' => $val->set_value('hwcroom_cnt_' . $rw2['hwc_dtl_id'] . '_' . $rw1['hwc_item_id']),
                    );
                }
            }

            $data_adl = array('school_id' => $school_id,
                'total_teachers' => $val->set_value('total_teachers'),
                'handle_ict' => $val->set_value('handle_ict'),
                'shall_equip' => $val->set_value('shall_equip'),
                'wiki_curent_updation' => $val->set_value('wiki_curent_updation'),
                'wiki_updation_by31' => $val->set_value('wiki_updation_by31'),
                'wiki_remarks' => $val->set_value('wiki_remarks'),
                'total_no_intenet' => $val->set_value('total_no_intenet'),
                'sam_curent_updation' => $val->set_value('sam_curent_updation'),
                'sam_updation_by31' => $val->set_value('sam_updation_by31'),
                'sam_remarks' => $val->set_value('sam_remarks'));

            $confirmation_det = $this->ci->PM->save_primary_school_survey($data_sch, $data_basic, $data_std, $data_lab, $data_hwc, $data_adl, $school_id);
            return $confirmation_det;
        } else {
            return validation_errors();
        }
    }

    public function validation_primary_school_survey() {

        $val = $this->ci->form_validation;
        $val->set_error_delimiters('<div class="text-error"> <i class="fa fa-exclamation-triangle"></i> <strong> ', '</strong></div>');
        $val->set_rules('assembly', 'Assembly', 'trim|required|xss_clean|numeric');
        $val->set_rules('txtname_principal', 'Name of Principal', 'customAlpha|xss_clean|trim');
        $val->set_rules('txtphone_principal', 'Phone no. of Principal', 'numeric|xss_clean|trim');
        $val->set_rules('txtemail_principal', 'Email. of Principal', 'xss_clean|trim|valid_email');
        $val->set_rules('txtname_chairman', 'Name of SMC Chairman', 'customAlpha|xss_clean|trim');
        $val->set_rules('txtphone_chairman', 'Phone no. of SMC Chairman', 'numeric|xss_clean|trim');
        $val->set_rules('txtemail_chairman', 'Email.  SMC Chairman', 'xss_clean|trim|valid_email');
        $val->set_rules('txtname_hitc', 'Name of HITC', 'customAlpha|xss_clean|trim');
        $val->set_rules('txtphone_hitc', 'Phone no. of HITC', 'numeric|xss_clean|trim');
        $val->set_rules('txtemail_hitc', 'Email.  of HITC', 'xss_clean|trim|valid_email');

        $cls = $this->ci->General->getdata($this->tbl_primary_class_master, 'cls_room_id', '', 'cls_room_id');
        $clshd = $this->ci->General->getdata($this->tbl_primary_class_room_req_master, 'cls_room_req_id', '', 'cls_room_req_id');
        foreach ($cls as $rw1) {
            foreach ($clshd as $rw2) {
                $val->set_rules('txtroom_cnt_' . $rw2['cls_room_req_id'] . '_' . $rw1['cls_room_id'], 'No. of Present Hi-Tech Classrooms', 'numeric|xss_clean|trim');
            }
        }

        $lab = $this->ci->General->getdata($this->tbl_primary_itlab_dtls_master, 'dtl_id', '', 'dtl_id');
        foreach ($lab as $rw)
            $val->set_rules('no_lab_items_' . $rw['dtl_id'], 'Lab details', 'numeric|xss_clean|trim');


        $hwc = $this->ci->General->getdata($this->tbl_primary_hwc_item_master, 'hwc_item_id', '', 'hwc_item_id');
        $hd = $this->ci->General->getdata($this->tbl_primary_hwc_item_dtl_master, 'hwc_dtl_id', '', 'hwc_dtl_id');
        foreach ($hwc as $rw1) {
            foreach ($hd as $rw2) {
                $val->set_rules('hwcroom_cnt_' . $rw2['hwc_dtl_id'] . '_' . $rw1['hwc_item_id'], 'No. of Present Hi-Tech Classrooms', 'numeric|xss_clean|trim');
            }
        }

        $val->set_rules('total_teachers', 'Total No. of Teachers', 'trim|numeric|xss_clean');
        $val->set_rules('handle_ict', 'Capable of handling ICT enabled classrooms', 'numeric|xss_clean|trim');
        $val->set_rules('shall_equip', 'Shall equip to handle ICT enabled class rooms by 31st December 2016', 'numeric|xss_clean|trim');
        $val->set_rules('wiki_curent_updation', '% of current updation ', 'xss_clean|trim|numeric');
        $val->set_rules('wiki_updation_by31', '% of updation by 31st December', 'numeric|xss_clean|trim');
        $val->set_rules('wiki_remarks', 'Remarks', 'customAlpha|xss_clean|trim');
        $val->set_rules('total_no_intenet', 'Total No. of Computers / laptops where Internet is available in Computer lab', 'numeric|xss_clean|trim');
        $val->set_rules('sam_curent_updation', '% of current updation ', 'numeric|xss_clean|trim');
        $val->set_rules('sam_updation_by31', '% of updation by 31st December', 'numeric|xss_clean|trim');
        $val->set_rules('sam_remarks', 'Remarks', 'customAlpha|xss_clean|trim');

        return $val;
    }

    public function confirm_primary_school_survey($school_id) {

        $data = array('school_id' => $school_id,
            'confirm' => 1);
        $confirmation_dettails = $this->ci->PM->primary_school_survey_confirm($data, $school_id);
        return $confirmation_dettails;
    }

}
