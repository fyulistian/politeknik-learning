<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelas_model extends CI_Model
{

    public $table = 'kelas';
    public $id = 'id_kelas';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    function get_all()
    {
        $this->db->from('kelas');
        $this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun_ajaran = kelas.id_tahun_ajaran');
        $this->db->order_by('nama_kelas', $this->order);
        return $this->db->get()->result();
    }

    function detailed($id)
    {
        $this->db->from('kelas');
        $this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun_ajaran = kelas.id_tahun_ajaran');
        $this->db->where($this->id, $id);
        return $this->db->get()->row();
    }

    function get_id($id)
    {
        $this->db->from('kelas');
        $this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan');
        $this->db->where($this->id, $id);
        return $this->db->get()->result();
    }

    function get_mhs($jurusan, $id)
    {
        $this->db->from('mahasiswa');
        $this->db->join('detail_kelas', 'detail_kelas.nim = mahasiswa.nim');
        $this->db->join('kelas', 'kelas.id_kelas = detail_kelas.id_kelas');
        $this->db->where('kelas.id_jurusan', $jurusan);
        $this->db->where('kelas.id_kelas', $id);
        return $this->db->get()->result();
    }

    // valid all
    function valid_all($param1,$param2,$param3,$param4)
    {
        $this->db->from('kelas');
        $this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun_ajaran = kelas.id_tahun_ajaran');
        $this->db->where('kelas.nama_kelas', $param1);
        $this->db->where('kelas.id_jurusan', $param2);
        $this->db->where('kelas.semester', $param4);
        $this->db->where('tahun_ajaran.id_tahun_ajaran', $param3);
        $this->db->order_by('nama_kelas', $this->order);
        return $this->db->get()->result();
    }

    function valid_nim($param1)
    {
        $this->db->from('detail_kelas');
        $this->db->where('detail_kelas.nim', $param1);
        return $this->db->get()->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->from('kelas');
        $this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun_ajaran = kelas.id_tahun_ajaran');
        $this->db->where('kelas.id_kelas', $id);
        return $this->db->get()->row();
    }
    
    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    function insert_collager($data)
    {
        $this->db->insert('detail_kelas', $data);
        return $this->db->insert_id();
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function del($id)
    {
        // $this->db->where('id_kelas', $uri);
        $this->db->where('nim', $id);
        $this->db->delete('detail_kelas');
    }

    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function delete_all($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete('diajar');
    }

    function delete_det($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete('detail_kelas');
    }
}

/* End of file Kelas_model.php */
/* Location: ./application/models/Kelas_model.php */