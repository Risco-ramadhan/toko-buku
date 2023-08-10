<div class="row mx-4">
    <div class="col">
        <div class="d-flex justify-content-end mb-4">

            <div class="mx-4">
                <a href="<?= base_url('admin/addProduk') ?>">
                    <button class="btn btn-primary">
                        Tambah Data
                    </button>
                </a>
            </div>

        </div>
        <!-- Basic Card Example -->

        <div class="container-fluid">
            <?= $this->session->flashdata('message'); ?>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <!-- <th>No</th> -->
                                    <th>No</th>
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>Stok</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>

                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                foreach ($buku as $x) {
                                    $i++ ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td>
                                            <img style="width: 300px;" class="card-img-top" src="data:image/jpeg;base64,<?php echo $x->BarangImage; ?>">

                                        </td>
                                        <td><?= $x->BarangNama ?></td>
                                        <td><?= $x->BarangStok ?></td>
                                        <td><?= $x->BarangDeskripsi ?></td>
                                        <td><?= $x->BarangHarga ?></td>
                                        <td><?= $x->KategoriNama ?></td>
                                        <td>
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editModal<?= $x->BarangId ?>" data-whatever="@mdo"> <i class="fas fa-fw fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal<?= $x->BarangId ?>" data-whatever="@mdo"><i class="far fa-trash-alt"></i></button></button>
                                        </td>
                                    </tr>
                                <?php  } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>



    </div>

</div>
<!-- Modal Hapus -->
<?php
foreach ($buku as $x) {
?>
    <div class="modal fade" id="hapusModal<?= $x->BarangId ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">Apakah Anda Yakin Ingin Menghapus ?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-danger" href="<?= base_url('admin/destroyBarang/') . $x->BarangId ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php  } ?>
<!-- tambah kategori -->
<div class="modal fade" id="tambahKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>

            <form action="<?= base_url('admin/addKategori') ?>" method="post">
                <div class="mb-3 mx-2">
                    <label for="exampleFormControlInput1" class="form-label">Kategori Buku </label>
                    <input type="text" class="form-control" name="BarangKategori" placeholder="Masukan Kategori Buku">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- tambah kategori -->

<!-- Modal Edit -->
<?php
foreach ($buku as $x) {
?>
    <div class=" modal fade" id="editModal<?= $x->BarangId ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>

                <div class="mx-3">
                    <form action="<?= base_url('admin/editBarang/') . $x->BarangId ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama Buku</label>
                            <input type="text" class="form-control" name="BarangNama" placeholder="Masukan Nama Buku " value="<?= $x->BarangNama ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Stok Buku </label>
                            <input type="text" class="form-control" name="BarangStok" placeholder="Masukan Stok Buku" value="<?= $x->BarangStok ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Harga Buku </label>
                            <input type="text" class="form-control" name="BarangHarga" placeholder="Masukan Harga Buku" value="<?= $x->BarangHarga ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Foto Buku </label>
                            <input type="file" class="form-control" name="BarangImage" placeholder="Masukan Stok Buku">
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Deskripsi Buku </label>
                            <textarea type="text" class="form-control" name="BarangDeskripsi" placeholder="Masukan Deskripsi Buku" value="<?= $x->BarangDeskripsi ?>">
                            </textarea>
                        </div>
                        <div class="mb-3">

                            <select name="BarangKategori" class="custom-select" id="inputGroupSelect01">
                                <?php foreach ($kategori as $x) {

                                ?>
                                    <option selected value="<?= $x->KategoriId ?>"><?= $x->KategoriNama ?></option>
                                <?php  } ?>
                            </select>

                        </div>


                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                            <button class="btn btn-success" type="submit">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php  } ?>