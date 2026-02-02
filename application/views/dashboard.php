<?php
$canViewDashboard = is_admin() || is_super_admin() || is_team_leader() || is_finance() || is_operasional();
$showTotalUser = is_admin() || is_super_admin();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard UJO</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 4 -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <style>
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, .1);
        }
    </style>
</head>

<body>

    <!-- ================= WELCOME CARD ================= -->
    <div class="row justify-content-center mb-4">
        <div class="col-12 col-md-9">
            <div class="card shadow h-100 py-3">
                <div class="card-body text-center">
                    <img src="<?= base_url('assets/img/KAL.png') ?>" style="max-width:30%" class="mb-3">
                    <h4 class="text-gray-800"
                        style="margin-top: 10px; font-size: 1.25rem; font-family: 'Poppins', sans-serif;">
                        Selamat Datang di Website UJO PT Krakatau Argo Logistics
                    </h4>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <?php if (is_admin() || is_super_admin() || is_team_leader() || is_finance() || is_operasional()): ?>
        <!-- ================= SUMMARY CARD ================= -->
        <div class="row justify-content-center">

            <div class="col-md-3 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs font-weight-bold text-warning text-uppercase">
                                Pending Approval
                            </div>
                            <div class="h5 font-weight-bold"><?= $pending_count; ?></div>
                        </div>
                        <i class="fas fa-file-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs font-weight-bold text-info text-uppercase">
                                Pending Payment
                            </div>
                            <div class="h5 font-weight-bold"><?= $payment_count; ?></div>
                        </div>
                        <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <div class="text-xs font-weight-bold text-primary text-uppercase">
                                Total Data UJO
                            </div>
                            <div class="h5 font-weight-bold"><?= $total_ujo; ?></div>
                        </div>
                        <i class="fas fa-database fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>

        </div>
    <?php endif; ?>

    <hr>

    <?php if ($canViewDashboard): ?>
        <div class="container mt-4">
            <div class="row">

                <!-- ================= UJO STATISTICS ================= -->
                <div class="<?= $showTotalUser ? 'col-md-6' : 'col-md-6 mx-auto' ?> mb-4">
                    <div class="card shadow h-100">
                        <div class="card-header">
                            <h6 class="font-weight-bold text-primary mb-0">UJO Statistics</h6>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">

                                <!-- STATUS DATA -->
                                <div class="col-md-6">
                                    <h6 class="small font-weight-bold mb-2">Data Status</h6>
                                    <div style="height:220px">
                                        <canvas id="ujoStatusChart"></canvas>
                                    </div>
                                </div>

                                <!-- STATUS PEMBAYARAN -->
                                <div class="col-md-6">
                                    <h6 class="small font-weight-bold mb-2">Payment Status</h6>
                                    <div style="height:220px">
                                        <canvas id="ujoPaymentChart"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= TOTAL USER ================= -->
                <?php if ($showTotalUser): ?>
                    <div class="col-md-6 mb-4">
                        <div class="card shadow h-100">
                            <div class="card-header">
                                <h6 class="font-weight-bold text-primary mb-0">Total UJO User</h6>
                            </div>
                            <div class="card-body">

                                <?php
                                $roles = [
                                    'Super Admin' => [$super_admin_count, 'danger'],
                                    'Admin' => [$admin_count, 'warning'],
                                    'Team Leader' => [$team_leader_count, 'primary'],
                                    'Operasional' => [$operasional_count, 'info'],
                                    'Finance' => [$finance_count, 'success']
                                ];

                                foreach ($roles as $role => $data):
                                    ?>
                                    <h6 class="small font-weight-bold">
                                        <?= $role ?>
                                        <span class="float-right">
                                            <?= $data[0] ?>
                                        </span>
                                    </h6>
                                    <div class="progress mb-3">
                                        <div class="progress-bar bg-<?= $data[1] ?>" style="width: <?= ($data[0] / 200) * 100 ?>%">
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    <?php endif; ?>


    <!-- ================= JS ================= -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const statusData = <?= json_encode($ujo_status); ?>;

        const statusValues = [
            statusData.pending,
            statusData.approved,
            statusData.revision,
            statusData.rejected
        ];

        // 🔽 TAMBAHAN PENTING
        const totalStatus = statusValues.reduce((a, b) => a + b, 0);

        if (totalStatus === 0) {
            document.getElementById('ujoStatusChart').parentElement.innerHTML =
                '<div class="d-flex align-items-center justify-content-center h-100 text-muted">Belum ada data</div>';
        } else {
            new Chart(document.getElementById('ujoStatusChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Pending', 'Approved', 'Revision', 'Rejected'],
                    datasets: [{
                        data: statusValues,
                        backgroundColor: ['#ffc107', '#28a745', '#17a2b8', '#dc3545']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });
        }


        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            title: 'UJO Online version 1.0!',
            showConfirmButton: false,
            timer: 3000
        });
    </script>
    <script>const paymentData = <?= json_encode($ujo_payment); ?>;

        const paymentValues = [
            paymentData.paid,
            paymentData.process,
            paymentData.unpaid
        ];

        // 🔽 TAMBAHAN PENTING
        const totalPayment = paymentValues.reduce((a, b) => a + b, 0);

        if (totalPayment === 0) {
            document.getElementById('ujoPaymentChart').parentElement.innerHTML =
                '<div class="d-flex align-items-center justify-content-center h-100 text-muted">Belum ada data</div>';
        } else {
            new Chart(document.getElementById('ujoPaymentChart'), {
                type: 'doughnut',
                data: {
                    labels: ['Paid', 'Partial Payment', 'Unpaid'],
                    datasets: [{
                        data: paymentValues,
                        backgroundColor: ['#28a745', '#ffc107', '#6c757d']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    cutout: '75%',
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });
        }

    </script>
</body>