<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ujo_pokok_model extends MY_Model
{
    private $table = 'uang_jalan_pokok';

    public function get_all()
    {
        return $this->db->get($this->table)->result_array();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }
    public function get_ujo_by_rule($origin, $destination, $tipe_angkutan)
    {
        return $this->db->get_where('uang_jalan_pokok', [
            'origin' => $origin,
            'destination' => $destination,
            'tipe_angkutan' => $tipe_angkutan
        ])->row();
    }

    public function get_origin_unique()
    {
        $this->db->distinct();
        $this->db->select('origin');
        return $this->db->get('uang_jalan_pokok')->result();
    }


    public function get_destination_unique()
    {
        $this->db->distinct();
        $this->db->select('destination');
        return $this->db->get('uang_jalan_pokok')->result();
    }

    public function get_ujo($origin, $destination, $tipe)
    {
        return $this->db->get_where('uang_jalan_pokok', [
            'origin' => $origin,
            'destination' => $destination,
            'tipe_angkutan' => $tipe
        ])->row_array();
    }



}

