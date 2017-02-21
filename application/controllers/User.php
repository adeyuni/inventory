<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('BarangModel', 'MBarang');
	}

	public function change_password($param1 = null)
	{

		$this->data['username'] = $_SESSION["username"];
		$this->data['msg'] = $this->session->flashdata('msg');
		$url_redirect = 'user/change_password';

		if($param1 != null){
			$pass1 = $this->input->post('password');
			$pass2 = $this->input->post('repassword');

			if($pass1 != $pass2){
				$msg = "Konfirmasi Password Tidak Sama.";
				$this->set_message(0, $msg);
				redirect(site_url($url_redirect),'refresh');
			}else{
				$query = $this->MBarang->update_table('user_id', $_SESSION["user_id"], 'user', array('user_password' => md5($pass1)));

				if($query){
					$this->set_message(1, 'Success');
				}else{
					$this->set_message(0, 'Gagal, Silahkan ulangi lagi.');
				}

				redirect(site_url($url_redirect),'refresh');
			}
		}

		$this->data['action'] = 'user/change_password/save/';
		$this->data['title'] = 'Ganti Password';
		$this->load->template('user/v_change_password', $this->data);
	}

	private function set_message($type = null, $msg = null)
	{
		if($type == 1){
			$this->data['msg'] = "<div class='alert bg-success' role='alert'>
						<svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg>".$msg."</div>";
		}elseif($type == 0){
			$this->data['msg'] = "<div class='alert bg-danger' role='alert'>
						<svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg>".$msg."</div>";
		}

		$this->session->set_flashdata('msg', $this->data['msg']);
	}

	public function logout()
	{
		$this->session->sess_destroy();

		redirect('user/login','refresh');
	}

	public function login()
	{
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['title'] = "Login Admin";
		$this->load->view('admin/v_login', $this->data);
	}

		public function home()
	{
		if (!$this->load->check_session_admin()) return;

		$this->data['isHome'] = true;
		$this->data['jmlPCAwal'] = $this->MBarang->count_rows('cpu', array('cpu_status = 1 or cpu_status = 0') );
		$this->data['jmlLaptopAwal'] = $this->MBarang->count_rows('laptop', array('laptop_status = 1 or laptop_status = 0') );
		$this->data['jmlImacAwal'] = $this->MBarang->count_rows('imac', array('imac_status = 1 or imac_status = 0') );
		$this->data['jmlSmartphoneAwal'] = $this->MBarang->count_rows('smartphone', array('smartphone_status = 1 or smartphone_status = 0') );

		$this->data['jmlPC'] = $this->MBarang->count_rows('cpu', array('cpu_status' => 1) );
		$this->data['jmlLaptop'] = $this->MBarang->count_rows('laptop', array('laptop_status' => 1) );
		$this->data['jmlImac'] = $this->MBarang->count_rows('imac', array('imac_status' => 1) );
		$this->data['jmlSmartphone'] = $this->MBarang->count_rows('smartphone', array('smartphone_status' => 1) );

		$query = $this->MBarang->get_data('type_barang','');
		foreach($query->result() as $row){

			$this->data['nama_barang'][] = $row->nama;
			if($row->id == 1){
				$this->data['jmlAwal'][] = $this->MBarang->count_rows('cpu', array('cpu_status = 1 or cpu_status = 0') );
				$this->data['jmlBeredar'][] = $this->MBarang->count_rows('cpu', array('cpu_status' => 1) );
			}
			else if($row->id == 100){
				$this->data['jmlAwal'][] = $this->MBarang->count_rows('laptop', array('laptop_status = 1 or laptop_status = 0') );
				$this->data['jmlBeredar'][] = $this->MBarang->count_rows('laptop', array('laptop_status' => 1) );
			}
			else if($row->id == 200){
				$this->data['jmlAwal'][] = $this->MBarang->count_rows('smartphone', array('smartphone_status = 1 or smartphone_status = 0') );
				$this->data['jmlBeredar'][] = $this->MBarang->count_rows('smartphone', array('smartphone_status' => 1) );
			}
			else if($row->id == 300){
				$this->data['jmlAwal'][] = $this->MBarang->count_rows('imac', array('imac_status = 1 or imac_status = 0') );
				$this->data['jmlBeredar'][] = $this->MBarang->count_rows('imac', array('imac_status' => 1) );
			}
			else{
				$this->data['jmlAwal'][] = $this->MBarang->count_rows('barang', array('barang_status = 1 or barang_status = 0', 'barang_jenis_barang_id' => $row->id) );
				$this->data['jmlBeredar'][] = $this->MBarang->count_rows('barang', array('barang_status' => 1, 'barang_jenis_barang_id' => $row->id) );
			}
		}

		$this->data['title'] = "Home";
		$this->load->template('admin/v_home', $this->data);
	}
}