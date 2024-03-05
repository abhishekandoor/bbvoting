<?php

class General extends CI_Model {

    function __construct() {
        parent:: __construct();
    }

    function getdata($table = '', $fields = '*', $where = array(), $order_by = '') {

        if ((is_array($where) && count($where) > 0) or ( !is_array($where) && trim($where) != '')) {
            $this->db->where($where);
        }
        if ($order_by) {
            $this->db->order_by($order_by);
        }
        $this->db->select($fields, FALSE);
        $query = $this->db->get($table);
        return $query->result_array();
    }


    /**
     * to get maximum id from table
     * @param table-name,field-name,conditions if any
     * return max_id
     */
    function get_max_id($table = '', $fields = '', $where = array(), $order_by = '') {
        $this->db->select_max($fields);
        $this->db->where($where);
        $query = $this->db->get($table);
        $id = $query->row()->$fields;
        return $id;
    }

    /***
     * to get manager list for dropdown
     * 
     * @param table-name,fieldname
     * 
     */
    function getDataManager($table = '', $fields = '*',$where, $order_by = '') {

      //  $management_mapped=0;
      $this->db->select('distinct(school_management_id)');
      $this->db->from('users');
      $this->db->where('school_management_id IS NOT NULL');
      $query = $this->db->get();
      if($query->num_rows()>0) {

          $data = $query->result_array();
          $count=0;
          $val=array();
         foreach($data as $dt){
             $val[$count]=$dt['school_management_id'];
             $count++;
         }
          

          
      }
     // print_r($val);exit;

        if ((is_array($where) && count($where) > 0) or ( !is_array($where) && trim($where) != '')) {
            $this->db->where($where);
        }
        $this->db->where_not_in('id',$val);
        if ($order_by) {
            $this->db->order_by($order_by);
        }
        $this->db->select($fields, FALSE);
        $query = $this->db->get($table);
        return $query->result_array();
    }
    /**
     * to update a row inn a table
     * @param table-name,field-name,conditions if any
     * return boolean
     */
    function update($table = '', $fields = array(), $where = array()) {
        $this->db->where($where);
        $this->db->update($table, $fields);
        if ($this->db->affected_rows() > 0)
            return 1;
        else
            return 0;
    }

    /**
     * Delete a row from a table
     * @param table-name,conditions if any
     * return boolean
     */
    function delete($table = '', $where = array()) {
        $this->db->where($where);
        $this->db->delete($table);
        if ($this->db->affected_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }

    /**
     * Select data for dropdown
     * @param table-name,conditions if any
     * return result
     */
    function prepare_select_box_data($table, $fields, $where = array(), $insert_null = false, $order_by = '', $placeholder='Please Select') {

        list($key, $val) = explode(',', $fields);
        $key = trim($key);
        $val = trim($val);
        $order_by = $order_by ? $order_by : $val;
        $input_array = $this->getdata($table, $fields, $where, $order_by);

        $select_box_array = array();
        $total_records = count($input_array);
        if ($insert_null) {
            $select_box_array[] = $insert_null === true ? '' : $insert_null;
        }
        $select_box_array['0'] = $placeholder;
        for ($i = 0; $i < $total_records; $i++) {
            $select_box_array[$input_array[$i][$key]] = $input_array[$i][$val];
        }

        return $select_box_array;
    }

     /**
     * Select data for managementdropdown
     * @param table-name,conditions if any
     * return result
     */
    function prepare_select_box_data_management($table, $fields, $where = array(), $insert_null = false, $order_by = '') {

        list($key, $val) = explode(',', $fields);
        $key = trim($key);
        $val = trim($val);
        $order_by = $order_by ? $order_by : $val;
        $input_array = $this->getDataManager($table, $fields, $where, $order_by);

        $select_box_array = array();
        $total_records = count($input_array);
        if ($insert_null) {
            $select_box_array[] = $insert_null === true ? '' : $insert_null;
        }
        $select_box_array['0'] = 'Please Select';
        for ($i = 0; $i < $total_records; $i++) {
            $select_box_array[$input_array[$i][$key]] = $input_array[$i][$val];
        }

        return $select_box_array;
    }

   

    /**
     * function for dropdown listing
     * return list items
     */
    function dolistDropdown($table, $select, $where, $orderby) {
        //spli select parameters into array
        $params = explode(',', $select);
        $id = $params[0];
        $value = $params[1];

        $this->db->select($id . ',' . $value);

        if ($where != NULL) {
            $this->db->where($where);
        }
        $this->db->order_by($orderby, 'asc');
        $query = $this->db->get($table);

        $list = array();

        if ($query->result()) {
            foreach ($query->result() as $item) {
                $list[$item->$id] = $item->$value;
            }
            $list[0] = 'Please Select';
            return $list;
        } else {
            return FALSE;
        }
    }

    /**
     * function for getting a single column value
     * @param type $table
     * @param type $fields
     * @param type $where
     * @param type $order_by
     * @return type
     */
    function get_column($table = '', $fields = '', $where = array(), $order_by = '') {
        $this->db->select($fields);
        if ((is_array($where) && count($where) > 0) or ( !is_array($where) && trim($where) != '')) {
            $this->db->where($where);
        }
        $query = $this->db->get($table);
        $column = $query->row()->$fields;
        return $column;
    }

    /**
     * function for return a single row
     * @param type $table
     * @param type $fields
     * @param type $where
     * @param type $order_by
     * @return type
     */
    function getrow($table = '', $fields = '*', $where = array(), $order_by = '') {

        if ((is_array($where) && count($where) > 0) or ( !is_array($where) && trim($where) != '')) {
            $this->db->where($where);
        }
        if ($order_by) {
            $this->db->order_by($order_by);
        }
        $this->db->select($fields);
        $query = $this->db->get($table);
        return $query->row();
    }

    /**
     * function for getting listbox values onchange of parent list
     * @param type $table
     * @param type $fields
     * @param type $where
     * @param type $order_by
     * @return boolean|string
     */
    function dynamic_list($table = '', $fields = '*', $where = array()) {
        list($key, $val) = explode(',', $fields);
        $key = trim($key);
        $val = trim($val);

        $this->db->select($fields);
        $this->db->from($table);
        if (!empty($where))
            $this->db->where($where);
        $query = $this->db->get();

        $res = array();

        if ($query->result()) {
            foreach ($query->result() as $response) {
                $res[$response->$key] = $response->$val;
            }
            $res[0] = 'Select';
            return $res;
        } else {
            return FALSE;
        }
    }

    public function get_single_column_value($table, $feild, $where = '') {
        $where = (trim($where) != '') ? ' WHERE ' . $where : '';
        $sql = "SELECT $feild  FROM $table $where";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            foreach ($result AS $value)
                return $value[$feild];
        } else {
            return 0;
        }
    }

