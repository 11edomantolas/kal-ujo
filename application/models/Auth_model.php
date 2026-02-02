<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends MY_Model
{
    public function cek_username($username)
    {
        $query = $this->db->get_where('user', ['username' => $username]);
        return $query->num_rows();
    }

    public function get_password($username)
    {
        $data = $this->db->get_where('user', ['username' => $username])->row_array();
        return $data ? $data['password'] : null;
    }

    public function userdata($username)
    {
        return $this->db->get_where('user', ['username' => $username])->row_array();
    }

    // Mendapatkan user berdasarkan email
    public function get_user_by_email($email)
    {
        return $this->db->get_where('user', ['email' => $email])->row_array();
    }

    // Menyimpan token reset password
    public function save_reset_token($user_id, $token)
    {
        $data = [
            'user_id' => $user_id,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s') // Menggunakan format timestamp yang tepat
        ];
        return $this->db->insert('password_resets', $data);
    }

    public function get_user_by_token($token)
    {
        $this->db->select('user.id_user'); // Ambil ID pengguna
        $this->db->from('password_resets');
        $this->db->join('user', 'user.id_user = password_resets.user_id');
        $this->db->where('password_resets.token', $token);

        // Tambahkan juga untuk mengecek waktu pembuatan token
        $this->db->where('password_resets.created_at >', date('Y-m-d H:i:s', strtotime('-1 hour'))); // Contoh: token hanya valid selama 1 jam

        $query = $this->db->get();
        return $query->row_array(); // Kembalikan data pengguna
    }


    // Menghapus token reset password
    public function delete_reset_token($token)
    {
        $this->db->delete('password_resets', ['token' => $token]);
    }

    public function update_password($user_id, $new_password)
    {
        $this->db->where('id_user', $user_id);
        return $this->db->update('user', ['password' => $new_password]);
    }
}
