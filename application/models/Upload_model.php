<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload_model extends CI_Model
{

    public $table = 'materi';
    public $id = 'id_materi';
    public $order = 'DESC';

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

    function get_all_query($param)
    {
        $this->db->from($this->table);
        $this->db->join('course', 'course.id_course = materi.id_course');
    	$this->db->join('matakuliah', 'matakuliah.id_matakuliah = course.id_matakuliah');
        $this->db->join('dosen', 'dosen.nip = course.nip');
    	$this->db->join('user', 'user.email = dosen.email');
    	$this->db->where('user.email', $param);
    	$query = $this->db->get();
    	return $query->result();
    }

    function get_dosen($param)
    {
        $this->db->where('email', $param);
        return $this->db->get('dosen')->row();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    function get_all_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->join('course', 'course.id_course = materi.id_course');
        $this->db->join('matakuliah', 'matakuliah.id_matakuliah = course.id_matakuliah');
        $this->db->where($this->id, $id);
        return $this->db->get()->row();
    }

    // save data
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $field)
    {
        $this->db->update($this->table, $field, $id);
        return $this->db->affected_rows();
    }

    // delete data
    function delete_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}
