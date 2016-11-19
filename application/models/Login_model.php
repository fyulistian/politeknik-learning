<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_model extends CI_Model
{

    public $table = 'user';
    public $id = 'email';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by('level', $this->order);
        return $this->db->get($this->table)->result();
    }
    
    // get data by id
    function get_by_id($id)
    {
        $this->db->where('nama_user', $id);
        return $this->db->get($this->table)->row();
    }

    // get data by email
    function get_by_email($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function insert($field)
    {
        $this->db->insert($this->table, $field);
        return $this->db->insert_id();
    }
    
    // update data
    function update($id, $data)
    {
        $this->db->where('nama_user', $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where('nama_user', $id);
        $this->db->delete($this->table);
    }

}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */