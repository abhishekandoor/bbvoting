<?php
class Home extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('General');
    }
    function index(){
        // echo 'helo'; die;
        $data =array();
        $data['contestants'] = $this->General->getdata('contestants','*');

        // $html = '';
        // echo '<pre>'; print_r($data['contestants']); echo '</pre>'; die;
        $this->template->write_view("content",'ml/contestants', $data);
        $this->template->load();
    }
    function results(){
        $data =array();
        $data['contestants'] = $this->General->getdata('contestants','*');
        $this->template->write_view("content",'ml/results', $data);
        $this->template->load();
    }
    function aboutus(){

        $data =array();
        // $data['contestants'] = $this->General->getdata('contestants','*');
        $this->template->write_view("content",'ml/about-us', $data);
        $this->template->load();
        

    }
}