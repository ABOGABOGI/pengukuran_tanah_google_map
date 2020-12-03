<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	protected $role;
	protected $username;
	protected $name;
	function __construct(){
		parent::__construct();
		$log = $this->db->get_where('user',["username"=>$this->session->userdata('us')])->row_array();
		if(!empty($log)){
			$this->role = $log['role'];
			$this->username = $log['username'];
			$this->name = $log['nama'];
		}else{
			redirect("login");
		}

	}
	public function index(){
		redirect("Admin/profil");
		// $data = [
		// 	'role' => $this->role,
		// 	'out' => 'Home' 
		// ];
		// $this->load->view('root',$data);
	}
	public function profil(){
		$data = [
			'nama' => $this->name,
			'role' => $this->role,
			'kec'  =>  $this->db->get('kecamatan')->result_array(),
			'profil' => $this->db->get_where('profil',["username"=>$this->username])->row_array(),
			'out' => 'profil',
			'ajax' => 'ajax_profil' 
		];
		$this->load->view('root',$data);
	}
	public function ajax_desa(){
		$kec = $this->input->post('id_kec');
		$res = $this->db->get_where('desa',["id_kec"=>$kec])->result_array();
		$response = "";
		foreach ($res as $value) {
			$response .= '<option value="'.$value['id_desa'].'">'.$value['nama'].'</option>';
		}
		echo $response;
	}
	public function proses_profil(){
		$up = up('gmabar','assets/upload');
		if($up != false){
			$data_ = $this->input->post();
			unset($data_['nik']);
			$data__ = $this->input->post();

			$data = ["nik"=>$data__['nik'],"username"=>$this->username]+$data_+["image" => $up];
			$ex = $this->db->insert('profil',$data);
			if($ex){
				redirect("Admin/profil");
			}else{
				redirect("Admin/profil");
			}

		}else{
			redirect("Admin/profil");
		}
		
		// $data = $this->input->post();
		// var_dump($data);
	}



	public function ukurTanah(){
		$data = [
			'nama' => $this->name,
			'role' => $this->role,
			'out' => 'pengukuran_tanah',
			'ajax' => 'ajax_ukurTanah' 
		];
		$this->load->view('root',$data);
	} 
	public function ajxMulai(){
		if($this->input->post('btn') == 'Mulai'){
			$id = random(15);
			$data = [
				"id" 	   => $id,
				"nama_project" => $this->input->post('project'),
				"username" => $this->username,
				"tanggal"  => date("y-m-d h:i:s")
			];
			if($this->db->insert('luas_tanah',$data)){
				$this->session->set_userdata('project',$data);
				echo true;
			}else{
				echo false;
			}
		}
	}
	public function ajx_pengukuran(){
		$data = $this->input->post();
		$id_project = $this->session->userdata('project')['id'];
		$this->db->delete('polygon_area',["id_luasTanah	"=> $id_project]);
		foreach ($data['xy'] as  $value) {
			$ins = [
				'id_luasTanah'	=> $id_project,
				'let'			=> $value['lat'],
				'lng'			=> $value['lng']
			];
			$this->db->insert('polygon_area',$ins);
		}
		$this->db->where("id",$id_project);
		if($this->db->update('luas_tanah',[
			"luas_total" => $data['luas'],
			"tanggal"  => date("y-m-d h:i:s")
		])){
			echo true;
		}else{
			echo false;
		}

	}

	public function History(){
		$data = [
			'nama' => $this->name,
			'role' => $this->role,
			'out' => 'History',
			'all' => $this->db->get_where('luas_tanah',["username"=>$this->username])->result_array()
		];
		$this->load->view('root',$data);
	}
	public function viewAndEdit($id_project){
		$this->session->unset_userdata('project');
		$this->session->set_userdata('project',$this->db->get_where('luas_tanah',["nama_project"=>urldecode($id_project)])->row_array());
		$data = [
			'nama' => $this->name,
			'role' => $this->role,
			'out' => 'pengukuran_tanah',
			'ajax' => 'ajax_ukurTanah' ,
			'swc'  => true
		];

		// var_dump(json_encode($polygon));die();

		$this->load->view('root',$data);

	}
	public function ajaxPolygon(){
		$this->db->select("let,lng");
		$polygon = $this->db->get_where("polygon_area",["id_luasTanah"=>$this->session->userdata('project')['id']])->result_array();
		echo json_encode($polygon);
	}
	public function newProject(){
		$this->session->unset_userdata('project');
		Redirect("Admin/ukurTanah");
	}


	// laporan All

	public function laporan($search = "all"){
		if($search == "all"){
			$q = $this->db->get_where('luas_tanah',["username"=>$this->username])->result_array();
		}else{
			$this->db->like('tanggal', $search);
			$this->db->like("username", $this->username); 
			$q = $this->db->get('luas_tanah')->result_array();
		}
		$data = [
			'nama' => $this->name,
			'role' => $this->role,
			'out'  => 'Laporan',
			'get'  => $search,
			'ajax' => 'ajax_laporan',
			'all'  => $q
		];
		$this->load->view('root',$data);
	}
	public function pdf($search = "all"){
		if($search == "all"){
			$this->db->where("luas_tanah.username",$this->username);
			$this->db->select('*,luas_tanah.tanggal as tgl ');
			$this->db->join('profil','profil.username = luas_tanah.username');
			$q = $this->db->get_where('luas_tanah')->result_array();
		}else{
			$this->db->like('luas_tanah.tanggal', $search);
			$this->db->like("luas_tanah.username", $this->username); 
			$this->db->select('*,luas_tanah.tanggal as tgl ');
			$this->db->join('profil','profil.username = luas_tanah.username');
			$q = $this->db->get('luas_tanah')->result_array();
		}
		$data = [
			'nama' => $this->name,
			'role' => $this->role,
			'print'  => $q
		];
		$this->mypdf->generate('admin/base/pint_lapran_all', $data, 'laporan-mahasiswa', 'A4', 'portrait');
	}
	public function lapTrue(){
		
	}
	public function laporan_luasTanah(){
		// $this->load->view('admin/base/print_laporan');
		$id_project = $this->session->userdata('project')['id'];
		$this->db->select('*,luas_tanah.tanggal as tgl ');
		$this->db->where('luas_tanah.id',$id_project);
		$this->db->join('profil','profil.username = luas_tanah.username');
		$dt = $this->db->get_where('luas_tanah')->row_array();
		
		$data = [
			"data" 		=> $dt,
			"imgData" 	=> $_POST['imgs']
		];
		
		$this->mypdf->generate('admin/base/print_laporan', $data, 'laporan-mahasiswa', 'A4', 'portrait');
	}



}
