<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketplace extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('ModMarketplace');
		$this->load->model('ModUser');
	}
	public function index()
	{
		$q = $this->session->userdata('status');
		if($q != "login") {
			redirect('login','refresh');
		}
		
		$menu['modul'] = $this->ModUser->modul();
		$menu['akses'] = $this->ModUser->akses_admin($this->session->userdata('admin_id'));
		$menu['login'] = $this->ModUser->edit($this->session->userdata('admin_id'));
		$data['marketplace'] = $this->ModMarketplace->selectAll();
		$this->load->view('template/header');
		$this->load->view('template/menu',$menu);
		$this->load->view('marketplace',$data);
		$this->load->view('template/footer');
	}
	public function modal() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 0;
		$this->load->view('modal/marketplace', $data);
	}
	public function add() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModMarketplace->add();
		echo json_encode(array("status" => TRUE));
	}
	public function edit($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$data['cek'] = 1;
		$data['marketplace'] = $this->ModMarketplace->edit($id);
		$this->load->view('modal/marketplace', $data);
	}
	public function delete($id) {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModMarketplace->delete($id);
		echo json_encode(array("status" => TRUE));
	}
	public function update() {
		$q = $this->session->userdata('status');
		if($q != "login") {
			exit();
		}
		$this->ModMarketplace->update();
		echo json_encode(array("status" => TRUE));
	}
}
