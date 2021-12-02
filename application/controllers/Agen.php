<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agen extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('user_model', 'UserModels');
  }

  /* Get View Agen */
  public function index()
  {
    $data['agen'] = $this->UserModels->get_agen_join();
    $data['title'] = 'Agen Filtered | RTI Billing System';
    $data['title_page'] = '<marquee>Filter By Agen</marquee>';
    $this->load->view('templates/auth_header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('agen/index');
    $this->load->view('templates/auth_footer', $data);
  }
  /* End Get View Agen */

  /* Get Data From Ajax Populate */
  public function get_populate_agen()
  {
    $data = $this->input->post('id');
    $this->UserModels->get_agen_id($data);
    echo json_encode($this->UserModels->get_agen_id($data));
  }
  /* End Get Data From Ajax Populate */

  /* Update Agen Data */
  public function update_agen()
  {

    $this->form_validation->set_rules('agen_id', 'AgenID', 'trim|required|regex_match[/([a-zA-Z0-9])/]', [
      'required' => 'Agen Harus Di Isi !',
      'regex_match' => 'Data Yang Masuk Harus Berupa Angka Dan Huruf Tidak Boleh Symbol !',
    ]);

    $this->form_validation->set_rules('agen_name', 'agenName', 'trim|required|regex_match[/([a-zA-Z0-9])/]', [
      'required' => 'Agen Harus Di Isi !',
      'regex_match' => 'Data Yang Masuk Harus Berupa Angka Dan Huruf Tidak Boleh Symbol !',
    ]);
    if ($this->form_validation->run() == false) {
      $data['agen'] = $this->db->get('agen_name')->result_array();
      $data['title'] = 'Agen Filtered | RTI Billing System';
      $data['title_page'] = '<marquee>Filter By Agen</marquee>';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('agen/index', $data);
      $this->load->view('templates/auth_footer', $data);
    } else {
      $agen = $this->input->post('agen_name');
      $id = $this->input->post('agen_id');

      $data = [
        'id' => $id,
        'agen' => $agen,
      ];
      $this->db->set($data);
      $this->db->where('id', $id);
      $this->db->update('agen_name');
      $this->session->set_flashdata('message', '<div class="alert alert-success text-capitalize" role="alert">Berhasil Edit Data Agen</div>');
      redirect('agen');
      /* End Update Agen Data */
    }
  }

  /* Delete Data Agen name */

  public function filter_by_agen($agen)
  {
    $data['agen'] = $this->db->get_where('agen_name', ['agen' => $agen])->result_array();
    $data['title'] = 'Customer Filtered | RTI Billing System';
    $data['title_page'] = $this->uri->segment(3);
    $this->load->view('templates/auth_header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('agen/viewAgen', $data);
    $this->load->view('templates/auth_footer', $data);
  }




  public function get_agen_del()
  {
    $data = $this->input->post('agen_id');
    $this->UserModels->delete_agen($data);
    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your data Agen has been remove!</div>');
    redirect('agen');
  }

  /* End Delete Data Agen name*/
}
