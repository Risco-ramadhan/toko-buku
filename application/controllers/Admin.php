<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $data = $this->session->userdata('role_id');
        if ($data != 1) {
            redirect('auth');
        }
        $this->load->library('image_lib');
        $this->load->model('M_Barang');
    }

    public function index()
    {
        // $data = $this->session->userdata();
        // dd($data);

        $data['user'] = $this->Auth_model->getDatauser();
        $data['title'] = 'Halaman Admin';
        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/admin_footer', $data);
    }

    public function produk()
    {
        $data['buku'] = $this->M_Barang->showBuku();
        $data['kategori'] = $this->M_Barang->getKategori();
        $data['user'] = $this->Auth_model->getDatauser();
        $data['title'] = 'Halaman Admin';
        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/produk', $data);
        $this->load->view('template/admin_footer', $data);
    }
    public function Addproduk()
    {
        $data['user'] = $this->Auth_model->getDatauser();
        $data['kategori'] = $this->M_Barang->getKategori();

        $data['title'] = 'Halaman Admin';
        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/tambahproduk', $data);
        $this->load->view('template/admin_footer', $data);
    }

    public function storeProduk()
    {
        $config['upload_path']          = './uploads/foto/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 10000;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('BarangImage')) {
            $data['error'] = $this->upload->display_errors();
            redirect('admin/produk');
        } else {
            $this->upload->do_upload('BarangImage');
            $file2 = $this->upload->data();
            $imgdata2 = file_get_contents($file2['full_path']);
            $file_encode2 = base64_encode($imgdata2);
            $data['gambarProduk'] = $file_encode2;
            $data = array(
                'BarangNama' => $this->input->post('BarangNama'),
                'BarangStok' => $this->input->post('BarangStok'),
                'BarangHarga' => $this->input->post('BarangHarga'),
                'BarangImage' => $file_encode2,
                'BarangDeskripsi' => $this->input->post('BarangDeskripsi'),
                'BarangKategori' => $this->input->post('BarangKategori'),
            );
            $this->M_Barang->insetBarang($data);
        }

        $files = glob('./uploads/foto/' . '*');
        foreach ($files as $file) {
            if (is_file($file))
                unlink($file);
        }
        redirect('admin');
    }


    public function destroyBarang($id)
    {
        $this->M_Barang->deleteBarang($id);
        $this->session->set_flashdata('message', '<div class= "alert alert-danger" role= "alert">Data Berhasil Dihapus! </div>');
        redirect('admin/produk');
    }

    public function editBarang($id)
    {
        $config['upload_path']          = './uploads/foto/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 10000;
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('BarangImage')) {
            // $data['error'] = $this->upload->display_errors();
            // dd($data['error']);

            $data = array(
                'BarangNama' => $this->input->post('BarangNama'),
                'BarangStok' => $this->input->post('BarangStok'),
                'BarangHarga' => $this->input->post('BarangHarga'),
                'BarangDeskripsi' => $this->input->post('BarangDeskripsi'),
                'BarangKategori' => $this->input->post('BarangKategori'),
            );
            $this->M_Barang->updateBarang($id, $data);
        } else {
            $this->upload->do_upload('BarangImage');
            $file2 = $this->upload->data();
            $imgdata2 = file_get_contents($file2['full_path']);
            $file_encode2 = base64_encode($imgdata2);
            $data['gambarProduk'] = $file_encode2;
            $data = array(
                'BarangNama' => $this->input->post('BarangNama'),
                'BarangStok' => $this->input->post('BarangStok'),
                'BarangHarga' => $this->input->post('BarangHarga'),
                'BarangImage' => $file_encode2,
                'BarangDeskripsi' => $this->input->post('BarangDeskripsi'),
                'BarangKategori' => $this->input->post('BarangKategori'),
            );
            $this->M_Barang->updateBarang($id, $data);
        }

        $this->session->set_flashdata('message', '<div class= "alert alert-success" role= "alert">Data Berhasil diedit! </div>');
        redirect('admin/produk');
    }

    public function pesanan()
    {
        $data['Pesanan'] = $this->M_Barang->GetPesananAll();
        // dd($data);


        $data['user'] = $this->Auth_model->getDatauser();
        $data['title'] = 'Halaman Admin';
        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/pesanan', $data);
        $this->load->view('template/admin_footer', $data);
    }
    public function detailPesanan($idOrder)
    {
        $data['detailPesanan'] = $this->M_Barang->getDetailPesanan($idOrder);
        // dd($data);


        $data['user'] = $this->Auth_model->getDatauser();
        $data['title'] = 'Halaman Admin';
        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/detailPesanan', $data);
        $this->load->view('template/admin_footer', $data);
    }

    public function updatePesanan($status, $invoice)
    {
        $status = str_replace('%20', ' ', $status);
        $data['PesananStatus'] = $status;
        $this->M_Barang->updateStatusPesanan($data, $invoice);
        redirect('admin/pesanan');
    }

    public function addKategori()
    {
        $data = $this->input->post();
        $this->M_Barang->insertKategori($data);
        redirect('admin/kategori');
    }
    public function editKategori($id)
    {
        $data = $this->input->post();
        $this->M_Barang->updateKategori($data, $id);
        redirect('admin/kategori');
    }
    public function destroyKategori($id)
    {
        $this->M_Barang->deleteKategori($id);
        redirect('admin/kategori');
    }
    public function kategori()
    {
        $data['kategori'] = $this->M_Barang->getKategori();
        // dd($data);


        $data['user'] = $this->Auth_model->getDatauser();
        $data['title'] = 'Halaman Admin';
        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/kategori', $data);
        $this->load->view('template/admin_footer', $data);
    }

    public function kelolaUser()
    {
        $data['user'] = $this->Auth_model->getDatauser();
        $data['datauser'] = $this->Auth_model->allUser();
        $data['role'] = $this->Auth_model->getRole();

        // dd($data);
        $data['title'] = 'Halaman Admin';
        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/user', $data);
        $this->load->view('template/admin_footer', $data);
    }

    public function deleteuser($id)
    {
        // dd($id);
        $this->Auth_model->deleteuser($id);
        $this->session->set_flashdata('message', '<div class= "alert alert-danger" role= "alert">Data Berhasil Dihapus </div>');
        redirect('admin/kelolauser');
    }

    public function edituser()
    {

        $this->form_validation->set_rules('Email', 'Email', 'required');
        if ($this->form_validation->run() == false) {
            $data['user'] = $this->Auth_model->getDatauser();
            $data['datauser'] = $this->Auth_model->allUser();
            $data['title'] = 'Kelola User';
            $this->load->view('template/admin_header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('admin/user', $data);
            $this->load->view('template/admin_footer', $data);
        } else {

            $email = $this->input->post('Email');
            $name = $this->input->post('name');
            $oldNIm = $this->input->post('oldid');

            $role = $this->input->post('role');
            $data = array(
                'name' => $name,
                'email' => $email,
                'role_id' => $role
            );

            $this->Auth_model->editAdmin($oldNIm, $data);
            $this->session->set_flashdata('message', '<div class= "alert alert-success" role= "alert">Data Berhasil Diubah </div>');
            redirect('admin/kelolauser');
        }
    }
}
