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
        <th style="background-color:#d9edf7; text-align:center;">No</th>
        <th style="background-color:#d9edf7; text-align:center;">No CS</th>
        <th style="background-color:#d9edf7; text-align:center;">Tanggal</th>
        <th style="background-color:#d9edf7; text-align:center;">No Surat Jalan</th>
        <th style="background-color:#d9edf7; text-align:center;">No Unit</th>
        <th style="background-color:#d9edf7; text-align:center;">Driver</th>
        <th style="background-color:#d9edf7; text-align:center;">Bank</th>
        <th style="background-color:#d9edf7; text-align:center;">No Rekening</th>
        <th style="background-color:#d9edf7; text-align:center;">Cargo</th>
        <th style="background-color:#d9edf7; text-align:center;">Origin</th>
        <th style="background-color:#d9edf7; text-align:center;">Destination</th>
        <th style="background-color:#d9edf7; text-align:center;">Tonase</th>
        <th style="background-color:#d9edf7; text-align:center;">UJO</th>
        <th style="background-color:#d9edf7; text-align:center;">Approval</th>
        <th style="background-color:#d9edf7; text-align:center;">Pembayaran</th>
    </tr>

    <?php if (empty($rows)): ?>
        <tr>
            <td colspan="15" style="text-align:center;">Data tidak tersedia</td>
        </tr>

    <?php else: ?>
        <?php
        $no = 1;
        $total_ujo = 0;
        foreach ($rows as $r):
            $total_ujo += (float) $r->ujo;
            ?>
            <tr>
                <td style="text-align:center;"><?= $no++; ?></td>
                <td style="text-align:center;"><?= $r->no_cs; ?></td>
                <td style="text-align:center;"><?= date('d-m-Y', strtotime($r->tanggal)); ?></td>
                <td style="text-align:center;"><?= $r->no_surat_jalan ?: '-'; ?></td>
                <td style="text-align:center;"><?= $r->no_unit; ?></td>
                <td><?= $r->driver; ?></td>
                <td><?= $r->nama_bank; ?></td>
                <td style="mso-number-format:'\@'; text-align:center;"><?= $r->nomor_rekening; ?></td>
                <td><?= $r->cargo; ?></td>
                <td><?= $r->origin; ?></td>
                <td><?= $r->destination; ?></td>
                <td style="text-align:right;"><?= number_format($r->tonase, 2, ',', '.'); ?></td>
                <td style="text-align:right;"><?= number_format($r->ujo, 0, ',', '.'); ?></td>
                <td style="text-align:center;"><?= ucfirst($r->status); ?></td>
                <td style="text-align:center;">
                    <?= strtolower($r->status_pembayaran) === 'paid'
                        ? 'Lunas'
                        : ucfirst($r->status_pembayaran); ?>
                </td>
            </tr>
        <?php endforeach; ?>

        <!-- TOTAL -->
        <tr>
            <td colspan="12" style="text-align:right; font-weight:bold;">
                TOTAL UANG JALAN
            </td>
            <td style="text-align:right; font-weight:bold;">
                <?= number_format($total_ujo, 0, ',', '.'); ?>
            </td>
            <td colspan="2"></td>
        </tr>
    <?php endif; ?>

</table>