    function find_record_exists($table, $field, $where = '') {
        $where = (trim($where) != '') ? ' WHERE ' . $where : '';
        $sql = "SELECT $field   FROM  $table $where";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function is_record_exists($table, $where = '') {
        $where = (trim($where) != '') ? ' WHERE ' . $where : '';
        $sql = "SELECT COUNT(*) AS CNT FROM $table $where";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result[0]['CNT'];
        } else {
            return 0;
        }
    } 

    /**
     * to update a row inn a table
     * @param table-name,field-name,conditions if any
     * return boolean
     */
    function insert($table = '', $fields = array()) {
        $this->db->insert($table, $fields);
        if ($this->db->affected_rows() > 0)
            return 1;
        else
            return 0;
    }
     function prepare_select_box_data_new($table, $fields, $where = array(), $insert_null = false, $order_by = '',$join='') {
/*
        list($key, $val) = explode(',', $fields);
        $key = trim($key);
        $val = trim($val);
 */
        $order_by = $order_by;
        if(count((array)$join)>0){
            $input_array = $this->getdata_new($table, $fields, $where, $order_by,$join);
        }else{
            $input_array = $this->getdata($table, $fields, $where, $order_by);
        }
        $select_box_array = array();
        $total_records = count($input_array);
        if ($insert_null) {
            $select_box_array[] = $insert_null === true ? '' : $insert_null;
        }

        $select_box_array[""] = 'Please Select';
        $select = array_keys($input_array[0]);
        $key = $select[0];
        $val = $select[1];

        for ($i = 0; $i < $total_records; $i++) {
            $select_box_array[$input_array[$i][$key]] = $input_array[$i][$val];
        }

        return $select_box_array;
    }
    
     function getdata_new($table = '', $fields = '*', $where = array(), $order_by = '',$join = array(),$index = '') {

        if ((is_array($where) && count($where) > 0) or ( !is_array($where) && trim($where) != '')) {
            $this->db->where($where);
        }
        if ($order_by) {
            $this->db->order_by($order_by);
        }

        if (is_array($join) && count($join) > 0) {
            foreach ($join as $key => $value) {
                $string = explode(",", $value);
                if (isset($string[2])) {
                    $this->db->join($string[0], $string[1], $string[2]);
                } else {
                    $this->db->join($string[0], $string[1]);
                }
            }
        }
        $this->db->select($fields, FALSE);
        $query = $this->db->get($table);
        if($index == ""){
             return $query->result_array();
        }else{
            $data = array();  $new_data = array();
            $data = $query->result_array();
            foreach($data as $k => $v){
                $new_data[$v[$index]] = $v;
            }
            return $new_data;
        }
        
    }

    function count_schools_under_management($managementid) {
        $this->db->select('count(S.id) AS tot');
        $this->db->from('schools S');
        $this->db->join('school_details SD', 'S.id=SD.school_id');
        $this->db->join('sub_districts_Master AS SB', 'SB.id = S.sub_district_id');
        $this->db->join('master_district AS DM', 'DM.district_code = S.revenue_district_id');
        $this->db->join('edu_district_master AS ED', 'ED.edu_district_code = S.edu_district_id');
        $this->db->join('AASF_Management MG', 'MG.id=' . $managementid);
        $this->db->where('SD.mngment_id', $managementid);
        $query = $this->db->get();
        $result = $query->result_array();
        if (count($result) > 0) {
            return $result[0]['tot'];
        } else {

            return 0;
        }
    }
   public function get_record_count($table, $where = '', $field = '*') {
       if ((is_array($where) && count($where) > 0) or ( !is_array($where) && trim($where) != '')) {
            $this->db->where($where);
        }
         $this->db->select($field.' as CNT');
        $query = $this->db->get($table);
      //  $this->db->select('$feild as CNT');
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            return $result[0]['CNT'];
        } else {
            return 0;
        }
         

         

      
    }
}
?>