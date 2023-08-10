<!-- SECTION -->
<div class="section">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- section title -->
            <div class="col-md-12">
                <div class="section-title">
                    <h3 class="title">Buku Pilihan</h3>

                </div>
            </div>
            <!-- /section title -->
            <?php foreach ($buku as $x) { ?>
                <!-- Products tab & slick -->
                <div class="col-md-3 col-sm-4">
                    <div class="product">
                        <div class="product-img">

                            <img style="height: 400px;" class="img-responsive" src="data:image/jpeg;base64,<?php echo $x->BarangImage; ?>">
                        </div>
                        <div class="product-body">
                            <!-- <p class="product-category">Category</p> -->
                            <h3 class="product-name"><a href="<?= base_url('home/detail/') . $x->BarangId ?>"><?= $x->BarangNama ?></a></h3>
                            <h4 class="product-price">Rp<?= $x->BarangHarga ?></h4>
                            <div class="product-rating">

                            </div>

                        </div>
                        <a href="<?= base_url('home/detail/') . $x->BarangId ?>">
                            <div class="add-to-cart">
                                <button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> View Detail</button>
                            </div>
                        </a>
                    </div>
                </div>
            <?php } ?>
            <!-- Products tab & slick -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /SECTION -->