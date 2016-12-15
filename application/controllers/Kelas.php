<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelas extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        allowed('administrator');
        $this->load->library('dompdf_gen');
        $this->load->model('Kelas_model');
        $this->load->model('Decide_model');
    }

    public function index()
    {
        $kelas = $this->Kelas_model->get_all();
        $data = array(
            'kelas_data' => $kelas,
            'user'       => '',
            'dosen'      => '',
            'matakuliah' => '',
            'group'      => '',
            'diajar'     => '',
            'mengajar'   => '',
            'angkatan'   => '',
            'kelas'      => 'active',
            'jurusan'    => '',
            'mahasiswa'  => '',
            'dashboard'  => '',
        );
        $this->template->load('template','master/kelas_list', $data);
    }

    public function open($id)
    {
        $kelas     = $this->Kelas_model->get_id($id);
        $jurusan   = $kelas['0']->id_jurusan;
        $smt       = $this->Decide_model->get_smt($id);
        $semester  = $smt->semester;
        $class     = $smt->nama_kode.' '.$smt->tahun_masuk.' '.$smt->nama_kelas;
        $mahasiswa = $this->Kelas_model->get_mhs($jurusan, $id);
        $data = array(
            'mhs_data'   => $mahasiswa,
            'classroom'  => $class,
            'id_kelas'   => $id,
            'user'       => '',
            'dosen'      => '',
            'matakuliah' => '',
            'diajar'     => '',
            'group'      => '',
            'mengajar'   => '',
            'angkatan'   => '',
            'kelas'      => 'active',
            'jurusan'    => '',
            'mahasiswa'  => '',
            'dashboard'  => '',
        );

        $this->template->load('template','master/kelas_mahasiswa', $data);
    }

    public function ajax_detail($id)
    {
        $data = $this->Kelas_model->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        $this->_validate();

        
        $param1    = $this->input->post('nama_kelas');
        $param2    = $this->input->post('id_jurusan');
        $param3    = $this->input->post('id_tahun_ajaran');
        $param4    = $this->input->post('semester');
        $check = $this->Kelas_model->valid_all($param1,$param2,$param3,$param4);
        $check = count($check) ;
        if($check > 0)
        {
            $data['inputerror'][] = 'nama_kelas';
            $data['inputerror'][] = 'id_jurusan';
            $data['inputerror'][] = 'id_tahun_ajaran';
            $data['inputerror'][] = 'semester';
            $data['error_string'][] = 'Classroom already exists';
            $data['error_string'][] = 'Classroom already exists';
            $data['error_string'][] = 'Classroom already exists';
            $data['error_string'][] = 'Classroom already exists';
            $data['status'] = FALSE;
        }
        if (is_numeric($param1)) 
        {
            $data['inputerror'][] = 'nama_kelas';
            $data['error_string'][] = 'Major code only character';
            $data['status'] = FALSE;   
        }
        if (!is_numeric($param4)) 
        {
            $data['inputerror'][] = 'semester';
            $data['error_string'][] = 'Major code only number';
            $data['status'] = FALSE;   
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
        $stu    = strtoupper($param1);
        $field  = array(
                    'semester'          => $param4,
                    'nama_kelas'        => $stu,
                    'id_jurusan'        => $param2,
                    'id_tahun_ajaran'   => $param3,
            );
        $insert = $this->Kelas_model->insert($field);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_in()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror']   = array();
        $data['status'] = TRUE;
        $param1 = $this->input->post('nim');
        $param2 = $this->input->post('id_kelas');
        $check  = $this->Kelas_model->valid_nim($param1);
        $check  = count($check);
        if($check > 0)
        {
            $data['inputerror'][] = 'nim';
            $data['error_string'][] = 'NIM already Register';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
        $field  = array(
                    'nim'       => $param1,
                    'id_kelas'  => $param2,
            );
        $insert = $this->Kelas_model->insert_collager($field);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->Kelas_model->delete($id);
        $this->Kelas_model->delete_det($id);
        $this->Kelas_model->delete_all($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_del($id)
    {
        // $uri = $this->uri->segment(3);
        $this->Kelas_model->del($id);
        // $data = array(
        //     'uri' => $uri,
        //     'id' => $id, );
        echo json_encode(array("status" => TRUE));
    }

    public function report() {
        $nama = date('ymdHis');
        $data['title'] = "Data Classroom";
        $data['kelas_data'] = $this->Kelas_model->get_all();
        $this->load->view('report/kelas',$data);
        $html = $this->output->get_output();
        $this->dompdf->set_paper("DEFAULT_PDF_PAPER_SIZE","landscape");
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream($nama.".pdf");
        redirect('kelas');
    }

    public function report_mahasiswa($id) {
        $nama = date('ymdHis');
        $kelas = $this->Kelas_model->get_id($id);
        $jurusan = $kelas['0']->id_jurusan;
        $smt      = $this->Decide_model->get_smt($id);
        $semester = $smt->semester;
        $class    = $smt->nama_kode.' '.$smt->tahun_masuk.' '.$smt->nama_kelas;
        $mahasiswa = $this->Kelas_model->get_mhs($jurusan, $id);
        $data = array(
            'mhs_data'   => $mahasiswa,
            'classroom'  => $class,
            'title'  => 'Detail Classroom',
        );
        $this->load->view('report/mahasiswa_kelas',$data);
        $html = $this->output->get_output();
        $this->dompdf->set_paper("DEFAULT_PDF_PAPER_SIZE","landscape");
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream($nama.".pdf");
        redirect('kelas/open/'.$id);
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('nama_kelas') == '')
        {
            $data['inputerror'][] = 'nama_kelas';
            $data['error_string'][] = 'Classroom is required';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file Kelas.php */
/* Location: ./application/controllers/Kelas.php */