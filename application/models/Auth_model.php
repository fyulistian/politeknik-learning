<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model {

	function __construct() 
	{
		parent:: __construct();
	}

	public function getLoginData($email) 
	{
		$this->db->where('email',$email);
		$querry = $this->db->get('user');
		if ($querry->num_rows() == 1) {
			foreach ($querry->result() as $row) {
				$data = array(
							'logged_in' => 'Yes',
							'nama_user' => $row->nama_user,
							'email' => $row->email,
							'level' => $row->level
					);
			}
		//SESSION DI CODEIGNITER
		$this->session->set_userdata($data);
		return $querry->row_array();
		}
	}

	public function get_setting_dsn()
	{
		$un = $this->session->userdata('email');
        $this->db->from('user');
        $this->db->join('dosen', 'dosen.email = user.email');
        $this->db->where('user.email', $un);
        return $this->db->get()->result();
	}

	public function get_setting_mhs()
	{
		$un = $this->session->userdata('email');
        $this->db->from('user');
        $this->db->join('mahasiswa', 'mahasiswa.email = user.email');
        $this->db->where('user.email', $un);
        return $this->db->get()->result();
	}

	public function get_setting_adm()
	{
		$un = $this->session->userdata('email');
        $this->db->from('user');
        $this->db->where('user.email', $un);
        return $this->db->get()->result();
	}

	function updatefoto($data, $condition, $condition1){
        $this->db->where($condition);
        $update = $this->db->update($condition1, $data);
        return $update;
    }
    
	function cekPass($email) {
        $this->db->select('password');
        $this->db->from('user');
        $this->db->where('email', $email);
        $ck = $this->db->get();
        if ($ck->num_rows()>0){
            return $ck->row_array();
        }
    }

    function updPass($email,$newHash) {
        $data = array(
                    'password' => $newHash
            );
        $this->db->where('email',$email);
        $update = $this->db->update('user',$data);
        return TRUE;
    }

}

/* End of file Auth_model.php */
/* Location: ./application/models/Auth_model.php */