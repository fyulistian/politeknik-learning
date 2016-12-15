<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Decide extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        allowed('administrator');
        $this->load->library('dompdf_gen');
        $this->load->model('Decide_model');
    }

    public function open($id)
    {
        $smt      = $this->Decide_model->get_smt($id);
        $semester = $smt->semester;
        $class    = $smt->nama_kode.' '.$smt->tahun_masuk.' '.$smt->nama_kelas;
        $decide   = $this->Decide_model->get_class($id, $semester);
        $decide1  = $this->Decide_model->get_courses($id, $semester);
        $data = array(
                'value'      => $decide,
                'value1' 	 => $decide1,
                'semester'   => $semester,
                'id_kelas'   => $id,
                'classroom'  => $class,
                'user'       => '',
                'group'      => '',
                'dosen'      => '',
                'matakuliah' => '',
                'mengajar'   => '',
                'angkatan'   => '',
                'diajar'     => '',
                'jurusan'    => '',
                'mahasiswa'  => '',
                'kelas'      => 'active',
                'dashboard'  => '',
        );

        $this->template->load('template','master/decide_list', $data);
    }

    public function ajax_detail($id)
    {
        $data = $this->Decide_model->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        
        $param1 = $this->input->post('id_matakuliah');
        $check  = $this->Decide_model->valid_id($param1, $this->input->post('id_kelas'));
        $check  = count($check) ;
        if($check > 0)
        {
            $data['inputerror'][] = 'id_matakuliah';
            $data['error_string'][] = 'Lesson already registered';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
        $field  = array(
                    'id_matakuliah' => $param1,
                    'semester'      => $this->input->post('semester'),
                    'id_kelas'      => $this->input->post('id_kelas'),
            );
        $insert = $this->Decide_model->insert($field);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->Decide_model->delete($id);
        echo json_encode(array("status" => TRUE));
    }

    public function report_course($id) {
        $nama = date('ymdHis');
        $smt      = $this->Decide_model->get_smt($id);
        $semester = $smt->semester;
        $class    = $smt->nama_kode.' '.$smt->tahun_masuk.' '.$smt->nama_kelas;
        $decide   = $this->Decide_model->get_class($id, $semester);
        $data = array(
            'value_data' => $decide,
            'semester'   => $semester,
            'id_kelas'   => $id,
            'classroom'  => $class,
        );
        $this->load->view('report/kelas_course',$data);
        $html = $this->output->get_output();
        $this->dompdf->set_paper("DEFAULT_PDF_PAPER_SIZE","landscape");
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream($nama.".pdf");
        redirect('decide/open/'.$id);
    }

}

/* End of file Decide.php */
/* Location: ./application/controllers/Decide.php */