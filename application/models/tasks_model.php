<?php
defined('BASEPATH') or exit('No direct script access allowed');

class tasks_model extends CI_Model
{
    public function getTasks($id_user)
    {
        $this->db->where('users_id', $id_user); // Ambil data sesuai ID pengguna
        $query = $this->db->get('tasks'); // Tabel `tasks`
        return $query->result(); // Kembalikan sebagai array objek
    }

    public function getTaskById($id_task)
    {
        $this->db->where('id', $id_task); // Ambil data sesuai ID tugas
        $query = $this->db->get('tasks'); // Tabel `tasks`
        return $query->row(); // Kembalikan sebagai objek
    }
}
