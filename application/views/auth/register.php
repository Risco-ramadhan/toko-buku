<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Pendaftaran akun toko AZIZAH</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth/registration') ?>">
                            <div class="form-group row">
                                <div class="col">
                                    <input type="text" class="form-control form-control-user" id="Name" placeholder="Name" name="Name" value="<?= set_value('Name') ?>">
                                    <?= form_error('Name', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>

                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="Email" placeholder="Email Address" name="Email" value="<?= set_value('Email') ?>">
                                <?= form_error('Email', '<small class="text-danger pl-3">', '</small>') ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password" placeholder="Password" name="Password1">
                                    <?= form_error('Password1', '<small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password" placeholder="Repeat Password" name="Password2">
                                </div>
                            </div>

                            <button type="submit" class="btn btn-danger btn-user btn-block">
                                Register Account
                            </button>

                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth/') ?>">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>