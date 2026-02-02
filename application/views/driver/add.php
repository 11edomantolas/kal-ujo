<div class="container">
    <h2>Tambah Driver</h2>
    <?= validation_errors(); ?>
    <?= form_open('driver/add'); ?>

    <div class="form-group">
        <label>Nama Driver</label>
        <input type="text" name="nama" class="form-control" onkeyup="capitalizeEachWord(this)">
    </div>
    <div class="form-group">
        <label>Nomor Telepon</label>
        <input type="number" name="no_telepon" class="form-control">
    </div>
    <div class="form-group">
        <label>Nama Bank</label>
        <select name="nama_bank" class="form-control" required>
            <option value="" disabled selected> Pilih Bank</option>
            <?php foreach ($bank as $b): ?>
                <option value="<?= $b['nama_bank'] ?>" <?= set_select('nama_bank', $b['nama_bank']) ?>>
                    <?= $b['nama_bank'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Nomor Rekening</label>
        <input type="number" name="nomor_rekening" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= site_url('angkutan') ?>" class="btn btn-secondary">Kembali</a>

    <?= form_close(); ?>
</div>

<script>
    function capitalizeEachWord(input) {
        let words = input.value.toLowerCase().split(' ');
        for (let i = 0; i < words.length; i++) {
            if (words[i].length > 0) {
                words[i] = words[i][0].toUpperCase() + words[i].substr(1);
            }
        }
        input.value = words.join(' ');
    }
</script>