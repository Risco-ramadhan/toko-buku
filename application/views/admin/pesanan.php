<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row d-flex justify-content-center">
            <!-- Order Details -->
            <div class="col-md-10 col-md-offset-1 order-details">
                <div class="section-title text-center">
                    <h3 class="title">ORDER</h3>
                </div>
                <table class="table table-succes table-striped">
                    <thead class="table ">
                        <tr>
                            <th>No</th>
                            <th>Order#</th>
                            <th>Status</th>
                            <th>Total Item</th>
                            <th>Date</th>
                            <th>View Details</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0;
                        foreach ($Pesanan as $x) {
                            $status = 'warning';
                            if ($x->PesananStatus == 'Proses') {
                                $status = 'primary';
                            } elseif ($x->PesananStatus == 'Pending') {
                                $status = 'warning';
                            } elseif ($x->PesananStatus == 'Ambil') {
                                $status = 'info';
                            } elseif ($x->PesananStatus == 'Selesai') {
                                $status = 'success';
                            }
                            $i++;
                        ?>
                            <tr>
                                <td>
                                    <?= $i ?>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="ms-2">
                                            <h6 class="mb-0 font-14"><?= $x->PesananOrderKode ?> </h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="badge rounded-pill text-<?= $status ?> bg-light-<?= $status ?> p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i><?= $x->PesananStatus ?></div>
                                </td>
                                <td>4 Item</td>
                                <td><?= $x->PesananTanggal ?> </td>
                                <td>
                                    <a href="<?= base_url('admin/detailPesanan/') . $x->PesananOrderKode ?>" class="btn btn-primary btn-sm radius-30 px-4">View Details</a>
                                </td>
                                <td>
                                    <div class="d-flex order-actions">
                                        <a href="javascript:;" class="ms-3"><i class='bx bxs-trash'></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>

            </div>
            <!-- /Order Details -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->