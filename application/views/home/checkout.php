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
								foreach ($keranjang as $x) {
								?>
									<div class="order-col">
										<div><?= $x->KeranjangJumlah . 'x ' . $x->BarangNama ?> </div>
										<div>Rp. <?= $x->BarangHarga *  $x->KeranjangJumlah  ?> </div>
									</div>
								<?php
									$total = ($x->BarangHarga * $x->KeranjangJumlah) + $total;
								} ?>
							</div>
							<div class="order-col">
								<div>Shiping</div>
								<div><strong>FREE</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TOTAL</strong></div>
								<div><strong class="order-total">Rp.<?= $total ?></strong></div>
							</div>
						</div>
						<div class="input-checkbox">
							<input type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								I've read and accept the <a href="#">terms & conditions</a>
							</label>
						</div>
						<a href="<?= base_url('home/createPesanan') ?>" class="primary-btn order-submit">Place order</a>
					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->