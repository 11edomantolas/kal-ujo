<!-- Outer Row -->
<div class="row justify-content-center mt-5">

    <div class="col-xl-6 col-lg-8 col-md-10">

        <div class="card o-hidden border-0 shadow-lg">
            <div class="card-header text-center bg-primary text-white py-4">
                <h1 class="h4 mb-0">KAL UJO ONLINE</h1>
                <small>Buat Akun</small>
            </div>
            <div class="card-body p-5">
                <!-- <?= $this->session->flashdata('pesan'); ?> -->
                <?= form_open('auth/register', ['class' => 'user']); ?>

                <div class="form-group">
                    <input autofocus type="text" name="username" autocomplete="off"
                        class="form-control form-control-user" value="<?= set_value('username'); ?>"
                        placeholder="Username">
                    <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="password" name="password" class="form-control form-control-user" autocomplete="off"
                            placeholder="Password">
                        <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="form-group col-md-6">
                        <input type="password" name="password2" class="form-control form-control-user"
                            autocomplete="off" placeholder="Konfirmasi Password">
                        <?= form_error('password2', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <input value="<?= set_value('nama'); ?>" type="text" name="nama"
                        class="form-control form-control-user" autocomplete="off" placeholder="Nama PIC">
                    <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <input value="<?= set_value('email'); ?>" type="email" name="email"
                        class="form-control form-control-user" autocomplete="off" placeholder="Email">
                    <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                </div>

                <button type="submit" class="btn btn-primary btn-user btn-block mt-3">
                    Daftar
                </button>

                <div class="text-center mt-4">
                    <a class="small" href="<?= base_url('auth') ?>">Sudah punya akun? Login</a>
                </div>

                <?= form_close(); ?>
            </div>
        </div>

    </div>
</div>