<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dosen extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        allowed('administrator');
        $this->load->library('dompdf_gen');
        $this->load->model('Dosen_model');
    }

    public function index()
    {
        $dosen = $this->Dosen_model->get_all();

        $data = array(
                'dosen_data' => $dosen,
                'user'       => '',
                'dosen'      => 'active',
                'diajar'     => '',
                'matakuliah' => '',
                'group'      => '',
                'jurusan'    => '',
                'angkatan'   => '',
                'mengajar'   => '',
                'kelas'      => '',
                'mahasiswa'  => '',
                'dashboard'  => '',
        );

        $this->template->load('template','master/dosen_list', $data);
    }

    public function ajax_detail($nip)
    {
        $data = $this->Dosen_model->get_by_id($nip);
        echo json_encode($data);
    }

    public function ajax_add()
    {   
        $this->load->model('Login_model');
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        $this->_validate();

        $this->db->like('email', $this->input->post('email'));
        $this->db->from('user');
        $check = $this->db->count_all_results();
        if($check > 0)
        {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'email already taken';
            $data['status'] = FALSE;
        }
        $this->db->like('nip', $this->input->post('nip'));
        $this->db->from('dosen');
        $check1 = $this->db->count_all_results();
        if($check1 > 0)
        {
            $data['inputerror'][] = 'nip';
            $data['error_string'][] = 'Code already taken';
            $data['status'] = FALSE;
        }
        if($this->input->post('nip') == '')
        {
            $data['inputerror'][] = 'nip';
            $data['error_string'][] = 'Code is required';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
        $pass      = 'politeknik';
        $options   = array('cost' => 11);
        $nama_user = substr($this->input->post('nama_depan'), 0, 1).$this->input->post('nama_belakang');
        $field = array(
                    'nip'           => $this->input->post('nip'),
                    'nama_depan'    => strtolower($this->input->post('nama_depan')),
                    'nama_belakang' => strtolower($this->input->post('nama_belakang')),
                    'gender'        => strtolower($this->input->post('gender')),
                    'email'         => strtolower($this->input->post('email')),
                    'tempat_lahir'  => strtolower($this->input->post('tempat_lahir')),
                    'tanggal_lahir' => strtolower($this->input->post('tanggal_lahir')),
                    'gambar'        => './uploads/img/default.jpg',
            );
        $user = array(
                    'email'         => strtolower($this->input->post('email')),
                    'nama_user'     => strtolower($nama_user),
                    'password'      => password_hash($pass,PASSWORD_BCRYPT,$options),
                    'level'         => strtolower($this->input->post('level')),
            );
        $save   = $this->Login_model->insert($user);
        $insert = $this->Dosen_model->insert($field);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit($nip)
    {
        $data = $this->Dosen_model->get_by_id($nip);
        $data->tanggal_lahir = ($data->tanggal_lahir == '0000-00-00') ? '' : $data->tanggal_lahir;
        echo json_encode($data);
    }

    public function ajax_update()
    {
        $this->load->model('Login_model');
        $this->_validate();
        $field = array(
                'nama_depan'    => strtolower($this->input->post('nama_depan')),
                'nama_belakang' => strtolower($this->input->post('nama_belakang')),
                'gender'        => strtolower($this->input->post('gender')),
                'email'         => strtolower($this->input->post('email')),
                'tempat_lahir'  => strtolower($this->input->post('tempat_lahir')),
                'tanggal_lahir' => strtolower($this->input->post('tanggal_lahir')),
            );
        $nama_user = substr($this->input->post('nama_depan'), 0, 1).$this->input->post('nama_belakang');
        $user = array(
                'email' => strtolower($this->input->post('email')),
             );
        $upd  = $this->Login_model->update($nama_user,$user);
        $edit = $this->Dosen_model->update($this->input->post('code'), $field);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($nip)
    {
        $dosen = $this->Dosen_model->get_by_id($nip);
        if (!$dosen->gambar == './uploads/img/default.jpg') {
            if(file_exists($dosen->gambar) && $dosen->gambar) unlink($dosen->gambar);   
        }
        $this->Dosen_model->delete($nip);
        echo json_encode(array("status" => TRUE));
    }

    public function report() {
        $nama = date('ymdHis');
        $data['title'] = "Data Lecturer";
        $data['dosen_data'] = $this->Dosen_model->get_all();
        $this->load->view('report/dosen',$data);
        $html = $this->output->get_output();
        $this->dompdf->set_paper("DEFAULT_PDF_PAPER_SIZE","landscape");
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream($nama.".pdf");
        redirect('mahasiswa');
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nama_depan') == '')
        {
            $data['inputerror'][] = 'nama_depan';
            $data['error_string'][] = 'First name is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('nama_belakang') == '')
        {
            $data['inputerror'][] = 'nama_belakang';
            $data['error_string'][] = 'Last name is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('gender') == '')
        {
            $data['inputerror'][] = 'gender';
            $data['error_string'][] = 'Please select gender';
            $data['status'] = FALSE;
        }

        if($this->input->post('tempat_lahir') == '')
        {
            $data['inputerror'][] = 'tempat_lahir';
            $data['error_string'][] = 'Place of Birth is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('tanggal_lahir') == '')
        {
            $data['inputerror'][] = 'tanggal_lahir';
            $data['error_string'][] = 'Date of Birth is required';
            $data['status'] = FALSE;
        }

        if (!filter_var($this->input->post('email'), FILTER_VALIDATE_EMAIL)) 
        {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Invalid e-mail address';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}