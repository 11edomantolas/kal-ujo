<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        if (!has_permission('can_manage_user')) {
            redirect('dashboard');
        }

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "User Management";
        $data['users'] = $this->admin->getUsers(userdata('id_user'));
        $this->template->load('templates/dashboard', 'user/data', $data);
    }

    private function _validasi($mode)
    {

        $this->form_validation->set_rules('nama', 'Nama', '');
        $this->form_validation->set_rules('role', 'Role', 'required|trim');

        if ($mode == 'add') {
            $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]|alpha_numeric');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|is_unique[user.email]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|trim');
            $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'matches[password]|trim');
        } else {
            $id_user = $this->input->post('id_user', true);
            $db = $this->admin->get('user', ['id_user' => $id_user]);

            if ($db) {
                $username = $this->input->post('username', true);
                $email = $this->input->post('email', true);

                $uniq_username = ($db['username'] == $username) ? '' : '|is_unique[user.username]';
                $uniq_email = ($db['email'] == $email) ? '' : '|is_unique[user.email]';

                $this->form_validation->set_rules('username', 'Username', 'required|trim|alpha_numeric' . $uniq_username);
                $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email' . $uniq_email);
            } else {
                set_pesan('Data pengguna tidak ditemukan.', false);
                redirect('user');
            }
        }
    }

    public function add()
    {
        $this->_validasi('add');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah User";
            $this->template->load('templates/dashboard', 'user/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $input_data = [
                'username' => $input['username'],
                'nama' => $input['nama'],
                'email' => $input['email'],
                'role' => $input['role'],
                'password' => password_hash($input['password'], PASSWORD_DEFAULT),
                'created_at' => time(),
                'foto' => 'user.png'
            ];

            if ($this->admin->insert('user', $input_data)) {
                set_pesan('data berhasil disimpan.');
                redirect('user');
            } else {
                set_pesan('data gagal disimpan', false);
                redirect('user/add');
            }
        }
    }

    public function edit($id_user)
    {
        // Retrieve user data from database based on ID
        $data['user'] = $this->admin->getUserById($id_user);

        if (!$data['user']) {
            // Handle if user not found
            show_404();
        }

        // Set the title
        $data['title'] = 'Edit User';

        // Load view from 'views/user/edit.php' and pass the data
        $this->template->load('templates/dashboard', 'user/edit', $data);
    }



    public function update()
    {
        // Form validation rules
        $this->form_validation->set_rules('id_user', 'User ID', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == FALSE) {
            // If validation fails, reload the edit form with validation errors
            $this->edit($this->input->post('id_user'));
        } else {
            // If validation passes, update user data in the database
            $id_user = $this->input->post('id_user');
            $data = array(
                'username' => $this->input->post('username'),
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'role' => $this->input->post('role')
            );

            // Update user data in the database
            if ($this->admin->updateUser($id_user, $data)) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-success">Data berhasil diubah.</div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger">Data gagal diubah.</div>');
            }

            // Redirect to user list
            redirect('user');
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('user', 'id_user', $id)) {
            set_pesan('data berhasil dihapus.');
        } else {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('user');
    }

    public function toggle($getId)
    {
        $id = encode_php_tags($getId);
        $status = $this->admin->get('user', ['id_user' => $id])['is_active'];
        $toggle = $status ? 0 : 1; //Jika user aktif maka nonaktifkan, begitu pula sebaliknya
        $pesan = $toggle ? 'user diaktifkan.' : 'user dinonaktifkan.';

        if ($this->admin->update('user', 'id_user', $id, ['is_active' => $toggle])) {
            set_pesan($pesan);
        }
        redirect('user');
    }
}
