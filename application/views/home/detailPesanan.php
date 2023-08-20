		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Order Details -->
					<div class="col-md-6 col-md-offset-3 order-details">
						<div class="section-title text-center">
							<h3 class="title">Your Order</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>PRODUCT</strong></div>
								<div><strong>TOTAL</strong></div>
							</div>
							<div class="order-products">
								<?php $total = 0;
								// dd($detailPesanan);
								foreach ($detailPesanan as $x) {
								?>
									<div class="order-col">
										<div><?= $x->PesananJumlah . 'x ' . $x->BarangNama ?> </div>
										<div>Rp. <?= $x->BarangHarga *  $x->PesananJumlah  ?> </div>
									</div>
								<?php
									$total = ($x->BarangHarga * $x->PesananJumlah) + $total;
								} ?>
							</div>
							<div class="order-col">
								<div>Status</div>
								<div><strong><?= $x->PesananStatus ?></strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total">Rp.<?= $total ?></strong></div>
							</div>
						</div>
						<?php
						if ($x->PesananStatus == 'Dikirim') {
						?>

							<a href="<?= base_url('home/verifPesanan/') . $x->PesananOrderKode ?>" class="primary-btn order-submit">Konfirmasi Pesanan Telah Diterima</a>

						<?php }
						?>
					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
		<div class="text-center">
			Silahkan Lakukan Pembayaran melalu bank -------
			<br>
			Kemudian lakukan konfirmasi melalui link
			<a href="https://wa.me/+6285793472455">
				berikut ini
			</a>
		</div>