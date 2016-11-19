<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Decide_model extends CI_Model {

	public $table = 'diajar';
    public $id = 'id_diajar';
    public $order = 'ASC';
	
    function get_all($param1, $param2, $param3)
    {
        $this->db->from('diajar');
        $this->db->join('kelas', 'kelas.id_kelas = diajar.id_kelas');
        $this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun_ajaran = kelas.id_tahun_ajaran');
        $this->db->join('matakuliah', 'matakuliah.id_matakuliah = diajar.id_matakuliah');
        $this->db->where('kelas.id_kelas', $param1);
        $this->db->where('kelas.semester', $param2);
        $this->db->where('jurusan.nama_jurusan', $param3);
        $this->db->order_by('kelas.nama_kelas', $this->order);
        return $this->db->get()->result();
    }

    function get_kelas($nim)
    {
        $this->db->from('detail_kelas');
        $this->db->where('nim', $nim);
        return $this->db->get()->row();
    }

    function get_smt($id)
    {
    	$this->db->from('kelas');
    	$this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun_ajaran = kelas.id_tahun_ajaran');
        $this->db->where('kelas.id_kelas', $id);
        $this->db->order_by('kelas.nama_kelas', $this->order);
        return $this->db->get()->row();
    }

    function get_class($id, $semester)
    {
    	$this->db->from('kelas');
        $this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan');
        $this->db->join('diajar', 'diajar.id_kelas = kelas.id_kelas');
        $this->db->join('matakuliah', 'matakuliah.id_matakuliah = diajar.id_matakuliah');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun_ajaran = kelas.id_tahun_ajaran');
        $this->db->where('kelas.id_kelas', $id);
        $this->db->where('kelas.semester', $semester);
        $this->db->order_by('kelas.nama_kelas', $this->order);
        return $this->db->get()->result();
    }

    function valid_id($param1, $id)
    {
        $this->db->from($this->table);
        $this->db->where('id_matakuliah', $param1);
        $this->db->where('id_kelas', $id);
        return $this->db->get()->result();
    }

    function get_by_id($id)
    {
        $this->db->from('diajar');
        $this->db->join('matakuliah', 'matakuliah.id_matakuliah = diajar.id_matakuliah');
        $this->db->join('kelas', 'kelas.id_kelas = diajar.id_kelas');
        $this->db->where('diajar.id_diajar', $id);
        return $this->db->get()->row();
    }

    function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
    
}

/* End of file Decide_model.php */
/* Location: ./application/models/Decide_model.php */