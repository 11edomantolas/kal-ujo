<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends MY_Model
{
    public function get($table, $data = null, $where = null)
    {
        if ($data != null) {
            return $this->db->get_where($table, $data)->row_array();
        } else {
            return $this->db->get_where($table, $where)->result_array();
        }
    }

    public function update($table, $pk, $id, $data)
    {
        $this->db->where($pk, $id);
        return $this->db->update($table, $data);
    }

    public function insert($table, $data, $batch = false)
    {
        return $batch ? $this->db->insert_batch($table, $data) : $this->db->insert($table, $data);
    }

    public function getUsers($id)
    {
        /**
         * ID disini adalah untuk data yang tidak ingin ditampilkan. 
         * Maksud saya disini adalah 
         * tidak ingin menampilkan data user yang digunakan, 
         * pada managemen data user
         */
        $this->db->where('id_user !=', $id);
        return $this->db->get('user')->result_array();
    }

    public function delete($table, $id_field, $id_value)
    {
        $this->db->where($id_field, $id_value);
        return $this->db->delete($table);
    }



    public function getUserById($id_user)
    {
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('user');
        return $query->row_array();
    }

    public function updateUser($id_user, $data)
    {

        $this->db->where('id_user', $id_user);
        return $this->db->update('user', $data);
    }

    public function checkIfExists($table, $column, $value)
    {
        $this->db->from($table);
        $this->db->where($column, $value);
        $query = $this->db->get();

        return $query->num_rows() > 0;
    }
    public function get_by_status($status)
    {
        return $this->db->get_where('tbl_spk', ['status_approval' => $status])->result_array();
    }


    public function count_users_by_role($role)
    {
        $this->db->where('role', $role);
        return $this->db->count_all_results('user');
    }


}
