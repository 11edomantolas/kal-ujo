<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= $title; ?></title>
    <link rel="icon" href="<?php echo base_url('assets/img/LOGO.png'); ?>" type="image/x-icon">
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/LOGO.png'); ?>" type="image/x-icon">
    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url(); ?>assets/css/fonts.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Datepicker -->
    <link href="<?= base_url(); ?>assets/vendor/daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- DataTables -->
    <link href="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/vendor/datatables/buttons/css/buttons.bootstrap4.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/vendor/datatables/responsive/css/responsive.bootstrap4.min.css"
        rel="stylesheet">
    <link href="<?= base_url(); ?>assets/vendor/gijgo/css/gijgo.min.css" rel="stylesheet">
    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .custom-bell {
            margin-left: 70px;
            /* Atur sesuai kebutuhan */
        }

        /* ===== DROPDOWN USER ===== */
        .dropdown-menu {
            background-color: #ffffff !important;
            /* background putih */
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }

        /* item default */
        .dropdown-item {
            font-weight: 500 !important;
            color: #1f2937 !important;
            transition: background-color 0.25s ease;
        }


        /* hover */
        .dropdown-item:hover {
            background-color: #f1f5f9 !important;
            color: #111827 !important;
        }

        .nav-link span {
            font-weight: 500 !important;
        }


        /* divider */
        .dropdown-divider {
            border-top: 1px solid #e5e7eb;
        }
    </style>

</head>
<script>
    $(document).ready(function () {
        $('#userDropdown').on('click', function (e) {
            e.preventDefault();
            e.stopPropagation();

            var $parent = $(this).parent();

            if ($parent.hasClass('show')) {
                $parent.removeClass('show');
                $parent.find('.dropdown-menu').removeClass('show');
            } else {
                $('.dropdown').removeClass('show');
                $('.dropdown-menu').removeClass('show');

                $parent.addClass('show');
                $parent.find('.dropdown-menu').addClass('show');
            }
        });

        // klik di luar nutup dropdown
        $(document).on('click', function () {
            $('.dropdown').removeClass('show');
            $('.dropdown-menu').removeClass('show');
        });
    });
