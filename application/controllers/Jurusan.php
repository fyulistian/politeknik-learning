<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jurusan extends CI_Controller
{   
    function __construct()
    {
        parent::__construct();
        allowed('administrator');
        $this->load->library('dompdf_gen');
        $this->load->model('Jurusan_model');
    }

    public function index()
    {
        $jurusan = $this->Jurusan_model->get_all();

        $data = array(
                'jurusan_data' => $jurusan,
                'user'       => '',
                'dosen'      => '',
                'matakuliah' => '',
                'mengajar'   => '',
                'group'      => '',
                'angkatan'   => '',
                'diajar'     => '',
                'jurusan'    => 'active',
                'mahasiswa'  => '',
                'kelas'      => '',
                'dashboard'  => '',
        );

        $this->template->load('template','master/jurusan_list', $data);
    }

    public function ajax_detail($id)
    {
        $data = $this->Jurusan_model->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add()
    {   

        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        $this->_validate();

        $param1    = $this->input->post('id_jurusan');
        $param2    = ucwords(strtolower($this->input->post('nama_jurusan')));
        $param3    = strtoupper($this->input->post('nama_kode'));


        $check1 = $this->Jurusan_model->valid_id($param1);
        $check1 = count($check1) ;
        if($check1 > 0)
        {
            $data['inputerror'][] = 'id_jurusan';
            $data['error_string'][] = 'Major code already taken';
            $data['status'] = FALSE;
        }
        if (!is_numeric($param1)) 
        {
            $data['inputerror'][] = 'id_jurusan';
            $data['error_string'][] = 'Major code only number';
            $data['status'] = FALSE;   
        }
        $check2 = $this->Jurusan_model->valid_name($param2);
        $check2 = count($check2) ;
        if($check2 > 0)
        {
            $data['inputerror'][] = 'nama_jurusan';
            $data['error_string'][] = 'Major name already taken';
            $data['status'] = FALSE;
        }
        $check3 = $this->Jurusan_model->valid_code($param3);
        $check3 = count($check3) ;
        if($check3 > 0)
        {
            $data['inputerror'][] = 'nama_kode';
            $data['error_string'][] = 'Code name already taken';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
        $field = array(
                    'id_jurusan'      => $param1,
                    'nama_jurusan'    => $param2,
                    'nama_kode'       => $param3,
            );
        $insert = $this->Jurusan_model->insert($field);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit($id)
    {
        $data = $this->Jurusan_model->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update()
    {

        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        $this->_validate();

        $param1    = $this->input->post('id_jurusan');
        $param2    = ucwords(strtolower($this->input->post('nama_jurusan')));
        $param3    = strtoupper($this->input->post('nama_kode'));

        $field = array(
                'nama_kode'     => $param3,
                'nama_jurusan'  => $param2,
            );
        $edit = $this->Jurusan_model->update($this->input->post('id_jurusan'), $field);
        if ($edit) {
            echo json_encode(array("status" => TRUE));
        }else{
            echo json_encode(array("status" => FALSE));
        }
    }

    public function ajax_delete($id)
    {
        $jurusan = $this->Jurusan_model->get_by_id($id);
        $this->Jurusan_model->delete($id);
        echo json_encode(array("status" => TRUE));
    }

    public function report() {
        $nama = date('ymdHis');
        $data['title'] = "Data Major";
        $data['major_data'] = $this->Jurusan_model->get_all();
        $this->load->view('report/major',$data);
        $html = $this->output->get_output();
        $this->dompdf->set_paper("DEFAULT_PDF_PAPER_SIZE","landscape");
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream($nama.".pdf");
        redirect('jurusan');
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('id_jurusan') == '')
        {
            $data['inputerror'][] = 'id_jurusan';
            $data['error_string'][] = 'Major code is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('nama_jurusan') == '')
        {
            $data['inputerror'][] = 'nama_jurusan';
            $data['error_string'][] = 'Major name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('nama_kode') == '')
        {
            $data['inputerror'][] = 'nama_kode';
            $data['error_string'][] = 'Code name is required';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file Jurusan.php */
/* Location: ./application/controllers/Jurusan.php */