<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Soal extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        allowed('dosen');
        $this->load->model('Soal_model');
        $this->load->library(array('PHPExcel','PHPExcel/IOFactory'));
    }

    public function index()
    {
        $this->load->model('Dosen_model');
        $cekdata = $this->session->userdata('logged_in');
        if (empty($cekdata)) {
            echo "<script>document.location.href='".base_url('auth')."';</script>";
        } else {
            $user = $this->session->userdata('email');
            $nip  = $this->Dosen_model->my_nip($user);
            $soal = $this->Soal_model->get_all_query();
            $qst  = $this->Soal_model->course_soal($nip);
            $data = array(
                        'soal_data'   => $soal,
                        'soal_course' => $qst,
                        'dashboard'   => '',
                        'forum'       => '',
                        'soal'        => 'active',
                        'upload'      => '',
                        'group'       => ''
                    );
            $this->template->load('template','master/soal_list', $data);
        }
    }

    public function read($id) 
    {
        $row = $this->Soal_model->get_by_id($id);
        if ($row) {
            $data = array(
                'QS' => $row,
                'dashboard' => '',
                'forum'     => '',
                'soal'      => 'active',
                'upload'    => '',
                'group'     => ''
            );
            $this->template->load('template','master/soal_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found, Please import the question !!');
            $id_course = $this->Soal_model->my_course($id);
            $data = array(
                'id'        => $id,
                'title'     => $id_course,
                'QS'        => $row,
                'dashboard' => '',
                'forum'     => '',
                'soal'      => 'active',
                'upload'    => '',
                'group'     => ''
            );
            $this->template->load('template','master/soal_read', $data);
        }
    }

    public function ajax_read($id)
    {
        $data = $this->Soal_model->get_id($id);
        echo json_encode($data);
    }

    public function ajax_add()
    {   
        $this->load->model('Dosen_model');
        // $data = array();
        // $data['error_string'] = array();
        // $data['inputerror'] = array();
        // $data['status'] = TRUE;
        $this->_validate();

        // $this->db->like('nama_course', $this->input->post('nama_course'));
        // $this->db->from('course');
        // $check1 = $this->db->count_all_results();
        // if($check1 > 0)
        // {
        //     $data['inputerror'][] = 'nama_course';
        //     $data['error_string'][] = 'Course already exists';
        //     $data['status'] = FALSE;
        // }
        // if($data['status'] === FALSE)
        // {
        //     echo json_encode($data);
        //     exit();
        // }
        $user = $this->session->userdata('email');
        $nip = $this->Dosen_model->my_nip($user);
        $status = strtolower($this->input->post('status'));
        $pars = intval($this->input->post('durasi')) * 60;
        $durasi = gmdate("H:i:s", $pars);
        $deskripsi = ucfirst($this->input->post('deskripsi'));
        $nama_course = strtolower($this->input->post('nama_course'));
        $field = array(
                    'nip'            => $nip,
                    'status'         => ucwords($status),
                    'durasi'         => $durasi,
                    'deskripsi'      => $deskripsi,
                    'end_course'     => $this->input->post('end_course'),
                    'nama_course'    => ucwords($nama_course),
                    'id_matakuliah'  => $this->input->post('id_matakuliah'),
                    'tanggal_course' => $this->input->post('tanggal_course'),
            );
        $insert = $this->Soal_model->insert($field);
        echo json_encode(array("status" => TRUE));
        // echo json_encode($field);
    }

    public function ajax_edit($id)
    {
        $data = $this->Soal_model->get_soal_by_id($id);
        echo json_encode($data);
    }

    public function ajax_edit_course($id)
    {
        $data = $this->Soal_model->get_course_by_id($id);
        echo json_encode($data);
    }

    public function ajax_update_course()
    {
        $this->_validate();
        $pars = intval($this->input->post('durasi')) * 60;
        $durasi = gmdate("H:i:s", $pars);
        $field = array(
                'id_matakuliah'  => $this->input->post('id_matakuliah'),
                'tanggal_course' => $this->input->post('tanggal_course'),
                'end_course'     => $this->input->post('end_course'),
                'durasi'         => $durasi,
                'status'         => $this->input->post('status'),
                'deskripsi'      => $this->input->post('deskripsi'),
            );
        $edit = $this->Soal_model->update_course($this->input->post('id_course'), $field);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete_course($id)
    {
        $this->Soal_model->delete_course($id);
        $this->Soal_model->delete_all($id);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id)
    {
        $this->Soal_model->delete($id);
        echo json_encode(array("status" => TRUE));
    }

     public function ajax_save()
    {
        $this->_validate_read();

        $field = array(
                'soal'          => $this->input->post('soal'),
                'pilihan_1'     => $this->input->post('pilihan_1'),
                'pilihan_2'     => $this->input->post('pilihan_2'),
                'pilihan_3'     => $this->input->post('pilihan_3'),
                'pilihan_4'     => $this->input->post('pilihan_4'),
                'pilihan_5'     => $this->input->post('pilihan_5'),
                'kunci_jawaban' => $this->input->post('kunci_jawaban'),
            );
        $edit = $this->Soal_model->update($this->input->post('id_soal'), $field);
        echo json_encode(array("status" => TRUE));
    }

    function import_question()
    {
        $id_course = $this->input->post('id_course');
        $fileName = 'question-format'; // free use or not
        $config = array(
                    'file_name' => $fileName, // free use or not
                    'upload_path' => "./uploads/",
                    'allowed_types' => "xls|xlsx|cvs",
                    'overwrite' => TRUE,
                    'max_size' => "40000",
                    'max_width' => "1036",
                    'max_height' => "768"
                );
        $this->load->library('upload',$config);
        if(!$this->upload->do_upload('file') ) {
            $this->session->set_flashdata('file', 'Please upload file before import a question !!');
            redirect('soal/read/'.$id_course);
        } else {
            $ext_data = $this->upload->data();
            $ext_name = $ext_data['file_ext'];
            $data = array(
                'file_name' => $fileName.$ext_name
            );
            $inputFileName = './uploads/'.$data['file_name'];
            try {
                $inputFileType = IOFactory::identify($inputFileName);
                $objReader = IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch(Exception $e) {
                die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            }
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();
            for ($row = 2; $row <= $highestRow; $row++) {              
                $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);                               
                 $field = array(
                    'id_soal' => NULL,
                    'id_course' => $id_course,
                    'soal'=> $rowData[0][0],
                    'pilihan_1'=> $rowData[0][1],
                    'pilihan_2'=> $rowData[0][2],
                    'pilihan_3'=> $rowData[0][3],
                    'pilihan_4'=> $rowData[0][4],
                    'pilihan_5'=> $rowData[0][5],
                    'kunci_jawaban'=> $rowData[0][6],
                );
                $insert = $this->db->insert('soal',$field);
                // unlink($ext_data['file_path']);
            }
            redirect('soal/read/'.$id_course);
        }
    }

    private function _validate_read()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('soal') == '')
        {
            $data['inputerror'][] = 'soal';
            $data['error_string'][] = 'Question is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('pilihan_1') == '')
        {
            $data['inputerror'][] = 'pilihan_1';
            $data['error_string'][] = 'A is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('pilihan_2') == '')
        {
            $data['inputerror'][] = 'pilihan_2';
            $data['error_string'][] = 'B is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('pilihan_3') == '')
        {
            $data['inputerror'][] = 'pilihan_3';
            $data['error_string'][] = 'C is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('pilihan_4') == '')
        {
            $data['inputerror'][] = 'pilihan_4';
            $data['error_string'][] = 'D is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('pilihan_5') == '')
        {
            $data['inputerror'][] = 'pilihan_5';
            $data['error_string'][] = 'E is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('kunci_jawaban') == '')
        {
            $data['inputerror'][] = 'kunci_jawaban';
            $data['error_string'][] = 'Key is required';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('nama_course') == '')
        {
            $data['inputerror'][] = 'nama_course';
            $data['error_string'][] = 'Title is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('tanggal_course') == '')
        {
            $data['inputerror'][] = 'tanggal_course';
            $data['error_string'][] = 'Date is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('end_course') == '')
        {
            $data['inputerror'][] = 'end_course';
            $data['error_string'][] = 'Date is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('deskripsi') == '')
        {
            $data['inputerror'][] = 'deskripsi';
            $data['error_string'][] = 'Description is required';
            $data['status'] = FALSE;
        }
 
        if($this->input->post('durasi') == '')
        {
            $data['inputerror'][] = 'durasi';
            $data['error_string'][] = 'Duration is required';
            $data['status'] = FALSE;
        }
 
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

}

/* End of file Soal.php */
/* Location: ./application/controllers/Soal.php */