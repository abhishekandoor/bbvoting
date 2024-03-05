<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CacheManage extends CI_Controller {

	public function __construct() {
                parent::__construct();
                
        }
        public function clear_all_cache()
        {
            if($this->session->userdata('user_type') == "ITADMIN"){
                $CI =& get_instance();
                $path = $CI->config->item('cache_path');

                $cache_path = ($path == '') ? APPPATH.'cache/' : $path;

                $handle = opendir($cache_path);

                while (($file = readdir($handle))!== FALSE) 
                {
                    //Leave the directory protection alone
                    if ($file != '.htaccess' && $file != 'index.html')
                    {
                       @unlink($cache_path.'/'.$file);
                    }
                }
                closedir($handle); 
                echo "Cleared all cache..";
            }
        }
        
         public function clear_all_logs()
        {
            if($this->session->userdata('user_type') == "ITADMIN"){
                $CI =& get_instance();
                $path = $CI->config->item('log_path');

                $log_path = ($path == '') ? APPPATH.'logs/' : $path;

                $handle = opendir($log_path);

                while (($file = readdir($handle))!== FALSE) 
                {
                    //Leave the directory protection alone
                    if ($file != '.htaccess' && $file != 'index.html')
                    {
                       @unlink($log_path.'/'.$file);
                    }
                }
                closedir($handle); 
                echo "Cleared all logs..";
            }
        }

}
?>
