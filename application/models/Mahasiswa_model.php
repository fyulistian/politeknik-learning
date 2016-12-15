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

    public function total_collager()
    {
        $this->db->select($this->id);
        $this->db->from($this->table);
        $num_results = $this->db->count_all_results();
        return $num_results;
    }

    public function my_nim($email) 
    {
        $data = $this->db->query("SELECT * FROM mahasiswa WHERE email = '$email' ")->result_array();
        return $data[0]['nim'];
    }

    public function my_email($nim) 
    {
        $data = $this->db->query("SELECT * FROM mahasiswa WHERE nim = '$nim' ")->result_array();
        return $data[0]['email'];
    }

    public function my_name($email) 
    {
        $data = $this->db->query("SELECT * FROM mahasiswa WHERE email = '$email' ")->row();
        return $data;
    }

    function get_all_query()
    {
        $this->db->from('mahasiswa');
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
        $tables = array('user','mahasiswa');
        $this->db->where('email', $nim);
        $this->db->delete($tables);
    }

}