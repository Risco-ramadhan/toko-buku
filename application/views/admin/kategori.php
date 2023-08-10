<div class="row mx-4">
    <div class="col">
        <div class="d-flex justify-content-end mb-4">

            <div class="mx-4">
                <div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahKategori" data-whatever="@mdo">Tambah Kategori</button></button>
                </div>
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
                                    <th>Nama Kategori</th>
                                    <th>Deskripsi Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0;
                                foreach ($kategori as $x) {
                                    $i++ ?>
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td><?= $x->KategoriNama ?></td>
                                        <td><?= $x->KategoriDeskripsi ?></td>
                                        <td>
                                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#editModal<?= $x->KategoriId ?>" data-whatever="@mdo"> <i class="fas fa-fw fa-edit"></i></button>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapusModal<?= $x->KategoriId ?>" data-whatever="@mdo"><i class="far fa-trash-alt"></i></button></button>
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

<?php foreach ($kategori as $x) {

?>
    <div class="modal fade" id="hapusModal<?= $x->KategoriId ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a class="btn btn-danger" href="<?= base_url('admin/destroyKategori/') . $x->KategoriId ?>">Hapus</a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

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
                    <label for="exampleFormControlInput1" class="form-label">Nama Kategori </label>
                    <input type="text" class="form-control" name="KategoriNama" placeholder="Masukan Kategori Buku">
                </div>
                <div class="mb-3 mx-2">
                    <label for="exampleFormControlInput1" class="form-label">Deskripsi Buku </label>
                    <textarea type="text" class="form-control" name="KategoriDeskripsi" placeholder="Masukan deskripsi kategori"></textarea>
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
foreach ($kategori as $x) {
?>
    <div class=" modal fade" id="editModal<?= $x->KategoriId ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>

                <div class="mx-3">
                    <form action="<?= base_url('admin/editKategori/') . $x->KategoriId ?>" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama Buku</label>
                            <input type="text" class="form-control" name="KategoriNama" placeholder="Masukan Nama Buku " value="<?= $x->KategoriNama ?>">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Deskripsi Kategori </label>
                            <input type="text" class="form-control" name="KategoriDeskripsi" placeholder="Masukan Deskripsi Kategori" value="<?= $x->KategoriDeskripsi ?>">
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