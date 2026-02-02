<div class="container">
    <h2>Edit UJO Pokok</h2>
    <?= validation_errors(); ?>
    <?= form_open('Ujo_pokok/edit/' . $Ujo_pokok['id']); ?>


    <div class="form-group">
        <label>Origin</label>
        <input type="text" name="origin" class="form-control" value="<?= $Ujo_pokok['origin'] ?>"
            onkeyup="capitalizeEachWord(this)">
    </div>

    <div class="form-group">
        <label>Destination</label>
        <input type="text" name="destination" class="form-control" value="<?= $Ujo_pokok['destination'] ?>"
            onkeyup="capitalizeEachWord(this)">
    </div>

    <div class="form-group">
        <label>Tipe</label>
        <select name="tipe_angkutan" class="form-control" required>
            <option value="" disabled selected> Pilih Tipe Angkutan</option>
            <?php foreach ($tipe_angkutan as $b): ?>
                <option value="<?= $b['nama_tipe'] ?>" <?= ($b['nama_tipe'] == $Ujo_pokok['tipe_angkutan']) ? 'selected' : '' ?>>
                    <?= $b['nama_tipe'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>UJO Pokok</label>
        <!-- input tampilan Rupiah -->
        <input type="text" id="jumlah_UJO" class="form-control">
        <!-- input asli untuk database -->
        <input type="hidden" id="Jumlah" name="uang_jalan_pokok" value="<?= $Ujo_pokok['uang_jalan_pokok']; ?>">
    </div>


    <button type="submit" class="btn btn-success">Update</button>
    <a href="<?= site_url('Ujo_pokok') ?>" class="btn btn-secondary">Kembali</a>

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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const inputRp = document.getElementById('jumlah_UJO');
        const inputAsli = document.getElementById('Jumlah');

        let angka = inputAsli.value;

        if (angka) {
            inputRp.value = 'Rp ' + angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }
    });
</script>