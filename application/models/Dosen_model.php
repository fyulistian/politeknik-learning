<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dosen_model extends CI_Model
{

    public $table = 'dosen';
    public $id    = 'nip';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    public function total_lecturer()
    {
        $this->db->select($this->id);
        $this->db->from($this->table);
        $num_results = $this->db->count_all_results();
        return $num_results;
    }

    public function my_nip($email) 
    {
        $data = $this->db->query("SELECT * FROM dosen WHERE email = '$email' ")->result_array();
        return $data[0]['nip'];
    }

    public function my_email($nip) 
    {
        $data = $this->db->query("SELECT * FROM dosen WHERE nip = '$nip' ")->result_array();
        return $data[0]['email'];
    }

    public function my_name($email) 
    {
        $data = $this->db->query("SELECT * FROM dosen WHERE email = '$email' ")->row();
        return $data;
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
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $tables = array('user','dosen');
        $this->db->where('email', $id);
        $this->db->delete($tables);
    }

}
