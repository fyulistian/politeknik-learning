<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Android_model extends CI_Model {

	public function getLog($email,$password) 
	{
		$this->db->from('login');
        $this->db->where('email',$email);
        $this->db->where('password',$password);
        $this->db->where('level !=','administrator');
        $this->db->where('level !=','dosen');
        $this->db->where('level !=','Dosen');
        $q = $this->db->get();
        if ($q->num_rows()==1){
            return $q;
        } else {
            return FALSE;
        }
    }

    public function check_password($id)
    {
        $this->db->select('password');
        $this->db->from('login');
        $this->db->where('id',$id);
        $cari = $this->db->get();
        if ($cari->num_rows()>0){
            return $cari->row_array();
        }
    }
    
    public function sandi()
    {
        $this->datapass = array(
          'password' => $this->input->post('passbaru1')
        );
    }


    public function change_password($id) 
    {
        $this->db->where('id',$id);
        $update = $this->db->update('login',$this->datapass);
        return $update;
    }

    public function check_status() 
    {
        $this->db->from('task');
        $this->db->join('matakuliah', 'matakuliah.idmk = task.idmk');
        $query = $this->db->get();
        if ($query->num_rows()>0){
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function check_nilai($id) 
    {
         $query = $this->db->query("SELECT mahasiswa.nim, matakuliah.namamk, task.section, nilai.nilai, nilai.tanggal FROM nilai, login, mahasiswa, matakuliah, task WHERE login.email = mahasiswa.email AND mahasiswa.nim = nilai.nim AND task.idtask = nilai.idtask AND task.idmk = matakuliah.idmk AND login.id = '$id'");
        if ($query->num_rows()>0){
            return $query->result();
        } else {
            return FALSE;
        }
    }

} 

/* End of file Android_model.php */
/* Location: ./application/models/Android_model.php */