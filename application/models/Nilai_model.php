<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai_model extends CI_Model {

	function get_course($id, $nim)
	{
		$this->db->from('matakuliah');
		$this->db->join('diajar', 'diajar.id_matakuliah = matakuliah.id_matakuliah');
		$this->db->join('kelas', 'kelas.id_kelas = diajar.id_kelas');
		$this->db->join('detail_kelas', 'detail_kelas.id_kelas = kelas.id_kelas');
		$this->db->where('kelas.id_kelas', $id);
		$this->db->where('detail_kelas.nim', $nim);
		return $this->db->get()->result();
	}

	function get_all_course($course, $id, $nim)
	{
		$this->db->from('course');
		$this->db->join('jawaban', 'jawaban.id_course = course.id_course');
		$this->db->join('mahasiswa', 'mahasiswa.nim = jawaban.nim');
		$this->db->join('matakuliah', 'matakuliah.id_matakuliah = course.id_matakuliah');
		$this->db->join('detail_kelas', 'detail_kelas.nim = mahasiswa.nim');
		$this->db->join('kelas', 'kelas.id_kelas = detail_kelas.id_kelas');
		$this->db->where('kelas.id_kelas', $id);
		$this->db->where('mahasiswa.nim', $nim);
		$this->db->where('matakuliah.nama_matakuliah', $course);
		return $this->db->get()->result();
	}

}

/* End of file Nilai_model.php */
/* Location: ./application/models/Nilai_model.php */