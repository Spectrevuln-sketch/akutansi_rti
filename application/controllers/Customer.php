<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('user_model', 'UserModels');
  }
  /* Get View Customer Filtered */
  public function index()
  {
    $data['invoice'] = $this->UserModels->get_cust_join();
    $data['title'] = 'Customer Filtered | RTI Billing System';
    $data['title_page'] = '<marquee>Filter By Customer</marquee>';
    $this->load->view('templates/auth_header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('customer/index', $data);
    $this->load->view('templates/auth_footer', $data);
  }
  /* End Get View Customer Filtered */
  /* Update Data Customer Name */
  public function UpdateCustomer()
  {

    $this->form_validation->set_rules('cust_id', 'CustID', 'trim|required|regex_match[/([a-zA-Z0-9])/]', [
      'required' => 'Customer Harus Di Isi !',
      'regex_match' => 'Data Yang Masuk Harus Berupa Angka Dan Huruf Tidak Boleh Symbol !',
    ]);
    if ($this->form_validation->run() == false) {
      $data['invoice'] = $this->db->get('invoice')->result_array();
      $data['title'] = 'Customer Filtered | RTI Billing System';
      $data['title_page'] = '<marquee>Filter By Customer</marquee>';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('customer/index', $data);
      $this->load->view('templates/auth_footer', $data);
    } else {
      $customer = $this->input->post('customer_name');
      $id = $this->input->post('cust_id');
      $data = [
        'id' => $id,
        'cust_name' => $customer,
      ];
      $this->db->set($data);
      $this->db->where('id', $id);
      $this->db->update('customer_name');
      $this->session->set_flashdata('message', '<div class="alert alert-success text-capitalize" role="alert">Berhasil Edit Data Customer</div>');
      redirect('customer');
    }
  }

  /* End Update Data Customer Name */

  /* Delete Customer */
  public function getDelCust()
  {
    $data = $this->input->post('inv_id');
    $this->UserModels->delete_cust($data);
    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your data customer has been remove!</div>');
    redirect('customer');
  }
  /* End Delete Customer */

  /* Get Data From Ajax */
  public function getRenderTable()
  {
    $data = $this->input->post('id');
    $this->UserModels->get_cust_id($data);
    echo json_encode($this->UserModels->get_cust_id($data));
  }
  /* End Get Data From Ajax */

  /* Load View Customer Filltered */
  public function filter_by_customer($Customer)
  {
    $data['invoice'] = $this->db->get_where('customer_name', ['cust_name' => $Customer])->result_array();
    $data['title'] = 'Customer Filtered | RTI Billing System';
    $data['title_page'] = $this->uri->segment(3);
    $this->load->view('templates/auth_header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('customer/viewCustomer', $data);
    $this->load->view('templates/auth_footer', $data);
  }
  /* End Load View Customer Filltered */
}
