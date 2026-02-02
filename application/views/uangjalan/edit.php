<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-header text-white py-3" style="background: linear-gradient(90deg, #0056b3, #007bff);">
            <h4 class="m-0 fw-bold"><i class="fas fa-edit me-2"></i>Edit Data Uang Jalan</h4>
        </div>

        <div class="card-body bg-light">
            <?= validation_errors('<div class="alert alert-danger rounded-3 fw-semibold">', '</div>'); ?>
            <?= form_open('uangjalan/edit_cs/' . $header['no_cs']); ?>



            <div class="row g-3">

                <!-- KIRI -->
                <div class="col-md-6">

                    <div class="form-group mb-3">
                        <label class="fw-semibold text-dark">No CS</label>
                        <input type="text" name="no_cs" class="form-control border-primary"
                            value="<?= $header['no_cs']; ?>" readonly>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-semibold text-dark">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control border-primary"
                            value="<?= $header['tanggal']; ?>" required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-semibold text-dark">Tipe Pekerjaan</label>
                        <select id="tipePekerjaan" name="tipe_pekerjaan" class="form-control" required>
                            <option value="" disabled>Pilih Tipe Pekerjaan</option>
                            <option value="Domestik" <?= $header['tipe_pekerjaan'] == 'Domestik' ? 'selected' : ''; ?>>
                                Domestik
                            </option>
                            <option value="Export/Import" <?= $header['tipe_pekerjaan'] == 'Export/Import' ? 'selected' : ''; ?>>
                                Export/Import</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-semibold text-dark">Vesel</label>
                        <input id="vesel" type="text" name="vesel" class="form-control border-primary"
                            value="<?= $header['vesel']; ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-semibold text-dark">Tipe Angkutan</label>

                        <select id="tipe_angkutan_select" class="form-control border-primary" required>
                            <option value="" disabled>Pilih Tipe Angkutan</option>
                            <?php
                            $tipeUnik = array_unique(array_column($angkutan, 'tipe_angkutan'));
                            foreach ($tipeUnik as $tipe):
                                ?>
                                <option value="<?= $tipe; ?>" <?= $tipe == $header['tipe_angkutan'] ? 'selected' : ''; ?>>
                                    <?= $tipe; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <input type="hidden" name="tipe_angkutan" id="tipe_angkutan_hidden"
                            value="<?= $header['tipe_angkutan']; ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-semibold text-dark">No Unit</label>
                        <select name="no_unit" id="no_unit" class="form-control border-primary" required>
                            <option value="" disabled>Pilih No Unit</option>
                            <?php foreach ($angkutan as $a): ?>
                                <option value="<?= $a['nomor_polisi']; ?>" data-tipe="<?= $a['tipe_angkutan']; ?>"
                                    <?= $a['nomor_polisi'] == $header['no_unit'] ? 'selected' : ''; ?>>
                                    <?= $a['nomor_polisi']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-semibold text-dark">Driver</label>
                        <select id="nama" name="driver" class="form-control border-primary" required>
                            <option value="" disabled>Pilih Driver</option>
                            <?php foreach ($driver as $d): ?>
                                <option value="<?= $d['nama']; ?>" data-nomor_rekening="<?= $d['nomor_rekening']; ?>"
                                    <?= $d['nama'] == $header['driver'] ? 'selected' : ''; ?>>
                                    <?= $d['nama']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group mt-2">
                        <label class="fw-bold text-dark">Nomor Rekening Driver</label>
                        <input type="text" id="nomor_rekening_text" class="form-control border-primary"
                            value="<?= $header['nomor_rekening']; ?>" readonly>
                        <input type="hidden" name="nomor_rekening" id="nomor_rekening_hidden"
                            value="<?= $header['nomor_rekening']; ?>">
                    </div>

                </div>

                <!-- KANAN -->
                <div class="col-md-6">

                    <div class="form-group mb-3">
                        <label class="fw-semibold text-dark">Cargo</label>
                        <select name="cargo" class="form-control" required>
                            <option value="" disabled>Pilih Cargo</option>
                            <?php foreach ($cargo as $b): ?>
                                <option value="<?= $b['cargo'] ?>" <?= $b['cargo'] == $header['cargo'] ? 'selected' : ''; ?>>
                                    <?= $b['cargo'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group mb-3 position-relative">
                        <label class="fw-semibold text-dark">Origin</label>
                        <input type="text" name="origin" id="origin" class="form-control border-primary"
                            autocomplete="off" value="<?= $header['origin']; ?>" required
                            onkeyup="capitalizeEachWord(this)">
                        <div id="originDropdown" class="border rounded position-absolute w-100"
                            style="display:none; top:100%; left:0; background:#1e3a5f; color:#fff; border-color:#22476f; z-index:1000;">
                        </div>
                    </div>

                    <div class="form-group mb-3 position-relative">
                        <label class="fw-semibold text-dark">Destination</label>
                        <input type="text" name="destination" id="destination" class="form-control border-primary"
                            autocomplete="off" value="<?= $header['destination']; ?>" required
                            onkeyup="capitalizeEachWord(this)">
                        <div id="destinationDropdown" class="border rounded position-absolute w-100"
                            style="display:none; top:100%; left:0; background:#1e3a5f; color:#fff; border-color:#22476f; z-index:1000;">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-semibold text-dark">Ritase</label>
                        <input type="number" name="ritase" id="ritase" class="form-control border-primary"
                            value="<?= $header['ritase']; ?>" min="1" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-semibold text-dark">Additional</label>
                        <select name="additional" id="additional" class="form-control border-primary">
                            <option value="tidak" <?= $header['additional'] == 'tidak' ? 'selected' : ''; ?>>Tidak
                            </option>
                            <option value="ya" <?= $header['additional'] == 'ya' ? 'selected' : ''; ?>>Ada</option>
                        </select>
                    </div>

                    <div id="additionalFields" style="display:none;">
                        <div class="form-group mb-3">
                            <label class="fw-semibold text-dark">Alasan</label>
                            <textarea name="alasan" class="form-control border-primary" rows="3"
                                style="resize:none;"><?= $header['alasan']; ?></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label class="fw-semibold text-dark">Jumlah</label>

                            <!-- input tampilan Rupiah -->
                            <input type="text" id="jumlah_rp" class="form-control border-primary">

                            <!-- input asli untuk database -->
                            <input type="hidden" id="additionalJumlah" name="jumlah" value="<?= $header['jumlah']; ?>">
                        </div>

                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-semibold text-dark">UJO (Rp)</label>

                        <!-- Tampilan Rupiah -->
                        <input type="text" id="ujo_rp" class="form-control border-primary" readonly>

                        <!-- Nilai asli untuk database -->
                        <input type="hidden" name="ujo" id="ujo_asli" value="<?= $header['ujo']; ?>">
                    </div>
                </div>

            </div>

            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm me-2">
                    <i class="fas fa-save me-1"></i> Update
                </button>
                <a href="<?= base_url('uangjalan'); ?>"
                    class="btn btn-outline-secondary px-4 py-2 rounded-pill shadow-sm">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <?= form_close(); ?>
        </div>
    </div>
</div>

<script>
    /* ===================== GLOBAL FUNCTION ===================== */
    function loadUJO() {
        let origin = $('#origin').val();
        let destination = $('#destination').val();
        let tipe = $('#tipe_angkutan_hidden').val();
        let ritase = $('#ritase').val();

        if (!origin || !destination || !tipe) {
            $('#ujo_asli').val('');
            $('#ujo_rp').val('');

            return;
        }

        $.ajax({
            url: "<?= base_url('uangjalan/get_ujo'); ?>",
            type: "GET",
            dataType: "json",
            data: { origin, destination, tipe, ritase },
            success: function (res) {
                let baseUJO = res.status ? parseFloat(res.ujo) : 0;
                let additional = 0;

                if ($('#additional').val() === 'ya') {
                    additional = parseFloat($('#additionalJumlah').val()) || 0;
                }

                let totalUJO = baseUJO + additional;

                // isi ke hidden (database)
                $('#ujo_asli').val(totalUJO);

                // isi ke tampilan Rupiah
                $('#ujo_rp').val(formatRupiah(totalUJO));

            },
            error: function (xhr) {
                console.log('AJAX ERROR:', xhr.responseText);
            }
        });
    }

    /* ===================== DOCUMENT READY ===================== */
    $(document).ready(function () {

        /* === Trigger hitung ulang UJO === */
        $('#origin, #destination, #tipe_angkutan_hidden, #ritase, #additionalJumlah')
            .on('change input', loadUJO);

        /* === Unit → Tipe Angkutan === */
        function filterNoUnitByTipe(tipe) {

            $('#no_unit option').each(function () {
                let tipeOption = $(this).data('tipe');

                if (!tipeOption) return; // skip "Pilih No Unit"

                if (tipeOption === tipe) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }

        // Saat user ganti tipe angkutan
        $('#tipe_angkutan_select').on('change', function () {
            let tipe = $(this).val();

            $('#tipe_angkutan_hidden').val(tipe);
            $('#no_unit').val(''); // reset no unit
            filterNoUnitByTipe(tipe);

            loadUJO();
        });

        // Saat halaman EDIT pertama kali dibuka
        let tipeAwal = $('#tipe_angkutan_select').val();

        if (tipeAwal) {
            filterNoUnitByTipe(tipeAwal);
        }
    });
    /* === Nama → Nomor Rekening === */
    $('#nama').on('change', function () {
        let norek = $(this).find(':selected').data('nomor_rekening') || '';
        $('#nomor_rekening_text').val(norek);
        $('#nomor_rekening_hidden').val(norek);
    });

    /* === Additional === */
    if ($('#additional').val() === 'ya') {
        $('#additionalFields').show();
    }

    $('#additional').on('change', function () {
        if (this.value === 'ya') {
            $('#additionalFields').show();
        } else {
            $('#additionalFields').hide();
            $('#additionalFields input').val('');
            loadUJO();
        }
    });
    // === FIX EDIT MODE ADDITIONAL ===
    if ($('#additional').val() === 'ya') {
        $('#additionalFields').show();

        let jumlah = $('#additionalJumlah').val();
        if (jumlah) {
            $('#jumlah_rp').val('Rp ' + jumlah.replace(/\B(?=(\d{3})+(?!\d))/g, '.'));
        }
    } else {
        $('#additionalFields').hide();
        $('#jumlah_rp').val('');
        $('#additionalJumlah').val('');
    }

    /* === Hitung awal (edit page aman) === */
    loadUJO();
</script>
<script>function focusNextField(currentInput) {
        let fields = $('input:not([type=hidden]):not([readonly]):not([disabled]), select:not([disabled]), textarea:not([disabled])')
            .filter(':visible');

        let index = fields.index(currentInput);
        if (index + 1 < fields.length) {
            fields.eq(index + 1).focus();
        }
    }
</script>
<script>
    function setupAutocomplete(inputId, dropdownId, dataList, onSelect) {
        let index = -1;

        $('#' + inputId).on('input', function () {
            let keyword = this.value.toLowerCase().trim();
            let dropdown = $('#' + dropdownId).empty();
            index = -1;

            if (!keyword) {
                return dropdown.hide();
            }

            let matches = dataList.filter(item =>
                item.toLowerCase().includes(keyword)
            );

            if (!matches.length) {
                return dropdown.hide();
            }

            dropdown.show();

            matches.forEach(item => {
                dropdown.append(`<div class="autocomplete-item">${item}</div>`);
            });
        });

        $('#' + inputId).on('keydown', function (e) {
            let items = $('#' + dropdownId + ' .autocomplete-item');
            if (!items.length) return;


            if (e.key === 'ArrowDown') {
                e.preventDefault();
                index = (index + 1) % items.length;
            }

            if (e.key === 'ArrowUp') {
                e.preventDefault();
                index = (index - 1 + items.length) % items.length;
            }

            if (e.key === 'Enter' || e.key === 'Tab') {
                if (index >= 0) {
                    e.preventDefault();
                    $(items[index]).click();
                } else {
                    // biar Tab normal
                }
            }

            if (e.key === 'Escape') {
                $('#' + dropdownId).hide();
            }

            items.removeClass('active');
            if (index >= 0) $(items[index]).addClass('active');
        });

        $(document).on('click', '#' + dropdownId + ' .autocomplete-item', function () {
            let input = $('#' + inputId);

            input.val($(this).text().trim());
            $('#' + dropdownId).hide()

            if (onSelect) onSelect();

            // 🔥 PINDAH KE FIELD BERIKUTNYA
            focusNextField(input[0]);
        });

        $(document).on('click', function (e) {
            if (!$(e.target).closest('#' + inputId + ', #' + dropdownId).length) {
                $('#' + dropdownId).hide();
            }
        });
    }

</script>
<script>
    setupAutocomplete(
        'origin',
        'originDropdown',
        <?= json_encode(array_column($origin_list, 'origin')); ?>,
        loadUJO
    );

    setupAutocomplete(
        'destination',
        'destinationDropdown',
        <?= json_encode(array_column($destination_list, 'destination')); ?>,
        loadUJO
    );
</script>

<script>
    function checkVeselState() {
        const tipe = $('#tipePekerjaan').val();
        const vesel = $('#vesel');
        const ritase = $('#ritase');

        if (tipe === 'Domestik') {
            vesel.prop({ disabled: true, required: false }).val('');
            ritase.val(1).prop({ readonly: true }).attr({ min: 1, max: 1 });
        } else {
            vesel.prop({ disabled: false, required: true });
            ritase.prop({ readonly: false }).removeAttr('max').attr('min', 1);
        }

        loadUJO();
    }

    $('#tipePekerjaan').on('change', checkVeselState);
    $(window).on('DOMContentLoaded', checkVeselState);
</script>
<script>
    const inputRp = document.getElementById('jumlah_rp');
    const inputAsli = document.getElementById('additionalJumlah');

    inputRp.addEventListener('input', function () {

        // 🚫 kalau additional = tidak, jangan format apa pun
        if ($('#additional').val() !== 'ya') {
            this.value = '';
            inputAsli.value = '';
            return;
        }

        let angka = this.value.replace(/[^0-9]/g, '');
        inputAsli.value = angka;

        if (angka !== '') {
            this.value = 'Rp ' + angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        } else {
            this.value = '';
        }

        loadUJO();
    });


</script>
<script>
    function capitalizeEachWord(input) {
        input.value = input.value.toUpperCase();
    }
</script>
<script>function formatRupiah(angka) {
        if (!angka) return 'Rp 0';
        angka = angka.toString();
        return 'Rp ' + angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }
</script>
<script>
    $(document).ready(function () {

        function getFocusableFields() {
            return $('input:not([type=hidden]):not([readonly]):not([disabled]), select:not([disabled]), textarea:not([disabled])')
                .filter(':visible');
        }

        $(document).on('keydown', 'input, select, textarea', function (e) {

            // ✅ CEK: apakah input ini punya dropdown autocomplete yang sedang tampil
            let hasActiveAutocomplete =
                $(this).attr('id') === 'origin' && $('#originDropdown').is(':visible') ||
                $(this).attr('id') === 'destination' && $('#destinationDropdown').is(':visible');

            // 🔒 Jika autocomplete aktif → jangan pindah field
            if (hasActiveAutocomplete) return;

            let fields = $('input:not([type=hidden]):not([readonly]):not([disabled]), select:not([disabled]), textarea:not([disabled])')
                .filter(':visible');

            let index = fields.index(this);

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                if (index + 1 < fields.length) {
                    fields.eq(index + 1).focus();
                }
            }

            if (e.key === 'ArrowUp') {
                e.preventDefault();
                if (index - 1 >= 0) {
                    fields.eq(index - 1).focus();
                }
            }

        });

    });
</script>

<style>
    .autocomplete-item {
        cursor: pointer;
        padding: 6px 10px;
        color: #fff;
    }

    .autocomplete-item:hover,
    .autocomplete-item.active {
        background: #0d6efd;
    }
</style>