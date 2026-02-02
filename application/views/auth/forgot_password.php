<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h2><?php echo $title; ?></h2>
                    <!-- <?= $this->session->flashdata('pesan'); ?> -->
                </div>
                <div class="card-body">
                    <?php echo form_open('auth/forgot_password'); ?>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="Masukkan email Anda" value="<?php echo set_value('email'); ?>">
                        <?php echo form_error('email', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Send To Admin</button>
                    <?php echo form_close(); ?>
                </div>
                <div class="card-footer text-center">
                    <p><a href="<?php echo base_url('auth'); ?>">Back To Login Page</a></p>
                </div>
            </div>
        </div>
    </div>
</div>