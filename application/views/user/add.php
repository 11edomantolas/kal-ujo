<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm mb-4 border-bottom-primary">
            <div class="card-header bg-white py-3">
                <div class="row">
                    <div class="col">
                        <h4 class="h5 align-middle m-0 font-weight-bold text-primary">
                            Form <?= $title; ?>
                        </h4>
                    </div>
                    <div class="col-auto">
                        <a href="<?= base_url('user') ?>" class="btn btn-sm btn-secondary btn-icon-split">
                            <span class="icon">
                                <i class="fa fa-arrow-left"></i>
                            </span>
                            <span class="text">
                                Kembali
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body pb-2">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open(); ?>

                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="username">Username</label>
                    <div class="col-md-2">
                        <i class="fas fa-user fa-lg"></i>
                    </div>
                    <div class="col-md-6">
                        <input value="<?= set_value('username'); ?>" type="text" id="username" name="username"
                            class="form-control" autocomplete="off" placeholder="Username">
                        <?= form_error('username', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="password">Password</label>
                    <div class="col-md-2">
                        <i class="fas fa-lock fa-lg"></i>
                    </div>
                    <div class="col-md-6">
                        <input type="password" id="password" name="password" class="form-control" autocomplete="off"
                            placeholder="Password">
                        <?= form_error('password', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="password2">Konfirmasi Password</label>
                    <div class="col-md-2">
                        <i class="fas fa-lock fa-lg"></i>
                    </div>
                    <div class="col-md-6">
                        <input type="password" id="password2" name="password2" class="form-control" autocomplete="off"
                            placeholder="Konfirmasi Password">
                        <?= form_error('password2', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <!-- <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="nama_perusahaan">Nama Perusahaan</label>
                    <div class="col-md-2">
                        <i class="fas fa-building fa-lg"></i>
                    </div>
                    <div class="col-md-6">
                        <input value="<?= set_value('nama_perusahaan'); ?>" type="text" id="nama_perusahaan" name="nama_perusahaan" autocomplete="off" class="form-control" placeholder="Nama Perusahaan">
                        <?= form_error('nama_perusahaan', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div> -->
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="nama">Nama</label>
                    <div class="col-md-2">
                        <i class="fas fa-user fa-lg"></i>
                    </div>
                    <div class="col-md-6">
                        <input value="<?= set_value('nama'); ?>" type="text" id="nama" name="nama" class="form-control"
                            autocomplete="off" placeholder="Nama">
                        <?= form_error('nama', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="email">Email</label>
                    <div class="col-md-2">
                        <i class="fas fa-envelope fa-lg"></i>
                    </div>
                    <div class="col-md-6">
                        <input value="<?= set_value('email'); ?>" type="text" id="email" name="email"
                            class="form-control" autocomplete="off" placeholder="Email">
                        <?= form_error('email', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <!-- <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="alamat">Alamat</label>
                    <div class="col-md-2">
                        <i class="fas fa-map-marker-alt fa-lg"></i>
                    </div>
                    <div class="col-md-6">
                        <input value="<?= set_value('alamat'); ?>" type="text" id="alamat" name="alamat"
                            class="form-control" autocomplete="off" placeholder="Alamat">
                        <?= form_error('alamat', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div> -->
                <!-- <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="no_telp">Nomor Telepon</label>
                    <div class="col-md-2">
                        <i class="fas fa-phone fa-lg"></i>
                    </div>
                    <div class="col-md-6">
                        <input value="<?= set_value('no_telp'); ?>" type="text" id="no_telp" name="no_telp"
                            autocomplete="off" class="form-control" placeholder="Nomor Telepon">
                        <?= form_error('no_telp', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="no_wa">Nomor Whatsapp</label>
                    <div class="col-md-2">
                        <i class="fab fa-whatsapp fa-lg"></i>
                    </div>
                    <div class="col-md-6">
                        <input value="<?= set_value('no_wa'); ?>" type="text" id="no_wa" name="no_wa"
                            class="form-control" autocomplete="off" placeholder="Nomor Whatsapp">
                        <?= form_error('no_wa', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div> -->
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="role">Role</label>
                    <div class="col-md-2">
                        <i class="fas fa-user-tag fa-lg"></i>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <select class="form-control" id="role" name="role">
                                <option value="" disabled selected>Pilih Role</option>

                                <option value="admin" <?= set_select('role', 'admin'); ?>>
                                    Admin
                                </option>

                                <option value="team_leader" <?= set_select('role', 'team_leader'); ?>>
                                    Team Leader
                                </option>

                                <option value="finance" <?= set_select('role', 'finance'); ?>>
                                    Finance
                                </option>

                                <option value="operasional" <?= set_select('role', 'operasional'); ?>>
                                    Operasional
                                </option>
                            </select>

                            <?= form_error('role', '<span class="text-danger small">', '</span>'); ?>
                        </div>

                    </div>
                </div>


                <br>
                <div class="row form-group justify-content-end">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon"><i class="fa fa-save"></i></span>
                            <span class="text">Simpan</span>
                        </button>
                        <button type="reset" class="btn btn-secondary">
                            Reset
                        </button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">