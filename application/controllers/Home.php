<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Barang');
    }


    public function index()
    {
        $data['keranjang'] = $this->keranjangIsi();
        $data['kategori'] = $this->M_Barang->getKategori();

        $data['buku'] = $this->M_Barang->showBuku();
        // dd($data['keranjang']);
        $this->load->view('template/electro/css', $data);
        $this->load->view('template/electro/header', $data);
        $this->load->view('home/index', $data);
        $this->load->view('template/electro/footer', $data);
        $this->load->view('template/electro/js', $data);
    }

    public function detail($id)
    {
        $data['kategori'] = $this->M_Barang->getKategori();

        $data['keranjang'] = $this->keranjangIsi();
        $data['buku'] = $this->M_Barang->showDetailBuku($id);

        $this->load->view('template/electro/css', $data);
        $this->load->view('template/electro/header', $data);
        $this->load->view('home/DetailProduk');
        $this->load->view('template/electro/footer', $data);
        $this->load->view('template/electro/js', $data);
    }
    public function checkout()
    {
        $userId = $this->session->userdata('id');
        $data['keranjang'] = $this->keranjangIsi();
        $data['kategori'] = $this->M_Barang->getKategori();

        $this->load->view('template/electro/css', $data);
        $this->load->view('template/electro/header', $data);
        $this->load->view('home/checkout');
        $this->load->view('template/electro/footer', $data);
        $this->load->view('template/electro/js', $data);
    }
    public function deleteKeranjangUser($idBarang)
    {
        $userId = $this->session->userdata('id');
        $this->M_Barang->destroyBarangUser($userId, $idBarang);
        redirect('home');
    }

    public function addCart()
    {
        $dataUser = $this->session->userdata('role_id');
        if (!$dataUser) {
            redirect('auth');
        }

        // dd($this->input->post());
        $userId = $this->session->userdata('id');

        // dd($userId);
        $barangId = $this->input->post('KeranjangBarangId');
        $quantity = $this->input->post('KeranjangJumlah');

        $cek = $this->M_Barang->cekKeranjang($userId, $barangId);
        if (!$cek) {
            $data = array(
                'KeranjangUserId' => $userId,
                'KeranjangBarangId' => $barangId,
                'KeranjangJumlah' => $quantity,

            );
            $this->M_Barang->addKeranjang($data);
            redirect('home');
        }
        $data = array(
            'KeranjangJumlah' => $quantity,
        );
        $this->M_Barang->updateKeranjang($userId, $barangId, $data);

        redirect('home');
    }

    public function createPesanan()
    {
        $userId = $this->session->userdata('id');
        $idOrder = $this->idOrder();
        $dataKeranjang = $this->M_Barang->getKeranjang($userId);
        // dd($dataKeranjang);
        if (!$dataKeranjang) {
            redirect('home/checkout');
        }

        $quantity = [];
        // for ($i = 0; $i < count($dataKeranjang); $i++) {
        //     array_push($quantity, $this->input->post('jumlah' . $i));
        // }
        $Status = "Belum Bayar";
        $pesanan = array(
            'PesananUserId' => $userId,
            'PesananStatus' => $Status,
            'PesananOrderKode' => 'INVOICE-' . $idOrder,
            'PesananTanggal' => date('Y-m-d')
        );
        $this->M_Barang->addPesanan($pesanan);

        $pesananLast = max($this->M_Barang->getPesananLast($userId));

        for ($i = 0; $i < count($dataKeranjang); $i++) {
            $detailPesanan = array(
                'PesananDetailPesananId' => $pesananLast->PesananId,
                'PesananDetailBarangId' => $dataKeranjang[$i]->KeranjangBarangId,
                'PesananJumlah' => $dataKeranjang[$i]->KeranjangJumlah
            );
            $this->M_Barang->insetDetailPesanan($detailPesanan);
        }
        //hapus keranjang
        $this->M_Barang->deleteKeranjangUser($userId);

        redirect('home/pesanan');
    }

    private function idOrder()
    {
        $this->load->model('M_Barang');
        $randomNumber = rand();
        $cek = $this->M_Barang->cekRandomOrder('INVOICE-' . $randomNumber);
        if ($cek) {
            return $this->idOrder();
        }
        return $randomNumber;
    }
    public function pesanan()
    {

        $data['kategori'] = $this->M_Barang->getKategori();

        $userId = $this->session->userdata('id');
        $data['keranjang'] = $this->keranjangIsi();

        $data['pesanan'] = $this->M_Barang->getPesanan($userId);

        $this->load->view('template/electro/css', $data);
        $this->load->view('template/electro/header', $data);
        $this->load->view('home/pesanan');
        $this->load->view('template/electro/footer', $data);
        $this->load->view('template/electro/js', $data);
    }

    public function detailPesanan($idPesanan)
    {

        $userId = $this->session->userdata('id');
        $data['keranjang'] = $this->keranjangIsi();
        $data['detailPesanan'] = $this->M_Barang->getDetailPesanan($idPesanan);

        $this->load->view('template/electro/css', $data);
        $this->load->view('template/electro/header', $data);
        $this->load->view('home/detailPesanan');
        $this->load->view('template/electro/footer', $data);
        $this->load->view('template/electro/js', $data);
    }

    private function keranjangIsi()
    {
        $userId = $this->session->userdata('id');
        $keranjang = $this->M_Barang->cekKeranjangUser($userId);
        if (!$keranjang) {
            $data = [];
        } else {
            $data = $keranjang;
        }
        return $data;
    }

    public function store()
    {
        $data['kategori'] = $this->M_Barang->getKategori();
        // dd($this->input->post());
        $data['keranjang'] = $this->keranjangIsi();
        $find = $this->input->post('search');
        $kategori = $this->input->post('kategori');
        $data['buku'] = $this->M_Barang->cariBarang($find, $kategori);

        $this->load->view('template/electro/css', $data);
        $this->load->view('template/electro/header', $data);
        $this->load->view('home/store');
        $this->load->view('template/electro/footer', $data);
        $this->load->view('template/electro/js', $data);
    }
}
