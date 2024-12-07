<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('validasi');
        $this->load->model('tasks_model');
        $this->validasi->validasi_user();
    }
    public function index()
    {
        if ($this->session->userdata('username') == "") {
            $this->session->set_flashdata('pesanLogin', 'Anda harus login terlebih dahulu');
            redirect('auth', 'refresh');
        }

        $id_user = $this->session->userdata('id');
        $data['tasks'] = $this->tasks_model->getTasks($id_user);

        $data['konten'] = $this->load->view('task_view', $data, true);
        $this->load->view('dashboard_view', $data);
    }



    public function simpanTask($id_user)
    {
        $id_user = $id_user;
        $judul = $this->input->post('judul');
        $deskripsi = $this->input->post('deskripsi');
        $prioritas = $this->input->post('prioritas');
        $deadline = $this->input->post('deadline');
        $kategori = $this->input->post('kategori');
        $status = "belum";



        $data = array(
            'users_id' => $id_user,
            'judul' => $judul,
            'deskripsi' => $deskripsi,
            'prioritas' => $prioritas,
            'deadline' => $deadline,
            'kategori' => $kategori,
            'status' => $status
        );

        $this->db->insert('tasks', $data);
        redirect('dashboard', 'refresh');
    }
}
