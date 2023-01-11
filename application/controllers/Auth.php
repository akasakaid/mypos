<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		if ($this->session->userdata('is_login')){
			redirect(base_url('/dashboard'));
			exit;
		}
        $this->load->view('auth/login');
	}

	// membuat fungsi method bernama logout dan menghapus session
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url('/auth/login'));
	}

	// query sql untuk menghitung total pendapatan


    public function login(){
        $metod = $this->input->server('REQUEST_METHOD');
        if ($metod == 'GET'){
			if ($this->session->userdata('is_login')){
				redirect(base_url('/dashboard'));
				exit;
			}
            $this->load->view('auth/login');
        }
        elseif ($metod == 'POST') {
			$this->load->model('User_model','user');
            $email = $this->input->post('email',true);
            $password = $this->input->post('password',true);
            $password_hash = password_hash($password,PASSWORD_DEFAULT);
			$query = $this->user->select($email);
			if (count($query) == 1){
				$verify = password_verify($password,$query[0]->password);
				if ($verify){
					$data = [
						'username' => $query[0]->username,
						'email' => $query[0]->email,
						'level' => $query[0]->level,
						'is_login' => true,
						'passsword' => $query[0]->password
					];
					// echo json_encode($data);
					// return
					$this->session->set_userdata($data);
					redirect(base_url('/dashboard'));
				}else {
					$this->session->set_flashdata('error','Email atau Password salah !');
					$url = base_url('/auth/login');
					redirect($url);
				}
			} else {
				$this->session->set_flashdata('error','Email atau Password salah !');
				$url = base_url('/auth/login');
				redirect($url);
			}
        }
    }
}