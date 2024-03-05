<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | Email
  | -------------------------------------------------------------------------
  | This file lets you define parameters for sending emails.
  | Please see the user guide for info:
  |
  |	http://codeigniter.com/user_guide/libraries/email.html
  |     http://biostall.com/resolving-error-with-sending-emails-via-smtp-using-codeigniter/
  |     http://forum.codeigniter.com/thread-44184.html
  |
 */
$config['protocol'] = "smtp";
$config['smtp_host'] = "ssl://mail.kite.kerala.gov.in";//"ssl://smtp.googlemail.com";
$config['smtp_port'] = "465";
$config['smtp_user'] = "samanwaya@kite.kerala.gov.in"; //also valid  Google Apps Accounts
$config['smtp_pass'] = "k1T3@2020";
$config['charset'] = "utf-8";
$config['mailtype'] = "html";
$config['newline'] = "\r\n";


/* End of file email.php */
/* Location: ./application/config/email.php */