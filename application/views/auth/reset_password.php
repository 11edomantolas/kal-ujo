<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h2>Reset Password KAL UJO</h2>
                    <!-- <?= $this->session->flashdata('pesan'); ?> -->
                </div>

                <div class="card-body">
                    <?php echo form_open('auth/reset_password'); ?>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="<?= set_value('email'); ?>"
                            required>
                        <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" class="form-control" name="password" required>
                        <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">
                        Reset Password
                    </button>

                    <?php echo form_close(); ?>
                </div>

                <div class="card-footer text-center">
                    <a href="<?= base_url('auth'); ?>">Back To Login Page</a>
                </div>
            </div>
        </div>
    </div>
</div>