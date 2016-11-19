<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class  Diajar extends CI_Controller {

	function __construct()
    {
        parent::__construct();
        allowed('administrator');
        $this->load->model('Diajar_model');
    }

	public function index()
	{
		$diajar = $this->Diajar_model->get_all_query();

        $data = array(
                'data_study' => $diajar,
                'user'       => '',
                'diajar'     => 'active',
                'dosen'      => '',
                'matakuliah' => '',
                'group'      => '',
                'angkatan'   => '',
                'kelas'      => '',
                'jurusan'    => '',
                'mengajar'   => '',
                'mahasiswa'  => '',
                'dashboard'  => '',
        );
        $this->template->load('template','master/diajar_list', $data);
	}

	public function ajax_detail($nim)
    {
        $data = $this->Diajar_model->get_all_by_id($nim);
        echo json_encode($data);
    }

    public function ajax_view($nim)
    {
        $data = $this->Diajar_model->get_all($nim);
        echo json_encode($data);
    }

    public function ajax_add()
    {   
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        $this->db->like('nim', $this->input->post('nim'));
        $this->db->from('detail_kelas');
        $check = $this->db->count_all_results();
        if($check > 0)
        {
            $data['inputerror'][] = 'id_kelas';
            $data['error_string'][] = 'Student Already registered';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
        $field = array(
                    'nim'               => $this->input->post('nim'),
                    'id_tahun_ajaran'	=> $this->input->post('id_tahun_ajaran'),
                    'id_kelas'    		=> $this->input->post('id_kelas'),
            );
        $insert = $this->Diajar_model->insert($field);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update()
    {
        $field = array(
                'id_tahun_ajaran'	=> $this->input->post('id_tahun_ajaran'),
                'id_kelas'    		=> $this->input->post('id_kelas'),
            );
        $edit = $this->Diajar_model->update($this->input->post('nim'), $this->input->post('id_detail_kelas'), $field);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $param = $this->Diajar_model->get_id($id);
        $this->Diajar_model->delete($param->id_detail_kelas);
        echo json_encode(array("status" => TRUE));
    }

}

/* End of file Diajar */
/* Location: ./application/controllers/Diajar */