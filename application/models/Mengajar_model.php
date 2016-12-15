<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mengajar_model extends CI_Model
{

    public $table = 'mengajar';
    public $id = 'id_mengajar';
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

    function get_id($param)
    {
        $this->db->from($this->table);
        $this->db->join('diajar', 'diajar.id_diajar = mengajar.id_diajar');
        $this->db->join('matakuliah','matakuliah.id_matakuliah', 'diajar.id_matakuliah');
        $this->db->where('mengajar.id_mengajar', $param);
        return $this->db->get()->row();
    }

    function get_classroom($id)
    {
        $this->db->from('dosen');
        $this->db->where('nip', $id);
        return $this->db->get()->row();
    }

    function check($where= "") {
        $data = $this->db->query('SELECT * FROM diajar '.$where);
        return $data;
    }

    function lesson($id, $semester, $id_kelas)
    {
        $this->db->distinct();
        $this->db->from('matakuliah');
        $this->db->join('diajar', 'diajar.id_matakuliah = matakuliah.id_matakuliah');
        $this->db->where('matakuliah.id_jurusan', $id);
        $this->db->where('matakuliah.semester', $semester);
        $this->db->where('diajar.id_kelas', $id_kelas);
        return $this->db->get()->result();
    }

    function get_all_by_id($id)
    {   
        $this->db->from('mengajar');
        $this->db->join('dosen', 'dosen.nip = mengajar.nip');
        $this->db->join('diajar', 'diajar.id_diajar = mengajar.id_diajar');
        $this->db->join('matakuliah', 'matakuliah.id_matakuliah = diajar.id_matakuliah');
        $this->db->join('kelas', 'kelas.id_kelas = diajar.id_kelas');
        $this->db->join('detail_kelas', 'detail_kelas.id_kelas = kelas.id_kelas');
        $this->db->join('mahasiswa', 'mahasiswa.nim = detail_kelas.nim');
        $this->db->join('jurusan', 'jurusan.id_jurusan = mahasiswa.id_jurusan');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun_ajaran = kelas.id_tahun_ajaran');
        $this->db->where('kelas.id_kelas', $id);
        return $this->db->get()->row();
    }

    function get_by_id($nip)
    {
        $this->db->from('mengajar');
        $this->db->join('dosen', 'dosen.nip = mengajar.nip');
        $this->db->join('diajar', 'diajar.id_diajar = mengajar.id_diajar');
        $this->db->join('matakuliah', 'matakuliah.id_matakuliah = diajar.id_matakuliah');
        $this->db->join('kelas', 'kelas.id_kelas = diajar.id_kelas');
        $this->db->join('detail_kelas', 'detail_kelas.id_kelas = kelas.id_kelas');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun_ajaran = kelas.id_tahun_ajaran');
        $this->db->where('kelas.id_kelas', $nip);
        return $this->db->get()->result();
    }

    function group_by_id($nip)
    {
        $this->db->from('mengajar');
        $this->db->join('detail_mengajar', 'detail_mengajar.id_mengajar = mengajar.id_mengajar');
        $this->db->join('matakuliah', 'matakuliah.id_matakuliah = mengajar.id_matakuliah');
        $this->db->join('kelas', 'kelas.id_kelas = detail_mengajar.id_kelas');
        $this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun_ajaran = kelas.id_tahun_ajaran');
        $this->db->where('mengajar.nip', $nip);
        return $this->db->get()->result();
    }

    function insert($field)
    {
        $this->db->insert($this->table, $field);
        return $this->db->insert_id();
    }

    function insert_classroom($data)
    {
        $this->db->insert('mengajar', $data);
        return $this->db->insert_id();
    }

    function insert_detail_mengajar($field)
    {
        $this->db->insert('detail_mengajar', $field);
        return $this->db->insert_id();
    }

    function validasi($id, $idk)
    {
        $this->db->from('mengajar');
        $this->db->join('detail_mengajar', 'detail_mengajar.id_mengajar = mengajar.id_mengajar');
        $this->db->where('mengajar.id_matakuliah', $id);
        $this->db->where('detail_mengajar.id_kelas', $idk);
        return $this->db->count_all_results();
    }
    
    function delete_classroom($id)
    {
        $tables = array('mengajar','group','detail_mengajar');
        $this->db->where('id_mengajar', $id);
        $this->db->delete($tables);
    }

    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Mengajar_model.php */
/* Location: ./application/models/Mengajar_model.php */