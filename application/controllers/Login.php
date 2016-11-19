<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller
{
         
    function __construct()
    {
        parent::__construct();
        allowed('administrator');
        $this->load->library('dompdf_gen');
        $this->load->model('Login_model');
    }

    public function index()
    {
        $login = $this->Login_model->get_all();

        $data = array(
            'dashboard'  => '',
            'user'       => 'active',
            'dosen'      => '',
            'matakuliah' => '',
            'angkatan'   => '',
            'group'      => '',
            'jurusan'    => '',
            'diajar'     => '',
            'kelas'      => '',
            'mengajar'   => '',
            'mahasiswa'  => '',
            'login_data' => $login
        );

        $this->template->load('template','master/login_list', $data);
    }

    public function ajax_detail($id)
    {
        $data = $this->Login_model->get_by_id($id);
        echo json_encode($data);
    }

    public function reset($id)
    {
        $row = $this->Login_model->get_by_id($id);
        if ($row) {
            $options = array('cost' => 11);
            $password = 'politeknik';
            $data = array('password' => password_hash($password,PASSWORD_BCRYPT,$options), );
            $this->Login_model->update($id, $data);
            $this->session->set_flashdata('message', 'Reset Password Success');
            redirect(site_url('login'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('login'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Login_model->get_by_id($id);

        if ($row) {
            $this->Login_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('login'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('login'));
        }
    }

    public function report() {
        $nama = date('ymdHis');
        $data['title'] = "Data User";
        $data['user_data'] = $this->Login_model->get_all();
        $this->load->view('report/user',$data);
        $html = $this->output->get_output();
        $this->dompdf->set_paper("DEFAULT_PDF_PAPER_SIZE","landscape");
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream($nama.".pdf");
        redirect('login');
    }

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */