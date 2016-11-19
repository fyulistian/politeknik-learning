<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Android extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->model('Android_model');
	}

	public function login_andro() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        // $email    = $this->uri->segment('3');
        // $password = $this->uri->segment('4');
        
        if($cekData = $this->Android_model->getLog($email,$password)) {
            foreach ($cekData->result() as $row) {
                $data = array(
                    'ket' =>'1',
                    'email' => $row->email,
                    'id' => $row->id,
                    'level' => $row->level
                );
                }
            } else {
                $data = array(
                    'ket'=>'0',
                );
            }

            $data = json_encode($data);
            echo "{\"data\":[".$data."]}";
        }

    function change()
    {
        $arr = array();
        $id = $this->uri->segment(3);
        $pas1 = $this->input->post('passbaru1');
        $pas2 = $this->input->post('passbaru2');
        
        if ($pas1 <> $pas2) {
            $temp = array(
                    "ket"  => "33");
            array_push($arr, $temp);
            
            $data = json_encode($arr);
            echo "{\"data\":".$data."}";
        } else {
            $cek = $this->Android_model->check_password($id);
            $old = $this->input->post('passlama');
            if ($cek['password']<>$old){
                    $temp = array(
                            "ket"  => "11");
                        array_push($arr, $temp);
        
                        $dat = json_encode($arr);
                        echo "{\"data\":".$dat."}";
                } else {
                    $this->Android_model->sandi();
                    $ganti = $this->Android_model->change_password($id);
                    if ($ganti){
                        $temp = array(
                            "ket"  => "22");
                        array_push($arr, $temp);
        
                        $dat = json_encode($arr);
                        echo "{\"data\":".$dat."}";
                    } else {
                        $temp = array(
                            "ket"  => "0");
                        array_push($arr, $temp);
        
                        $dat = json_encode($arr);
                        echo "{\"data\":".$dat."}";
                    }
                } 
        }
    }

    public function task()
    {
        $arr = array();
        $cek = $this->Android_model->check_status();
        if ($cek){
            foreach ($cek as $row){
                $dat = array(
                    'namamk' => $row->namamk,
                    'section' => $row->section,
                    'status' => $row->status,
                    'ket' => '1'
                );
                array_push($arr, $dat);
            }
        } else {
            $dat = array(
            'ket' => '0'
            );
        }
    
        $data = json_encode($arr);
        echo "{\"data\":".$data."}";
    }

    public function nilai()
    {
        $arr = array();
        $id = $this->uri->segment(3);
        $cek = $this->Android_model->check_nilai($id);
        if ($cek){
            foreach ($cek as $row){
                $dat = array(
                    'namamk' => $row->namamk,
                    'section' => $row->section,
                    'nilai' => $row->nilai,
                    'tanggal' => $row->tanggal,
                    'ket' => '1'
                );
                array_push($arr, $dat);
            }
        } else {
            $dat = array(
            'ket' => '0'
            );
        }
    
        $data = json_encode($arr);
        echo "{\"data\":".$data."}";
    }
}

/* End of file Android.php */
/* Location: ./application/controllers/Android.php */