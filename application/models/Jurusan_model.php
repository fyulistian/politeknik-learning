<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jurusan_model extends CI_Model
{

    public $table = 'jurusan';
    public $id = 'id_jurusan';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    public function total_major()
    {
        $this->db->select($this->id);
        $this->db->from($this->table);
        $num_results = $this->db->count_all_results();
        return $num_results;
    }

    function valid_id($param1)
    {
        $this->db->from('jurusan');
        $this->db->where('jurusan.id_jurusan', $param1);
        return $this->db->get()->result();
    }

    function valid_name($param2)
    {
        $this->db->from('jurusan');
        $this->db->where('jurusan.nama_jurusan', $param2);
        return $this->db->get()->result();
    }

    function valid_code($param3)
    {
        $this->db->from('jurusan');
        $this->db->where('jurusan.nama_kode', $param3);
        return $this->db->get()->result();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        return $this->db->update($this->table, $data);

    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Jurusan_model.php */
/* Location: ./application/models/Jurusan_model.php */