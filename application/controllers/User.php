<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('user_model', 'UserModels');
    // $this->load->helper('NumberFormater', 'num_format');
  }

  public function index()
  {
    $data['title'] = 'RTI Billing System';
    $this->load->view('templates/auth_header', $data);
    $this->load->view('templates/topbar');
    $this->load->view('templates/sidebar');
    $this->load->view('user/index');
    $this->load->view('templates/auth_footer');
  }


  public function invoice()
  {
    $data['invoice'] = $this->db->get('invoice')->result_array();
    $data['title'] = 'Input Invoice | RTI Billing System';
    $data['title_page'] = 'Input Invoice';
    $this->load->view('templates/auth_header', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('user/invoice', $data);
    $this->load->view('templates/auth_footer', $data);
  }


  public function getEdit()
  {
    $data = $this->input->post('id');
    $this->UserModels->getId($data);
    echo json_encode($this->UserModels->getId($data));
  }

  public function updateInvoice()
  {
    $this->form_validation->set_rules('no_invoice', 'No Invoice', 'trim|required', [
      'required' => 'No Invoice Harus Di isi !',
    ]);
    $this->form_validation->set_rules('agen', 'Agen', 'trim|required', [
      'required' => 'Agen Harus Di Isi !',
    ]);

    if ($this->form_validation->run() == false) {
      $data['invoice'] = $this->db->get('invoice')->result_array();
      $data['title'] = 'Input Invoice | RTI Billing System';
      $data['title_page'] = 'Input Invoice';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('user/invoice', $data);
      $this->load->view('templates/auth_footer', $data);
    } else {
      $id = $this->input->post('inv_id');
      $data = [
        'id' => $id,
        'customer' => ucfirst($this->input->post('customer')),
        'agen' => $this->input->post('agen'),
        'selling' => $this->input->post('selling'),
        'ppn' => $this->input->post('ppn'),
        'buying' => $this->input->post('buying'),
        'diskon_customer' => $this->input->post('diskon_customer'),
        'keterangan' => $this->input->post('keterangan'),
        'margin' => $this->input->post('margin'),
        'no_invoice' => $this->input->post('no_invoice'),
        'updated_at' => time()
      ];
      $this->db->set($data);
      $this->db->where('id', $id);
      $this->db->update('invoice');
      $this->session->set_flashdata('message', '<div class="alert alert-success text-capitalize" role="alert">Berhasil Edit Data </div>');
      redirect('user/invoice');
    }
  }

  public function getDel()
  {
    $data = $this->input->post('inv_id');
    $this->UserModels->deleteInv($data);
    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Your data has been remove!</div>');
    redirect('user/invoice');
  }

  public function insert_inv()
  {
    $this->form_validation->set_rules('no_invoice', 'No Invoice', 'trim|required', [
      'required' => 'No Invoice Harus Di isi !',
    ]);
    $this->form_validation->set_rules('agen', 'Agen', 'trim|required', [
      'required' => 'Agen Harus Di Isi !',
    ]);
    $this->form_validation->set_rules('customer', 'Customer', 'trim|required|regex_match[/([A-Za-z0-9])/]', [
      'required' => 'Agen Harus Di Isi !',
      'regex_match' => 'Data yang Masuk Hanya Berupa Huruf Dan Angka'
    ]);

    if ($this->form_validation->run() == false) {
      $data['invoice'] = $this->db->get('invoice')->result_array();
      $data['title'] = 'Input Invoice | RTI Billing System';
      $data['title_page'] = 'Input Invoice';
      $this->load->view('templates/auth_header', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('user/invoice', $data);
      $this->load->view('templates/auth_footer', $data);
    } else {

      $customer = ucfirst($this->input->post('customer'));
      $agen = ucfirst($this->input->post('agen'));
      $agen_data = [
        'agen' => ucfirst($this->input->post('agen'))
      ];
      $data_cust = [
        'cust_name' => $customer
      ];
      $data = [
        'customer' => $customer,
        'agen' => $agen,
        'selling' => $this->input->post('selling'),
        'ppn' => $this->input->post('ppn'),
        'buying' => $this->input->post('buying'),
        'diskon_customer' => $this->input->post('diskon_customer'),
        'diskon_marketing' => $this->input->post('diskon_marketing'),
        'keterangan' => $this->input->post('keterangan'),
        'margin' => $this->input->post('margin'),
        'no_invoice' => $this->input->post('no_invoice'),
        'created_at' => time(),
        'updated_at' => time()
      ];
      $chack_customer = $this->db->get_where('customer_name', ['cust_name' => $customer])->result_array();
      $chack_agen = $this->db->get_where('agen_name', ['agen' => $agen])->result_array();
      if ($chack_customer == true && $chack_agen == true) {
        $this->db->insert('invoice', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success text-capitalize" role="alert">Berhasil Tambah Data Dengan Nama Customer ' . $this->input->post('customer') . ' </div>');
        redirect('user/invoice');
      } elseif ($chack_agen == true) {
        $this->db->insert('customer_name', $data_cust);
        $this->db->insert('invoice', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success text-capitalize" role="alert">Berhasil Tambah Data Dengan Nama Customer ' . $this->input->post('customer') . ' </div>');
        redirect('user/invoice');
      } elseif ($chack_customer == true) {
        $this->db->insert('agen_name', $agen_data);
        $this->db->insert('invoice', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success text-capitalize" role="alert">Berhasil Tambah Data Dengan Nama Customer ' . $this->input->post('customer') . ' </div>');
        redirect('user/invoice');
      } else {
        $this->db->insert('customer_name', $data_cust);
        $this->db->insert('agen_name', $agen_data);
        $this->db->insert('invoice', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success text-capitalize" role="alert">Berhasil Tambah Data Dengan Nama Customer ' . $this->input->post('customer') . ' </div>');
        redirect('user/invoice');
      }
    }
  }
}
