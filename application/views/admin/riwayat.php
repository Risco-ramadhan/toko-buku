<div class="row mx-4">
    <div class="col">
        <!-- Basic Card Example -->

        <div class="container-fluid">
            <?= $this->session->flashdata('message'); ?>
            <!-- DataTales Example -->
            <div class="card shadow mb-4 text-sm-start">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="dataTable">
                            <thead>
                                <tr>
                                    <!-- <th>No</th> -->
                                    <th>No</th>
                                    <th>Kode Pesanan</th>
                                    <th>Nama Barang</th>
                                    <th>Harga</th>
                                    <th>Tgl Pesanan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($riwayat as $x) {

                                ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= $x->RiwayatPesananPesananOrderKode ?></td>
                                        <td><?= $x->RiwayatPesananBarang ?></td>
                                        <td><?= $x->RiwayatPesananHarga ?></td>

                                        <td><?= $x->RiwayatPesananTanggal ?></td>
                                        <td>
                                            <a href="<?= base_url('admin/detailPesanan/') . $x->RiwayatPesananPesananOrderKode ?>"> <button type="button" class="btn btn-warning"> <i class="fas fa-fw fa-eye fa-xs "></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php  } ?>

                            </tbody>
                        </table>
                    </div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Rekap Data
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Print Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/print/') ?>" method="post" id="formPrint">
                    <div class="input-group mb-3">
                        <select class="custom-select" id="inputGroupSelect01" name="tahun">
                            <option selected>Tahun</option>
                            <?php
                            $tahun = date('Y');
                            for ($i = $tahun - 10; $i < $tahun + 10; $i++) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php  } ?>
                        </select>
                        <select class="custom-select" id="inputGroupSelect02" name="bulan">
                            <option selected>Bulan</option>
                            <?php
                            $bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

                            for ($i = 0; $i < 12; $i++) {
                            ?>
                                <option value="0<?= $i + 1 ?>"><?= $bulan[$i] ?></option>
                            <?php  } ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button form="formPrint" type="submit" class="btn btn-primary">Print</button>
            </div>
        </div>
    </div>
</div>