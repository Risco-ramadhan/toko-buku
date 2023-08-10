<!-- table -->
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data User</h1>
    <?= $this->session->flashdata('message'); ?>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama </th>
                            <th scope="col">Role</th>
                            <th scope="col">Email</th>
                            <!-- <th scope="col">Password</th> -->
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        // dd($datauser);
                        ?>
                        <?php foreach ($datauser as $x) {
                            $i++;
                        ?>

                            <tr>
                                <th scope="row"><?= $i ?></th>
                                <td><?= $x->name ?></td>
                                <td><?= $x->role ?></td>
                                <td><?= $x->email ?></td>


                                <td>
                                    <!-- <a href=" <?= base_url('admin/editKriteria/') ?>">
                                        <button type="button" class="btn btn-info">Ubah</button>
                                    </a> -->
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#edit<?= $x->id ?>" data-whatever="@mdo"> <i class="fas fa-fw fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal<?= $x->id ?>" data-whatever="@mdo"><i class="far fa-trash-alt"></i></button></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>


            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<!-- end Table -->

<!-- Start Modal -->
<?php
foreach ($datauser as $row) {
?>
    <div class="modal fade" id="exampleModal<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">apakah anda yakin menghapus data tersebut ? </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href=" <?= base_url('admin/deleteuser/' . $row->id) ?>">
                        <button type="button" class="btn btn-danger">Hapus</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- End Modal -->
<script>
    //     $('#exampleModal').on('show.bs.modal', function(event) {
    //         var button = $(event.relatedTarget) // Button that triggered the modal
    //         var recipient = button.data('whatever') // Extract info from data-* attributes
    //         // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    //         // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    //         var modal = $(this)
    //         modal.find('.modal-title').text('New message to ' + recipient)
    //         modal.find('.modal-body input').val(recipient)
    //     })
    // 
</script>

<?php
foreach ($datauser as $row) {
?>
    <div class="modal fade" id="edit<?= $row->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('admin/edituser/') . $row->id ?>" method="POST" id="kirimEdit<?= $row->id ?>">
                        <?= $this->session->flashdata('message'); ?>

                        <div class="mb-3">
                            <input type="text" value="<?= $row->id ?>" class="form-control" name="oldid" hidden>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Nama</label>
                            <input type="text" value="<?= $row->name ?>" class="form-control" name="name" id="name" placeholder="Masukan Nama ">
                            <?= form_error('Name', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                        <?php foreach ($role as $x) {

                        ?>
                            <div class="mb-3 form-check">
                                <input value="<?= $x->id ?>" class="form-check-input" type="radio" name="role" id="flexRadioDefault1" required>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    <?= $x->role ?>
                                </label>
                            </div>
                        <?php } ?>

                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email </label>
                            <input type="email" class="form-control form-control-user" id="Email" placeholder="Email Address" name="Email" value="<?= $row->email ?>">
                            <!-- <input type="text" value="<?= $row->email ?>" class="form-control" name="Email" id="Email" placeholder="Masukan Email"> -->
                            <?= form_error('Email', '<small class="text-danger pl-3">', '</small>') ?>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="kirimEdit<?= $row->id ?>">Kirim</button>

                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- End Modal -->