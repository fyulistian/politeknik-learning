<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Soal_model extends CI_Model
{

    public $table = 'soal';
    public $id = 'id_soal';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    public function my_course($id) 
    {
        $data = $this->db->query("SELECT * FROM course WHERE id_course = '$id' ")->result_array();
        return $data[0]['nama_course'];
    }

    function course_soal($nip)
    {
        $this->db->from('mengajar');
        $this->db->join('matakuliah', 'matakuliah.id_matakuliah = mengajar.id_matakuliah');
        $this->db->where('mengajar.nip', $nip);
        $query = $this->db->get();
        return $query->result();
    }

    function get_all_query()
    {
        // $param = $this->session->userdata('email');
        $this->db->from('course');
        // $this->db->join('course', 'course.id_course = soal.id_course');
        $this->db->join('matakuliah', 'matakuliah.id_matakuliah = course.id_matakuliah');
        $this->db->join('dosen', 'dosen.nip = course.nip');
        // $this->db->join('user', 'user.email = dosen.email');
        // $this->db->where('user.email', $param);
        // $this->db->group_by(array('soal.id_course', 'matakuliah.nama_matakuliah'));
        $query = $this->db->get();
        return $query->result();
    }

    function get_all_by_id($id)
    {   
        $param = $this->session->userdata('email');
        $this->db->from('soal');
        $this->db->join('course', 'course.id_course = soal.id_course');
        $this->db->join('matakuliah', 'matakuliah.id_matakuliah = course.id_matakuliah');
        $this->db->join('dosen', 'dosen.nip = course.nip');
        $this->db->join('user', 'user.email = dosen.email');
        $this->db->where('user.email', $param);
        $this->db->where('soal.id_soal', $id);
        return $this->db->get()->row();
    }

    function get_soal_by_id($id)
    {   
        $this->db->from($this->table);
        $this->db->where($this->id, $id);
        return $this->db->get()->row();
    }

    function get_course_by_id($id)
    {   
        $this->db->from('course');
        $this->db->where('id_course', $id);
        return $this->db->get()->row();
    }

    function get_id($id)
    {
        $this->db->from('course');
        $this->db->where('id_course', $id);
        return $this->db->get()->row();
    }

    function get_by_id($id)
    {   
        $param = $this->session->userdata('email');
        $this->db->from('soal');
        $this->db->join('course', 'course.id_course = soal.id_course');
        $this->db->join('matakuliah', 'matakuliah.id_matakuliah = course.id_matakuliah');
        $this->db->join('dosen', 'dosen.nip = course.nip');
        $this->db->join('user', 'user.email = dosen.email');
        $this->db->where('user.email', $param);
        $this->db->where('soal.id_course', $id);
        return $this->db->get()->result();
    }

    function detail_question($id,$soal)
    {   
        $param = $this->session->userdata('email');
        $this->db->from('soal');
        $this->db->join('course', 'course.id_course = soal.id_course');
        $this->db->join('matakuliah', 'matakuliah.id_matakuliah = course.id_matakuliah');
        $this->db->join('dosen', 'dosen.nip = course.nip');
        $this->db->join('user', 'user.email = dosen.email');
        $this->db->where('user.email', $param);
        $this->db->where('soal.id_course', $id);
        $this->db->where('soal.soal', $soal);
        return $this->db->get()->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert('course', $data);
        return $this->db->insert_id();
    }

    // update data course
    function update_course($id, $data)
    {
        $this->db->where('id_course', $id);
        $this->db->update('course', $data);
    }
    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data course
    function delete_course($id)
    {
        $this->db->where('id_course', $id);
        $this->db->delete('course');
    }

    // delete binding data
    function delete_all($id)
    {
        $this->db->where('id_course', $id);
        $this->db->delete($this->table);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Soal_model.php */
/* Location: ./application/models/Soal_model.php */