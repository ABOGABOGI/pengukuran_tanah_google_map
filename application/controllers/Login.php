<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('admin/base/login');
	}
	public function login(){
		$data = $this->input->post();

		$log = $this->db->get_where('user',["username"=>$data['username'],"password"=>md5($data['password'])])->num_rows();

		if($log == 1){
			$log = $this->session->set_userdata('us',$data['username']);
		redirect('Admin');
		}else{
			$this->session->set_flashdata('msg', 'Login gagal');
			redirect('Login');
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('Login');
	}
}
