<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function index()
	{
		$this->load->view('login_view');
	}

	public function register()
	{
		$this->load->view('register_view');
	}

	public function prosesLogin()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$sql = "SELECT * FROM users WHERE username = ?";
		$query = $this->db->query($sql, array($username));

		if (empty($username) || empty($password)) {
			$this->session->set_flashdata('pesanLogin', 'Username dan Password tidak boleh kosong');
			redirect('auth', "refresh");
		}

		if ($query->num_rows() > 0) {
			$data = $query->row();

			if ($data->password == $password) {
				$array = array(
					'id' => $data->id,
					'username' => $data->username,
					'nama' => $data->nama,
					'email' => $data->email,
				);
				$this->session->set_userdata($array);
				redirect('dashboard', "refresh");
			} else {
				$this->session->set_flashdata('pesanLogin', 'Password yang anda masukkan salah');
				redirect('auth', "refresh");
			}
		} else {
			$this->session->set_flashdata('pesanLogin', 'Username tidak ditemukan');
			redirect('auth', "refresh");
		}
	}


	public function prosesRegister()
	{
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		if (empty($nama) || empty($username) || empty($email) || empty($password)) {
			$this->session->set_flashdata('pesanRegister', 'Semua data harus diisi');
			redirect('auth/register', "refresh");
		}

		$data = array(
			'nama' => $nama,
			'username' => $username,
			'email' => $email,
			'password' => $password
		);


		$sql = "select * from users where username = ? and email = ?";
		$query = $this->db->query($sql, array($username, $email));
		if ($query->num_rows() > 0) {
			$this->session->set_flashdata('pesanRegister', 'Username atau Email sudah digunakan');
			redirect('auth/register', "refresh");
		} else {
			$sql = "insert into users (nama, username, email, password) values (?, ?, ?, ?)";
			$query = $this->db->query($sql, $data);

			$this->session->set_flashdata('pesanLogin', 'Register berhasil, silahkan login');
			redirect('auth', "refresh");
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth', "refresh");
	}
}
