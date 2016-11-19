<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Matakuliah_model extends CI_Model
{

    public $table = 'matakuliah';
    public $id = 'id_matakuliah';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_detail($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_by_param($smt, $jrs)
    {
        $this->db->from('matakuliah');
        $this->db->join('jurusan', 'jurusan.id_jurusan = matakuliah.id_jurusan');
        $this->db->where('matakuliah.semester', $smt);
        $this->db->where('jurusan.nama_kode', $jrs);
        return $this->db->get()->result();
    }

    // get data by id
    function get_by_id($id, $smt, $jur)
    {
        $this->db->from('matakuliah');
        $this->db->join('jurusan', 'jurusan.id_jurusan = matakuliah.id_jurusan');
        $this->db->where('matakuliah.semester', $smt);
        $this->db->where('jurusan.nama_kode', $jur);
        $this->db->where($this->id, $id);
        return $this->db->get()->row();
    }

    function get_id($id)
    {
        $this->db->from('jurusan');
        $this->db->where('jurusan.nama_kode', $id);
        return $this->db->get()->row();
    }

    // insert data
    function insert($field)
    {
        $this->db->insert($this->table, $field);
        return $this->db->insert_id();
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Matakuliah_model.php */
/* Location: ./application/models/Matakuliah_model.php */