<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Matakuliah extends CI_Controller
{
    
        
    function __construct()
    {
        parent::__construct();
        allowed('administrator');
        $this->load->library('dompdf_gen');
        $this->load->model('Matakuliah_model');
    }

    public function index()
    {
        $this->load->model('Jurusan_model');
        $jurusan = $this->Jurusan_model->get_all();
        $data = array(
                    'jurusan_data' => $jurusan,
                    'user'       => '',
                    'dosen'      => '',
                    'matakuliah' => 'active',
                    'kelas'      => '',
                    'angkatan'   => '',
                    'diajar'     => '',
                    'group'      => '',
                    'jurusan'    => '',
                    'mengajar'   => '',
                    'mahasiswa'  => '',
                    'dashboard'  => '',
            );
        $this->template->load('template','master/matakuliah_group', $data);
    }

    public function jurusan($id)
    {
        $this->load->model('Jurusan_model');
        $jurusan = $this->Jurusan_model->get_all();
        $data = array(
                    'data_jurusan' => $jurusan,
                    'smt' => $id,
                 );
        $this->load->view('master/matakuliah_jurusan', $data);
    }

    public function list_course($id, $jrs)
    {
        $matakuliah = $this->Matakuliah_model->get_by_param($id, $jrs);
        if ($matakuliah) {
            $this->session->unset_userdata('notification');
            $data = array(
                'matakuliah_data' => $matakuliah,
                'smt' => $id,
                'jur' => $jrs,
            );
            $this->load->view('master/matakuliah_list', $data);
        } else {
            $this->session->set_flashdata('notification', 'Record Not Found, Please insert the course !!');
            $data = array(
                'matakuliah_data' => $matakuliah,
                'smt' => $id,
                'jur' => $jrs,
            );
            $this->load->view('master/matakuliah_list', $data);
        }
    }

    public function ajax_detail($id, $smt, $jur)
    {
        $data = $this->Matakuliah_model->get_by_id($id, $smt, $jur);
        echo json_encode($data);
    }

    public function ajax_edit($id, $smt, $jur)
    {
        $data = $this->Matakuliah_model->get_by_id($id, $smt, $jur);
        echo json_encode($data);
    }

    public function ajax_add()
    {   
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        $this->_validate();

        $this->db->like('nama_matakuliah', $this->input->post('nama_matakuliah'));
        $this->db->from('matakuliah');
        $check = $this->db->count_all_results();
        if($check > 0)
        {
            $data['inputerror'][]   = 'nama_matakuliah';
            $data['error_string'][] = 'Course name already taken';
            $data['status'] = FALSE;
        }
        if (!is_numeric($this->input->post('sks'))) 
        {
            $data['inputerror'][] = 'sks';
            $data['error_string'][] = 'SKS only number';
            $data['status'] = FALSE;   
        }
        if (!is_numeric($this->input->post('seri_num'))) 
        {
            $data['inputerror'][] = 'seri_num';
            $data['error_string'][] = 'Serial number only number';
            $data['status'] = FALSE;   
        }
        if($this->input->post('seri_num') == '')
        {
            $data['inputerror'][]   = 'seri_num';
            $data['error_string'][] = 'Serial number is required';
            $data['status'] = FALSE;
        }
        $kode  = strlen($this->input->post('seri_num'));
        if ($kode == 1) {
            $kode = sprintf('%02d',$this->input->post('seri_num'));
            $kode = $this->input->post('jur').'-'.$this->input->post('kelompok_matakuliah').$this->input->post('smt').$kode;
        } else {
            $kode = $this->input->post('seri_num');
            $kode = $this->input->post('jur').'-'.$this->input->post('kelompok_matakuliah').$this->input->post('smt').$kode;
        }
        $this->db->like('kode_matakuliah', $kode);
        $this->db->from('matakuliah');
        $check1 = $this->db->count_all_results();
        if($check1 > 0)
        {
            $data['inputerror'][]   = 'seri_num';
            $data['error_string'][] = 'Serial number already taken';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
        $jurusan = $this->Matakuliah_model->get_id($this->input->post('jur'));
        $id_jurusan = $jurusan->id_jurusan;
        $nama  = strtolower($this->input->post('nama_matakuliah'));
        $field = array(
                    'sks'               => $this->input->post('sks'),
                    'nama_matakuliah'   => ucwords($nama),
                    'kode_matakuliah'   => $kode,
                    'id_jurusan'        => $id_jurusan,
                    'semester'          => $this->input->post('smt'),
            );
        $insert = $this->Matakuliah_model->insert($field);
        echo json_encode(array("status" => TRUE));
        // echo json_encode($field);
    }

    public function ajax_update()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        $this->_validate();

        $this->db->like('nama_matakuliah', $this->input->post('nama_matakuliah'));
        $this->db->from('matakuliah');
        $check = $this->db->count_all_results();
        if($check > 0)
        {
            $data['inputerror'][] = 'nama_matakuliah';
            $data['error_string'][] = 'Course name already taken';
            $data['status'] = FALSE;
        }
        if (!is_numeric($this->input->post('sks'))) 
        {
            $data['inputerror'][] = 'sks';
            $data['error_string'][] = 'SKS only number';
            $data['status'] = FALSE;   
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
        $nama  = strtolower($this->input->post('nama_matakuliah'));
        $field = array(
                'sks'               => $this->input->post('sks'),
                'nama_matakuliah'   => ucwords($nama),
            );
        $edit = $this->Matakuliah_model->update($this->input->post('id_matakuliah'), $field);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->Matakuliah_model->delete($id);
        echo json_encode(array("status" => TRUE));
    }

    public function report($smt, $jur) {
        $matakuliah = $this->Matakuliah_model->get_by_param($smt, $jur);
        if ($matakuliah) {
            $nama = date('ymdHis');
            $data['title'] = "Data Course";
            $data['course_data'] = $this->Matakuliah_model->get_by_param($smt, $jur);
            $this->load->view('report/course',$data);
            $html = $this->output->get_output();
            $this->dompdf->set_paper("DEFAULT_PDF_PAPER_SIZE","landscape");
            $this->dompdf->load_html($html);
            $this->dompdf->render();
            $this->dompdf->stream($nama.".pdf");
            redirect('matakuliah');
        } else {
            $this->session->set_flashdata('reportNotification', 'Record Not Found, Please pick another one !!');
            redirect('matakuliah');
        }
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
 
        if($this->input->post('nama_matakuliah') == '')
        {
            $data['inputerror'][]   = 'nama_matakuliah';
            $data['error_string'][] = 'Course name is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('sks') == '')
        {
            $data['inputerror'][]   = 'sks';
            $data['error_string'][] = 'SKS is required';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file Matakuliah.php */
/* Location: ./application/controllers/Matakuliah.php */