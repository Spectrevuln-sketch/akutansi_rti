<?php
defined('BASEPATH') or exit('No direct script access allowed');

class license extends CI_Controller
{
  public function index()
  {
    $this->load->helper('download');
    force_download('license.txt', null);
  }
}
