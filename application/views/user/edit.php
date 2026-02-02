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
                <?= form_open('user/update', [], ['id_user' => $user['id_user']]); ?>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="username">Username</label>
                    <div class="col-md-6">
                        <input value="<?= set_value('username', $user['username']); ?>" type="text" id="username"
                            name="username" class="form-control" placeholder="Username">
                        <?= form_error('username', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <hr>
                <!-- <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="nama_perusahaan">Nama Perusahaan</label>
                    <div class="col-md-6">
                        <input value="<?= set_value('nama_perusahaan', $user['nama_perusahaan']); ?>" type="text"
                            id="nama_perusahaan" name="nama_perusahaan" class="form-control"
                            placeholder="Nama Perusahaan">
                        <?= form_error('nama_perusahaan', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div> -->
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="nama">Nama</label>
                    <div class="col-md-6">
                        <input value="<?= set_value('nama', $user['nama']); ?>" type="text" id="nama" name="nama"
                            class="form-control" placeholder="Nama">
                        <?= form_error('nama', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <!-- <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="alamat">Alamat</label>
                    <div class="col-md-6">
                        <input value="<?= set_value('alamat', $user['alamat']); ?>" type="text" id="alamat"
                            name="alamat" class="form-control" placeholder="Alamat">
                        <?= form_error('alamat', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div> -->
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="email">Email </label>
                    <div class="col-md-6">
                        <input value="<?= set_value('email', $user['email']); ?>" type="text" id="email" name="email"
                            class="form-control" placeholder="Email">
                        <?= form_error('email', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <!-- <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="no_telp">Nomor Telepon</label>
                    <div class="col-md-6">
                        <input value="<?= set_value('no_telp', $user['no_telp']); ?>" type="text" id="no_telp"
                            name="no_telp" class="form-control" placeholder="Nomor Telepon">
                        <?= form_error('no_telp', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="no_wa">Nomor WhatsApp</label>
                    <div class="col-md-6">
                        <input value="<?= set_value('no_wa', $user['no_wa']); ?>" type="text" id="no_wa" name="no_wa"
                            class="form-control" placeholder="Nomor WhatsApp">
                        <?= form_error('no_wa', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div> -->
                <div class="row form-group">
                    <label class="col-md-4 text-md-right" for="role">Role</label>
                    <div class="col-md-6">
                        <div class="custom-control custom-radio">
                            <input <?= $user['role'] == 'admin' ? 'checked' : ''; ?> <?= set_radio('role', 'admin'); ?>
                                value="admin" type="radio" id="admin" name="role" class="custom-control-input">
                            <label class="custom-control-label" for="admin">Admin</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input <?= $user['role'] == 'vendor' ? 'checked' : ''; ?> <?= set_radio('role', 'vendor'); ?>
                                value="vendor" type="radio" id="vendor" name="role" class="custom-control-input">
                            <label class="custom-control-label" for="vendor">Vendor</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input <?= $user['role'] == 'super admin' ? 'checked' : ''; ?> <?= set_radio('role', 'super admin'); ?> value="super admin" type="radio" id="super_admin" name="role"
                                class="custom-control-input">
                            <label class="custom-control-label" for="super_admin">Super Admin</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input <?= $user['role'] == 'TL' ? 'checked' : ''; ?> <?= set_radio('role', 'TL'); ?> value="TL"
                                type="radio" id="TL" name="role" class="custom-control-input">
                            <label class="custom-control-label" for="TL">TL</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input <?= $user['role'] == 'GM' ? 'checked' : ''; ?> <?= set_radio('role', 'GM'); ?> value="GM"
                                type="radio" id="GM" name="role" class="custom-control-input">
                            <label class="custom-control-label" for="GM">GM</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input <?= $user['role'] == 'viewer' ? 'checked' : ''; ?> <?= set_radio('role', 'viewer'); ?>
                                value="viewer" type="radio" id="viewer" name="role" class="custom-control-input">
                            <label class="custom-control-label" for="viewer">Viewer</label>
                        </div>
                        <?= form_error('role', '<span class="text-danger small">', '</span>'); ?>
                    </div>
                </div>
                <br>
                <div class="row form-group justify-content-end">
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon"><i class="fa fa-save"></i></span>
                            <span class="text">Simpan</span>
                        </button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">