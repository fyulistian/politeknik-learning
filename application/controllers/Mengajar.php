<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mengajar extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        allowed('administrator');
        $this->load->library('dompdf_gen');
        $this->load->model('Mengajar_model');
        $this->load->model('Dosen_model');
    }

    public function index()
    {
        $mengajar = $this->Dosen_model->get_all();

        $data = array(
            'dosen_data' => $mengajar,
            'user'       => '',
            'dosen'      => '',
            'matakuliah' => '',
            'kelas'      => '',
            'group'      => '',
            'angkatan'   => '',
            'diajar'     => '',
            'jurusan'    => '',
            'mengajar'   => 'active',
            'mahasiswa'  => '',
            'dashboard'  => '',
        );
        $this->template->load('template','master/mengajar_list', $data);
    }

    public function teach($nip)
    {
        $this->load->model('Kelas_model');
        $mengajar = $this->Mengajar_model->group_by_id($nip);
        $classroom = $this->Kelas_model->get_all_combo();
        $data = array(
            'ajar'       => $mengajar,
            'data_class' => $classroom,
            'user'       => '',
            'dosen'      => '',
            'angkatan'   => '',
            'matakuliah' => '',
            'diajar'     => '',
            'group'      => '',
            'kelas'      => '',
            'jurusan'    => '',
            'mengajar'   => 'active',
            'mahasiswa'  => '',
            'dashboard'  => '',
        );
        $this->template->load('template','master/mengajar_form', $data);
    }

    public function get_lesson()
    {
        $id = $this->input->post('id');
        $sid = $this->input->post('sid');
        $tid = $this->input->post('tid');
        $less =  $this->Mengajar_model->lesson($id, $sid, $tid);
        echo json_encode($less);
    }

    public function ajax_detail($nip)
    {
        $data['results'] = $this->Mengajar_model->get_by_id($nip);
        echo json_encode($data);
    }

    public function ajax_add($id)
    {
        $data = $this->Mengajar_model->get_all_by_id($id);
        echo json_encode($data);
    }

    public function ajax_classroom($id)
    {

        $data = $this->Mengajar_model->get_classroom($id);
        echo json_encode($data);
    }

    public function ajax_update($id)
    {
        $data = $this->Mengajar_model->get_id($id);
        echo json_encode($data);
    }

    public function ajax_add_classroom()
    {
        $this->load->model('Matakuliah_model');
        $this->load->model('Group_model');
        $this->load->model('Kelas_model');
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        $id  = $this->input->post('id_matakuliah');
        $nip = $this->input->post('nip');
        $id_kelas   = $this->input->post('id_kelas');
        $classroom  = $this->Kelas_model->detailed($id_kelas);
        $group_name = $classroom->nama_kode.' '.$classroom->tahun_masuk.' '.$classroom->nama_kelas;
        $matakuliah = $this->Matakuliah_model->get_detail($id);
        $check = $this->Mengajar_model->validasi($id, $id_kelas);
        if($check > 0)
        {
            $data['inputerror'][] = 'id_matakuliah';
            $data['error_string'][] = 'Lesson already Registered';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
        $field = array(
                'nip'           => $nip,
                'id_matakuliah' => $id,
            );
        $insert = $this->Mengajar_model->insert_classroom($field);
        $fieldM = array(
                'nip'             => $nip,
                'id_mengajar'     => $insert,
                'nama_group'      => $group_name.' - '.$matakuliah->nama_matakuliah,
                'pembuatan_group' => date('Y-m-d H:i:s'),
            );
        $put_in = $this->Group_model->insert_in($fieldM);
        $fieldDetailMengajar = array(
                                'id_mengajar' => $insert,
                                'id_kelas' => $id_kelas,
                            );
        $put_in = $this->Mengajar_model->insert_detail_mengajar($fieldDetailMengajar);
        $member = $this->Group_model->get_detail($id_kelas);
        foreach( $member as $mbr ) {
            $mbr->id_group = $put_in;
        }
        $this->Group_model->insert_batch($member);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->Mengajar_model->delete($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete_classroom($id)
    {
        $this->Mengajar_model->delete_classroom($id);
        echo json_encode(array("status" => TRUE));
    }

    public function report($id) {
        $nama = date('ymdHis');
        $data['title'] = $id;
        $data['mengajar_data'] = $this->Mengajar_model->group_by_id($id);
        $this->load->view('report/mengajar',$data);
        $html = $this->output->get_output();
        $this->dompdf->set_paper("DEFAULT_PDF_PAPER_SIZE","landscape");
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream($nama.".pdf");
        redirect('mengajar/teach/'.$id);
    }

}

/* End of file Mengajar.php */
/* Location: ./application/controllers/Mengajar.php */