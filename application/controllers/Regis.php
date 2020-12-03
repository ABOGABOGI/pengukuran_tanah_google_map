<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regis extends CI_Controller {
	public function index(){
		$this->load->view('admin/base/registrasi');
	}
	public function proses(){
		$data = $this->input->post();
		$us = $this->db->get_where('user',['username'=>$data['username']])->num_rows();
		if($us > 0){
			$this->session->set_flashdata('msg', 'Username Siudah Ada');
			redirect('Regis');
		}else{
			unset($data['password']);
			$data = $data + ["password"=>md5($this->input->post('password')),"role"=>2];
			$reg  = $this->db->insert('user',$data);
			if($reg){
				
				redirect('Login');
			}else{
				$this->session->set_flashdata('msg', 'Registrasi Gagal');
				redirect('Regis');
			}
		}
		
	}
}
