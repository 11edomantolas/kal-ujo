<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KAL UJO Online</title>
    <!-- Load Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .gradient-input {
            background: linear-gradient(to right, #1E90FF, #87CEFA);
            /* Gradasi dari biru tua ke biru muda */
            border: 2px solid white;
            /* Garis pinggir berwarna putih */
            border-radius: 5px;
            color: white;
            /* Warna teks di dalam input menjadi putih */
            padding: 10px 15px;
            width: 100%;
            box-sizing: border-box;
            -webkit-background-clip: padding-box;
            /* Untuk Safari/Chrome */
            background-clip: padding-box;
            /* Untuk browser modern */
        }

        .gradient-input::placeholder {
            color: rgba(255, 255, 255, 0.7);
            /* Placeholder putih dengan sedikit transparansi */
        }

        .gradient-input:focus {
            border-color: white;
            /* Warna garis pinggir tetap putih saat fokus */
            outline: none;
            box-shadow: none;
        }

        body {
            background-color: white;
        }

        .card-custom {
            max-width: 500px;
            margin: auto;
        }

        .logo {
            width: 100%;
            max-width: 220px;
            height: auto;
            margin-bottom: 10px;
        }

        .card-body {
            padding: 15px;
            /* Further reduced padding */
        }

        .form-group {
            margin-bottom: 10px;
            /* Further reduced margin-bottom */
        }

        .text-center {
            margin-bottom: 10px;
            /* Reduced margin-bottom for text-center */
        }

        .preloader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .preloader .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .gradient-button {
            background: linear-gradient(to right, #00BFFF, #00BFFF);
            /* Gradasi dari hijau (Lawn Green) ke kuningan (Gold) */
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
        }


        .card-gradient {
            background: linear-gradient(to right, #F8F8FF, #F8F8FF);
            /* Gradasi dari biru tua ke biru muda */
            border-radius: 10px;
            /* Membuat sudut card lebih halus */
            padding: 20px;
            color: black;
            /* Warna teks pada card */
            transition: none;
            /* Menghapus efek perubahan saat hover */
        }

        .card-gradient .card-body {
            color: black;
            /* Warna teks di dalam body card */
        }

        .gradient-input {
            background: linear-gradient(to right, #FFFAFA, #FFFAFA);
            /* Gradasi dari biru tua ke biru muda */
            border: 2px solid black;
            /* Garis pinggir berwarna putih */
            border-radius: 5px;
            color: black;
            /* Warna teks di dalam input */
            padding: 10px 15px;
            width: 100%;
            box-sizing: border-box;
            -webkit-background-clip: padding-box;
            /* Untuk Safari/Chrome */
            background-clip: padding-box;
            /* Untuk browser modern */
        }

        .gradient-input::placeholder {
            color: #888;
            /* Warna placeholder */
        }

        .gradient-input:focus {
            border-color: black;
            /* Warna garis pinggir tetap putih saat fokus */
            outline: none;
            box-shadow: none;
        }

        .text-gray-900 {
            color: black;
            /* Make "LOGIN" text black */
        }

        /* CSS untuk mengubah warna placeholder */
        .form-control::placeholder {
            color: #ffffff;
            /* Mengatur warna placeholder menjadi putih */
        }

        /* CSS untuk mengubah warna font dan background */
        .custom-header {
            color: #ffffff;
            /* Mengatur warna font menjadi putih */
            background: linear-gradient(to right, #F8F8FF, #F8F8FF);
            /* Gradient oranye ke biru tua */
            padding: 10px;
            /* Menambahkan padding untuk spasi di sekitar teks */
            border-radius: 5px;
            /* Menambahkan border radius jika ingin sudut membulat */
        }

        .text-center a {
            color: black;
            /* Warna teks saat tidak di-hover */
            text-decoration: none;
            /* Menghilangkan garis bawah pada link */
        }

        .text-center a:hover {
            color: red;
            /* Warna teks saat di-hover */
        }
    </style>
</head>

<body>
    <!-- Preloader -->
    <div class="preloader" id="preloader">
        <div class="spinner"></div>
    </div>

    <!-- Outer Row -->
    <div class="row justify-content-center mt-5 pt-lg-5">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg card-custom card-gradient">
                <div class="card-body p-lg-5 p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <!-- Form Column -->
                        <div class="col-12">
                            <div class="p-4">
                                <div class="text-center mb-3">
                                    <!-- Image Added Here -->
                                    <div class="container text-center">
                                        <div class="row justify-content-center">
                                            <div class="col-12">
                                                <img src="<?= base_url('assets/img/KAL.png') ?>" alt="Logo Perusahaan"
                                                    class="logo mb-3">
                                            </div>
                                            <div class="col-12">
                                                <h1 class="h4 text-gray-900 mb-2">LOGIN</h1>
                                            </div>
                                            <div class="col-12">
                                                <h1 class="h4 text-primary mb-2">UJO ONLINE</h1>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Flash Data Message -->
                                <div id="flashMessage">
                                    <?= $this->session->flashdata('pesan'); ?>
                                </div>

                                <!-- Login Form -->
                                <?= form_open('', ['class' => 'user']); ?>
                                <div class="form-group">
                                    <input autofocus="autofocus" autocomplete="off"
                                        value="<?= set_value('username'); ?>" type="text" name="username"
                                        class="form-control form-control-user gradient-input" placeholder="Username">
                                    <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password"
                                        class="form-control form-control-user gradient-input" placeholder="Password">
                                    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <button type="submit" class="btn btn-user btn-block gradient-button">
                                    <strong>Login</strong>
                                </button>

                                <?= form_close(); ?>
                                <!-- Links -->
                                <div class="text-center mt-4">
                                    <a class="small d-block mb-2" href="<?= base_url('auth/register'); ?>">
                                        Belum punya akun? <strong>Daftar</strong>
                                    </a>
                                    <a class="small" href="<?= base_url('auth/forgot_password'); ?>">
                                        Lupa password?
                                    </a>
                                </div>
                            </div>
                            <div class="copyright text-center my-auto" style="font-size: 12px;">
                                <span>Copyright &copy; <?= date('Y'); ?>
                                    <a href="https://krakatau-argologistics.com/">PT Krakatau Argo Logistics</a>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Load Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        window.addEventListener('load', function () {
            document.getElementById('preloader').style.display = 'none';
        });

        document.querySelector('form').addEventListener('submit', function () {
            document.getElementById('preloader').style.display = 'flex';
        });
        // Tunggu 3 detik, lalu sembunyikan flash message
        setTimeout(function () {
            var flashMessage = document.getElementById('flashMessage');
            if (flashMessage) {
                flashMessage.style.display = 'none';
            }
        }, 1000); // 1 detik
    </script>
</body>

</html>