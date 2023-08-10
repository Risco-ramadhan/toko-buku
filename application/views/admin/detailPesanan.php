<div class="container d-flex justify-content-center">
	<div class="row">
		<div class="col">
			<div class="card">
				<div class="card-header text-center">
					<h3 class="card-title">Purchase Receipt</h3>
				</div>
				<div class="card-body">
					<!-- Order Details -->
					<div class="order-summary">
						<table class="table table-striped text-center">
							<thead>
								<tr>
									<th>Nama</th>
									<th>Kategori</th>
									<th>Jumlah</th>
									<th>Price</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								<?php $total = 0;
								foreach ($detailPesanan as $x) {
									# code...
								?>
									<tr>
										<td><?= $x->BarangNama ?></td>
										<td><?= $x->BarangKategori ?></td>
										<td><?= $x->PesananJumlah ?></td>
										<td><?= $x->BarangHarga ?></td>
										<td><?= $x->BarangHarga * $x->PesananJumlah ?></td>
									</tr>
								<?php $total = ($x->BarangHarga * $x->PesananJumlah) + $total;
								} ?>

								<tr>
									<td colspan="4" class="text-right"><strong>Ongkos Kirim</strong></td>
									<td>Gratis</td>
								</tr>
								<tr>
									<td colspan="4" class="text-right"><strong>Total</strong></td>
									<td><?= $total ?></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="dropdown">
						<button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
							<?= $x->PesananStatus ?>
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="<?= base_url('admin/updatepesanan/Belum Bayar/') . $detailPesanan[0]->PesananOrderKode ?>">Belum Bayar</a>
							<a class="dropdown-item" href="<?= base_url('admin/updatepesanan/Dikirim/') . $detailPesanan[0]->PesananOrderKode ?>">Dikirim</a>
							<a class="dropdown-item" href="<?= base_url('admin/updatepesanan/Selesai/') . $detailPesanan[0]->PesananOrderKode ?>">Selesai</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>