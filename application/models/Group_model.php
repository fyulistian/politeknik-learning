<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_model extends CI_Model {

	public $table = 'group';
    public $id = 'id_group';
    public $order = 'DESC';

	function get_group_by($nip)
	{
		$this->db->from('group');
		$this->db->join('dosen', 'dosen.nip = group.nip');
        $this->db->where('dosen.nip', $nip);
		return $this->db->get()->result();
	}

	function check_group($id)
    {
        $this->db->from('group');
    	$this->db->where('nama_group', $id);
        return $data = $this->db->get()->row();
    }

    function check_nim_group($nim, $id)
    {
        $this->db->from('detail_group');
        $this->db->where('nim', $nim);
        $this->db->where('id_group', $id);
        return $data = $this->db->get()->num_rows();
    }

    function get_all_by_id($id)
    {   
        $this->db->from($this->table);
        $this->db->where('group.id_group', $id);
        return $this->db->get()->row();
    }

    function get_group($id)
    {
        $this->db->from('detail_group');
        $this->db->join('group', 'group.id_group = detail_group.id_group');
        $this->db->join('mahasiswa', 'mahasiswa.nim = detail_group.nim');
        $this->db->where('group.id_group', $id);
        return $this->db->get()->result();
    }

    function get_detail($id)
    {
        $this->db->select('nim');
        $this->db->from('detail_kelas');
        $this->db->where('id_kelas', $id);
        return $this->db->get()->result();
    }

    function insert_batch($data)
    {
        $this->db->insert_batch('detail_group', $data);
    }

    function detailed($id)
    {
        $this->db->from('group_post');
        $this->db->join('group', 'group.id_group = group_post.id_group');
        $this->db->join('dosen', 'dosen.nip = group.nip');
        $this->db->where('group_post.id_group', $id);
        return $this->db->get()->result();
    }

    function get_publish($id)
    {
        $this->db->from($this->table);
        $this->db->where($this->id, $id);
        return $this->db->get()->row();
    }

    function get_all_group()
    {
        $this->db->from($this->table);
        return $this->db->get()->result();   
    }

    function get_title($id)
    {
        $this->db->from($this->table);
        $this->db->where($this->id, $id);
        return $this->db->get()->row();
    }

    function register($field)
    {
        $this->db->insert('detail_group', $field);
        return $this->db->insert_id();
    }

    function check_nim($nim, $id)
    {
        $this->db->from('detail_group');
        $this->db->where('nim', $nim);
        $this->db->where('id_group', $id);
        return $data = $this->db->get()->row();
    }

    function publish($field)
    {
        $this->db->insert('group_post', $field);
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
        $this->db->where('id_group', $id);
        $this->db->delete($this->table);
    }

    function delete_member($id)
    {
        $this->db->where('id_group', $id);
        $this->db->delete('detail_group');
    }

    function delete_me($nim, $id)
    {
        $this->db->where('id_group', $id);
        $this->db->where('nim', $nim);
        $this->db->delete('detail_group');
    }

}

/* End of file Group_model.php */
/* Location: ./application/models/Group_model.php */