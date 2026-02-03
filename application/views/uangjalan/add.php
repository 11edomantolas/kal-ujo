<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="container my-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-header text-white py-3 rounded-top-4"
            style="background: linear-gradient(90deg, #0056b3, #007bff);">
            <h4 class="m-0 fw-bold"><i class="fas fa-truck me-2"></i>Tambah Data Uang Jalan</h4>
        </div>

        <div class="card-body bg-light">
            <?= validation_errors('<div class="alert alert-danger rounded-3 fw-semibold">', '</div>'); ?>
            <?= form_open('uangjalan/create'); ?>

            <div class="row g-3">
                <div class="col-md-6">

                    <div class="form-group">
                        <label class="fw-bold text-dark">No CS</label>
                        <input type="text" name="no_cs" class="form-control border-primary" required>
                    </div>

                    <div class="form-group">
                        <label class="fw-bold text-dark">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control border-primary" required>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold text-dark">Tipe Pekerjaan</label>
                        <select id="tipePekerjaan" name="tipe_pekerjaan" class="form-control border-primary" required>
                            <option value="" disabled selected>Pilih Tipe Pekerjaan</option>
                            <option value="Domestik">Domestik</option>
                            <option value="Export/Import">Export/Import</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold text-dark">Vessel</label>
                        <input id="vesel" type="text" name="vesel" class="form-control border-primary">
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-semibold text-dark">Tipe Angkutan</label>
                        <select id="tipe_angkutan_select" class="form-control border-primary" required>
                            <option value="" selected disabled>Pilih Tipe Angkutan</option>
                            <?php
                            $tipeUnik = array_unique(array_column($angkutan, 'tipe_angkutan'));
                            foreach ($tipeUnik as $tipe):
                                ?>
                                <option value="<?= $tipe; ?>">
                                    <?= $tipe; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <input type="hidden" name="tipe_angkutan" id="tipe_angkutan_hidden">
                    </div>
                    <div class="form-group mb-3">
                        <label class="fw-semibold text-dark">No Unit</label>
                        <select name="no_unit" id="no_unit" class="form-control border-primary" required disabled>
                            <option value="" disabled selected>Pilih No Unit</option>
                            <?php foreach ($angkutan as $a): ?>
                                <option value="<?= $a['nomor_polisi']; ?>" data-tipe="<?= $a['tipe_angkutan']; ?>">
                                    <?= $a['nomor_polisi']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <!-- Driver -->
                    <div class="form-group position-relative">
                        <label class="fw-bold text-dark">Driver</label>

                        <div class="combo-wrapper">
                            <input type="text" id="driver" name="driver" class="form-control border-primary"
                                autocomplete="off" required>
                            <span id="driverToggle" class="combo-arrow">▾</span>
                        </div>

                        <div id="driverDropdown" class="border rounded position-absolute w-100"
                            style="display:none; top:100%; left:0; background:#1e3a5f; color:#fff; z-index:1000;">
                        </div>
                    </div>

                    <div class="form-group mt-2">
                        <label class="fw-bold text-dark">Nomor Rekening Driver</label>
                        <input type="text" id="nomor_rekening_text" class="form-control border-primary" readonly>

                        <input type="hidden" name="nomor_rekening" id="nomor_rekening_hidden">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="fw-bold text-dark">Cargo</label>
                        <select name="cargo" class="form-control border-primary" required>
                            <option value="" disabled selected>Pilih Cargo</option>
                            <?php foreach ($cargo as $b): ?>
                                <option value="<?= $b['cargo'] ?>" <?= set_select('cargo', $b['cargo']) ?>>
                                    <?= $b['cargo'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group position-relative">
                        <label class="fw-bold text-dark">Origin (Asal)</label>
                        <input type="text" name="origin" id="origin" class="form-control border-primary"
                            autocomplete="off" required onkeyup="capitalizeEachWord(this)">
                        <div id="originDropdown" class="border rounded position-absolute w-100"
                            style="display:none; top:100%; left:0; background:#1e3a5f; color:#fff; border-color:#22476f; z-index:1000;">
                        </div>
                    </div>

                    <div class="form-group position-relative">
                        <label class="fw-bold text-dark">Destination (Tujuan)</label>
                        <input type="text" name="destination" id="destination" class="form-control border-primary"
                            autocomplete="off" required onkeyup="capitalizeEachWord(this)">
                        <div id="destinationDropdown" class="border rounded position-absolute w-100"
                            style="display:none; top:100%; left:0; background:#1e3a5f; color:#fff; border-color:#22476f; z-index:1000;">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="fw-bold text-dark">Ritase</label>
                        <input type="number" name="ritase" id="ritase" class="form-control border-primary" value="1"
                            min="1">
                    </div>
                    <div class="form-group">
                        <label class="fw-bold text-dark">Additional</label>
                        <select name="additional" id="additional" class="form-control border-primary" required>
                            <option value="tidak">Tidak</option>
                            <option value="ya">Ada</option>
                        </select>
                    </div>
                    <div id="additionalFields" style="display:none;">
                        <div class="form-group">
                            <label class="fw-bold text-dark">Alasan</label>
                            <textarea name="alasan" class="form-control border-primary" rows="3"
                                style="resize:none;"></textarea>
                        </div>

                        <div class="form-group">
                            <label class="fw-bold text-dark">Jumlah</label>
                            <input type="text" id="jumlah_rp" class="form-control border-primary">
                            <input type="hidden" name="jumlah" id="additionalJumlah">
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="fw-bold text-dark">UJO (Rp)</label>

                        <!-- Tampilan Rupiah -->
                        <input type="text" id="ujo_rp" class="form-control border-primary" readonly>

                        <!-- Nilai asli untuk database -->
                        <input type="hidden" name="ujo" id="ujo_asli">
                    </div>


                </div>
            </div>

            <div class="mt-4 text-center">
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm me-2">
                    <i class="fas fa-save me-1"></i> Simpan
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
    function loadUJO() {
        var origin = $('#origin').val();
        var destination = $('#destination').val();
        var tipe = $('#tipe_angkutan_hidden').val();
        var ritase = $('#ritase').val();

        if (!origin || !destination || !tipe) {
            $('#ujo_asli').val('');
            $('#ujo_rp').val('');
            return;
        }

        $.ajax({
            url: "<?= base_url('uangjalan/get_ujo'); ?>",
            type: "GET",
            data: {
                origin: origin,
                destination: destination,
                tipe: tipe,
                ritase: ritase
            },
            dataType: "json",
            success: function (res) {
                var baseUJO = res.status ? parseFloat(res.ujo) : 0;
                var additional = 0;

                // HITUNG additional HANYA kalau dipilih "ya"
                if ($('#additional').val() === 'ya') {
                    additional = parseFloat($('#additionalJumlah').val()) || 0;
                }

                let totalUJO = baseUJO + additional;

                // isi ke hidden (database)
                $('#ujo_asli').val(totalUJO);

                // isi ke tampilan rupiah
                $('#ujo_rp').val(formatRupiah(totalUJO));

            },
            error: function (xhr) {
                console.log("AJAX ERROR:", xhr.responseText);
            }
        });
    }

    // Trigger load UJO saat field berubah
    $('#origin, #destination, #tipe_angkutan_hidden, #ritase, #additionalJumlah')
        .on('change keyup', loadUJO);

    // Show / Hide Additional (ENUM ya / tidak)
    $('#additional').on('change', function () {
        if ($(this).val() === 'ya') {
            $('#additionalFields').show();
        } else {
            $('#additionalFields').hide();
            $('#additionalFields').find('input, textarea').val('');
            loadUJO(); // reset UJO tanpa additional
        }
    });
</script>

<script>
    function capitalizeEachWord(input) {
        input.value = input.value.toUpperCase();
    }
</script>
<script>
    function focusNextField(currentInput) {
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
                    // 🔥 biar Tab normal lanjut
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
            $('#' + dropdownId).hide();


            if (onSelect) onSelect();

            // 🔥 PINDAH KE FIELD BERIKUTNYA
            focusNextField(input[0]);
        });

        $(document).on('click', function (e) {
            if (!$(e.target).closest('#' + inputId + ', #' + dropdownId).length) {
                $('#' + dropdownId).hide();
                // 🔥 WAJIB
            }
        });

    }
</script>
<script>
    $(document).ready(function () {

        // 🔒 pastikan no unit disable saat awal
        $('#no_unit').prop('disabled', true);

        $('#tipe_angkutan_select').on('change', function () {
            let tipeDipilih = $(this).val();

            // set ke hidden
            $('#tipe_angkutan_hidden').val(tipeDipilih);

            // aktifkan no unit
            $('#no_unit').prop('disabled', false);

            // reset pilihan
            $('#no_unit').val('');

            // filter no polisi sesuai tipe
            $('#no_unit option').each(function () {
                let tipeOption = $(this).data('tipe');

                if (!tipeOption) return; // skip "Pilih No Unit"

                if (tipeOption === tipeDipilih) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            loadUJO();
        });

    });
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

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
<script>
    document.getElementById('tipePekerjaan').addEventListener('change', function () {
        const vesel = document.getElementById('vesel');
        const ritase = document.getElementById('ritase');

        if (this.value === 'Domestik') {
            // Vessel
            vesel.disabled = true;
            vesel.required = false;
            vesel.value = "";

            // Ritase hanya boleh 1
            ritase.value = 1;
            ritase.max = 1;   // batasi max di input
            ritase.min = 1;   // pastikan tidak bisa 0
            ritase.readOnly = true; // user tidak bisa edit
        }
        else {
            // Vessel
            vesel.disabled = false;
            vesel.required = true;

            // Ritase kembali normal
            ritase.readOnly = false;
            ritase.removeAttribute('max');
            ritase.min = 1;
        }
        loadUJO();
    });
</script>
<script>
    const inputRp = document.getElementById('jumlah_rp');
    const inputAsli = document.getElementById('additionalJumlah');

    inputRp.addEventListener('input', function () {
        let angka = this.value.replace(/[^0-9]/g, '');

        inputAsli.value = angka;

        if (angka) {
            this.value = 'Rp ' + angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        } else {
            this.value = '';
        }

        // 🔥 WAJIB: hitung ulang UJO
        loadUJO();
    });

</script>
<script>
    function formatRupiah(angka) {
        if (!angka) return '';
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
                $(this).attr('id') === 'destination' && $('#destinationDropdown').is(':visible') ||
                $(this).attr('id') === 'driver' && $('#driverDropdown').is(':visible');

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
<script>
    /* ================= DRIVER FIX ADD ================= */

    (function () {

        const driverData = <?= json_encode($driver); ?>;
        let index = -1;

        const $driver = $('#driver');
        const $dropdown = $('#driverDropdown');
        const $rekText = $('#nomor_rekening_text');
        const $rekHidden = $('#nomor_rekening_hidden');

        if (!$driver.length) return;

        // 🔥 MATIKAN EVENT DRIVER LAMA (TANPA GANGGU JS LAIN)
        $driver.off('input keydown focus');
        $('#driverToggle').off('click');
        $(document).off('click.driverAdd');

        function render(list) {
            $dropdown.empty();
            if (!list.length) return $dropdown.hide();

            list.forEach(d => {
                $dropdown.append(`
                <div class="autocomplete-item"
                     data-nama="${d.nama}"
                     data-rek="${d.nomor_rekening}">
                    ${d.nama}
                </div>
            `);
            });

            $dropdown.show();
        }

        // INPUT
        $driver.on('input', function () {
            const keyword = this.value.toLowerCase().trim();
            index = -1;

            $rekText.val('');
            $rekHidden.val('');

            const list = keyword
                ? driverData.filter(d => d.nama.toLowerCase().includes(keyword))
                : driverData;

            render(list);
        });

        // FOCUS
        $driver.on('focus', function () {
            render(driverData);
        });

        // KEYBOARD
        $driver.on('keydown', function (e) {
            const items = $dropdown.find('.autocomplete-item');
            if (!items.length) return;

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                index = (index + 1) % items.length;
            }

            if (e.key === 'ArrowUp') {
                e.preventDefault();
                index = (index - 1 + items.length) % items.length;
            }

            if (e.key === 'Enter' && index >= 0) {
                e.preventDefault();
                $(items[index]).click();
            }

            items.removeClass('active');
            if (index >= 0) $(items[index]).addClass('active');
        });

        // CLICK ITEM
        $dropdown.on('click', '.autocomplete-item', function () {
            $driver.val($(this).data('nama'));
            $rekText.val($(this).data('rek'));
            $rekHidden.val($(this).data('rek'));
            $dropdown.hide();

            // 🔥 lanjut ke field berikutnya
            // focusNextField($driver[0]);
        });

        // TOGGLE
        $('#driverToggle').on('click', function (e) {
            e.stopPropagation();
            render(driverData);
        });

        // CLICK OUTSIDE
        $(document).on('click.driverAdd', function (e) {
            if (!$(e.target).closest('#driver, #driverDropdown, #driverToggle').length) {
                $dropdown.hide();
            }
        });

        // VALIDASI SUBMIT
        $('form').on('submit', function (e) {
            const nama = $driver.val().trim().toLowerCase();
            const valid = driverData.some(d => d.nama.toLowerCase() === nama);

            if (!valid) {
                alert('Nama driver harus dipilih dari daftar');
                $driver.focus();
                e.preventDefault();
            }
        });

    })();
</script>



<style>
    .combo-wrapper {
        position: relative;
    }

    .combo-arrow {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 20px;
        color: #555;
    }

    .autocomplete-item {
        padding: 6px 10px;
        cursor: pointer;
    }

    .autocomplete-item:hover,
    .autocomplete-item.active {
        background: #0d6efd;
    }

    html {
        overflow-y: scroll;
    }

    #driverDropdown {
        max-height: 190px;
        overflow-y: auto;
    }
</style>