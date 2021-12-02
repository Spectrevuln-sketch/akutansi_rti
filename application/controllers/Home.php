<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
  }




  public function index()
  {
    if ($this->session->userdata('email')) {
      redirect('user');
    }
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'trim|required');
    if ($this->form_validation->run() == false) {
      $data['title'] = 'RTI Billing System';
      $this->load->view('templates/header', $data);
      $this->load->view('page/login');
      $this->load->view('templates/footer');
    } else {
      $this->_login();
    }
  }

  public function register()
  {
    if ($this->session->userdata('email')) {
      redirect('user');
    }
    $this->form_validation->set_rules('name', 'Name', 'required|trim');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
      'is_unique' => 'Email Telah Terdaftar !'
    ]);
    $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]|matches[password1]', [
      'min_length' => 'Password Minimal 5 Karakter !',
      'matches' => 'Password Tidak Sama !'
    ]);
    $this->form_validation->set_rules('password1', 'Password1', 'required|trim|matches[password]', [
      'matches' => 'Password Tidak Sama !'
    ]);
    $this->form_validation->set_rules('phone', 'Phone', 'required|trim|numeric');


    if ($this->form_validation->run() == FALSE) {
      $data['title'] = 'RTI Billing System';
      $this->load->view('templates/header', $data);
      $this->load->view('page/login');
      $this->load->view('templates/footer');
    } else {



      $password1 = $this->input->post('password', true);
      $data = [
        'name' => htmlspecialchars($this->input->post('name', true)),
        'email' => htmlspecialchars($this->input->post('email', true)),
        'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        'phone' => $this->input->post('phone'),
        'is_active' => 1,
        'role_id' => 2
      ];
      $data2 = [
        'name' => htmlspecialchars($this->input->post('name', true)),
        'email' => htmlspecialchars($this->input->post('email', true)),
        'password' => htmlspecialchars($password1),
        'phone' => $this->input->post('phone')
      ];
      $this->db->insert('user', $data);
      $this->db->insert('user_backup', $data2);

      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been created. Please activate your account</div>');
      redirect('home');
    }
  }

  private function _login()
  {
    $email = $this->input->post('email');
    $password = $this->input->post('password');

    $user = $this->db->get_where('user', ['email' => $email])->row_array();
    if ($user) {
      if ($user['is_active'] == 1) {
        if (password_verify($password, $user['password'])) {
          // simpan data ke session
          $data = [
            'email' => $user['email'],
            'password' => $user['password']
          ];

          $this->session->set_userdata($data);
          if ($user['role_id'] == 1) {
            redirect('admin');
          } else {
            redirect('user');
          }
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong password!</div>');
          redirect('home');
        }
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This email has not been activated!</div>');
        redirect('home');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>');
      redirect('home');
    }
  }
}
