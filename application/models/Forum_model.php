<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_model extends CI_Model {

	public $table = 'forum';
    public $id = 'id_forum';
    public $order = 'DESC';

	function get_all_query($id_course, $nip)
    {
        $this->db->from($this->table);
        $this->db->join('course', 'course.id_course = forum.id_course');
        $this->db->join('dosen', 'dosen.nip = course.nip');
        $this->db->join('matakuliah', 'matakuliah.id_matakuliah = course.id_matakuliah');
        $this->db->where('forum.id_course', $id_course);
        $this->db->where('dosen.nip', $nip);
        $this->db->order_by('forum.tanggal_post', 'desc');
        return $this->db->get()->result();
    }

    function get_all_query_group_by()
    {
        $this->db->from($this->table);
        $this->db->join('course', 'course.id_course = forum.id_course');
        $this->db->join('dosen', 'dosen.nip = course.nip');
        $this->db->join('matakuliah', 'matakuliah.id_matakuliah = course.id_matakuliah');
        $this->db->group_by('course.nama_course');
        return $this->db->get()->result();
    }

    function get_all_forum_group_by()
    {
        $user = $this->session->userdata('email');
        $nim = $this->Mahasiswa_model->my_nim($user);
        $this->db->from('forum');
        $this->db->join('course', 'course.id_course = forum.id_course');
        $this->db->join('matakuliah', 'matakuliah.id_matakuliah = course.id_matakuliah');
        $this->db->join('diajar', 'diajar.id_matakuliah = matakuliah.id_matakuliah');
        $this->db->join('kelas', 'kelas.id_kelas = diajar.id_kelas');
        $this->db->join('detail_kelas', 'detail_kelas.id_kelas = kelas.id_kelas');
        $this->db->join('mahasiswa', 'mahasiswa.nim = detail_kelas.nim');
        $this->db->where('course.status', 'Available');
        $this->db->where('mahasiswa.nim', $nim);
        $this->db->group_by(array('course.nama_course'));
        return $this->db->get()->result();
    }

    function get_all_forum($id_course, $nim)
    {
        $this->db->from('forum');
        $this->db->join('course', 'course.id_course = forum.id_course');
        $this->db->join('matakuliah', 'matakuliah.id_matakuliah = course.id_matakuliah');
        $this->db->join('diajar', 'diajar.id_matakuliah = matakuliah.id_matakuliah');
        $this->db->join('kelas', 'kelas.id_kelas = diajar.id_kelas');
        $this->db->join('detail_kelas', 'detail_kelas.id_kelas = kelas.id_kelas');
        $this->db->join('mahasiswa', 'mahasiswa.nim = detail_kelas.nim');
        $this->db->where('course.status', 'Available');
        $this->db->where('forum.id_course', $id_course);
        $this->db->where('mahasiswa.nim', $nim);
        $this->db->order_by('forum.tanggal_post', 'asc');
        return $this->db->get()->result();
    }

    function get_discussion($id)
    {
    	$this->db->select('mahasiswa.gambar AS mhs_gambar, mahasiswa.nama_depan AS mhs_nama_depan, mahasiswa.nama_belakang AS mhs_nama_belakang, mahasiswa.nim');
    	$this->db->select('forum.*');
    	$this->db->select('dosen.*');
    	$this->db->select('course.*');
    	$this->db->select('matakuliah.*');
    	$this->db->select('detail_forum.*');
    	$this->db->from($this->table);
    	$this->db->join('detail_forum', 'detail_forum.id_forum = forum.id_forum');
    	$this->db->join('mahasiswa', 'mahasiswa.nim = detail_forum.nim');
        $this->db->join('course', 'course.id_course = forum.id_course');
        $this->db->join('dosen', 'dosen.nip = course.nip');
        $this->db->join('matakuliah', 'matakuliah.id_matakuliah = course.id_matakuliah');
        $this->db->where('forum.id_forum', $id);
        return $this->db->get()->result();
    }

    function get_forum($id)
    {
    	$this->db->from($this->table);
        $this->db->join('course', 'course.id_course = forum.id_course');
        $this->db->join('dosen', 'dosen.nip = course.nip');
        $this->db->where('forum.id_forum', $id);
        return $this->db->get()->result();
    }

    function get_detail_forum($id)
    {
    	$this->db->from('detail_forum');
        $this->db->where('id_forum', $id);
        $data = $this->db->get();
		  if($data->num_rows() > 0) {
		  	$result = $data->result_array();
		   	return $result[0]['id_detail_forum'];
		  }
		return $data->row();;
    }

    function get_topics($id)
    {
    	$this->db->from($this->table);
    	$this->db->where($this->id, $id);
    	return $this->db->get()->row();
    }

    function get_all_by_id($id)
    {   
        $this->db->from($this->table);
        $this->db->join('course', 'course.id_course = forum.id_course');
        $this->db->where('forum.id_forum', $id);
        return $this->db->get()->row();
    }

    function get_replies($id)
    {
    	$this->db->from('replies');
    	$this->db->join('dosen', 'dosen.nip = replies.replies_by');
    	$this->db->where('id_detail_forum', $id);
    	return $this->db->get()->result();
    }

    function check_forum($id)
    {
    	$this->db->like('forum_title', $id);
        $this->db->from('forum');
        return $data = $this->db->count_all_results();
    }

    function insert($data)
    {
        $this->db->insert('replies', $data);
        return $this->db->insert_id();
    }

    function insert_comment($data)
    {
        $this->db->insert('detail_forum', $data);
        return $this->db->insert_id();
    }

    function insert_in($field)
    {
        $this->db->insert($this->table, $field);
        return $this->db->insert_id();
    }

    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function delete($id)
    {
        $this->db->where('id_forum', $id);
        $this->db->delete($this->table);
    }

    function delete_replies($id)
    {
        $this->db->where('id_detail_forum', $id);
        $this->db->delete('replies');
    }

    function delete_detail($id)
    {
        $this->db->where('id_forum', $id);
        $this->db->delete('detail_forum');
    }

}

/* End of file Forum_model.php */
/* Location: ./application/models/Forum_model.php */