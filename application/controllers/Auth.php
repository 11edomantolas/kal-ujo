<?php
defined('BASEPATH') or exit('No direct script access allowed');
#[AllowDynamicProperties]
class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Auth_model', 'auth');
        $this->load->model('Admin_model', 'admin');
    }

    private function _has_login()
    {
        if ($this->session->has_userdata('login_session')) {
            redirect('dashboard');
        }
    }

    public function index()
    {
        $this->_has_login();

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login UJO Online';
            $this->template->load('templates/auth', 'auth/login', $data);
        } else {
            $input = $this->input->post(null, true);

            $cek_username = $this->auth->cek_username($input['username']);
            if ($cek_username > 0) {
                $password = $this->auth->get_password($input['username']);
                if (password_verify($input['password'], $password)) {
                    $user_db = $this->auth->userdata($input['username']);
                    if ($user_db['is_active'] != 1) {
                        set_pesan('akun anda belum aktif/dinonaktifkan. Silahkan hubungi admin.', false);
                        redirect('login');
                    } else {
                        $userdata = [
                            'user' => $user_db['id_user'],
                            'role' => $user_db['role'],
                            'timestamp' => time()
                        ];
                        $this->session->set_userdata('login_session', $userdata);
                        redirect('dashboard');
                    }
                } else {
                    set_pesan('password salah', false);
                    redirect('auth');
                }
            } else {
                set_pesan('username belum terdaftar', false);
                redirect('auth');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('login_session');

        set_pesan('anda telah berhasil logout');
        redirect('auth');
    }

    public function register()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]|alpha_numeric');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|trim');
        $this->form_validation->set_rules(
            'password2',
            'Konfirmasi Password',
            'required|trim|matches[password]'
        );
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Buat Akun';
            $this->template->load('templates/auth', 'auth/register', $data);
        } else {
            $input = $this->input->post(null, true);
            unset($input['password2']);
            $input['password'] = password_hash($input['password'], PASSWORD_DEFAULT);
            $input['role'] = 'vendor';
            $input['foto'] = 'user.png';
            $input['is_active'] = 0;
            $input['created_at'] = time();

            $query = $this->admin->insert('user', $input);
            if ($query) {
                set_pesan('daftar berhasil. Selanjutnya silahkan hubungi admin untuk mengaktifkan akun anda.');
                redirect('auth');
            } else {
                set_pesan('gagal menyimpan ke database', false);
                redirect('register');
            }
        }
    }

    public function forgot_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->template->load('templates/auth', 'auth/forgot_password', $data);
        } else {
            $email = $this->input->post('email', true);
            $user = $this->auth->get_user_by_email($email);

            if ($user) {
                $token = bin2hex(random_bytes(32));
                $this->auth->save_reset_token($user['id_user'], $token);

                $reset_link = base_url("auth/reset_password?token=$token");

                // NOMOR ADMIN (gunakan format internasional)
                $admin_wa = '6282230959545';

                $pesan = urlencode(
                    "*Permintaan Reset Password*\n\n" .
                    "Halo Admin,\n" .
                    "Terdapat permintaan reset password dengan detail berikut:\n\n" .
                    "📧 Email User:\n$email\n\n" .
                    "🔗 Link Reset Password:\n$reset_link\n\n" .
                    "Mohon dilakukan reset password sesuai prosedur.\n" .
                    "Terima kasih."
                );


                redirect("https://wa.me/$admin_wa?text=$pesan");
            } else {
                set_pesan('Email tidak terdaftar', false);
                redirect('auth/forgot_password');
            }
        }
    }


    private function send_reset_email($email, $reset_link)
    {
        $this->load->library('email');
        $this->email->from('mantolasedo@gmail.com', 'Krakatau Argo Logistics');
        $this->email->to($email);
        $this->email->subject('Reset Password');
        $this->email->message("Klik link berikut untuk reset password Anda: $reset_link");

        if (!$this->email->send()) {
            log_message('error', 'Email tidak dapat dikirim.');
        }
    }

    public function reset_password()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Reset Password';
            $this->template->load('templates/auth', 'auth/reset_password', $data);
        } else {
            $input = $this->input->post(null, true);
            $user = $this->auth->get_user_by_email($input['email']);

            if ($user) {
                $new_password = password_hash($input['password'], PASSWORD_DEFAULT);
                $this->auth->update_password($user['id_user'], $new_password);

                set_pesan('Password berhasil direset.');
                redirect('auth');
            } else {
                set_pesan('Email tidak terdaftar.', false);
                redirect('auth/reset_password');
            }
        }
    }

}

