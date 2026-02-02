<div class="container">
    <h2>Tambah Data UJO</h2>
    <?= validation_errors(); ?>
    <?= form_open('Ujo_pokok/add'); ?>

    <div class="form-group">
        <label>Origin</label>
        <input type="text" name="origin" class="form-control" id="origin" onkeyup="capitalizeEachWord(this)">
    </div>
    <div class="form-group">
        <label>Destination</label>
        <input type="text" name="destination" class="form-control" id="destination" onkeyup="capitalizeEachWord(this)">
    </div>
    <div class="form-group">
        <label>Tipe</label>
        <select name="tipe_angkutan" class="form-control" required>
            <option value="" disabled selected>Pilih Tipe Angkutan</option>
            <?php foreach ($tipe_angkutan as $b): ?>
                <option value="<?= $b['nama_tipe'] ?>" <?= set_select('nama_tipe', $b['nama_tipe']) ?>>
                    <?= $b['nama_tipe'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Besaran UJO</label>
        <input type="text" id="jumlah_UJO" class="form-control">
        <input type="hidden" name="uang_jalan_pokok" id="Jumlah">
    </div>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="<?= site_url('angkutan') ?>" class="btn btn-secondary">Kembali</a>

    <?= form_close(); ?>
</div>

<script>
    function capitalizeEachWord(input) {
        input.value = input.value.toUpperCase();
    }
</script>

<script>
    const inputRp = document.getElementById('jumlah_UJO');
    const inputAsli = document.getElementById('Jumlah');

    inputRp.addEventListener('input', function () {
        let angka = this.value.replace(/[^0-9]/g, '');

        inputAsli.value = angka;

        if (angka) {
            this.value = 'Rp ' + angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        } else {
            this.value = '';
        }

    });

</script>