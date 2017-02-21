<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('BarangModel', 'MBarang');
	}

	public function login()
	{
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['title'] = "Login Admin";
		$this->load->view('admin/v_login', $this->data);
	}
	
	public function logout()
	{
		$this->session->sess_destroy();

		redirect('admin/login','refresh');
	}

	//management/barang/edit/1
	public function management($param1 = null, $param2 = null, $id = null)
	{
		if (!$this->load->check_session_admin()) return;
		
		$this->data['msg'] = $this->session->flashdata('msg');
		if($param1 == "barang"){
			$this->_management_jenis_barang($param2, $id);
		}elseif($param1 == "lokasi"){
			$this->_management_lokasi($param2, $id);
		}elseif($param1 == "department"){
			$this->_management_department($param2, $id);
		}elseif($param1 == "akun"){
			$this->_management_akun($param2, $id);
		}elseif($param1 == "home-location"){
			$this->_management_home_location($param2, $id);
		}

	}

	//delete/jenis_barang/1
	public function delete($param1 = null, $id = null)
	{
		if (!$this->load->check_session_admin()) return;

		if($param1 == "jenis_barang"){
			$this->_delete_jenis_barang($id);
		}elseif($param1 == "lokasi"){
			$this->_delete_lokasi($id);
		}elseif($param1 == "sublokasi"){
			$this->_delete_sublokasi($id);
		}elseif($param1 == "department"){
			$this->_delete_department($id);
		}elseif($param1 == "akun"){
			$this->_delete_akun($id);
		}
	}

	public function reset($id = null, $param1 = null){
		if($param1 == null){

			$this->data['action'] = 'admin/reset/'.$id.'/password';
			$this->data['akun'] = $this->_get_username($id);
			$this->data['id'] = $id;
			$this->data['title'] = "Reset Password";
			$this->load->template('admin/v_reset_password', $this->data);
		}else{
			$query = $this->MBarang->update_table('user_id', $id, 'user', array('user_password' => md5('Password12')));

			if($query){
				$this->set_message(1, 'Success');
			}else{
				$this->set_message(0, 'Gagal, Silahkan ulangi lagi.');
			}

			redirect(site_url('admin/management/akun'),'refresh');
		}
	}

	private function _delete_lokasi($id = null)
	{
		$this->data['isThereRelathionship'] = false;
		$check1 = $this->MBarang->is_exist('barang', array('barang_location' => $id) );
		$check2 = $this->MBarang->is_exist('cpu', array('cpu_location' => $id) );
		$check3 = $this->MBarang->is_exist('laptop', array('laptop_location' => $id) );
		$check4 = $this->MBarang->is_exist('imac', array('imac_location' => $id) );
		$check5 = $this->MBarang->is_exist('smartphone', array('smartphone_location' => $id) );
		$check6 = $this->MBarang->is_exist('rekap', array('rekap_lokasi' => $id) );

		if($check1 == true || $check2 == true || $check3 == true || $check4 == true || $check5 == true || $check6 == true){
			$this->data['isThereRelathionship'] = true;
		}
		$this->data['title'] = "Delete Lokasi";
		$this->data['location_id'] = $id;
		$this->data['lokasi'] = $this->_get_location_name($id);
		$this->load->template('admin/delete/v_delete_lokasi', $this->data);
	}

	private function _delete_sublokasi($id = null)
	{
		$this->data['isThereRelathionship'] = false;
		$check1 = $this->MBarang->is_exist('barang', array('barang_sub_location' => $id) );
		$check2 = $this->MBarang->is_exist('cpu', array('cpu_sub_location' => $id) );
		$check3 = $this->MBarang->is_exist('laptop', array('laptop_sub_location' => $id) );
		$check4 = $this->MBarang->is_exist('imac', array('imac_sub_location' => $id) );
		$check5 = $this->MBarang->is_exist('smartphone', array('smartphone_sub_location' => $id) );
		$check6 = $this->MBarang->is_exist('rekap', array('rekap_sub_lokasi' => $id) );

		if($check1 == true || $check2 == true || $check3 == true || $check4 == true || $check5 == true || $check6 == true){
			$this->data['isThereRelathionship'] = true;
		}
		$this->data['title'] = "Delete Sublokasi";
		$this->data['location_id'] = $id;
		$this->data['lokasi'] = $this->_get_sublocation_name($id);
		$this->load->template('admin/delete/v_delete_sublokasi', $this->data);
	}

	private function _delete_department($id = null)
	{
		$this->data['isThereRelathionship'] = false;
		$check1 = $this->MBarang->is_exist('barang', array('barang_department' => $id) );
		$check2 = $this->MBarang->is_exist('cpu', array('cpu_department' => $id) );
		$check3 = $this->MBarang->is_exist('laptop', array('laptop_department' => $id) );
		$check4 = $this->MBarang->is_exist('imac', array('imac_department' => $id) );
		$check5 = $this->MBarang->is_exist('smartphone', array('smartphone_department' => $id) );

		if($check1 == true || $check2 == true || $check3 == true || $check4 == true || $check5 == true){
			$this->data['isThereRelathionship'] = true;
		}
		$this->data['title'] = "Delete Department";
		$this->data['department_id'] = $id;
		$this->data['department'] = $this->_get_department_name($id);
		$this->load->template('admin/delete/v_delete_department', $this->data);
	}

	private function _delete_jenis_barang($id = null)
	{
		$this->data['isThereRelathionship'] = false;
		$check = $this->MBarang->is_exist('barang', array('barang_jenis_barang_id' => $id) );

		if($check == true){
			$this->data['isThereRelathionship'] = true;
		}
		$this->data['title'] = "Delete Jenis Barang";
		$this->data['jenis_barang'] = $this->_get_nama_jenis_barang($id);
		$this->data['jenis_barang2'] = $id;
		$this->load->template('admin/delete/v_delete_jenis_barang', $this->data);
	}

	private function _delete_akun($id = null)
	{

		$this->data['title'] = "Delete Akun";
		$this->data['akun'] = $this->_get_username($id);
		$this->data['akun2'] = $id;
		$this->load->template('admin/delete/v_delete_akun', $this->data);
	}

	private function _get_username($id = null)
	{
		$q = $this->MBarang->get_data('user',array('user_id' => $id));
		foreach($q->result() as $row){	
			$name = $row->user_username;
		}	
		return $name;
	}

	public function process_delete($type = null, $id = null)
	{
		if($type == 'jenis_barang'){
			$query = $this->MBarang->delete('type_barang', 'id', $id);
			$url = site_url('admin/management/barang');
		}elseif($type == 'lokasi'){
			$query = $this->MBarang->delete('location', 'location_id', $id);
			$query = $this->MBarang->delete('dtl_location', 'location_dtl_location_id', $id);
			$url = site_url('admin/management/lokasi');
		}elseif($type == 'sublokasi'){
			$query = $this->MBarang->delete('dtl_location', 'location_dtl_id', $id);
			$url = site_url('admin/management/lokasi');
		}elseif($type == 'department'){
			$query = $this->MBarang->delete('department', 'department_id', $id);
			$url = site_url('admin/management/department');
		}elseif($type == 'akun'){
			$query = $this->MBarang->delete('user', 'user_id', $id);
			$url = site_url('admin/management/akun');
		}
		
		if($query){
			$this->set_message(1, "Data berhasil dihapus.");
		}else{
			$this->set_message(0, "Data gagal dihapus, silahkan ulangi lagi.");
		}
		redirect($url,'refresh');
	}

	private function _get_nama_jenis_barang($jenis_barang_id = null)
	{
		$query = $this->MBarang->get_data('type_barang', array('id' => $jenis_barang_id) );

		foreach($query->result() as $row){
			$nama = $row->nama;
		}

		return $nama;
	}

	private function _get_location_name($id = null)
	{
		$query = $this->MBarang->get_data('location', array('location_id' => $id) );
		foreach($query->result() as $row){
			$nama = $row->location_nama;
		}
		return $nama;
	}

	private function _get_sublocation_name($id = null)
	{
		$query = $this->MBarang->get_data('dtl_location', array('location_dtl_id' => $id) );
		foreach($query->result() as $row){
			$nama = $row->location_dtl_nama;
		}
		return $nama;
	}

	private function _get_department_name($id = null)
	{
		$query = $this->MBarang->get_data('department', array('department_id' => $id) );
		foreach($query->result() as $row){
			$nama = $row->department_nama;
		}
		return $nama;
	}

	private function _management_lokasi($param1 = null, $id = null)
	{
		if (!$this->load->check_session_admin()) return;
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['jmlSubLokasi'] = 0;
		$this->data['additional'] = "include/plus_form_add_lokasi.php";
		$this->data['action'] = "admin/save/lokasi/add";
		$this->data['title'] = "Manage Lokasi";
		$this->data['isEditing'] = false;
		$this->data['listLocation'] = $this->MBarang->get_data('location', '');

		foreach($this->data['listLocation']->result() as $row){
			$this->data['subLocation'][$row->location_id] = $this->MBarang->get_data('dtl_location', array('location_dtl_location_id' => $row->location_id) );
		}

		if($param1 == 'edit'){
			$this->data['title'] = "Edit Lokasi";
			$this->data['action'] = "admin/save/lokasi/edit/".$id;
			$this->data['isEditing'] = true;
			$this->data['location_id'] = $id;
			$location = $this->MBarang->get_data('location', array('location_id' => $id) );
			$dtlLocation = $this->MBarang->get_data('dtl_location', array('location_dtl_location_id' => $id) );

			foreach($location->result() as $row){
				$this->data['lokasi_utama'] = $row->location_nama;
			}

			$jmlSubLokasi = 0;
			foreach ($dtlLocation->result() as $row) {

				$this->data['location_dtl_id'][$jmlSubLokasi] = $row->location_dtl_id;
				$this->data['location_dtl_nama'][$jmlSubLokasi] = $row->location_dtl_nama;
				$jmlSubLokasi++;
			}
			$this->data['jmlSubLokasi'] = $jmlSubLokasi;
		}
		$this->load->template('admin/v_tambah_lokasi', $this->data);
	}

	private function _management_jenis_barang($param1 = null, $id = null)
	{
		if (!$this->load->check_session_admin()) return;
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['listBarang'] = $this->MBarang->get_data_table('type_barang', '', 'id', 'desc');
		$this->data['action'] = "admin/save/jenis_barang/add";
		$this->data['isEditing'] = false;
		$this->data['title'] = "Manage Jenis Barang";

		if($param1 == 'edit'){
			$this->data['title'] = "Edit Jenis Barang";
			$this->data['isEditing'] = true;
			$this->data['action'] = "admin/save/jenis_barang/edit/".$id;
			$query = $this->MBarang->get_data('type_barang', array('id' => $id) );
			foreach($query->result() as $row){
				$this->data['jenis_barang'] = $row->nama;
			}
		}elseif($param1 == 'delete'){
			$query = $this->MBarang->delete('type_barang', 'id', $id);
			$this->set_message(1, "Data berhasil dihapus.");
			redirect('admin/management/barang','refresh');
		}
		
		$this->load->template('admin/v_tambah_barang', $this->data);
	}

	private function _management_department($param1 = null, $id = null)
	{
		if (!$this->load->check_session_admin()) return;
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['listDepartment'] = $this->MBarang->get_data_table('department', '', 'department_id', 'desc');
		$this->data['action'] = "admin/save/department/add";
		$this->data['isEditing'] = false;
		$this->data['title'] = "Manage Department";

		if($param1 == 'edit'){
			$this->data['title'] = "Edit Department";
			$this->data['isEditing'] = true;
			$this->data['action'] = "admin/save/department/edit/".$id;
			$query = $this->MBarang->get_data('department', array('department_id' => $id) );
			foreach($query->result() as $row){
				$this->data['department_nama'] = $row->department_nama;
			}
		}
		
		$this->load->template('admin/v_tambah_department', $this->data);
	}

	private function _management_akun($param1 = null, $id = null)
	{
		if (!$this->load->check_session_admin()) return;
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['listUser'] = $this->MBarang->get_data_table('user', '', 'user_id', 'desc');
		$this->data['listRole'] = $this->MBarang->get_data_table('user_role', '', 'user_role_id', 'asc');
		$this->data['action'] = "admin/save/akun/add";
		$this->data['isEditing'] = false;
		$this->data['title'] = "Manage Akun";

		if($param1 == 'edit'){
			$this->data['title'] = "Edit Akun";
			$this->data['isEditing'] = true;
			$this->data['action'] = "admin/save/akun/edit/".$id;
			$query = $this->MBarang->get_data('user', array('user_id' => $id) );
			foreach($query->result() as $row){
				$this->data['user_username'] = $row->user_username;
				$this->data['role'] = $row->user_role;
			}
			$this->load->template('admin/v_edit_akun', $this->data);
		}else{
			$this->load->template('admin/v_tambah_akun', $this->data);
		}
		
	}
	
	//function for search something
	private function _get_sn($table = null, $id_s = null, $id = null, $column = null)
	{
		$q = $this->MBarang->get_data($table,array($id_s => $id));

		foreach($q->result() as $row){
			$name = $row->$column;
		}
		return $name;
	}

	private function _management_home_location($param1 = null, $id = null)
	{
		if (!$this->load->check_session_admin()) return;
		$this->data['additional'] = "include/plus_form_assigment.php";
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['listLocation'] = $this->MBarang->get_data_table('location', '', 'location_id', 'asc');
		$this->data['selectedLocation'] = $this->_get_sn('home_location', 'home_location_id', 1, 'home_location_location');
		$this->data['action'] = "admin/save/home-location/edit/".$id;
		$this->data['title'] = "Manage Home Location";
		$this->load->template('admin/v_manage_home_location', $this->data);
	}

	public function deleteSubLocation($location_id = null, $sublocation_id = null)
	{	
		if (!$this->load->check_session_admin()) return;
		$delete = $this->MBarang->delete_sub_location($location_id, $sublocation_id);
		if($delete){
			$this->set_message(1, "Data berhasil dihapus.");
		}else{
			$this->set_message(0, "Prose Gagal, silahkan ulangi lagi.");
		}
		redirect(site_url('admin/management/lokasi/edit/'.$location_id),'refresh');
	}

	public function save($param1 = null, $param2 = null, $id = null)
	{
		if (!$this->load->check_session_admin()) return;
		$this->db->trans_start();
		if($param1 == 'jenis_barang'){
			$data = array('nama' => $this->input->post('jenis_barang') );
			if($param2 == "add"){
				$table = "type_barang";
				$url_redirect = "admin/management/barang";
				$msg = "Data berhasil ditambahkan.";
				//tambah jenis barang
				$query = $this->MBarang->add($table, $data);
			}elseif($param2 == "edit"){
				$id_table = "id";
				$table = "type_barang";
				$url_redirect = "admin/management/barang/edit/".$id;
				$msg = "Data berhasil diupdate.";
				$query = $this->MBarang->update_table($id_table, $id, $table, $data);
			}			
		}elseif ($param1 == "lokasi") {
			$data_lokasi_utama = array('location_nama' =>$this->input->post('lokasi_utama'));
			if($param2 == "add"){
				$url_redirect = "admin/management/lokasi";
				$msg = "Data berhasil ditambahkan.";
				$insert = $this->MBarang->insert_location('location', $data_lokasi_utama);
				$data_sub_lokasi = $this->input->post('sub_lokasi');
				//insert to rekap_dtl
				foreach ($data_sub_lokasi as $key=>$value) {
					if($this->input->post('sub_lokasi['.$key.']')!=""){
						$this->data['sub_lokasi'][$key] = $this->input->post('sub_lokasi['.$key.']');

						$data2 = array('location_dtl_location_id' => $insert['location_id'],
										'location_dtl_nama' => $this->data['sub_lokasi'][$key]
										);
						$query = $this->MBarang->add('dtl_location', $data2);
					}
				}
			}elseif($param2 == "edit"){
				$this->MBarang->update_table('location_id', $id, 'location', $data_lokasi_utama);
				//$deleteSubLocation = $this->MBarang->delete('dtl_location', 'location_dtl_location_id', $id);
				$data_sub_lokasi = $this->input->post('sub_lokasi');
				//insert to rekap_dtl
				foreach ($data_sub_lokasi as $key=>$value) {
					if($this->input->post('sub_lokasi['.$key.']')!=""){
						$this->data['sub_lokasi'][$key] = $this->input->post('sub_lokasi['.$key.']');

						$data2 = array('location_dtl_location_id' => $id,
										'location_dtl_nama' => $this->data['sub_lokasi'][$key]
										);
						$id_sublocation = $this->input->post('id_sublocation['.$key.']');
						$jmlSubLokasi = $this->input->post('jmlSubLokasi');
						
						if($key > $jmlSubLokasi){
							$query = $this->MBarang->add('dtl_location', $data2);
						}else{
							$query = $this->MBarang->update_table("location_dtl_id", $id_sublocation, "dtl_location", $data2);
						}
					}
				}
				$msg = "Data berhasil diupdate.";
				$url_redirect = "admin/management/lokasi/edit/".$id;
			}	
		}elseif($param1 == 'department'){
			$data = array('department_nama' => $this->input->post('department_nama') );
			if($param2 == "add"){
				$table = "department";
				$url_redirect = "admin/management/department";
				$msg = "Data berhasil ditambahkan.";
				//tambah jenis barang
				$query = $this->MBarang->add($table, $data);
			}elseif($param2 == "edit"){
				$id_table = "department_id";
				$table = "department";
				$url_redirect = "admin/management/department/edit/".$id;
				$msg = "Data berhasil diupdate.";
				$query = $this->MBarang->update_table($id_table, $id, $table, $data);
			}			
		}elseif($param1 == 'akun'){

			$pass1 = $this->input->post('user_password');
			$pass2 = $this->input->post('user_repassword');
			$data = array('user_username' => $this->input->post('user_username'),
							'user_password' => md5($this->input->post('user_password'))
				);

			$table = "user";
			if($param2 == "add"){
				$url_redirect = "admin/management/akun";
				if($pass1 != $pass2){
					$msg = "Konfirmasi Password Tidak Sama.";
					$this->set_message(0, $msg);
					redirect(site_url($url_redirect),'refresh');
				}else{
					$msg = "Data berhasil ditambahkan.";
					//tambah akun
					$query = $this->MBarang->add($table, $data);
				}
			}elseif($param2 == "edit"){
				$id_table = "user_id";
				$url_redirect = "admin/management/akun/edit/".$id;
				$user_role = $this->input->post('user_role');
				$username = $this->input->post('user_username');

				$query = $this->MBarang->update_table($id_table, $id,$table, array('user_role' => $user_role, 'user_username' => $username));
			}			
		}elseif ($param1 == "home-location") {
			$location = $this->input->post('location');
			$query = $this->MBarang->update_table('home_location_id', 1, 'home_location', array('home_location_location'=> $location));
				$msg = "Success";
				$url_redirect = "admin/management/home-location/";
		}

		$this->db->trans_complete();
		if($query){
			$this->set_message(1, 'Success');
		}else{
			$this->set_message(0, "Proses Gagal, silahkan ulangi lagi.");
		}

		redirect(site_url($url_redirect),'refresh');
	}

	public function process_login()
	{
		
		$isExist = $this->MBarang->is_exist('user', array('user_username' => $this->input->post('username'), 'user_password' => md5($this->input->post('password'))));
		if($isExist){
			$this->session->set_userdata('username', $this->input->post('username') );
			$query = $this->MBarang->get_data('user', array('user_username' => $this->input->post('username')) );
			foreach($query->result() as $row){
				$id = $row->user_id;
				$role = $row->user_role;
				$this->session->set_userdata('user_id', $id);
				$this->session->set_userdata('user_role', $role);
			}
			
			
			$data = array('log_user_username' => $this->input->post('username'),
							'log_user_last_login' => date('Y-m-d H:i:s'));
			$this->MBarang->add('log_user',$data);
			$this->MBarang->update_table('user_id', $id, 'user', array('user_last_login' => date('Y-m-d H:i:s')) );

			redirect('user/home','refresh');

		}else{
			$this->set_message(0, "Username atau Password Salah.");
			redirect('user/login','refresh');
		}
	}

	public function tes(){
		echo $_SESSION["username"];
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

	public function power()
	{
		$psPath = "powershell.exe";
		$psDIR = "C:\\ps\\";
		$psScript = "tes.ps1";
		$runScript = $psDIR. $psScript;
		$runCMD = $psPath." ".$runScript." 2>&1"; 

		$output= shell_exec($runCMD);
		echo( '<pre>' );
		echo( $output );
		echo( '</pre>' );
	}
}