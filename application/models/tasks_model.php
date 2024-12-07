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
}
