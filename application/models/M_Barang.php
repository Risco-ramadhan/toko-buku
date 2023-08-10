<?php
class M_Barang extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function showBuku()
    {
        // $query = $this->db->get('barang');
        // return $query->result();
        $this->db->select('*');
        $this->db->from('barang');
        $this->db->join('kategori', 'kategori.KategoriId = barang.BarangKategori');
        $query = $this->db->get();
        return $query->result();
    }
    public function insetBarang($data)
    {
        $this->db->insert('barang', $data);
    }
    public function showDetailBuku($data)
    {
        $query = $this->db->get_where('barang', array(
            'BarangId' => $data
        ));

        return $query->row();
    }

    public function deleteBarang($id)
    {
        $id['BarangId'] = $id;
        $this->db->where('BarangId', $id);
        $this->db->delete('barang');
    }

    public function updateBarang($id, $data)
    {
        $this->db->where('BarangId', $id);
        $this->db->update('barang', $data);
    }

    public function cekKeranjang($idUser, $idBarang)
    {
        $query = $this->db->get_where('keranjang', array('KeranjangUserId' => $idUser, 'KeranjangBarangId' => $idBarang));
        return $query->row();
    }
    public function cekKeranjangUser($idUser)
    {
        $this->db->select('*');
        $this->db->from('keranjang');
        $this->db->join('barang', 'keranjang.KeranjangBarangId = barang.BarangId');
        $this->db->where(array('KeranjangUserId' => $idUser));
        $query = $this->db->get();
        // $query = $this->db->get_where('keranjang', array('KeranjangUserId' => $idUser));
        return $query->result();
    }



    public function addKeranjang($data)
    {
        $this->db->insert('keranjang', $data);
    }

    public function updateKeranjang($idUser, $idBarang, $data)
    {
        $array = array('KeranjangUserId' => $idUser, 'KeranjangBarangId' => $idBarang);
        $this->db->where($array);
        $this->db->update('keranjang', $data);
    }

    public function destroyBarangUser($idUser, $idBarang)
    {
        $this->db->delete('keranjang', array('KeranjangUserId' => $idUser, 'KeranjangBarangId' => $idBarang));
    }

    public function cekRandomOrder($id)
    {
        $query = $this->db->get_where('pesanan', array('PesananOrderKode' => $id));
        return $query->row();
    }

    public function getKeranjang($userId)
    {
        $this->db->select('*');
        $this->db->from('keranjang');
        $this->db->join('barang', 'keranjang.KeranjangBarangId = barang.BarangId');
        $this->db->where('KeranjangUserId', $userId);
        $query = $this->db->get();
        return $query->result();
    }

    public function addPesanan($data)
    {
        $this->db->insert('pesanan', $data);
    }

    public function getPesananLast($Userid)
    {
        $query = $this->db->get_where('pesanan', array('PesananUserId' => $Userid));
        return $query->result();
    }

    public function insetDetailPesanan($data)
    {
        $this->db->insert('pesanan_detail', $data);
    }

    public function deleteKeranjangUser($id)
    {
        $this->db->where('KeranjangUserId', $id);
        $this->db->delete('keranjang');
    }

    public function getPesanan($Userid)
    {
        $query = $this->db->get_where('pesanan', array('PesananUserId' => $Userid));
        return $query->result();
    }

    public function getDetailPesanan($idOrder)
    {
        $this->db->select('*');
        $this->db->from('pesanan');
        $this->db->join('pesanan_detail', 'pesanan.PesananId = pesanan_detail.PesananDetailPesananId', 'left');
        $this->db->join('barang', 'pesanan_detail.PesananDetailBarangId = barang.BarangId', 'left');
        $this->db->where('PesananOrderKode', $idOrder);
        $query = $this->db->get();
        return $query->result();
    }

    public function GetPesananAll()
    {
        $query = $this->db->get('pesanan');
        return $query->result();
    }

    public function updateStatusPesanan($status, $invoice)
    {
        $this->db->where('PesananOrderKode', $invoice);
        $this->db->update('pesanan', $status);
    }

    public function cariBarang($data, $kategori)
    {

        $this->db->like('BarangNama', $data);
        $this->db->like('BarangKategori', $kategori);
        $this->db->from('barang');
        $query = $this->db->get();
        return $query->result();
    }

    public function getKategori()
    {
        $query = $this->db->get('kategori');
        return $query->result();
    }
    public function insertKategori($data)
    {
        $this->db->insert('kategori', $data);
    }
    public function deleteKategori($id)
    {
        $this->db->where('KategoriId', $id);
        $this->db->delete('kategori');
    }
    public function updateKategori($data, $id)
    {
        $this->db->where('KategoriId', $id);
        $this->db->update('kategori', $data);
    }
}
