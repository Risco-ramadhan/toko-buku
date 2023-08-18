    <!-- HEADER -->
    <header>
        <!-- MAIN HEADER -->
        <div id="header">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="<?= base_url() ?>" class="logo">
                                <img src="<?= base_url('assets/electro/') ?>/img/logo.png" alt="">
                                <!-- <h2 class="text-white">Toko Buku </h1> -->
                            </a>
                        </div>
                    </div>
                    <!-- /LOGO -->

                    <!-- SEARCH BAR -->
                    <div class="col-md-4">
                        <div class="header-search">
                            <form action="<?= base_url('home/store/') ?>" method="post">
                                <select class="input-select" name="kategori">
                                    <option value="">All Categories</option>
                                    <?php foreach ($kategori as $a) {
                                        # code...
                                    ?>
                                        <option value="<?= $a->KategoriId ?>"><?= $a->KategoriNama ?></option>
                                    <?php } ?>
                                </select>
                                <input class="input" name="search" placeholder="Search here">
                                <button class="search-btn" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                    <!-- /SEARCH BAR -->

                    <!-- ACCOUNT -->
                    <div class="col-md-5 clearfix">
                        <div class="header-ctn">
                            <div>
                                <a href="<?= base_url('home/pesanan') ?>">
                                    <i class="fa fa-list"></i>
                                    <span>Pesanan</span>
                                </a>
                            </div>

                            <!-- Cart -->
                            <div class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-shopping-cart"></i>
                                    <span>Your Cart</span>
                                    <?php
                                    if (!$keranjang) {
                                    } else { ?>
                                        <div class="qty"><?= count($keranjang) ?></div>
                                    <?php }
                                    ?>

                                </a>
                                <div class="cart-dropdown">
                                    <div class="cart-list">
                                        <?php $i = 0;
                                        $total = 0;
                                        foreach ($keranjang as $x) {
                                        ?>
                                            <div class="product-widget">
                                                <div class="product-img">
                                                    <!-- <img src="<?= base_url('assets/electro/') ?>img/product01.png" alt=""> -->
                                                    <img src="data:image/jpeg;base64,<?= $x->BarangImage; ?>">
                                                </div>
                                                <div class="product-body">
                                                    <h3 class="product-name"><a href="#"><?= $x->BarangNama; ?></a></h3>
                                                    <h4 class="product-price"><span class="qty"><?= $x->KeranjangJumlah ?>x</span>Rp. <?= $x->BarangHarga; ?></h4>
                                                </div>
                                                <a href="<?= base_url('home/deleteKeranjangUser/') . $x->BarangId  ?>">

                                                    <button class="delete"><i class="fa fa-close"></i></button>
                                                </a>
                                            </div>
                                        <?php $i++;
                                            $total = ($x->BarangHarga * $x->KeranjangJumlah) + $total;
                                        } ?>

                                    </div>
                                    <div class="cart-summary">
                                        <small><?= $i ?> Item</small>
                                        <h5>SUBTOTAL: Rp. <?= $total ?></h5>
                                    </div>
                                    <div class="cart-btns">
                                        <a href="#">Close</a>
                                        <a href="<?= base_url('home/checkout') ?>">Checkout <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- /Cart -->

                            <div>
                                <a href="#" id="scanQrCode">
                                    <i class="fa fa-qrcode"></i>
                                    <span>Scan</span>
                                </a>
                            </div>

                            <?php
                            if (!$this->session->userdata('id')) {
                            ?>
                                <div>
                                    <a href="<?= base_url('auth') ?>">
                                        <i class="fa fa-user"></i>
                                        <span>Login</span>
                                    </a>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div>
                                    <a href="<?= base_url('auth/logout') ?>">
                                        <i class="fa fa-user"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            <?php

                            }

                            ?>
                        </div>
                    </div>
                    <!-- /ACCOUNT -->
                </div>
                <!-- row -->
            </div>
            <!-- container -->
        </div>
        <!-- /MAIN HEADER -->
    </header>
    <!-- /HEADER -->