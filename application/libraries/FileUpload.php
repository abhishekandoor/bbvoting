<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class FileUpload {

    function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->library('upload');
        $this->ci->load->library('image_lib');
        $this->error = array();
    }

    function uploadImage($photoName, $uploadPath, $field_name = 'userfile') {

        $_FILES[$field_name]['name'] = $photoName . strtolower($this->ci->upload->get_extension($_FILES[$field_name]['name']));
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = "doc|docx|pdf";
        $config['max_size'] = "1000";
        $config['max_width'] = "1500";
        $config['max_height'] = "1500";
        $config['overwrite'] = true;
        //echo $config['upload_path'];
        if (!is_dir($config['upload_path']))
            mkdir($config['upload_path'], 0777, true);

        $this->deletePhoto($photoName, $uploadPath);

        $this->ci->upload->initialize($config);
        if (!$this->ci->upload->do_upload($field_name)) {
            $this->error['message'] = $this->ci->upload->display_errors();
            return false;
        }

        $finfo = $this->ci->upload->data();
        return true;
    }

    function getError() {
        return $this->error;
    }

    function getPhoto($photo, $directory) {

        $exts = array('jpg', 'jpeg', 'gif', 'png');
        foreach ($exts as $ext) {
            if (file_exists($directory . $photo . '.' . $ext)) {
                return $directory . $photo . '.' . $ext;
            }
        }
        return 'photos/img_user_nophoto.png';
    }

    function deletePhoto($photo, $directory) {

        if (substr($directory, -1) !== '/') {
            $directory.="/";
        }
        exec("rm $directory$photo.*");
    }

}
