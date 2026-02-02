<?php
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename={$filename}.xls");
header("Pragma: no-cache");
header("Expires: 0");

$grouped = [];

foreach ($rows as $r) {
    $key = $r->nama_bank . '|' . $r->nomor_rekening . '|' . $r->driver;

    if (!isset($grouped[$key])) {
        $grouped[$key] = [
            'data' => [],
            'total' => 0
        ];
    }

    $grouped[$key]['data'][] = $r;
    $grouped[$key]['total'] += (int) ($r->ujo_sisa ?? 0);
}

/* PEMISAHAN DATA */
$singleData = [];
$groupData = [];

foreach ($grouped as $group) {
    if (count($group['data']) === 1) {
        $singleData[] = $group['data'][0];
    } else {
        $groupData[] = $group;
    }
}
?>

<!-- ================= JUDUL ================= -->
<table border="1" width="100%" cellpadding="6" cellspacing="0">
    <tr>
        <th colspan="5" style="font-size:16pt; font-weight:bold; text-align:center; background-color:#f2f2f2;">
            PAYMENT PELUNASAN UJO
        </th>
    </tr>
    <tr>
        <td colspan="5" style="text-align:center; font-style:italic;">
            Tanggal Cetak: <?= date('d F Y'); ?>
        </td>
    </tr>
    <tr>
        <td colspan="5"></td>
    </tr>
</table>

<br>

<!-- ============ TABEL DATA SINGLE (1 TABEL SAJA) ============ -->
<?php if (!empty($singleData)): ?>
    <table border="1" width="100%" cellpadding="6" cellspacing="0">
        <tr>
            <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="5%">No</th>
            <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="20%">Nama Bank</th>
            <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="25%">No Rekening</th>
            <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="15%">Driver</th>
            <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="35%">Tanggungan UJO</th>
        </tr>

        <?php $no = 1;
        foreach ($singleData as $r): ?>
            <tr>
                <td style="text-align:center;"><?= $no++; ?></td>
                <td><?= $r->nama_bank; ?></td>
                <td style="mso-number-format:'\@'; text-align:center;"><?= $r->nomor_rekening; ?></td>
                <td><?= $r->driver; ?></td>
                <td style="text-align:right;"><?= number_format($r->ujo_sisa ?? 0, 0, ',', '.'); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br><br>
<?php endif; ?>

<!-- ============ TABEL DATA GROUP (LEBIH DARI 1 + TOTAL) ============ -->
<?php foreach ($groupData as $group): ?>
    <table border="1" width="100%" cellpadding="6" cellspacing="0">
        <tr>
            <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="5%">No</th>
            <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="20%">Nama Bank</th>
            <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="25%">No Rekening</th>
            <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="15%">Driver</th>
            <th style="background-color:#d9edf7; font-weight:bold; text-align:center;" width="35%">Tanggungan UJO</th>
        </tr>

        <?php $no = 1;
        foreach ($group['data'] as $r): ?>
            <tr>
                <td style="text-align:center;"><?= $no++; ?></td>
                <td><?= $r->nama_bank; ?></td>
                <td style="mso-number-format:'\@'; text-align:center;"><?= $r->nomor_rekening; ?></td>
                <td><?= $r->driver; ?></td>
                <td style="text-align:right;"><?= number_format($r->ujo_sisa ?? 0, 0, ',', '.'); ?></td>
            </tr>
        <?php endforeach; ?>

        <tr>
            <td colspan="4" style="text-align:center; font-weight:bold; background:#f0f0f0;">
                TOTAL Pelunasan
            </td>
            <td style="text-align:right; font-weight:bold; background:#f0f0f0;">
                <?= number_format($group['total'], 0, ',', '.'); ?>
            </td>
        </tr>
    </table>

    <br><br>
<?php endforeach; ?>