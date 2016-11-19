<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		allowed('dosen');
		$this->load->model('Forum_model');
	}

	public function index()
	{
		$this->load->model('Dosen_model');
		$course = $this->Forum_model->get_all_query_group_by();
		$user = $this->session->userdata('email');
        $nip = $this->Dosen_model->my_nip($user);
        $data = array(
        		'data_course' => $course,
	            'nip'   	  => $nip,
	            'dashboard'   => '',
                'group'      => '',
	            'soal'        => '',
	            'forum'       => 'active',
	            'upload'      => ''
        );

        $this->template->load('template','forum/forum', $data);
	}

	public function topics($id)
	{	
		$this->load->model('Dosen_model');
		$discussion = $this->Forum_model->get_discussion($id);
		$topics     = $this->Forum_model->get_topics($id);
		$forum      = $this->Forum_model->get_forum($id);
		$id_detail_forum = $this->Forum_model->get_detail_forum($id);
		$replies    = $this->Forum_model->get_replies($id_detail_forum);
		$topic 		= $topics->forum_title;
		$user  = $this->session->userdata('email');
        $dosen = $this->Dosen_model->my_name($user);
        $name  = ucwords($dosen->nama_depan).', '.ucwords($dosen->nama_belakang);
        $img   = $dosen->gambar;
		$data = array(
        		'data_discussion' => $discussion,
        		'topic' 		  => $topic,
        		'nama_dos'		  => $name,
        		'gambar'		  => $img,
        		'data_replies'    => $replies,
        		'data_forum'	  => $forum,
        		'detail_forum'	  => $id_detail_forum,
	            'dashboard'   	  => '',
                'group'           => '',
	            'soal'        	  => '',
	            'forum'           => 'active',
	            'upload'          => ''
        );	
        $this->template->load('template','forum/forum_discussion', $data);
	}

	public function ajax_edit($id)
    {
        $data = $this->Forum_model->get_all_by_id($id);
        echo json_encode($data);
    }

	public function ajax_save()
    {   
        $this->load->model('Dosen_model');
        $user = $this->session->userdata('email');
        $nip = $this->Dosen_model->my_nip($user);
        $field = array(
                    'id_detail_forum' => $this->input->post('id_detail_forum'),
                    'date_replies'    => date('Y-m-d H:i:s'),
                    'replies_by'      => $nip,
                    'content_replies' => $this->input->post('ckeditor'),
            );
        $insert = $this->Forum_model->insert($field);
        echo json_encode(array("status" => TRUE));
        // echo json_encode($field);
    }

    public function ajax_add()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('forum_title') == '')
        {
            $data['inputerror'][] = 'forum_title';
            $data['error_string'][] = 'Title is required';
            $data['status'] = FALSE;
        }
       	if ($this->input->post('forum_title') != '') {
   		 	$check = $this->Forum_model->check_forum($this->input->post('forum_title'));
	        if($check > 0)
	        {
	            $data['inputerror'][] = 'forum_title';
	            $data['error_string'][] = 'Forum already started';
	            $data['status'] = FALSE;
	        }
       	}
        if($this->input->post('forum_content') == '')
        {
            $data['inputerror'][] = 'forum_content';
            $data['error_string'][] = 'Content is required';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
        $field = array(
                    'id_course'    => $this->input->post('id_course'),
                    'forum_title'  => $this->input->post('forum_title'),
                    'forum_content'=> $this->input->post('forum_content'),
                    'tanggal_post' => date('Y-m-d H:i:s'),
        	);
        $insert = $this->Forum_model->insert_in($field);
        echo json_encode(array("status" => TRUE));
        // echo json_encode($field);
    }

    public function ajax_update()
    {
    	$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('forum_title') == '')
        {
            $data['inputerror'][] = 'forum_title';
            $data['error_string'][] = 'Title is required';
            $data['status'] = FALSE;
        }
        if($this->input->post('forum_content') == '')
        {
            $data['inputerror'][] = 'forum_content';
            $data['error_string'][] = 'Content is required';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
        $field = array(
                'forum_title'  => $this->input->post('forum_title'),
                'forum_content'=> $this->input->post('forum_content'),
                'tanggal_post' => date('Y-m-d H:i:s'),
            );
        $edit   = $this->Forum_model->update($this->input->post('id_forum'), $field);
        $delete = $this->Forum_model->delete_detail($this->input->post('id_forum'));
        echo json_encode(array("status" => TRUE));
        // echo json_encode($field);
    }

    public function ajax_delete($id)
    {
    	$id_detail_forum = $this->Forum_model->get_detail_forum($id);
        $this->Forum_model->delete_replies($id_detail_forum);
        $this->Forum_model->delete_detail($id);
        $this->Forum_model->delete($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('id_detail_forum') == '')
        {
            $data['inputerror'][] = 'id_detail_forum';
            $data['error_string'][] = 'Your Comment is required';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file Forum.php */
/* Location: ./application/controllers/Forum.php */