<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dosen_model extends CI_Model
{

    public $table = 'dosen';
    public $id = 'nip';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    public function my_nip($email) 
    {
        $data = $this->db->query("SELECT * FROM dosen WHERE email = '$email' ")->result_array();
        return $data[0]['nip'];
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
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}
