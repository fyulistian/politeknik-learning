<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Period extends CI_Controller
{
        
    function __construct()
    {
        parent::__construct();
        allowed('administrator');
        $this->load->library('dompdf_gen');
        $this->load->model('Period_model');
    }

    public function index()
    {
        $period = $this->Period_model->get_all();

        $data = array(
            'period_data' => $period,
            'user'       => '',
            'dosen'      => '',
            'angkatan'   => 'active',
            'kelas'      => '',
            'jurusan'    => '',
            'matakuliah' => '',
            'group'      => '',
            'diajar'     => '',
            'group'      => '',
            'mengajar'   => '',
            'mahasiswa'  => '',
            'dashboard'  => '',
        );

        $this->template->load('template','master/period_list', $data);
    }

    public function ajax_detail($id)
    {
        $data = $this->Period_model->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_edit($id)
    {
        $data = $this->Period_model->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add()
    {   
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        $this->db->like('tahun_masuk', $this->input->post('tahun_masuk'));
        $this->db->from('tahun_ajaran');
        $check = $this->db->count_all_results();
        if($check > 0)
        {
            $data['inputerror'][] = 'tahun_masuk';
            $data['error_string'][] = 'Period already exists';
            $data['status'] = FALSE;
        }
        if($this->input->post('tahun_masuk') == '')
        {
            $data['inputerror'][] = 'tahun_masuk';
            $data['error_string'][] = 'Period is required';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
        $this->db->select_max('id_tahun_ajaran', 'id');
        $query = $this->db->get('tahun_ajaran')->row();
        $no = $query->id + 1;
        $field = array(
                'tahun_masuk'     => $this->input->post('tahun_masuk'),
                'tahun_keluar'    => intval($this->input->post('tahun_masuk'))+1,
                'id_tahun_ajaran' => $no,
            );
        $insert = $this->Period_model->insert($field);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        $this->db->like('tahun_masuk', $this->input->post('tahun_masuk'));
        $this->db->from('tahun_ajaran');
        $check = $this->db->count_all_results();
        if($check > 0)
        {
            $data['inputerror'][] = 'tahun_masuk';
            $data['error_string'][] = 'Period already exists';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
        $field = array(
                'tahun_masuk'   => $this->input->post('tahun_masuk'),
                'tahun_keluar'  => intval($this->input->post('tahun_masuk'))+1,
            );
        $edit = $this->Period_model->update($this->input->post('id_tahun_ajaran'), $field);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->Period_model->delete($id);
        echo json_encode(array("status" => TRUE));
    }

    public function report() {
        $nama = date('ymdHis');
        $data['title'] = "Data Period";
        $data['period_data'] = $this->Period_model->get_all();
        $this->load->view('report/period',$data);
        $html = $this->output->get_output();
        $this->dompdf->set_paper("DEFAULT_PDF_PAPER_SIZE","landscape");
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream($nama.".pdf");
        redirect('period');
    }

}

/* End of file Period.php */
/* Location: ./application/controllers/Period.php */