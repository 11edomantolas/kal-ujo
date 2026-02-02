<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?></title>

    <link rel="icon" href="<?php echo base_url('assets/img/LOGO.png'); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/LOGO.png'); ?>" type="image/x-icon">
    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        /* Header form auth / register */
        .card-header,
        .auth-header {
            background-color: #00bfff !important;
            color: #fff !important;
            font-weight: 700;
            /* ← bikin teks lebih tebal */
            letter-spacing: 0.5px;
            /* opsional, biar rapi */
        }

        /* Override warna default SB Admin 2 (ungu) */
        .btn-primary {
            background-color: #00bfff !important;
            border-color: #00bfff !important;
            font-weight: 600;
            /* tombol lebih tegas */
        }

        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary:active {
            background-color: #1f7fa0 !important;
            border-color: #1f7fa0 !important;
        }
    </style>



</head>

<body style="background-image: url('<?= base_url('assets/img/L.jpeg'); ?>'); background-size: cover;">


    <div class="container">
        <?= $contents; ?>
    </div>



    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>assets/js/sb-admin-2.min.js"></script>

</body>