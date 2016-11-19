<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Diajar_model extends CI_Model {

	function get_all_query()
    {
        $this->db->from('mahasiswa');
        $this->db->join('jurusan', 'jurusan.id_jurusan = mahasiswa.id_jurusan');
        $this->db->order_by('nim', 'asc');
        return $this->db->get()->result();
    }

    // get data by nim 
    function get_all_by_id($nim)
    {   
    	$this->db->from('mahasiswa');
        $this->db->join('jurusan', 'jurusan.id_jurusan = mahasiswa.id_jurusan');
        $this->db->where('mahasiswa.nim', $nim);
        return $this->db->get()->row();
    }

    function get_all($nim)
    {   
    	$this->db->from('kelas');
        $this->db->join('detail_kelas', 'detail_kelas.id_kelas = kelas.id_kelas');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun_ajaran = detail_kelas.id_tahun_ajaran');
        $this->db->join('mahasiswa', 'mahasiswa.nim = detail_kelas.nim');
        $this->db->join('jurusan', 'jurusan.id_jurusan = mahasiswa.id_jurusan');
        $this->db->where('mahasiswa.nim', $nim);
        return $this->db->get()->row();
    }

    function get_id($id)
    {
        $this->db->from('mahasiswa');
        $this->db->join('detail_kelas', 'detail_kelas.nim = mahasiswa.nim');
        $this->db->where('mahasiswa.nim', $id);
        $query = $this->db->get();
        return $query->row();
    }

	// insert data
    function insert($field)
    {
        $this->db->insert('detail_kelas', $field);
        return $this->db->insert_id();
    }

    // update data
    function update($id, $period, $data)
    {
        $this->db->where('detail_kelas.nim', $id);
        $this->db->where('detail_kelas.id_tahun_ajaran', $period);
        $this->db->update('detail_kelas', $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where('id_detail_kelas', $id);
        $this->db->delete('detail_kelas');
    }

}

/* End of file Diajar_model.php */
/* Location: ./application/models/Diajar_model.php */