<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename={$filename}.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!-- ================= JUDUL ================= -->
<table border="1" width="100%" cellpadding="6" cellspacing="0">
    <tr>
        <th colspan="15" style="font-size:16pt; font-weight:bold; text-align:center; background-color:#f2f2f2;">
            Riwayat Uang Jalan
        </th>
    </tr>
    <tr>
        <td colspan="15" style="text-align:center; font-style:italic;">
            Tanggal Cetak:
            <?= date('d F Y'); ?>
        </td>
    </tr>
    <tr>
        <td colspan="15"></td>
    </tr>
</table>

<br>

<!-- ================= TABEL DATA ================= -->
<table border="1" width="100%" cellpadding="6" cellspacing="0">
    <tr>
        <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="3%">No</th>
        <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="6%">No CS</th>
        <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="7%">Tanggal</th>
        <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="8%">No Surat Jalan</th>
        <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="6%">No Unit</th>
        <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="10%">Driver</th>
        <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="8%">Bank</th>
        <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="10%">No Rekening</th>
        <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="7%">Cargo</th>
        <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="7%">Origin</th>
        <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="7%">Destination</th>
        <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="5%">Tonase</th>
        <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="7%">UJO</th>
        <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="6%">Approval</th>
        <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="6%">Pembayaran</th>
    </tr>

    <?php $no = 1;
    foreach ($rows as $r): ?>
        <tr>
            <td style="text-align:center;">
                <?= $no++; ?>
            </td>
            <td style="text-align:center;">
                <?= $r->no_cs; ?>
            </td>
            <td style="text-align:center;">
                <?= date('d-m-Y', strtotime($r->tanggal)); ?>
            </td>
            <td style="text-align:center;">
                <?= !empty(trim($r->no_surat_jalan ?? '')) ? $r->no_surat_jalan : '-' ?>
            </td>
            <td style="text-align:center;">
                <?= $r->no_unit; ?>
            </td>
            <td>
                <?= $r->driver; ?>
            </td>
            <td>
                <?= $r->nama_bank; ?>
            </td>
            <td style="mso-number-format:'\@'; text-align:center;">
                <?= $r->nomor_rekening; ?>
            </td>
            <td>
                <?= $r->cargo; ?>
            </td>
            <td>
                <?= $r->origin; ?>
            </td>
            <td>
                <?= $r->destination; ?>
            </td>
            <td style="text-align:right;">
                <?= number_format($r->tonase, 2, ',', '.'); ?>
            </td>
            <td style="text-align:right;">
                <?= number_format($r->ujo, 0, ',', '.'); ?>
            </td>
            <td style="text-align:center;">
                <?= ucfirst($r->status); ?>
            </td>
            <td style="text-align:center;">
                <?= strtolower($r->status_pembayaran) === 'paid'
                    ? 'Lunas'
                    : ucfirst($r->status_pembayaran); ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>