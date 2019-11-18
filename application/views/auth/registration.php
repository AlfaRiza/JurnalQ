
    <div class="container d-flex justify-content-center">

    <div class="card o-hidden border-0 shadow-lg my-5" style="width: 50rem;">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
        <div class="col-lg">
            <div class="p-5">
            <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Buat akun baru</h1>
            </div>
            <?= $this->session->flashdata('message'); ?>
            <form class="user" action="<?= base_url('auth/registration') ?>" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?= set_value('username'); ?>">
                    <?= form_error('username', '<div class="text-sm text-danger">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Full Name" value="<?= set_value('nama'); ?>">
                    <?= form_error('nama', '<div class="text-sm text-danger">', '</div>'); ?>
                </div>
                <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control " id="email" placeholder="Email Address" value="<?= set_value('email'); ?>">
                <?= form_error('email', '<div class="text-sm text-danger">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <label for="agama">Agama</label>
                    <select class="form-control " name="agama" id="agama" >
                    <?php foreach( $agama as $a) : ?>
                    <option value="<?= $a['id'];?>"> <?= $a['agama']; ?></option>
                    <?php endforeach ?>
                    </select>
                    <?= form_error('agama', '<div class="text-sm text-danger">', '</div>'); ?>
                </div>
                
                <div class="form-check">
                <label for="jk">Jenis Kelamin</label> <br>
                <?php foreach( $jk as $jk) : ?>
                    <input class="form-check-input" type="radio" name="jk" id="jk<?=$jk['id']?>" value="<?= $jk['id'] ?>">
                    <label class="form-check-label" for="jk<?=$jk['id']?>">
                        <?= $jk['jenis_kelamin'] ?>
                    </label> <br>
                    <?php endforeach ?>
                    <?= form_error('jk', '<div class="text-sm text-danger">', '</div>'); ?>
                </div>

                <div class="form-group mt-1">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= set_value('alamat'); ?></textarea>
                    <?= form_error('alamat', '<div class="text-sm text-danger">', '</div>'); ?>
                </div>

                <div class="form-group">
                <label for="no_telp">Nomor Telpon</label>
                <input type="text" name="no_telp" class="form-control " id="no_telp" placeholder="Nomor Telpon" value="<?= set_value('no_telp'); ?>">
                <?= form_error('no_telp', '<div class="text-sm text-danger">', '</div>'); ?>
                </div>
                
                <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control " id="password" placeholder="Password">
                    <?= form_error('password', '<div class="text-sm text-danger">', '</div>'); ?>
                </div>
                <div class="col-sm-6">
                    <label for="repeatPassword">Repeat Password</label>
                    <input type="password" name="repeatPassword" class="form-control" id="repeatPassword" placeholder="Repeat Password">
                    <?= form_error('repeatPassword', '<div class="text-sm text-danger">', '</div>'); ?>
                </div>
                </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                Buat Akun
                </button>
                <hr>
                <a href="<?= base_url()?>" class=" d-flex justify-content-center ">Sudah punya akun? Login</a>
            </form>
            </div>
        </div>
        </div>
    </div>
</div>

</div>
