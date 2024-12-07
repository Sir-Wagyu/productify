<?php
class Validasi extends CI_Model
{
    public function validasi_user()
    {
        $username = $this->session->userdata('username');
        if (empty($username)) {
            echo '<script>alert("Anda tidak berhak mengakses halaman ini")</script>';
            redirect('auth', 'refresh');
        }
    }
}
