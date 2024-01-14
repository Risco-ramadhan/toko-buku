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
        $data['user'] = $this->Auth_model->getDatauser();
        $data['act'] = "Dashboard";
        $date = date('Y');
        $bulan = $this->M_Barang->getPerbulan($date);
        $data['perbulan'] = $this->rupiah($bulan->RiwayatPesananHarga / 12);
        $tahun = $this->M_Barang->getTotal($date);
        $data['total'] = $this->rupiah($tahun->RiwayatPesananHarga);
        $data['pending'] = $this->M_Barang->getRequest();

        $totalData = $this->M_Barang->getTotalData();
        $hasil = ($data['pending'] / $totalData) * 100;
        $data['persen'] = 100 - round($hasil);

        $data['title'] = 'Halaman Admin';
        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('template/admin_footer', $data);
    }

    private function rupiah($angka)
    {

        $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
        return $hasil_rupiah;
    }

    public function produk()
    {
        $data['buku'] = $this->M_Barang->showBuku();
        $data['act'] = "Produk";

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
        $data['act'] = "Pesanan";

        // dd($data);


        $data['user'] = $this->Auth_model->getDatauser();
        $data['title'] = 'Halaman Admin';
        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/pesanan2', $data);
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
        $data['act'] = "Kategori";

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
        $data['act'] = "User";
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

    public function cetak_qr($id, $nama)
    {

        $data['qr'] = $id;
        $data['nama_barang'] = str_replace('%20', ' ', $nama);

        $this->load->view('admin/cetak_qr', $data);
    }
    public function riwayat()
    {
        $data['user'] = $this->Auth_model->getDatauser();
        $data['riwayat'] = $this->M_Barang->getRiwayat();
        $data['act'] = "Riwayat";



        $data['title'] = 'Halaman Admin';
        $this->load->view('template/admin_header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('admin/riwayat', $data);
        $this->load->view('template/admin_footer', $data);
    }

    private function verifPesanan($invoice)
    {
        $userId = $this->session->userdata('id');
        $tgl = $this->M_Barang->getPesananTanggal($invoice);
        $barang = $this->M_Barang->getDetailPesanan($invoice);
        // dd($barang);
        $namaBarang = " ";
        $total = 0;
        foreach ($barang as $x) {
            $namaBarang = $namaBarang . $x->BarangNama . " , ";
            $total = $total + $x->BarangHarga;
        }
        $data = array(
            'RiwayatPesananPesananOrderKode' => $invoice,
            'RiwayatPesananTanggal' => $tgl->PesananTanggal,
            'RiwayatPesananBarang' => $namaBarang,
            'RiwayatPesananHarga' => $total
        );
        $this->M_Barang->verifikasiPesananUser($invoice);
        $this->M_Barang->addRiwayat($data);
    }

    public function print()
    {
        $this->load->library('Pdf');

        $tahun = $this->input->post('tahun');
        $bulan = $this->input->post('bulan');

        if ($bulan == '010') {
            $bulan = 10;
        } else if ($bulan == '011') {
            $bulan = 11;
        } else if ($bulan == '012') {
            $bulan = 12;
        }
        // dd($bulan);
        $periode = $tahun . "-" . $bulan;

        $data = $this->M_Barang->getDataPrint($periode);
        if ($tahun == "semua") {
            $data = $this->M_Barang->getRiwayat();
        }
        // dd($data);
        $tinggi = 6;

        error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
        $pdf = new FPDF('P', 'mm', 'Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 7, 'Rekap Penjualan', 0, 1, 'C');
        $pdf->Cell(10, 7, '', 0, 1);
        $pdf->SetFont('Arial', 'B', 10);
        // $pdf->Cell(Lebar, Tinggi, 'Judul', 1 = garis, 0 =pembuka 1= penutup, 'C');
        $pdf->Cell(10, $tinggi, 'No', 1, 0, 'C');
        $pdf->Cell(40, $tinggi, 'Kode Invoice', 1, 0, 'C');
        $pdf->Cell(80, $tinggi, 'Nama Barang', 1, 0, 'C');
        $pdf->Cell(40, $tinggi, 'harga', 1, 0, 'C');
        $pdf->Cell(20, $tinggi, 'tanggal', 1, 1, 'C');

        //input Data
        $pdf->SetFont('Arial', '', 10);
        $no = 1;

        foreach ($data as $z) {
            $cellWidth = 80; //lebar sel
            $cellHeight = 6; //tinggi sel satu baris normal

            //periksa apakah teksnya melibihi kolom?
            if ($pdf->GetStringWidth($z->RiwayatPesananBarang) < $cellWidth) {
                //jika tidak, maka tidak melakukan apa-apa
                $line = 1;
            } else {
                //jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
                //dengan memisahkan teks agar sesuai dengan lebar sel
                //lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

                $textLength = strlen($z->RiwayatPesananBarang);    //total panjang teks
                $errMargin = 5;        //margin kesalahan lebar sel, untuk jaga-jaga
                $startChar = 0;        //posisi awal karakter untuk setiap baris
                $maxChar = 0;            //karakter maksimum dalam satu baris, yang akan ditambahkan nanti
                $textArray = array();    //untuk menampung data untuk setiap baris
                $tmpString = "";        //untuk menampung teks untuk setiap baris (sementara)

                while ($startChar < $textLength) { //perulangan sampai akhir teks
                    //perulangan sampai karakter maksimum tercapai
                    while (
                        $pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) &&
                        ($startChar + $maxChar) < $textLength
                    ) {
                        $maxChar++;
                        $tmpString = substr($z->RiwayatPesananBarang, $startChar, $maxChar);
                    }
                    //pindahkan ke baris berikutnya
                    $startChar = $startChar + $maxChar;
                    //kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
                    array_push($textArray, $tmpString);
                    //reset variabel penampung
                    $maxChar = 0;
                    $tmpString = '';
                }
                //dapatkan jumlah baris
                $line = count($textArray);
            }

            //tulis selnya
            $pdf->SetFillColor(255, 255, 255);
            $pdf->Cell(10, ($line * $cellHeight), $no++, 1, 0, 'C', true); //sesuaikan ketinggian dengan jumlah garis
            $pdf->Cell(40, ($line * $cellHeight), $z->RiwayatPesananPesananOrderKode, 1, 0); //sesuaikan ketinggian dengan jumlah garis

            //memanfaatkan MultiCell sebagai ganti Cell
            //atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
            //ingat posisi x dan y sebelum menulis MultiCell
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();
            $pdf->MultiCell($cellWidth, $cellHeight, $z->RiwayatPesananBarang, 1);

            //kembalikan posisi untuk sel berikutnya di samping MultiCell 
            //dan offset x dengan lebar MultiCell
            $pdf->SetXY($xPos + $cellWidth, $yPos);
            $pdf->Cell(40, ($line * $cellHeight), $z->RiwayatPesananHarga, 1, 1); //sesuaikan ketinggian dengan jumlah garis

            $pdf->SetXY($xPos + $cellWidth + 40, $yPos);
            $pdf->Cell(20, ($line * $cellHeight), $z->RiwayatPesananTanggal, 1, 1); //sesuaikan ketinggian dengan jumlah garis
        }

        $pdf->Output();
    }
}
