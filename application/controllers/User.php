<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function index()
    {
        $data['user'] = $this->Auth_model->getDatauser();
        $data['act'] = "My Profile";

        $data['title'] = 'Halaman User';
        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('template/admin_footer', $data);
    }
}
