 <!-- Main content -->
 <div class="content">
     <div class="container-fluid">
         <div class="row">
             <div class="col-lg">
                 <div class="card">
                     <div class="card-body">
                         <h5 class="card-title">Masukan Produk</h5><br>
                         <div class="mb-3">
                             <form action="<?= base_url('admin/storeProduk') ?>" method="post" enctype="multipart/form-data">

                                 <div class="mb-3">
                                     <label for="exampleFormControlInput1" class="form-label">Nama Buku</label>
                                     <input type="text" class="form-control" name="BarangNama" placeholder="Masukan Nama Buku ">
                                 </div>
                                 <div class="mb-3">
                                     <label for="exampleFormControlInput1" class="form-label">Stok Buku </label>
                                     <input type="text" class="form-control" name="BarangStok" placeholder="Masukan Stok Buku">
                                 </div>
                                 <div class="mb-3">
                                     <label for="exampleFormControlInput1" class="form-label">Harga Buku </label>
                                     <input type="text" class="form-control" name="BarangHarga" placeholder="Masukan Harga Buku">
                                 </div>
                                 <div class="mb-3">
                                     <label for="exampleFormControlInput1" class="form-label">Foto Buku </label>
                                     <input type="file" class="form-control" name="BarangImage" placeholder="Masukan Stok Buku">
                                 </div>

                                 <div class="mb-3">
                                     <label for="exampleFormControlInput1" class="form-label">Deskripsi Buku </label>
                                     <input type="text" class="form-control" name="BarangDeskripsi" placeholder="Masukan Deskripsi Buku">
                                 </div>
                                 <div class="mb-3">

                                     <select name="BarangKategori" class="custom-select" id="inputGroupSelect01">
                                         <?php foreach ($kategori as $x) {

                                            ?>
                                             <option selected value="<?= $x->KategoriId ?>"><?= $x->KategoriNama ?></option>
                                         <?php  } ?>
                                     </select>

                                 </div>

                                 <button type="submit" class="btn btn-primary">Submit</button>
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <!-- /.row -->
     </div><!-- /.container-fluid -->
 </div>