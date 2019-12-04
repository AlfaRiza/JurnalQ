
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

        <div class="col-xl-6 col-lg-6 col-md-6 mt-5">

            <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Halaman Login</h1>
                        </div>
                        <?= $this->session->flashdata('message'); ?>
                        <form class="user" action="auth" method="post">
                            <div class="form-group">
                            <input type="text" name="user" class="form-control form-control-user" id="user" placeholder="Username atau Email" value="<?= set_value('user'); ?>">
                            <?= form_error('user', '<div class="text-sm text-danger">', '</div>'); ?>
                            </div>
                            <div class="form-group">
                            <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                            </div>
                            <?= form_error('password', '<div class="text-sm text-danger">', '</div>'); ?>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                            Login
                            </button>
                            <hr>
                        </form>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth/registration'); ?>">Belum punya akun?</a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

        </div>

        </div>

    </div>

