<?php
$filename = 'payment_partial_' . date('Ymd_His');
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename={$filename}.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!-- ================= JUDUL ================= -->
<table border="1" width="100%" cellpadding="6" cellspacing="0">
    <tr>
        <th colspan="5" style="font-size:16pt; font-weight:bold; text-align:center; background-color:#f2f2f2;">
            PAYMENT PARTIAL UJO
        </th>
    </tr>
    <tr>
        <td colspan="5" style="text-align:center; font-style:italic;">
            Tanggal Cetak:
            <?= date('d F Y'); ?>
        </td>
    </tr>
    <tr>
        <td colspan="5"></td>
    </tr>
</table>

<br>

<!-- ================= TABEL DATA ================= -->
<table border="1" width="100%" cellpadding="6" cellspacing="0">
    <tr>
        <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="5%">No</th>
        <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="20%">Nama Bank</th>
        <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="25%">No Rekening</th>
        <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="20%">Driver</th>
        <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="30%">UJO Partial</th>
    </tr>

    <?php if (!empty($rows)): ?>
        <?php $no = 1;
        foreach ($rows as $row): ?>
            <tr>
                <td style="text-align:center;">
                    <?= $no++; ?>
                </td>
                <td>
                    <?= $row['nama_bank']; ?>
                </td>
                <td style="mso-number-format:'\@';">
                    <?= $row['nomor_rekening']; ?>
                </td>
                <td>
                    <?= $row['driver']; ?>
                </td>
                <td style="text-align:right;">
                    <?= number_format($row['ujo_terbayar'], 0, ',', '.'); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5" style="text-align:center;">Tidak ada data</td>
        </tr>
    <?php endif; ?>
</table>