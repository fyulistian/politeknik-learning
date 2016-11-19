<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Course_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function get_nim($param)
    {
        $this->db->from('user');
        $this->db->join('mahasiswa', 'mahasiswa.email = user.email');
        $this->db->where('user.nama_user', $param);
        return $this->db->get()->row();
    }

    function get_all($id)
    {
        $now = date('Y-m-d H:i:s');
        $this->db->from('diajar');
        $this->db->join('matakuliah', 'matakuliah.id_matakuliah = diajar.id_matakuliah');
        $this->db->join('course', 'course.id_matakuliah = matakuliah.id_matakuliah');
        $this->db->join('soal', 'soal.id_course = course.id_course');
        $this->db->join('kelas', 'kelas.id_kelas = diajar.id_kelas');
        $this->db->join('detail_kelas', 'detail_kelas.id_kelas = kelas.id_kelas');
        $this->db->join('mahasiswa', 'mahasiswa.nim = detail_kelas.nim');
        $this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun_ajaran = kelas.id_tahun_ajaran');
        $this->db->where('course.status', 'Available');
        // $this->db->where('course.end_course >', $now);
        $this->db->where('mahasiswa.nim', $id);
        $this->db->group_by(array('soal.id_course'));
        return $this->db->get()->result();
    }

    function get_download_course($id)
    {
        $this->db->from('diajar');
        $this->db->join('matakuliah', 'matakuliah.id_matakuliah = diajar.id_matakuliah');
        $this->db->join('course', 'course.id_matakuliah = matakuliah.id_matakuliah');
        $this->db->join('kelas', 'kelas.id_kelas = diajar.id_kelas');
        $this->db->join('detail_kelas', 'detail_kelas.id_kelas = kelas.id_kelas');
        $this->db->join('mahasiswa', 'mahasiswa.nim = detail_kelas.nim');
        $this->db->join('jurusan', 'jurusan.id_jurusan = kelas.id_jurusan');
        $this->db->join('tahun_ajaran', 'tahun_ajaran.id_tahun_ajaran = kelas.id_tahun_ajaran');
        $this->db->where('mahasiswa.nim', $id);
        return $this->db->get()->result();
    }

    function get_file($course, $id)
    {
        $this->db->from('diajar');
        $this->db->join('matakuliah', 'matakuliah.id_matakuliah = diajar.id_matakuliah');
        $this->db->join('course', 'course.id_matakuliah = matakuliah.id_matakuliah');
        $this->db->join('materi', 'materi.id_course = course.id_course');
        $this->db->join('kelas', 'kelas.id_kelas = diajar.id_kelas');
        $this->db->where('kelas.id_kelas', $id);
        $this->db->where('materi.id_course', $course);
        return $this->db->get()->result();
    }

    function get_data($id)
    {
        $this->db->from('course');
        $this->db->where('nip', $id);
        return $this->db->get()->result();
    }

    function get_question($id)
    {
        // $now = date('Y-m-d');
        $this->db->from('course');
        $this->db->join('matakuliah', 'matakuliah.id_matakuliah = course.id_matakuliah');
        $this->db->join('soal', 'soal.id_course = course.id_course');
        // $this->db->where('course.end_course !=', $now);
        $this->db->where('course.id_course', $id);
        $this->db->order_by('soal.id_course', 'RANDOM');
        return $this->db->get()->result();
    }

    function total_question($id)
    {
        $this->db->from('soal');
        $this->db->where('soal.id_course', $id);
        $data = $this->db->get();
        return $data;
    }

    public function get_answer($id = 0) 
    {
        $data = $this->db->query("SELECT * FROM soal WHERE id_soal = '$id'")->result_array();
        return $data[0]['kunci_jawaban'];
    }

    public function id_answer($tabel, $data) 
    {
        $ins = $this->db->insert($tabel, $data);
        return $this->db->insert_id();
    }

    public function save_detail_answer($tabel, $data){
        $insert = $this->db->insert($tabel, $data);
        return $insert;
    }

    public function get_tes($where= "") {
        $data = $this->db->query('SELECT * FROM detail_jawaban '.$where);
        return $data;
    }

    public function update_nilai($id_jawaban,$data)
    {
        $this->db->where('id_detail_jawaban',$id_jawaban);
        $this->db->update('detail_jawaban',$data);

    }

    public function update_total_nilai($id_jawaban,$data)
    {
        $this->db->where('id_jawaban',$id_jawaban);
        $this->db->update('jawaban',$data);
    }

    public function get_detail_nilai($idjawaban) {
        $data = $this->db->query("SELECT * FROM detail_jawaban a, soal b, jawaban c WHERE a.id_soal = b.id_soal AND a.id_jawaban = c.id_jawaban AND a.id_jawaban = '$idjawaban'");
        return $data;
    }

    public function get_nilai($id) {
        $data = $this->db->query("SELECT * FROM jawaban WHERE id_jawaban = '$id'");
        return $data;
    }

}

/* End of file Course_model.php */
/* Location: ./application/models/Course_model.php */