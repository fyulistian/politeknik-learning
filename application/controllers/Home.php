<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		allowed('mahasiswa');
		$this->load->model('Auth_model');
		$this->load->model('Mahasiswa_model');
		$this->load->model('Course_model');
		$this->load->model('Forum_model');
		$this->load->model('Decide_model');
		$this->load->model('Group_model');
  	}

	public function index() 
	{
		$cekdata = $this->session->userdata('logged_in');
	        if (empty($cekdata)) {
	            echo "<script>document.location.href='".base_url('auth')."';</script>";
	        }
	}

	public function course()
	{
		$cekdata = $this->session->userdata('logged_in');
	        if (empty($cekdata)) {
	            echo "<script>document.location.href='".base_url('auth')."';</script>";
	        } else {
	        	if ($this->session->userdata('level') == 'mahasiswa') {
					$param           = $this->session->userdata('nama_user');
					$nim             = $this->Course_model->get_nim($param);
					$id              = $nim->nim;
					$idk             = $this->Group_model->my_class($id);
					$course          = $this->Course_model->get_all($id);
					$download_course = $this->Course_model->get_download_course($id, $idk);
	        		$data = array(
						'value'    => $course,
						'download' => $download_course,
						'nim'      => $id,
						'home'     => '',
						'forum'    => '',
						'group'    => '',
						'course'   => 'active',
				);
	        	$this->template->load('home','home/course', $data);
	        	} else {
	        		$this->load->view('error-pages/404');
	        	}
	        }
	}

	public function question()
	{
		$cekdata = $this->session->userdata('logged_in');
		$id = $this->uri->segment(3);
	        if (empty($cekdata)) {
	            echo "<script>document.location.href='".base_url('auth')."';</script>";
	        } else {
	        	if ($this->session->userdata('level') == 'mahasiswa') {
					
					$user = $this->session->userdata('email');
        			$nim = $this->Mahasiswa_model->my_nim($user);
					$field = array(
								'nim' 		=> $nim,
								'tanggal_jawab' => date('Y-m-d H:i:s'),	
							);
					
					$key = $this->Course_model->id_answer('jawaban', $field);

					$question = $this->Course_model->get_question($id);
					$total 	  = $this->Course_model->total_question($id);
					$data = array(
						'value'		  => $question,
						'home'		  => '',
						'group'       => '',
	                	'forum'       => '',
						'id_jawaban'  => $key,
						'total_soal'  => $total->num_rows(),
						'course'	  => 'active',
						'id'	  => $id,
					);
	        		$this->template->load('home','home/question', $data);
	        	} else {
	        		$this->load->view('error-pages/404');
	        	}
	        }
	}

	public function answer()
	{
		$id_jawaban = $this->input->post('id_jawaban'); 
		$id_nomor   = $this->input->post('id_course'); 
        
		$jawaban = $_POST['kunci_jawaban'];
		$id_soal = $_POST['id_soal'];
		$jumlah  = $_POST['jumlah_soal'];

        for ($i=0; $i<$jumlah; $i++) {   		

        	$nomor = $id_soal[$i];
        	$jawaban[$nomor];		    

        	$data = array(
				'id_jawaban' => $id_jawaban,
				'id_soal'    => $nomor,
				'jawaban'    => $jawaban[$nomor],
				'kunci'      => $this->Course_model->get_answer($nomor),
			);
			$this->Course_model->save_detail_answer('detail_jawaban', $data);
		}

		$syntax = $this->Course_model->get_tes("WHERE id_jawaban = $id_jawaban ");
		$jumlah = $syntax->num_rows();
		$nilai  = 100 / $jumlah; 
		foreach($syntax->result_array() as $data) {
			$id_detail_jawaban = $data['id_detail_jawaban'];
			if($data['jawaban'] == $data['kunci']) {
				$data = array(
					'nilai' => $nilai,
				);
			}
			else {
				$data = array(
					'nilai' => 0,
				);
			}
			$this->Course_model->update_nilai($id_detail_jawaban, $data);
		}

		$benar = 0;
		$salah = 0;
		$total_nilai = 0;
		$syntax = $this->Course_model->get_tes("WHERE id_jawaban = $id_jawaban ");
		$jumlah= $syntax->num_rows();
		foreach($syntax->result_array() as $data) {
			if($data['jawaban'] == $data['kunci']) {
				$benar++;
			}
			else {
				$salah++;
			}
			$total_nilai += $data['nilai'];
		}
		$data = array(
		 	'benar' => $benar,
            'salah' => $salah,
            'total_nilai' => $total_nilai,
            'id_course' => $id_nomor,
    	);
    	$this->Course_model->update_total_nilai($id_jawaban, $data);
    	redirect('home/report/'.$id_jawaban);
	}

	public function report($kode = 0)
	{
		$id = $this->uri->segment(3);
		$data = array(
			'kode'		=> $kode,
			'detail'	=> $this->Course_model->get_nilai($id)->result(),		
			'nilai'		=> $this->Course_model->get_detail_nilai($kode)->result_array(),
			'count'		=> $this->Course_model->get_detail_nilai($kode)->num_rows(),
		);
		// echo json_encode($data);
		$this->load->view('home/report', $data);
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
	        	$this->template->load('home','auth/setting', $data);
        	} else if ($this->session->userdata('level')=="mahasiswa") {
        		$setting = $this->Auth_model->get_setting_mhs();
	            $data = array(
	            	'setting'		=> $setting,
					'dashboard' 	=> 'active',
	                'soal'      	=> '',
	                'course'      	=> '',
	                'group'     	=> '',
	                'forum'      	=> '',
	                'home'      	=> '',
	                'upload'    	=> ''
				);
	        	$this->template->load('home','auth/setting', $data);
        	} else {
        		$setting = $this->Auth_model->get_setting_adm();
	            $data = array(
	            	'setting'		=> $setting,
					'dashboard' 	=> 'active',
	                'soal'      	=> '',
	                'user'       	=> '',
	                'dosen'      	=> '',
	                'jurusan'    	=> '',
	                'mahasiswa'  	=> '',
	                'upload'    	=> ''
				);
	        	$this->template->load('home','auth/setting', $data);
        	}
        }
	}

	public function group()
	{
		$user  = $this->session->userdata('email');
		$nim   = $this->Mahasiswa_model->my_nim($user);
		$idk   = $this->Group_model->my_class($nim);
		$group = $this->Group_model->get_all_group($idk);
		$data  = array(
        		'data_group'  => $group,
	         	'nim'   	  => $nim,
	            'home'        => '',
	            'group'       => 'active',
	            'forum'       => '',
	            'course'      => ''
        );
        $this->template->load('home','group/mhs_group', $data);
	}

	public function backToGroup()
	{
		$group = $this->Group_model->get_all_group();
		$user  = $this->session->userdata('email');
		$nim   = $this->Mahasiswa_model->my_nim($user);
		$data  = array(
        		'data_group'  => $group,
	         	'nim'   	  => $nim,
	            'home'        => '',
	            'group'       => 'active',
	            'forum'       => '',
	            'course'      => ''
        );
        $this->load->view('group/mhs_group', $data);
	}

	public function details($id)
	{
		$group      = $this->Group_model->get_publish($id);
		$id_group   = $group->id_group;
		$user = $this->session->userdata('email');
        $mhs  = $this->Mahasiswa_model->my_name($user);
        $name = ucwords($mhs->nama_depan).', '.ucwords($mhs->nama_belakang);
        $img  = $mhs->gambar;
        $nim = $mhs->nim;
		$detail_group = $this->Group_model->detailed($id);
		$data = array(
				'nama_mhs'   => $name,
				'gambar'     => $img,
				'data_group' => $detail_group,
				'id_group'   => $id,
				'nim'        => $nim,
				'home'       => '',
				'forum'      => '',
				'course'     => '',
				'group'      => 'active',
				);	
		$this->load->view('group/mhs_group_details', $data);
	}

	public function ajax_out_group($id)
    {	
    	$user = $this->session->userdata('email');
    	$mhs  = $this->Mahasiswa_model->my_name($user);
    	$nim = $mhs->nim;
    	$field = array(
                    'nim'  => $nim,
                    'id_group'=> $id,
        	);
        $this->Group_model->delete_me($nim, $id);
        echo json_encode(array("status" => TRUE));
        // echo json_encode($field);
    }

	public function ajax_reg_group($id)
    {
    	$user = $this->session->userdata('email');
        $nim = $this->Mahasiswa_model->my_nim($user);
    	$data = array();
        $data['status'] = TRUE;
	 	$check = $this->Group_model->check_nim($nim, $id);
        if(count($check))
        {
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
        $field = array(
                    'nim'  => $nim,
                    'id_group'=> $id,
        	);
        $insert = $this->Group_model->register($field);
        echo json_encode(array("status" => TRUE));
        // echo json_encode($field);
    }

	public function forum()
	{
		$forum = $this->Forum_model->get_all_forum_group_by();
		$user = $this->session->userdata('email');
  		$nim = $this->Mahasiswa_model->my_nim($user);
        $data = array(
        		'data_course' => $forum,
	         	'nim'   	  => $nim,
	            'home'        => '',
	            'group'       => '',
	            'forum'       => 'active',
	            'course'      => ''
        );

        $this->template->load('home','forum/mhs_forum', $data);
	}

	public function topics($id)
	{
		$discussion = $this->Forum_model->get_discussion($id);
		$topics     = $this->Forum_model->get_topics($id);
		$forum      = $this->Forum_model->get_forum($id);
		$id_detail_forum = $this->Forum_model->get_detail_forum($id);
		$replies    = $this->Forum_model->get_replies($id_detail_forum);
		$topic 		= $topics->forum_title;
		$user  = $this->session->userdata('email');
        $mhs = $this->Mahasiswa_model->my_name($user);
        $name  = ucwords($mhs->nama_depan).', '.ucwords($mhs->nama_belakang);
        $img   = $mhs->gambar;
		$data = array(
        		'data_discussion' => $discussion,
        		'topic' 		  => $topic,
        		'nama_mhs'		  => $name,
        		'gambar'		  => $img,
        		'data_replies'    => $replies,
        		'data_forum'	  => $forum,
	            'home'   => '',
	            'forum'	 => 'active',
	            'course' => '',
	            'group'	 => '',
        );	
        $this->template->load('home','forum/mhs_forum_discussion', $data);
	}

	public function ajax_save()
    {   
        $this->load->model('Mahasiswa_model');
        $user = $this->session->userdata('email');
        $nim = $this->Mahasiswa_model->my_nim($user);
        $field = array(
                    'id_forum' 		  => $this->input->post('id_forum'),
                    'replies_date'    => date('Y-m-d H:i:s'),
                    'nim'      		  => $nim,
                    'replies_content' => $this->input->post('ckeditor'),
            );
        $insert = $this->Forum_model->insert_comment($field);
        echo json_encode(array("status" => TRUE));
        // echo json_encode($field);
    }

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
