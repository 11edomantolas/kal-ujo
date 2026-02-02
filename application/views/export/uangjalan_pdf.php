<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Riwayat Uang Jalan</title>

    <style>
        @page {
            size: A4 landscape;
            margin: 15mm;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9.5px;
            color: #000;
        }

        .report-title {
            text-align: center;
            font-size: 15px;
            font-weight: bold;
            margin-bottom: 3px;
        }

        .report-subtitle {
            text-align: center;
            font-size: 10px;
            font-style: italic;
            margin-bottom: 10px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            table-layout: fixed;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 4px;
            vertical-align: middle;
            word-wrap: break-word;
        }

        th {
            background-color: #f0f0f0;
            text-align: center;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .footer {
            margin-top: 10px;
            font-size: 9px;
            text-align: right;
            font-style: italic;
        }
    </style>
</head>

<body>

    <div class="report-title">RIWAYAT UANG JALAN</div>
    <div class="report-subtitle">
        Tanggal Cetak: <?= date('d F Y'); ?>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width:3%">No</th>
                <th style="width:5%">No CS</th>
                <th style="width:6%">Tanggal</th>
                <th style="width:8%">No Surat Jalan</th>
                <th style="width:6%">No Unit</th>
                <th style="width:9%">Driver</th>
                <th style="width:7%">Bank</th>
                <th style="width:8%">No Rekening</th>
                <th style="width:6%">Cargo</th>
                <th style="width:6%">Origin</th>
                <th style="width:6%">Destination</th>
                <th style="width:6%">Tonase</th>
                <th style="width:8%">UJO</th>
                <th style="width:5%">Approval</th>
                <th style="width:7%">Pembayaran</th>
            </tr>
        </thead>
        <tbody>

            <?php if (empty($rows)): ?>
                <tr>
                    <td colspan="15" class="text-center">Data tidak tersedia</td>
                </tr>
            <?php else: ?>
                <?php $no = 1;
                foreach ($rows as $r): ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>

                        <td class="text-center">
                            <?= htmlspecialchars($r->no_cs, ENT_QUOTES, 'UTF-8'); ?>
                        </td>

                        <td class="text-center">
                            <?= date('d-m-Y', strtotime($r->tanggal)); ?>
                        </td>

                        <td class="text-center">
                            <?= !empty(trim($r->no_surat_jalan ?? ''))
                                ? htmlspecialchars($r->no_surat_jalan, ENT_QUOTES, 'UTF-8')
                                : '-'; ?>
                        </td>

                        <td class="text-center">
                            <?= htmlspecialchars($r->no_unit, ENT_QUOTES, 'UTF-8'); ?>
                        </td>

                        <td class="text-left">
                            <?= htmlspecialchars($r->driver, ENT_QUOTES, 'UTF-8'); ?>
                        </td>

                        <td class="text-left">
                            <?= htmlspecialchars($r->nama_bank, ENT_QUOTES, 'UTF-8'); ?>
                        </td>

                        <td class="text-center">
                            <?= htmlspecialchars($r->nomor_rekening, ENT_QUOTES, 'UTF-8'); ?>
                        </td>

                        <td class="text-left">
                            <?= htmlspecialchars($r->cargo, ENT_QUOTES, 'UTF-8'); ?>
                        </td>

                        <td class="text-left">
                            <?= htmlspecialchars($r->origin, ENT_QUOTES, 'UTF-8'); ?>
                        </td>

                        <td class="text-left">
                            <?= htmlspecialchars($r->destination, ENT_QUOTES, 'UTF-8'); ?>
                        </td>

                        <td class="text-right">
                            <?= number_format($r->tonase, 2, ',', '.'); ?> Ton
                        </td>

                        <td class="text-right">
                            Rp <?= number_format($r->ujo, 0, ',', '.'); ?>
                        </td>

                        <td class="text-center">
                            <?= ucfirst(strtolower($r->status)); ?>
                        </td>

                        <td class="text-center">
                            <?= strtolower($r->status_pembayaran) === 'paid'
                                ? 'Lunas'
                                : ucfirst(strtolower($r->status_pembayaran)); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>

        </tbody>
    </table>

    <div class="footer">
        Dicetak oleh sistem pada <?= date('d F Y H:i'); ?>
    </div>

</body>

</html>