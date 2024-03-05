<?php

/**
 * Control panel controller
 *  
 */
class Control_Panel extends MY_User {

    /**
     * @var string folder name contain the view files for the current controller
     */
    private $fview = "secured_user/control_panel";

    /**
     * @var table name of menu
     */
    private $table_menu = 'cp_menu';

    /**
     * @var table name of submenu
     */
    private $table_submenu = 'cp_submenu';

    /**
     * @var table name of news
     */
    private $table_news = 'cp_news';
    /**
     * @var table name of circulars
     */
    private $table_circular = 'cp_circulars_downloads';

    function __construct() {
        parent::__construct();
        $this->load->library('tank_auth');
        $this->load->library('AdminLib');
        

        $this->load->library('FileUpload');
        // check the user is authenticated to access this group
        $this->itschool_rbac->has_permission(__CLASS__);
        $this->load->model('Control_Panel_Model', 'CPM');
        $this->load->model('General');
    }

    /**
     * index page for Control_Panel
     */
    function index() {
        
    }

    /**
     * Create menus and submenus in public viewable pages
     */
    function create_menu() {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $this->load->library('form_validation');
        $data['errors'] = array();
        $this->form_validation->set_error_delimiters('<div class="text-error"> <i class="fa fa-exclamation-triangle"></i> <strong> ', '</strong></div>');

        //Check whether need to add a submenu
        if ($this->input->post('submenu') == 0) { //add menu without Submenu
            $this->form_validation->set_rules('menuname', 'Menu name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('purpose', 'Purpose', 'callback_purpose_check');

            //check whether form validation is true
            if ($this->form_validation->run() == true) {
                //get maximum id from menu table
                $menu_id = $this->General->get_max_id($this->table_menu, 'menu_id') + 1;

                //Check whether the menu item is a file or url
                if ($_FILES['action_selected']['name']) {
                    $uploadDirectory = 'assets/menu_docs';
                    $userfile_extn = explode(".", strtolower($_FILES['action_selected']['name']));
                    $file_name = $menu_id . '.' . $userfile_extn[1];

                    if ($this->fileupload->uploadImage($menu_id, $uploadDirectory, 'action_selected')) {
                        $this->CPM->do_create_menu($menu_id, $file_name);
                        $this->session->set_flashdata('flashSuccess', 'Menu Created.');
                        redirect($this->uri->uri_string());
                    } else {
                        $error = $this->fileupload->getError();
                        $this->template->write('error', $error['message']);
                    }
                } else {
                    $this->CPM->do_create_menu($menu_id, $this->input->post('address'));
                    $this->session->set_flashdata('flashSuccess', 'Menu Created.');
                    redirect($this->uri->uri_string());
                }
            }
        } else if ($this->input->post('submenu') == 1) { //Add a menu with submenu
            $this->form_validation->set_rules('submenuname', 'Submenu name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('menuname', 'Menu name', 'trim|required|xss_clean');

            //check whether form validation is true
            if ($this->form_validation->run() == true) {
                //get maximum id from submenu table
                $menu_id = $this->General->get_max_id($this->table_submenu, 'sub_menu_id') + 1;

                //Check whether the menu item is a file or url
                if ($_FILES['action_selected']['name']) {
                    $uploadDirectory = 'assets/smenu_docs';
                    $userfile_extn = explode(".", strtolower($_FILES['action_selected']['name']));
                    $file_name = $menu_id . '.' . $userfile_extn[1];

                    if ($this->fileupload->uploadImage($menu_id, $uploadDirectory, 'action_selected')) {
                        $this->CPM->do_create_menu_withsubmenu($menu_id, $file_name);
                        $this->session->set_flashdata('flashSuccess', 'Menu Created.');
                        redirect($this->uri->uri_string());
                    } else {
                        $error = $this->fileupload->getError();
                        $this->template->write('error', $error['message']);
                    }
                } else {
                    $this->CPM->do_create_menu_withsubmenu($menu_id, $this->input->post('address'));
                    $this->session->set_flashdata('flashSuccess', 'Menu Created.');
                    redirect($this->uri->uri_string());
                }
            }
        }
        $data['menus'] = $this->CPM->do_list_menu(); //Fetch Main menu Items From The databse
        $this->template->add_js('assets/secured_user/js/cp.js');
        $this->template->write_view('content', $this->fview . "/create_menu", $data);
        $this->template->load();
    }

    /**
     * Create Submenus Under Various Menu Items
     */
    function add_submenu() {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $data['errors'] = array();
        $this->form_validation->set_error_delimiters('<div class="text-error"> <i class="icon-warning-sign"></i> <strong> ', '</strong></div>');
        $id = $this->uri->segment(3);
        if (isset($_POST['create_submenu'])) {
            $this->form_validation->set_rules('submenuname', 'Menu name', 'trim|required|xss_clean');
            if ($this->form_validation->run() == true) {
                $menu_id = $this->General->get_max_id($this->table_submenu, 'sub_menu_id') + 1;
                $menu_name = $this->input->post('submenuname');
                $type = $this->input->post('sub_purpose');
                $addres = $this->input->post('action_selected');
                $result = $this->CPM->do_add_submenu($menu_id, $id, $menu_name, $type, $addres);
                $this->session->set_flashdata('flashSuccess', 'Menu Added.');
                redirect($this->uri->uri_string());
            }
        }
        $data = $this->CPM->do_get_submenu($id); //Getting List Of Submenu Items Corresponding to the Id
        $content['submenus'] = $data;
        $content['parent_id'] = $id; //Passing Parent Menu Id To The Submenu View Page
        $this->template->add_js('assets/secured_user/js/cp.js');
        $this->template->write_view('content', $this->fview . "/add_submenu", $content);
        $this->template->load();
    }

    /**
     * Menu Purpose Validation Error Check
     */
    public function purpose_check() {
        if ($this->input->post('purpose') == '') {
            $this->form_validation->set_message('purpose_check', 'Select Purpose');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     * Delete Menu
     * @param  $id menu
     */
    function delete_menu() {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $id = $this->uri->segment(3);
        $result = $this->CPM->do_delete_menu($id);
        $this->session->set_flashdata('flashSuccess', 'Menu Deleted.');
        redirect('Control_Panel/create_menu');
    }

    /**
     * Edit Menu
     * @param  $id menu
     */
    function edit_menu() {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $id = $this->uri->segment(3);
        if (isset($_POST['update'])) {
            $this->form_validation->set_rules('menuname', 'Menu name', 'trim|required|xss_clean');
            if ($this->form_validation->run() == true) {
                $name = $this->input->post('menuname');
                if (isset($_POST['url_address'])) {
                    $address = $this->input->post('url_address');
                    $upd = array('menu_name' => $name, 'url' => $address);
                } else
                    $upd = array('menu_name' => $name);
                $cond = array('menu_id' => $id);
                $this->General->update('cp_menu', $upd, $cond);
                $this->session->set_flashdata('flashSuccess', 'Menu Updated.');
                redirect($this->uri->uri_string());
            }
        }
        $where = array('menu_id' => $id);
        $content['data'] = $this->General->getdata('cp_menu', '*', $where);
        $content['id'] = $id;
        $this->template->write_view('content', $this->fview . "/edit_menu", $content);
        $this->template->load();
    }

    /**
     * Edit Sub Menu
     * @param  $id menu
     */
    function edit_sub_menu() {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $id = $this->uri->segment(3);
        if (isset($_POST['update'])) {
            $this->form_validation->set_rules('menuname', 'Menu name', 'trim|required|xss_clean');
            if ($this->form_validation->run() == true) {
                $name = $this->input->post('menuname');
                if (isset($_POST['url_address'])) {
                    $address = $this->input->post('url_address');
                    $upd = array('sub_menu_name' => $name, 'url' => $address);
                } else
                    $upd = array('sub_menu_name' => $name);
                $cond = array('sub_menu_id' => $id);
                $this->General->update('cp_submenu', $upd, $cond);
                $this->session->set_flashdata('flashSuccess', 'Menu Updated.');
                redirect($this->uri->uri_string());
            }
        }
        $where = array('sub_menu_id' => $id);
        $content['data'] = $this->General->getdata('cp_submenu', '*', $where);
        $content['id'] = $id;
        $this->template->write_view('content', $this->fview . "/edit_sub_menu", $content);
        $this->template->load();
    }

    /**
     * Delete SubMenu
     * @param  $id menu
     */
    function delete_submenu() {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $id = $this->uri->segment(3);
        $where = array('sub_menu_id' => $id);
        $result = $this->General->delete($this->table_submenu, $where);
        $this->session->set_flashdata('flashSuccess', 'Menu Deleted.');
        redirect('Control_Panel/create_menu');
    }

    /**
     * Add News & events
     * 
     */
    function add_news() {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $this->form_validation->set_rules('news_description', 'News', 'trim|required|xss_clean');
        if ($this->form_validation->run() == true) {
            $news_id = $this->General->get_max_id($this->table_news, 'news_id') + 1;
            if ($_FILES['action_selected']['name']) {
                $uploadDirectory = 'assets/docs';
                $userfile_extn = explode(".", strtolower($_FILES['action_selected']['name']));
                $file_name = $news_id . '.' . $userfile_extn[1];

                if ($this->fileupload->uploadImage($news_id, $uploadDirectory, 'action_selected')) {
                    $this->CPM->do_add_news($news_id, $file_name);
                    $this->session->set_flashdata('flashSuccess', 'News / Event Added.');
                    redirect($this->uri->uri_string());
                } else {
                    $error = $this->fileupload->getError();
                    $this->template->write('error', $error['message']);
                }
            } else {
                $this->CPM->do_add_news($news_id, $this->input->post('action_selected'));
                $this->session->set_flashdata('flashSuccess', 'News / Event Added.');
                redirect($this->uri->uri_string());
            }
        }
        $content['prio'] = $this->General->get_max_id($this->table_news, 'priority') + 1;
        $content['news'] = $this->General->getdata($this->table_news, '*', '', 'priority');
        $this->template->add_js('assets/secured_user/js/cp.js');
        $this->template->write_view('content', $this->fview . "/add_news", $content);
        $this->template->load();
    }
    /**
     * Add Circulars & downloads
     * 
     */
    function create_circulars() {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $this->form_validation->set_rules('news_description', 'News', 'trim|required|xss_clean');
        if ($this->form_validation->run() == true) {
            $news_id = $this->General->get_max_id($this->table_circular, 'news_id') + 1;
            if ($_FILES['action_selected']['name']) {
                $uploadDirectory = 'assets/docs';
                $userfile_extn = explode(".", strtolower($_FILES['action_selected']['name']));
                $file_name = $news_id . '.' . $userfile_extn[1];

                if ($this->fileupload->uploadImage($news_id, $uploadDirectory, 'action_selected')) {
                    $this->CPM->do_add_circulars($news_id, $file_name);
                    $this->session->set_flashdata('flashSuccess', 'Circular / Event Added.');
                    redirect($this->uri->uri_string());
                } else {
                    $error = $this->fileupload->getError();
                    $this->template->write('error', $error['message']);
                }
            } else {
                $this->CPM->do_add_circulars($news_id, $this->input->post('action_selected'));
                $this->session->set_flashdata('flashSuccess', 'Circular / Event Added.');
                redirect($this->uri->uri_string());
            }
        }
        
         /* Bread crum */
        $this->breadcrumbcomponent->add('Add Circular/Downloads', base_url() . 'index.php/Control_Panel/create_circulars');
        $breadcrumb['breadcrumb'] = $this->breadcrumbcomponent->output();
        $breadcrumb['title'] = 'Add Circular/Downloads';
        $this->template->write_view('content', "/breadcrumb", $breadcrumb);
        /* End Bread crum */
        
        $content['prio'] = $this->General->get_max_id($this->table_circular, 'priority') + 1;
        $content['news'] = $this->General->getdata($this->table_circular, '*', '', 'priority');
        $this->template->add_js('assets/secured_user/js/cp.js');
        $this->template->write_view('content', $this->fview . "/add_circular", $content);
        $this->template->load();
    }

    /**
     * Edit News & events
     * @param news-id
     */
    function edit_news($news_id = '') {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $this->form_validation->set_rules('news_description', 'News', 'trim|required|xss_clean');
        $this->form_validation->set_rules('priority', 'Priority', 'trim|required|xss_clean');
        if ($this->form_validation->run() == true) {
            $result = $this->CPM->do_edit_news($news_id);
            if ($result == 1)
                $this->session->set_flashdata('flashSuccess', 'News / Event Updated.');
            else if ($result == 0)
                $this->session->set_flashdata('flashError', 'Operation Failed! Try Again.');
            redirect($this->uri->uri_string());
        }
        $where = array('news_id' => $news_id);
        $content['edit_news'] = $this->General->getdata($this->table_news, '*', $where);
        $content['news_id'] = $news_id;
        $this->template->write_view('content', $this->fview . "/edit_news", $content);
        $this->template->load();
    }

    /**
     * Delete News & events
     * @param news-id
     */
    function delete_news($id = '') {
        $this->itschool_rbac->has_permission(__CLASS__, array('admin'));
        $where = array('news_id' => $id);
        $result = $this->General->delete($this->table_news, $where);
        $this->session->set_flashdata('flashSuccess', 'News / Event Deleted.');
        redirect('Control_Panel/add_news');
    }

}

?>
