<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends MY_Model
{
    public function get_all_users()
    {
        $this->db->select('id_user, username'); // Memilih kolom id_user, username, dan nama_perusahaan
        $query = $this->db->get('user'); // Mendapatkan data dari tabel 'user'
        return $query->result_array(); // Mengembalikan hasil dalam bentuk array
    }
    public function get_user_by_id($userId)
    {
        $this->db->where('id_user', $userId);
        $query = $this->db->get('user');
        return $query->row_array();
    }
}
