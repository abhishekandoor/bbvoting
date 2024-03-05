<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * User_scope
 * 
 * 		Handling User scope dependent sessions
 *  
 * @package		Itchool_rbac
 * @author		Mohamed Rashid C (https://twitter.com/rashivkp)
 * @based on	Tank_Auth 
 */
class Scope_session extends CI_Model {

    private $department_table_name = 'tbl_desig_type'; // 

    function __construct() {
        parent::__construct();
        $ci = & get_instance();
    }
    
    /**
     * geting additional details for department scope user
     * @param int $id
     * 
     */
    function department($id) {
        $this->db->where('type', $id);
        return $this->db->get($this->department_table_name)->row();
    }

}

?>
