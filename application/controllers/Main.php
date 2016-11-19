<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct() {
		parent::__construct();
  	}

	public function index() {
		$cekdata = $this->session->userdata('logged_in');
        if (empty($cekdata)) {
            echo "<script>document.location.href='".base_url('auth')."';</script>";
        } else {
            if ($this->session->userdata('level') == 'mahasiswa') {
                $this->load->model('Mahasiswa_model');
                $this->load->model('Decide_model');
                $this->load->model('Nilai_model');
                $user   = $this->session->userdata('email');
                $mhs    = $this->Mahasiswa_model->my_name($user);
                $name   = ucwords($mhs->nama_depan).', '.ucwords($mhs->nama_belakang);
                $img    = $mhs->gambar;
                $nim    = $mhs->nim;
                $kelas  = $this->Decide_model->get_kelas($nim);
                $id     = $kelas->id_kelas;
                $smt    = $this->Decide_model->get_smt($id);
                $class  = $smt->nama_kode.' '.$smt->tahun_masuk.' '.$smt->nama_kelas;
                $course = $this->Nilai_model->get_course($id, $nim);
                $data   = array(
                            'email'       => $user,
                            'level'       => $this->session->userdata('level'),
                            'home'        => 'active',
                            'course'      => '',
                            'forum'       => '',
                            'group'       => '',
                            'gambar'      => $img,
                            'nama_mhs'    => $name,
                            'classroom'   => $class,
                            'data_course' => $course,
                            'id_kelas'    => $id,
                            'nim'         => $mhs->nim,
                         );
                $this->template->load('home','home/me', $data);
            } else if ($this->session->userdata('level') == 'dosen') {
                $data['email']      = $this->session->userdata('email');
                $data['level']      = $this->session->userdata('level');
                $data['soal']       = '';
                $data['forum']      = '';
                $data['group']      = '';
                $data['user']       = '';
                $data['dosen']      = '';
                $data['upload']     = '';
                $data['diajar']     = '';
                $data['jurusan']    = '';
                $data['angkatan']   = '';
                $data['mengajar']   = '';
                $data['mahasiswa']  = '';
                $data['matakuliah'] = '';
                $data['kelas']      = '';
                $data['dashboard']  = 'active';
                $this->template->load('template','banner', $data);
            } else {
                $data['email']      = $this->session->userdata('email');
                $data['level']      = $this->session->userdata('level');
                $data['soal']       = '';
                $data['user']       = '';
                $data['forum']      = '';
                $data['dosen']      = '';
                $data['group']      = '';
                $data['upload']     = '';
                $data['diajar']     = '';
                $data['jurusan']    = '';
                $data['angkatan']   = '';
                $data['mengajar']   = '';
                $data['mahasiswa']  = '';
                $data['matakuliah'] = '';
                $data['kelas']      = '';
                $data['dashboard']  = 'active';
                $this->template->load('template','banner', $data);
            }
        }
	}

}

/* End of file Main.php */
/* Location: ./application/controllers/Main.php */