</script>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <style>
            /* Latar belakang sidebar */
            .sidebar {
                background: linear-gradient(145deg, #708090, #708090);
                color: white;
                box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.3);
                transition: all 0.3s ease-in-out;
            }

            .sidebar-brand-text,
            .nav-link span,
            .sidebar-brand-icon i,
            .nav-link i,
            #userDropdown .mr-2 {
                color: white !important;
            }

            .sidebar-brand-text {
                font-family: 'Times New Roman', Times, serif, sans-serif;
                font-weight: bold;
            }

            .nav-link:hover {
                background-color: #3a4b6a;
                color: #f1f1f1 !important;
                border-radius: 5px;
                transition: background-color 0.3s ease-in-out;
            }

            .nav-link i:hover {
                color: #f1f1f1 !important;
            }

            /* Efek aktif pada item sidebar */
            .nav-item.active .nav-link {
                background-color: #000000;
                /* Hitam */
                color: #f1f1f1 !important;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }

            .sidebar-brand {
                background-color: #708090;
                color: white;
                transition: background-color 0.3s ease;
            }

            .sidebar-brand:hover {
                background-color: #708090;
                transform: scale(1.05);
            }

            .sidebar-brand img {
                transition: transform 0.3s ease;
            }

            .sidebar-brand:hover img {
                transform: scale(1.1);
            }

            .nav-link {
                position: relative;
                transition: background-color 0.3s ease;
            }

            .nav-link::before {
                content: '';
                position: absolute;
                left: 0;
                right: 0;
                bottom: 0;
                height: 2px;
                background-color: transparent;
                transition: background-color 0.3s ease;
            }

            .nav-link:hover::before {
                background-color: #3a4b6a;
            }

            .nav-item:hover .nav-link {
                padding-left: 10px;
            }

            /* Warna aktif item sidebar menjadi biru dongker */
            .nav-item.active .nav-link {
                background-color: #152331 !important;
                /* Biru dongker */
                color: #f1f1f1 !important;
                /* Warna teks terang */
            }

            .nav-item.active .nav-link i {
                color: #f1f1f1 !important;
                /* Warna ikon aktif */
            }
        </style>


        <?php
        $ci = get_instance();
        $role = $ci->session->userdata('login_session')['role'];
        $uri = $this->uri->segment(1); // Ambil segmen pertama URL
        ?>

        <ul class="navbar-nav bg-secondary sidebar sidebar-light accordion shadow-sm" id="accordionSidebar">

            <!-- Brand Logo -->
            <a class="sidebar-brand d-flex text-white align-items-center justify-content-center" href="">
                <img src="<?= base_url('assets/img/kal_baru.png') ?>" alt="Logo" class="img-fluid"
                    style="max-height: 45px;">
            </a>

            <!-- Dashboard -->
            <li class="nav-item <?= $uri == 'dashboard' ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= base_url('dashboard'); ?>">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <div class="sidebar-heading">Data Master</div>

            <?php
            $uri1 = $this->uri->segment(1);
            $uri2 = $this->uri->segment(2);

            // Fungsi helper untuk cek active
            function is_active($controller, $method = '')
            {
                $CI =& get_instance();
                $uri1 = $CI->uri->segment(1);
                $uri2 = $CI->uri->segment(2);

                if ($method == '') {
                    return $uri1 == $controller && ($uri2 == '' || $uri2 == null) ? 'active' : '';
                }

                return ($uri1 == $controller && $uri2 == $method) ? 'active' : '';
            }
            ?>

            <!-- UJO -->
            <?php if (is_operasional() || is_super_admin()): ?>
                <li class="nav-item <?= is_active('uangjalan'); ?>">
                    <a class="nav-link" href="<?= base_url('uangjalan'); ?>">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Transaksi UJO</span>
                    </a>
                </li>
            <?php endif; ?>


            <!-- Aproval -->
            <?php if (has_permission('can_approve_ujo')): ?>
                <li class="nav-item <?= is_active('approval'); ?>">
                    <a class="nav-link" href="<?= base_url('approval'); ?>">
                        <i class="fas fa-fw fa-clipboard-check"></i>
                        <span>Approval</span>
                    </a>
                </li>
            <?php endif; ?>


            <!-- Partial Payment -->
            <?php if (has_permission('can_process_payment')): ?>
                <li class="nav-item <?= is_active('payment', 'index'); ?>">
                    <a class="nav-link" href="<?= base_url('payment/index'); ?>">
                        <i class="fas fa-fw fa-money-bill-wave"></i>
                        <span>Partial Payment</span>
                    </a>
                </li>


            <?php endif; ?>

            <!-- Konfirmasi Pekerjaan -->
            <?php if (has_permission('can_confirm_job')): ?>
                <li class="nav-item <?= is_active('payment', 'confirm'); ?>">
                    <a class="nav-link" href="<?= base_url('payment/confirm'); ?>">
                        <i class="fas fa-fw fa-check-circle"></i>
                        <span>Konfirmasi Pekerjaan</span>
                    </a>
                </li>
            <?php endif; ?>

            <!-- Full Payment -->
            <?php if (has_permission('can_process_payment')): ?>
                <li class="nav-item <?= is_active('payment', 'full_payment'); ?>">
                    <a class="nav-link" href="<?= base_url('payment/full_payment'); ?>">
                        <i class="fas fa-fw fa-wallet"></i>
                        <span>Full Payment</span>
                    </a>
                </li>
            <?php endif; ?>
            <!-- History Pekerjaan -->
            <?php if (has_permission('can_view_payment_history')): ?>
                <li class="nav-item <?= is_active('payment', 'history'); ?>">
                    <a class="nav-link" href="<?= base_url('payment/history'); ?>">
                        <i class="fas fa-fw fa-history"></i>
                        <span>History Transaksi UJO</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php if (has_permission('can_manage_master_data')): ?>
                <hr class="sidebar-divider">
                <div class="sidebar-heading">Settings</div>

                <li class="nav-item <?= is_active('bank'); ?>">
                    <a class="nav-link" href="<?= base_url('bank'); ?>">
                        <i class="fas fa-fw fa-database"></i>
                        <span>Master Data</span>
                    </a>
                </li>

                <li class="nav-item <?= is_active('angkutan'); ?>">
                    <a class="nav-link" href="<?= base_url('angkutan'); ?>">
                        <i class="fas fa-fw fa-truck"></i>
                        <span>Data Angkutan</span>
                    </a>
                </li>

                <li class="nav-item <?= is_active('driver'); ?>">
                    <a class="nav-link" href="<?= base_url('driver'); ?>">
                        <i class="fas fa-user"></i>
                        <span>Data Driver</span>
                    </a>
                </li>

                <li class="nav-item <?= is_active('Ujo_pokok'); ?>">
                    <a class="nav-link" href="<?= base_url('Ujo_pokok'); ?>">
                        <i class="fas fa-calculator"></i>
                        <span>UJO</span>
                    </a>
                </li>
            <?php endif; ?>
            <?php if (has_permission('can_manage_user')): ?>
                <li class="nav-item <?= is_active('user'); ?>">
                    <a class="nav-link" href="<?= base_url('user'); ?>">
                        <i class="fas fa-fw fa-user-plus"></i>
                        <span>User Management</span>
                    </a>
                </li>
            <?php endif; ?>

            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sign Out -->
            <li class="nav-item">
                <a class="nav-link text-danger" href="<?= base_url('auth/logout'); ?>">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Sign Out</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>





        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">


            <style>
                /* Latar belakang topbar */
                .topbar {
                    background: linear-gradient(145deg, #708090, #87CEFA);
                    /* Gradasi biru dongker */
                    color: white;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                    /* Menambah bayangan halus pada topbar */
                }

                /* Logo/Branding di topbar */
                .navbar-brand {
                    color: white;
                    font-family: 'Arial', sans-serif;
                    font-weight: bold;
                }

                /* Tombol toggle sidebar */
                #sidebarToggleTop {
                    background-color: transparent;
                    border: none;
                    color: white;
                    font-size: 20px;
                    transition: color 0.3s ease;
                }

                #sidebarToggleTop:hover {
                    color: #f1f1f1;
                    /* Warna putih saat hover */
                }

                /* Navbar items di topbar */
                .navbar-nav {
                    font-size: 16px;
                }

                /* Dropdown item di topbar */
                .dropdown-menu {
                    background-color: #708090;
                    border-radius: 5px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                }

                .dropdown-item {
                    color: white;
                    transition: background-color 0.3s ease;
                }

                .dropdown-item:hover {
                    background-color: #2c3e50;
                    /* Efek hover pada item dropdown */
                    color: #f1f1f1;
                }

                .dropdown-divider {
                    background-color: #2c3e50;
                    /* Ganti warna divider */
                }

                /* Gambar profil di dropdown */
                .img-profile {
                    width: 35px;
                    height: 35px;
                    object-fit: cover;
                    border: 2px solid #fff;
                }

                .text-capitalize {
                    font-size: 16px;
                    font-weight: 600;
                }
            </style>

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-dark topbar mb-4 static-top shadow-sm">

                    <a class="navbar-brand" href="<?= base_url('barang') ?>">
                        <!-- Logo / Branding -->
                    </a>

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link bg-transparent d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars text-white"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline small text-capitalize"
                                    style="font-size: 15px; color: white;">
                                    <?= userdata('nama'); ?>
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="<?= base_url() ?>assets/img/avatar/<?= userdata('foto'); ?>">
                            </a>

                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?= base_url('profile'); ?>">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-black-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="<?= base_url('profile/setting'); ?>">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-black-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="<?= base_url('profile/ubahpassword'); ?>">
                                    <i class="fas fa-lock fa-sm fa-fw mr-2 text-black-400"></i>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-black-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                    <?= $contents; ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-light">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; KAL UJO Online <?= date('Y'); ?> &bull; By
                            <?= anchor('https://krakatau-argologistics.com/', 'PT Krakatau Argo Logistics'); ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik "Logout" dibawah ini jika anda yakin ingin logout.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batalkan</button>
                    <a class="btn btn-primary" href="<?= base_url('logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>



    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>assets/js/sb-admin-2.min.js"></script>

    <!-- Datepicker -->
    <script src="<?= base_url(); ?>assets/vendor/daterangepicker/moment.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/daterangepicker/daterangepicker.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/jszip/jszip.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/buttons/js/buttons.colVis.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/datatables/responsive/js/responsive.bootstrap4.min.js"></script>

    <script src="<?= base_url(); ?>assets/vendor/gijgo/js/gijgo.min.js"></script>

    <script>
        $(document).ready(function () {
            var buttons = [];

            $('#dataTable').DataTable({
                buttons: buttons, // TETAP ADA
                dom: "<'row px-2 px-md-4 pt-2'<'col-md-3'l><'col-md-9'f>>" +
                    "<'row'<'col-md-12'tr>>" +
                    "<'row px-2 px-md-4 py-3'<'col-md-5'i><'col-md-7'p>>",
                lengthMenu: [
                    [5, 10, 25, 50, 100, -1],
                    [5, 10, 25, 50, 100, "All"]
                ],
                columnDefs: [{
                    targets: -1,
                    orderable: false,
                    searchable: false
                }]
            });
        });
    </script>


</body>

</html>