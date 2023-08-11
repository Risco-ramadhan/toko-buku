<div class="container-fluid d-flex justify-content-center">

    <!-- Page Heading -->
    <div class="card">
        <div class="row ">
            <div class="card-body">
                <div class="col-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Order</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="tableHide">Date</th>
                                <th scope="col">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            foreach ($Pesanan as $x) {
                                $status = 'warning';
                                if ($x->PesananStatus == 'Dikirim') {
                                    $status = 'primary';
                                } elseif ($x->PesananStatus == 'Belum Bayar') {
                                    $status = 'warning';
                                } elseif ($x->PesananStatus == 'Ambil') {
                                    $status = 'info';
                                } elseif ($x->PesananStatus == 'Selesai') {
                                    $status = 'success';
                                }
                                $i++;
                            ?>
                                <tr>
                                    <td><?= $x->PesananOrderKode ?> </td>
                                    <td>
                                        <div class="badge rounded-pill text-<?= $status ?> bg-light-<?= $status ?> p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i><?= $x->PesananStatus ?></div>
                                    </td>
                                    <td class="tableHide"><?= $x->PesananTanggal ?></td>
                                    <td class="smallEdit">

                                        <a href="<?= base_url('admin/detailPesanan/') . $x->PesananOrderKode ?>"> <button type="button" class="btn btn-info"> <i class="fas fa-fw fa-edit fa-xs "></i></button>
                                        </a>
                                    </td>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>