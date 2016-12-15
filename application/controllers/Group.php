<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		allowed('dosen');
		$this->load->model('Group_model');
	}

	public function index()
	{
		$this->load->model('Dosen_model');
		$user = $this->session->userdata('email');
        $nip  = $this->Dosen_model->my_nip($user);
		$group = $this->Group_model->get_group_by($nip);
        $data = array(
        		'data_group' => $group,
	            'nip'   	  => $nip,
	            'dashboard'   => '',
                'group'       => 'active',
	            'soal'        => '',
	            'forum'       => '',
	            'upload'      => ''
        );

        $this->template->load('template','group/group', $data);
	}

	public function details($id)
	{
        $group  = $this->Group_model->get_group($id);
        $titles = $this->Group_model->get_title($id);
        $title  = $titles->nama_group;
		$data = array(
        		'detail_group'	  => $group,
                'id_group'        => $id,
        		'group_title'	  => $title,
	            'dashboard'   	  => '',
                'group'           => 'active',
	            'soal'        	  => '',
	            'forum'           => '',
	            'upload'          => ''
        );	
        $this->template->load('template','group/detail', $data);
	}

	public function ajax_edit($id)
    {
        $data = $this->Group_model->get_all_by_id($id);
        echo json_encode($data);
    }

    public function ajax_post()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('group_content') == '')
        {
            $data['inputerror'][] = 'group_content';
            $data['error_string'][] = 'Content is required';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
        $id_group = $this->input->post('id_group');
        $config = array(
            'upload_path'   => "./uploads/file/group/",
            'allowed_types' => "pdf",
            'overwrite'     => FALSE,
            'max_size'      => "40000",
            'max_width'     => "1036",
            'max_height'    => "768",
            'file_name'     => $this->input->post('group_content')
        );
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('file')) {
            echo json_encode(array("status" => FALSE));
        } else {
            $ext_data     = $this->upload->data();
            $ext_name     = $ext_data['file_ext'];
            $content_name = $ext_data['file_name'];
            $field = array(
                    'group_file'    => $config['upload_path'].$content_name.$ext_name,
                    'group_content' => $this->input->post('group_content'),
                    'publish_date'  => date('Y-m-d H:i:s'),
                    'id_group'      => $id_group,
            );
            $pub = $this->Group_model->publish($field);
            echo json_encode(array("status" => TRUE));
        }
    }

    public function ajax_update()
    {
    	$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nama_group') == '')
        {
            $data['inputerror'][] = 'nama_group';
            $data['error_string'][] = 'Group Name is required';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
        $field = array(
                'nama_group'=> $this->input->post('nama_group'),
                'pembuatan_group' => date('Y-m-d H:i:s'),
            );
        $edit   = $this->Group_model->update($this->input->post('id_group'), $field);
        echo json_encode(array("status" => TRUE));
        // echo json_encode($field);
    }

    public function ajax_delete($id)
    {
        $this->Group_model->delete_member($id);
        $this->Group_model->delete($id);
        echo json_encode(array("status" => TRUE));
    }

}

/* End of file Group.php */
/* Location: ./application/controllers/Group.php */