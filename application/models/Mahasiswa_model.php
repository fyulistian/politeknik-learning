<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mahasiswa_model extends CI_Model
{

    public $table = 'mahasiswa';
    public $id = 'nim';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    public function my_nim($email) 
    {
        $data = $this->db->query("SELECT * FROM mahasiswa WHERE email = '$email' ")->result_array();
        return $data[0]['nim'];
    }

    public function my_name($email) 
    {
        $data = $this->db->query("SELECT * FROM mahasiswa WHERE email = '$email' ")->row();
        return $data;
    }

    function get_all_query()
    {
        $this->db->from('mahasiswa');
        $this->db->join('detail_kelas', 'detail_kelas.nim = mahasiswa.nim');
        $this->db->join('kelas', 'kelas.id_kelas = detail_kelas.id_kelas');
        $this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan');
        return $this->db->get()->result();
    }

    function rpt_get_all()
    {
        $this->db->from($this->table);
        return $this->db->get()->result();
    }

    // get data by nim
    function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('nim',$id);
        $query = $this->db->get();
        return $query->row();
    }

    // get data by nim with jurusan
    function get_all_by_id($id)
    {   
        $this->db->from($this->table);
        $this->db->join('detail_kelas', 'detail_kelas.nim = mahasiswa.nim');
        $this->db->join('kelas', 'kelas.id_kelas = detail_kelas.id_kelas');
        $this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan');
        $this->db->where('mahasiswa.nim', $id);
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
    function delete($nim)
    {
        $this->db->where($this->id, $nim);
        $this->db->delete($this->table);
    }

}