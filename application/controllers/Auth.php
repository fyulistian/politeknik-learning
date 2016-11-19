<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Auth_model');
  	}

	public function index() {
		$cekdata = $this->session->userdata('logged_in');
        if (empty($cekdata)) {
            $this->load->view('auth/login');
        } else {
        	echo "<script>document.location.href='".base_url()."';</script>";
        }
	}

	public function login() {
		$email = $this->input->post('login_email');
		$password = $this->input->post('login_password');
		// qwe
		// $2y$10$x1HAmNLDvfSW2dU2m2sBruHO1ur.TMWT04VH1EJSvFdH1kF79kftS
		$cekdata = $this->Auth_model->getLoginData($email);
		if ($cekdata) {
			$hash = $cekdata['password'];
			if (password_verify($password, $hash)) {
			    echo 1;
			    // echo json_encode($cekdata);
			} else {
			    echo 0;
			    $this->session->unset_userdata('logged_in');
			    redirect(site_url('auth'));
			}
		} else {
		 	echo 0;
    		redirect(site_url('auth'));
		}
	}


	public function logout() {
		$this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');
		$this->session->sess_destroy();
    	redirect(site_url('auth/login'));
	}

	public function setting() {
		$cekdata = $this->session->userdata('logged_in');
        if (empty($cekdata)) {
            echo "<script>document.location.href='".base_url('auth')."';</script>";
        } else {
        	if ($this->session->userdata('level')=="dosen") {
        		$setting = $this->Auth_model->get_setting_dsn();
	            $data = array(
	            	'setting'		=> $setting,
					'dashboard' 	=> 'active',
	                'soal'      	=> '',
	                'upload'    	=> ''
				);
	        	$this->template->load('template','auth/setting', $data);
        	} else if ($this->session->userdata('level')=="mahasiswa") {
        		$setting = $this->Auth_model->get_setting_mhs();
	            $data = array(
	            	'setting'		=> $setting,
					'dashboard' 	=> 'active',
	                'soal'      	=> '',
	                'upload'    	=> ''
				);
	        	$this->template->load('template','auth/setting', $data);
        	} else {
        		$setting = $this->Auth_model->get_setting_adm();
	            $data = array(
	            	'setting'		=> $setting,
					'dashboard' 	=> 'active',
	                'soal'      	=> '',
	                'user'       => '',
	                'dosen'      => '',
	                'jurusan'    => '',
	                'mahasiswa'  => '',
	                'upload'    	=> ''
				);
	        	$this->template->load('template','auth/setting', $data);
        	}
        }
	}

	public function editpersonal() {
        if ($_POST['Submit'] == 'updatepassword') {
            $email = $this->session->userdata('email');
            $password = $this->input->post('password');
            $passwordnew = $this->input->post('passwordnew');
            $passwordconfirm  = $this->input->post('passwordconfirm');
            if ($password == "" || $passwordnew == "" || $passwordconfirm == "") {
	            $filename = strtolower($this->input->post('nama_depan').$this->input->post('nama_belakang'));
	        	$config = array(
	        		'file_name' => $filename,
					'upload_path' => "./uploads/img/",
					'allowed_types' => "jpg|jpeg|png",
					'overwrite' => TRUE,
					'max_size' => "40000",
					'max_width' => "1036",
					'max_height' => "768"
				);
				$this->load->library('upload', $config);
				if ( ! $this->upload->do_upload('userfile')) {
					echo "<script>alert('Failure');document.location.href='".base_url('auth/setting')."';</script>";
				} else {
					$ext_data = $this->upload->data();
					$ext_name = $ext_data['file_ext'];
					$data = array(
	                    'gambar' => $config['upload_path'].$filename.$ext_name
          			);
					$condition['email'] = $this->input->post('email');
					$condition1 = $this->session->userdata('level');
					$ket = $this->Auth_model->updatefoto($data, $condition,$condition1);
					if ($ket == 1) {
					  echo "<script>alert('Data Edited');document.location.href='".base_url('auth/setting')."';</script>";
					} else {
					  echo "<script>alert('Failure');document.location.href='".base_url('auth/setting')."';</script>";
					}
				}
            } else {
            	if ($passwordnew == $passwordconfirm) {
                $check = $this->Auth_model->cekPass($email);
                $hash = $check['password'];
                if (password_verify($password, $hash)) {
                	$options = array('cost' => 11);
                	if (password_needs_rehash($hash, PASSWORD_BCRYPT, $options)) {
				        $newHash = password_hash($passwordconfirm, PASSWORD_BCRYPT, $options);
				        $cekdata  = $this->Auth_model->updPass($email,$newHash);
	                    if ($cekdata == 1) {
	                    	echo "<script>alert('Password Changed, Please Login Again !!');document.location.href='".base_url('auth/logout')."';</script>";
	                    }
				    } else {
				    	$newHash = password_hash($passwordconfirm, PASSWORD_BCRYPT, $options);
				    	$cekdata  = $this->Auth_model->updPass($email,$newHash);
	                    if ($cekdata == 1) {
	                    	echo "<script>alert('Password Changed, Please Login Again !!');document.location.href='".base_url('auth/logout')."';</script>";
	                    }
				    }
					} else {
					    echo "<script>alert('Incorrect Password');document.location.href='".base_url('auth/setting')."';</script>";
					}
	            } else {
	                echo "<script>alert('Wrong Confirm');document.location.href='".base_url('auth/setting')."';</script>";
	            }
            }
        }
    }
}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */
