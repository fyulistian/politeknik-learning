<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Upload extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        allowed('dosen');
        $this->load->model('Upload_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->model('Course_model');
        $this->load->model('Dosen_model');
        $cekdata = $this->session->userdata('logged_in');
        if (empty($cekdata)) {
            echo "<script>document.location.href='".base_url('auth')."';</script>";
        } else {
            $param       = $this->session->userdata('email');
            $upload      = $this->Upload_model->get_all_query($param);
            $nip         = $this->Dosen_model->my_nip($param);
            $course_data = $this->Course_model->get_data($nip);
            $data = array(
                'upload_data' => $upload,
                'course_data' => $course_data,
                'dashboard'   => '',
                'group'       => '',
                'soal'        => '',
                'forum'       => '',
                'upload'      => 'active'
            );
            $this->template->load('template','master/upload_list', $data);
        }
    }

    public function ajax_detail($id)
    {
        $data = $this->Upload_model->get_all_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        $this->_validate();
        
        $date  = date('Y-m-d H:i:s');
        $this->db->like('judul_materi', $this->input->post('judul_materi'));
        $this->db->from('materi');
        $check1 = $this->db->count_all_results();
        if($check1 > 0)
        {
            $data['inputerror'][] = 'judul_materi';
            $data['error_string'][] = 'Title already taken';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
        $field = array(
                'id_course'      => $this->input->post('id_course'),
                'judul_materi'   => $this->input->post('judul_materi'),
                'tanggal_upload' => $date,
            );
        if(!empty($_FILES['file']['name']))
        {
            $upload = $this->_do_upload();
            $field['nama_materi'] = $upload;
        }
        $insert = $this->Upload_model->save($field);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit($id)
    {
        $data = $this->Upload_model->get_by_id($id);
        $data->dob = ($data->tanggal_upload == '0000-00-00') ? '' : $data->tanggal_upload;
        echo json_encode($data);
    }

    public function ajax_update()
    {
        $this->_validate();
        $date  = date('Y-m-d H:i:s');
        $field = array(
                'tanggal_upload' => $date,
                'judul_materi'   => $this->input->post('judul_materi'),
            );
 
        if($this->input->post('remove_file'))
        {
            if(file_exists('./uploads/file/'.$this->input->post('remove_file')) && $this->input->post('remove_file'))
                unlink('./uploads/file/'.$this->input->post('remove_file'));
            $field['nama_materi'] = '';
        }
 
        if(!empty($_FILES['file']['name']))
        {
            $upload = $this->_do_upload();
            $param  = $this->Upload_model->get_by_id($this->input->post('id_materi'));
            if(file_exists('./uploads/file/'.$param->nama_materi) && $param->nama_materi)
                unlink('./upload/file/'.$param->nama_materi);
 
            $field['nama_materi'] = $upload;
        }
 
        $this->Upload_model->update(array('id_materi' => $this->input->post('id_materi')), $field);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $param = $this->Upload_model->get_by_id($id);
        if(file_exists('./uploads/file/'.$param->nama_materi) && $param->nama_materi)
            unlink('./uploads/file/'.$param->nama_materi);
        $this->Upload_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _do_upload()
    {
        $config['upload_path']   = './uploads/file/';
        $config['allowed_types'] = 'doc|docx|xls|xlsx|ppt|pptx|csv|pdf|txt';
        $config['max_size']      = 40000;
        $config['max_width']     = 1366;
        $config['max_height']    = 768;
        $config['overwrite']     = TRUE;
        $config['file_name']     = round(microtime(true) * 1000);
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('file'))
        {
            $data['inputerror'][]   = 'file';
            $data['error_string'][] = 'Upload error: '.$this->upload->display_errors('','');
            $data['status']         = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror']   = array();
        $data['status']       = TRUE;
 
        if($this->input->post('judul_materi') == '')
        {
            $data['inputerror'][]   = 'judul_materi';
            $data['error_string'][] = 'Title is required';
            $data['status']         = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}