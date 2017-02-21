<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class assigment extends CI_Controller {

	const TABLE_BARANG = "barang";
	const CREATOR = 1;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('BarangModel', 'MBarang');
		$this->load->model('AssigmentModel', 'MAssigment');
		if (!$this->load->check_session_admin()) return;
	}

	public function wow()
	{
		$data = array('nama' => 'ade', 'alamat' => 'sragen');
		$this->testing($data);
	}

	public function testing($data)
	{
		echo $data['nama'];
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

	public function barang($jenis_barang = null, $id = null)
	{
		$this->data['title'] = 'Serah Terima Barang';
		$this->data['selectedJenisBarang'] = $jenis_barang;
		$this->data['listJenisBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['listLocation'] = $this->MBarang->get_data('location ','');
		$this->data['listDepartment'] = $this->MBarang->get_data('department ','');
		$this->data['selectedLocation'] = null;
		$this->data['selectedCPU'] = $id;
		$this->data['selectedLaptop'] = $id;
		$this->data['selectedMon1'] = null;
		$this->data['selectedMon2'] = null;
		$this->data['selectedMouse'] = null;
		$this->data['selectedKeyboard'] = null;
		$this->data['selectedUPS'] = null;
		$this->data['selectedBarang'] = null;
		$this->data['selectedSmartphone'] = $id;
		$this->data['selectedIMAC'] = $id;
		$this->data['selectedDepartment'] = null;
		$this->data['selectedDongle'] = null;
		$this->data['sub_lokasi'] = 0;
		$this->data['cpu_id'] = 0;
		$this->data['laptop_id'] = 0;
		$this->data['smartphone_id'] = 0;
		$this->data['imac_id'] = 0;
		$this->data['barang_id'] = 0;
		$this->data['id_mon1'] = 0;
		$this->data['id_mon2'] = 0;
		$this->data['id_dongle'] = 0;
		$this->data['id_mouse'] = 0;
		$this->data['id_keyboard'] = 0;
		$this->data['id_ups'] = 0;


		$location_home = $this->_get_sn('home_location', 'home_location_id', 1, 'home_location_location');

		if($jenis_barang == 1){

			$this->data['listCPU'] = $this->MBarang->get_data('cpu',array('cpu_status' => 0, 'cpu_kondisi' => 1, 'cpu_location' => $location_home));
			$this->data['listMonitor'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 2, 'barang_kondisi' => 1, 'barang_location' => $location_home));
			$this->data['listKeyboard'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 3, 'barang_kondisi' => 1, 'barang_location' => $location_home));
			$this->data['listMouse'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 4, 'barang_kondisi' => 1, 'barang_location' => $location_home));
			$this->data['listUPS'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 5, 'barang_kondisi' => 1, 'barang_location' => $location_home));
			$this->data['listDongle'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 6, 'barang_kondisi' => 1, 'barang_location' => $location_home));
			$this->data['formAssigmentBarang'] = "additional/v_form_assigment_cpu.php";
			
			if($id != null){
				$this->data['cpu_hostname']= $this->_get_sn('cpu', 'cpu_id', $id, 'cpu_hostname');
			}
		}elseif($jenis_barang == 100){
			$this->data['listLaptop'] = $this->MBarang->get_data('laptop',array('laptop_status' => 0, 'laptop_kondisi' => 1, 'laptop_location' => $location_home));
			
			$this->data['listMonitor'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 2, 'barang_kondisi' => 1, 'barang_location' => $location_home));
			$this->data['listMouse'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 4, 'barang_kondisi' => 1, 'barang_location' => $location_home));
			$this->data['formAssigmentBarang'] = "additional/v_form_assigment_laptop.php";

			if($id != null){
				$this->data['kode_laptop']= $this->_get_sn('laptop', 'laptop_id', $id, 'laptop_kode');
				$this->data['nama_laptop']= $this->_get_sn('laptop', 'laptop_id', $id, 'laptop_nama');
			}
		}elseif($jenis_barang == 200){

			$this->data['listSmartphone'] = $this->MBarang->get_data('smartphone',array('smartphone_status' => 0, 'smartphone_kondisi' => 1, 'smartphone_location' => $location_home));
			$this->data['formAssigmentBarang'] = "additional/v_form_assigment_smartphone.php";
		}elseif($jenis_barang == 300){
			$this->data['listIMAC'] = $this->MBarang->get_data('imac',array('imac_status' => 0, 'imac_kondisi' => 1, 'imac_location' => $location_home));
			$this->data['listUPS'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 5, 'barang_kondisi' => 1));
			$this->data['formAssigmentBarang'] = "additional/v_form_assigment_imac.php";
		}else{

			$this->data['listBarang'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => $jenis_barang, 'barang_kondisi' => 1, 'barang_location' => $location_home));
			$this->data['formAssigmentBarang'] = "additional/v_form_assigment_barang.php";
		}

		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['additional'] = "include/plus_form_assigment.php";
		$this->data['action'] = 'assigment/save/add';
		$this->load->template('assigment/v_form_assigment', $this->data);
	}

	public function save($param1 = null, $jenis_barang = null, $id = null)
	{
		if($param1 == 'add'){
			$jenis_barang = $this->input->post('jenis_barang');
		}
		$user = $this->input->post('user');
		$department = $this->input->post('department');
		$location = $this->input->post('location');
		$sub_lokasi = $this->input->post('sub_lokasi');
		$this->db->trans_start();

		
		//data barang
		$data_barang = array(	'barang_user' => $user,
									'barang_department' => $department,
									'barang_location' => $location,
									'barang_sub_location' => $sub_lokasi,
									'barang_status' => 1
								);
		$url_redirect = "assigment/barang/add";
		if($jenis_barang == 1){
			$cpu_id = $this->input->post('cpu_id');
			$mon1 = $this->input->post('mon1_id');
			$mon2 = $this->input->post('mon2_id');
			$keyboard = $this->input->post('keyboard_id');
			$mouse = $this->input->post('mouse_id');
			$ups = $this->input->post('ups_id');
			$dongle = $this->input->post('dongle_id');
			$hostname = $this->input->post('hostname');

			$data = array(	'as_cpu_cpu_id' => $cpu_id,
							'as_cpu_mon1_id' => $mon1,
							'as_cpu_mon2_id' => $mon2,
							'as_cpu_dongle_id' => $dongle,
							'as_cpu_keyboard_id' => $keyboard,
							'as_cpu_mouse_id' => $mouse,
							'as_cpu_ups_id' => $ups,
							'as_cpu_id_creator' => $_SESSION["user_id"],
							'as_cpu_time_create' => date('Y-m-d H:i:s')
						);
			$table = "as_cpu";
			
			if($mon1 == $mon2){
				$this->set_message(0, "Monitor 1 tidak boleh sama dengan Monitor 2.");
				redirect(site_url($url_redirect),'refresh');
			}
			
			//update process on other barang and cpu
			$data_cpu = array(	'cpu_hostname' => $hostname,
								'cpu_user' => $user,
								'cpu_department' => $department,
								'cpu_location' => $location,
								'cpu_sub_location' => $sub_lokasi,
								'cpu_status' => 1
								);
			$this->MBarang->update_table('cpu_id', $cpu_id, 'cpu', $data_cpu);
			$this->MBarang->update_table('barang_id', $mon1, 'barang', $data_barang);
			$this->MBarang->update_table('barang_id', $keyboard, 'barang', $data_barang);
			$this->MBarang->update_table('barang_id', $mouse, 'barang', $data_barang);
			$this->MBarang->update_table('barang_id', $ups, 'barang', $data_barang);
			if(isset($mon2)){
				$this->MBarang->update_table('barang_id', $mon2, 'barang', $data_barang);
			}
			if(isset($dongle)){
				$this->MBarang->update_table('barang_id', $dongle, 'barang', $data_barang);
			}

			if($param1 == 'add'){
				$query = $this->MBarang->add($table, $data);
			}elseif ($param1 == 'edit') {
				$cpu_old = $this->input->post('cpu_old');
				$mon1_old = $this->input->post('mon1_old');
				$mon2_old = $this->input->post('mon2_old');
				$keyboard_old = $this->input->post('keyboard_old');
				$mouse_old = $this->input->post('mouse_old');
				$ups_old = $this->input->post('ups_old');
				$dongle_old = $this->input->post('dongle_old');

				if($cpu_old != $cpu_id AND $cpu_old != 0){
					//tarik cpu yg lama, kemudian update 
					$this->_tarik_cpu($cpu_old);
				}

				if($mon1_old != $mon1 AND $mon1_old != 0){
					$this->_tarik_barang(2, $mon1_old);
				}

				if($mon2_old != $mon2 AND $mon2_old != 0){
					$this->_tarik_barang(2, $mon2_old);
				}

				if($keyboard_old != $keyboard AND $keyboard_old != 0){
					$this->_tarik_barang(3, $keyboard);
				}

				if($mouse_old != $mouse AND $mouse_old != 0){
					$this->_tarik_barang(4, $mouse_old);
				}

				if($ups_old != $ups AND $ups_old != 0){
					$this->_tarik_barang(5, $ups_old);
				}

				if($dongle_old != $dongle AND $dongle_old != 0){
					$this->_tarik_barang(6, $dongle_old);
				}

				$data = array(	'as_cpu_cpu_id' => $cpu_id,
							'as_cpu_mon1_id' => $mon1,
							'as_cpu_mon2_id' => $mon2,
							'as_cpu_dongle_id' => $dongle,
							'as_cpu_keyboard_id' => $keyboard,
							'as_cpu_mouse_id' => $mouse,
							'as_cpu_ups_id' => $ups,
							'as_cpu_id_editor' => $_SESSION["user_id"],
							'as_cpu_time_edit' => date('Y-m-d H:i:s')
						);
				//update data di tabel as_cpu
				$query = $this->MBarang->update_table('as_cpu_cpu_id', $cpu_old, 'as_cpu', $data);
				$url_redirect = "barang/assigment/".$jenis_barang."/".$cpu_id;
			}
		}elseif($jenis_barang == 100){
			$laptop_id = $this->input->post('laptop_id');
			$nama_laptop = $this->input->post('nama_laptop');
			$kode_laptop = $this->input->post('kode_laptop');
			$mon1 = $this->input->post('mon1_id');
			$mouse = $this->input->post('mouse_id');

			$data = array(	'as_laptop_laptop_id' => $laptop_id,
							'as_laptop_mouse_id' => $mouse,
							'as_laptop_mon_id' => $mon1,
							'as_laptop_id_creator' => $_SESSION["user_id"],
							'as_laptop_time_create' => date('Y-m-d H:i:s')
							);

			$data_laptop = array('laptop_nama' => $nama_laptop,
								'laptop_kode' => $kode_laptop,
								'laptop_user' => $user,
								'laptop_department' => $department,
								'laptop_location' => $location,
								'laptop_sub_location' => $sub_lokasi,
								'laptop_status' => 1
								);

			$this->MBarang->update_table('laptop_id', $laptop_id, 'laptop', $data_laptop);
			if(isset($mon1)){
				$this->MBarang->update_table('barang_id', $mon1, 'barang', $data_barang);
			}
			if(isset($mouse)){
				$this->MBarang->update_table('barang_id', $mouse, 'barang', $data_barang);
			}

			if($param1 == 'add'){
				$query = $this->MBarang->add('as_laptop', $data);	
			}elseif ($param1 == 'edit') {
				$laptop_old = $this->input->post('laptop_old');
				$mon1_old = $this->input->post('mon1_old');
				$mouse_old = $this->input->post('mouse_old');

				if($laptop_old != $laptop_id AND $laptop_old != 0){
					//tarik cpu yg lama, kemudian update 
					$this->_tarik_laptop($laptop_old);
				}

				if($mon1_old != $mon1 AND $mon1_old != 0){
					$this->_tarik_barang(2, $mon1_old);
				}

				if($mouse_old != $mouse AND $mouse_old != 0){
					$this->_tarik_barang(4, $mouse_old);
				}

				$data = array(	'as_laptop_laptop_id' => $laptop_id,
							'as_laptop_mon_id' => $mon1,
							'as_laptop_mouse_id' => $mouse,
							'as_laptop_id_editor' => $_SESSION["user_id"],
							'as_laptop_time_edit' => date('Y-m-d H:i:s')
						);
				//update data di tabel as_laptop with old id
				$query = $this->MBarang->update_table('as_laptop_laptop_id', $laptop_old, 'as_laptop', $data);
				$url_redirect = "barang/assigment/".$jenis_barang."/".$laptop_id;
			}

		}elseif($jenis_barang == 200){
			$smartphone_id = $this->input->post('smartphone_id');

			$data = array(	'as_smartphone_smartphone_id' => $smartphone_id,
							'as_smartphone_id_creator' => $_SESSION["user_id"],
							'as_smartphone_time_create' => date('Y-m-d H:i:s')
						);

			$data_smartphone = array('smartphone_user' => $user,
									'smartphone_department' => $department,
									'smartphone_location' => $location,
									'smartphone_sub_location' => $sub_lokasi,
									'smartphone_status' => 1
								);
			
			$query = $this->MBarang->update_table('smartphone_id', $smartphone_id, 'smartphone', $data_smartphone);

			if($param1 == 'add'){
				$query = $this->MBarang->add('as_smartphone', $data);
			}elseif ($param1 == 'edit') {
				$smartphone_old = $this->input->post('smartphone_old');

				if($smartphone_old != $smartphone_id){
					//tarik cpu yg lama, kemudian update 
					$this->_tarik_smartphone($smartphone_old);
				}

				$data = array(	'as_smartphone_smartphone_id' => $smartphone_id,
							'as_smartphone_id_editor' => $_SESSION["user_id"],
							'as_smartphone_time_edit' => date('Y-m-d H:i:s')
						);
				//update data di tabel as_laptop with old id
				$query = $this->MBarang->update_table('as_smartphone_smartphone_id', $smartphone_old, 'as_smartphone', $data);
				$url_redirect = "barang/assigment/".$jenis_barang."/".$smartphone_id;
			}
		}elseif($jenis_barang == 300){
			$imac_id = $this->input->post('imac_sn');
			$ups = $this->input->post('ups_id');
			$nama_imac = $this->input->post('nama_imac');

			$data = array(	'as_imac_imac_id' => $imac_id,
							'as_imac_ups_id' => $ups,
							'as_imac_id_creator' => $_SESSION["user_id"],
							'as_imac_time_create' => date('Y-m-d H:i:s')
							);
			$data_imac = array(	'imac_nama' => $nama_imac,
								'imac_user' => $user,
								'imac_department' => $department,
								'imac_location' => $location,
								'imac_sub_location' => $sub_lokasi,
								'imac_status' => 1
								);
		
			$this->MBarang->update_table('imac_id', $imac_id, 'imac', $data_imac);
			$this->MBarang->update_table('barang_id', $ups, 'barang', $data_barang);

			if($param1 == 'add'){
				$query = $this->MBarang->add('as_imac', $data);
			}elseif ($param1 == 'edit') {
				$imac_old = $this->input->post('imac_old');
				$ups_old = $this->input->post('ups_old');

				if($imac_old != $imac_id AND $imac_old != 0){
					//tarik cpu yg lama, kemudian update 
					$this->_tarik_imac($imac_old);
				}

				if($ups_old != $ups AND $ups_old != 0){
					$this->_tarik_barang(5, $ups_old);
				}

				$data = array(	'as_imac_imac_id' => $imac_id,
							'as_imac_ups_id' => $ups,
							'as_imac_id_editor' => $_SESSION["user_id"],
							'as_imac_time_edit' => date('Y-m-d H:i:s')
						);
				//update data di tabel as_laptop with old id
				$query = $this->MBarang->update_table('as_imac_imac_id', $imac_old, 'as_imac', $data);
				$url_redirect = "barang/assigment/".$jenis_barang."/".$imac_id;
			}

		}else{

			$id_barang = $this->input->post('barang_sn');
			$data = array(	'as_barang_barang_id' => $id_barang,
							'as_barang_id_creator' => $_SESSION["user_id"],
							'as_barang_time_create' => date('Y-m-d H:i:s')
						);

			$query = $this->MBarang->add('as_barang', $data);
			$query = $this->MBarang->update_table('barang_id', $id_barang, 'barang', $data_barang);
		}
		


		$this->db->trans_complete();
		if($query){
			$this->set_message(1, "Success.");
		}else{
			$this->set_message(0, "Data gagal ditambahkan, silahkan ulangi lagi.");
		}
		redirect(site_url($url_redirect),'refresh');
	}

	public function daftar($jenis_barang = null)
	{
		$this->data['jenisBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['msg'] = $this->session->flashdata('msg');

		$jmlBeredar = 0;
		if($jenis_barang == 1){
			$this->data['listSelectedBarang'] = "v_list_cpu.php";
			$listCPU = $this->MBarang->get_two_table('cpu', 'as_cpu', 'cpu_id = as_cpu_cpu_id', 'cpu_id', "DESC");
			
			foreach($listCPU->result() as $row){
				$this->data['cpu_id'][] = $row->as_cpu_cpu_id;
				$this->data['mon1_id'][] = $row->as_cpu_mon1_id;
				$this->data['mon2_id'][] = $row->as_cpu_mon2_id;
				$this->data['dongle_id'][] = $row->as_cpu_dongle_id;
				$this->data['keyboard_id'][] = $row->as_cpu_keyboard_id;
				$this->data['mouse_id'][] = $row->as_cpu_mouse_id;
				$this->data['ups_id'][] = $row->as_cpu_ups_id;
				$this->data['service_tag'][] = $row->cpu_service_tag;
				$this->data['no_asset'][] = $row->cpu_no_asset;
				$this->data['no_it'][] = $row->cpu_no_it;
				$this->data['hostname'][] = $row->cpu_hostname;
				$this->data['user'][] = $row->cpu_user;
				$jmlBeredar++;
			}
		}elseif($jenis_barang == 100){
			$this->data['listSelectedBarang'] = "v_list_laptop.php";
			$listLaptop = $this->MBarang->get_two_table('laptop', 'as_laptop', 'laptop_id = as_laptop_laptop_id','laptop_id', "DESC");
			
			foreach($listLaptop->result() as $row){
				$this->data['laptop_id'][] = $row->as_laptop_laptop_id;
				$this->data['mon1_id'][] = $row->as_laptop_mon_id;
				$this->data['mouse_id'][] = $row->as_laptop_mouse_id;
				$this->data['no_asset'][] = $row->laptop_no_asset;
				$this->data['no_it'][] = $row->laptop_no_it;
				$this->data['sn'][] = $row->laptop_sn_lp;
				$this->data['hostname'][] = $row->laptop_kode;
				$this->data['user'][] = $row->laptop_user;
				$jmlBeredar++;
			}
		}elseif($jenis_barang == 200){
			$this->data['listSelectedBarang'] = "v_list_smartphone.php";
			$listSmartphone = $this->MBarang->get_two_table('smartphone', 'as_smartphone', 'smartphone_id = as_smartphone_smartphone_id','smartphone_id', "DESC");
			
			foreach($listSmartphone->result() as $row){
				$this->data['smartphone_id'][] = $row->as_smartphone_smartphone_id;
				$this->data['no_asset'][] = $row->smartphone_no_asset;
				$this->data['no_it'][] = $row->smartphone_no_it;
				$this->data['sn'][] = $row->smartphone_sn;
				$this->data['imei1'][] = $row->smartphone_imei1;
				$this->data['user'][] = $row->smartphone_user;
				$jmlBeredar++;
			}
		}elseif($jenis_barang == 300){
			$this->data['listSelectedBarang'] = "v_list_imac.php";
			$listImac = $this->MBarang->get_two_table('imac', 'as_imac', 'imac_id = as_imac_imac_id','imac_id', "DESC");
			
			foreach($listImac->result() as $row){
				$this->data['imac_id'][] = $row->as_imac_imac_id;
				$this->data['no_asset'][] = $row->imac_no_asset;
				$this->data['no_it'][] = $row->imac_no_it;
				$this->data['sn'][] = $row->imac_sn;
				$this->data['hostname'][] = $row->imac_nama;
				$this->data['user'][] = $row->imac_user;
				$jmlBeredar++;
			}
		}else{
			$this->data['listSelectedBarang'] = "v_list_barang2.php";
			$listBarang = $this->MAssigment->get_list_barang('barang', 'as_barang', 'barang_id = as_barang_barang_id', array('barang_jenis_barang_id' => $jenis_barang) );
			
			foreach($listBarang->result() as $row){
				$this->data['barang_id'][] = $row->as_barang_barang_id;
				$this->data['no_asset'][] = $row->barang_no_asset;
				$this->data['no_it'][] = $row->barang_no_it;
				$this->data['sn'][] = $row->barang_sn;
				$this->data['user'][] = $row->barang_user;
				$jmlBeredar++;
			}
		}

		$this->data['jmlBeredar'] = $jmlBeredar;
		$this->data['jenis_barang'] = $jenis_barang;
		$this->data['additional'] = "include/plus_assigment_barang.php";
		$this->data['title'] = 'Daftar Barang Beredar';
		$this->load->template('assigment/list/v_list_barang', $this->data);
	}

	private function _get_nama_jenis_barang($jenis_barang_id = null)
	{
		$query = $this->MBarang->get_data('type_barang', array('id' => $jenis_barang_id) );

		foreach($query->result() as $row){
			$nama = $row->nama;
		}

		return $nama;
	}

	private function get_location_name($type = null, $id = null)
	{
		if($type == "location"){
			$q = $this->MBarang->get_data('location',array('location_id' => $id));
			foreach($q->result() as $row){	
				$name = $row->location_nama;
			}
		}else{
			$q = $this->MBarang->get_data('dtl_location',array('location_dtl_id' => $id));
			foreach($q->result() as $row){	
				$name = $row->location_dtl_nama;
			}
		}
		return $name;
	}

	public function tarik($jenis_barang = null, $id = null)
	{
		$this->data['jenis_barang'] = $jenis_barang;
		$this->data['jenis_barang2'] = $this->_get_nama_jenis_barang($jenis_barang);

		if($jenis_barang == 1){
			
			$query = $this->MBarang->search_detail('cpu', 'rekap', 'rekap_dtl', 'location', 'department','cpu_no_po = rekap_id', 'cpu_rekap_dtl_id = rekap_dtl_id','cpu_location = location_id','cpu_department = department_id', 'rekap_id', 'asd', 'cpu_id', $id);

			foreach ($query->result() as $row) {
				$this->data['id_po'] = $row->rekap_id;
				$this->data['id_rekap_dtl'] = $row->rekap_dtl_id;
				$this->data['no_po'] = $row->rekap_no_po;
				$this->data['no_asset'] = $row->cpu_no_asset;
				$this->data['no_it'] = $row->cpu_no_it;
				$this->data['sn_cpu'] = $row->cpu_sn;
				$this->data['type'] = $row->rekap_dtl_type;
				$this->data['merk'] = $row->rekap_dtl_merk;
				$this->data['vendor'] = $row->rekap_vendor;
				$this->data['tgl_terima'] = $row->rekap_tgl_terima;
				$this->data['location'] = $row->location_nama;
				$this->data['sub_location'] = $this->get_location_name('sub_location',$row->cpu_sub_location);
				$this->data['user'] = $row->cpu_user;
				$this->data['hostname'] = $row->cpu_hostname;
				$this->data['service_tag'] = $row->cpu_service_tag;
				$this->data['department'] = $row->department_nama;
				$this->data['creator'] = $row->cpu_id_creator;
				$this->data['time_create'] = $row->cpu_time_create;
				$this->data['editor'] = $row->cpu_id_editor;
				$this->data['time_edit'] = $row->cpu_time_edit;
			}

			$cek = $this->MBarang->is_exist('as_cpu', array('as_cpu_cpu_id' =>  $id));

			if($cek == true){
				$query = $this->MBarang->relation_checking('cpu', 'as_cpu', 'cpu_id = as_cpu_cpu_id', array('cpu_id' => $id));

				foreach($query->result() as $row) {
					$this->data['id_mon1'] = $row->as_cpu_mon1_id;
					$this->data['sn_mon1'] = $this->get_sn_barang($row->as_cpu_mon1_id);

					if($row->as_cpu_mon2_id != 0){
						$this->data['id_mon2'] = $row->as_cpu_mon2_id;
						$this->data['sn_mon2'] = $this->get_sn_barang($row->as_cpu_mon2_id);
					}
					if($row->as_cpu_dongle_id != 0){
						$this->data['id_dongle'] = $row->as_cpu_dongle_id;
						$this->data['sn_dongle'] = $this->get_sn_barang($row->as_cpu_dongle_id);
					}
					$this->data['id_keyboard'] = $row->as_cpu_keyboard_id;
					$this->data['sn_keyboard'] = $this->get_sn_barang($row->as_cpu_keyboard_id);
					$this->data['id_mouse'] = $row->as_cpu_mouse_id;
					$this->data['sn_mouse'] = $this->get_sn_barang($row->as_cpu_mouse_id);
					$this->data['id_ups'] = $row->as_cpu_ups_id;
					$this->data['sn_ups'] = $this->get_sn_barang($row->as_cpu_ups_id);
					$this->data['as_cpu_id'] = $row->as_cpu_id;
				}
			}
			
			$viewDtl = 'assigment/tarik/v_tarik_cpu';
		}elseif($jenis_barang == 100){
			$query = $this->MBarang->search_detail('laptop', 'rekap', 'rekap_dtl', 'location', 'department','laptop_no_po = rekap_id', 'laptop_rekap_dtl_id = rekap_dtl_id','laptop_location = location_id','laptop_department = department_id', 'rekap_id', 'asd', 'laptop_id', $id);

			foreach ($query->result() as $row) {
				$this->data['id_po'] = $row->rekap_id;
				$this->data['id_rekap_dtl'] = $row->rekap_dtl_id;
				$this->data['no_po'] = $row->rekap_no_po;
				$this->data['no_asset'] = $row->laptop_no_asset;
				$this->data['no_it'] = $row->laptop_no_it;
				$this->data['sn'] = $row->laptop_sn_lp;
				$this->data['type'] = $row->rekap_dtl_type;
				$this->data['merk'] = $row->rekap_dtl_merk;
				$this->data['vendor'] = $row->rekap_vendor;
				$this->data['tgl_terima'] = $row->rekap_tgl_terima;
				$this->data['location'] = $row->location_nama;
				$this->data['sub_location'] = $this->get_location_name('sub_location',$row->laptop_sub_location);
				$this->data['user'] = $row->laptop_user;
				$this->data['kode_laptop'] = $row->laptop_kode;
				$this->data['department'] = $row->department_nama;
				$this->data['creator'] = $row->laptop_id_creator;
				$this->data['time_create'] = $row->laptop_time_create;
				$this->data['editor'] = $row->laptop_id_editor;
				$this->data['time_edit'] = $row->laptop_time_edit;
			}

			$cek = $this->MBarang->is_exist('as_laptop', array('as_laptop_laptop_id' =>  $id));

			if($cek == true){
				$query = $this->MBarang->relation_checking('laptop', 'as_laptop', 'laptop_id = as_laptop_laptop_id', array('laptop_id' => $id));

				foreach($query->result() as $row) {

					if($row->as_laptop_mon_id != 0){
						$this->data['id_mon1'] = $row->as_laptop_mon_id;
						$this->data['sn_mon1'] = $this->get_sn_barang($row->as_laptop_mon_id);
					}
					$this->data['id_mouse'] = $row->as_laptop_mouse_id;
					if($row->as_laptop_mouse_id != 0){
						$this->data['sn_mouse'] = $this->get_sn_barang($row->as_laptop_mouse_id);
					}
					
					$this->data['as_laptop_id'] = $row->as_laptop_id;
				}
			}

			$viewDtl = 'assigment/tarik/v_tarik_laptop';
		}elseif($jenis_barang == 200){
			$query = $this->MBarang->search_detail('smartphone', 'rekap', 'rekap_dtl', 'location', 'department','smartphone_no_po = rekap_id', 'smartphone_rekap_dtl_id = rekap_dtl_id','smartphone_location = location_id','smartphone_department = department_id', 'rekap_id', 'asd', 'smartphone_id', $id);

			foreach ($query->result() as $row) {
				$this->data['id_po'] = $row->rekap_id;
				$this->data['id_rekap_dtl'] = $row->rekap_dtl_id;
				$this->data['no_po'] = $row->rekap_no_po;
				$this->data['no_asset'] = $row->smartphone_no_asset;
				$this->data['no_it'] = $row->smartphone_no_it;
				$this->data['sn'] = $row->smartphone_sn;
				$this->data['type'] = $row->rekap_dtl_type;
				$this->data['merk'] = $row->rekap_dtl_merk;
				$this->data['vendor'] = $row->rekap_vendor;
				$this->data['tgl_terima'] = $row->rekap_tgl_terima;
				$this->data['location'] = $row->location_nama;
				$this->data['sub_location'] = $this->get_location_name('sub_location',$row->smartphone_sub_location);
				$this->data['user'] = $row->smartphone_user;
				$this->data['department'] = $row->department_nama;
				$this->data['creator'] = $row->smartphone_id_creator;
				$this->data['time_create'] = $row->smartphone_time_create;
				$this->data['editor'] = $row->smartphone_id_editor;
				$this->data['time_edit'] = $row->smartphone_time_edit;
			}

			$cek = $this->MBarang->is_exist('as_smartphone', array('as_smartphone_smartphone_id' =>  $id));

			if($cek == true){
				$query = $this->MBarang->relation_checking('smartphone', 'as_smartphone', 'smartphone_id = as_smartphone_smartphone_id', array('smartphone_id' => $id));

				foreach($query->result() as $row) {
					$this->data['as_smartphone_id'] = $row->as_smartphone_id;
				}
			}

			$viewDtl = 'assigment/tarik/v_tarik_smartphone';
		}elseif($jenis_barang == 300){
			$query = $this->MBarang->search_detail('imac', 'rekap', 'rekap_dtl', 'location', 'department','imac_no_po = rekap_id', 'imac_rekap_dtl_id = rekap_dtl_id','imac_location = location_id','imac_department = department_id', 'rekap_id', 'asd', 'imac_id', $id);

			foreach ($query->result() as $row) {
				$this->data['id_po'] = $row->rekap_id;
				$this->data['id_rekap_dtl'] = $row->rekap_dtl_id;
				$this->data['no_po'] = $row->rekap_no_po;
				$this->data['no_asset'] = $row->imac_no_asset;
				$this->data['no_it'] = $row->imac_no_it;
				$this->data['sn_imac'] = $row->imac_sn;
				$this->data['sn_keyboard'] = $row->imac_sn_keyboard;
				$this->data['sn_mouse'] = $row->imac_sn_mouse;
				$this->data['type'] = $row->rekap_dtl_type;
				$this->data['merk'] = $row->rekap_dtl_merk;
				$this->data['vendor'] = $row->rekap_vendor;
				$this->data['tgl_terima'] = $row->rekap_tgl_terima;
				$this->data['location'] = $row->location_nama;
				$this->data['sub_location'] = $this->get_location_name('sub_location',$row->imac_sub_location);
				$this->data['user'] = $row->imac_user;
				$this->data['imac_nama'] = $row->imac_nama;
				$this->data['department'] = $row->department_nama;
				$this->data['creator'] = $row->imac_id_creator;
				$this->data['time_create'] = $row->imac_time_create;
				$this->data['editor'] = $row->imac_id_editor;
				$this->data['time_edit'] = $row->imac_time_edit;
			}

			$cek = $this->MBarang->is_exist('as_imac', array('as_imac_imac_id' =>  $id));

			if($cek == true){
				$query = $this->MBarang->relation_checking('imac', 'as_imac', 'imac_id = as_imac_imac_id', array('imac_id' => $id));

				foreach($query->result() as $row) {
					if($row->as_imac_ups_id != 0){
						$this->data['id_ups'] = $row->as_imac_ups_id;
						$this->data['sn_ups'] = $this->get_sn_barang($row->as_imac_ups_id);
						$this->data['as_imac_id'] = $row->as_imac_id;
					}					
				}
			}

			$viewDtl = 'assigment/tarik/v_tarik_imac';
		}else{
			$query = $this->MBarang->search_detail('barang', 'rekap', 'rekap_dtl', 'location', 'department','barang_no_po = rekap_id', 'barang_rekap_dtl_id = rekap_dtl_id','barang_location = location_id','barang_department = department_id', 'rekap_id', 'asd', 'barang_id', $id);

			foreach ($query->result() as $row) {
				$this->data['id_po'] = $row->rekap_id;
				$this->data['id_rekap_dtl'] = $row->rekap_dtl_id;
				$this->data['no_po'] = $row->rekap_no_po;
				$this->data['no_asset'] = $row->barang_no_asset;
				$this->data['no_it'] = $row->barang_no_it;
				$this->data['sn'] = $row->barang_sn;
				$this->data['type'] = $row->rekap_dtl_type;
				$this->data['merk'] = $row->rekap_dtl_merk;
				$this->data['vendor'] = $row->rekap_vendor;
				$this->data['tgl_terima'] = $row->rekap_tgl_terima;
				$this->data['location'] = $row->location_nama;
				$this->data['sub_location'] = $this->get_location_name('sub_location',$row->barang_sub_location);
				$this->data['user'] = $row->barang_user;
				$this->data['department'] = $row->department_nama;
				$this->data['creator'] = $row->barang_id_creator;
				$this->data['time_create'] = $row->barang_time_create;
				$this->data['editor'] = $row->barang_id_editor;
				$this->data['time_edit'] = $row->barang_time_edit;
			}

			$cek = $this->MBarang->is_exist('as_barang', array('as_barang_barang_id' =>  $id));

			if($cek == true){
				$query = $this->MBarang->relation_checking('barang', 'as_barang', 'barang_id = as_barang_barang_id', array('barang_id' => $id));
				foreach($query->result() as $row) {
					$this->data['as_barang_id'] = $row->as_barang_id;
					
				}

				echo "tesss";
			}

			$viewDtl = 'assigment/tarik/v_tarik_barang';
		}

		$this->data['title'] = 'Penarikan Barang';
		$this->load->template($viewDtl, $this->data);
	}

	public function process_tarik($jenis_barang = null, $id = null)
	{
		$this->db->trans_start();
		if($jenis_barang == 1){
			$query = $this->MBarang->get_data('as_cpu', array('as_cpu_id' => $id) );

			foreach($query->result() as $row){

				//tarik cpu
				$this->_tarik_cpu($row->as_cpu_cpu_id);
				
				if($row->as_cpu_mon1_id != 0){
					$this->_tarik_barang(2, $row->as_cpu_mon1_id);
				}
				
				if($row->as_cpu_keyboard_id != 0){
					$this->_tarik_barang(3, $row->as_cpu_keyboard_id);
				}

				if($row->as_cpu_mouse_id != 0){
					$this->_tarik_barang(4, $row->as_cpu_mouse_id);
				}
				

				if($row->as_cpu_ups_id != 0){
					$this->_tarik_barang(5, $row->as_cpu_ups_id);
				}
				

				//addtional
				if($row->as_cpu_mon2_id != 0){
					$this->_tarik_barang(2, $row->as_cpu_mon2_id);
				}

				if($row->as_cpu_dongle_id != 0){
					$this->_tarik_barang(6, $row->as_cpu_dongle_id);
				}
			}

			$query = $this->MBarang->delete('as_cpu', 'as_cpu_id', $id);
		}elseif($jenis_barang == 100){
			$query = $this->MBarang->get_data('as_laptop', array('as_laptop_id' => $id) );

			foreach($query->result() as $row){

				//tarik laptop
				$this->_tarik_laptop($row->as_laptop_laptop_id);

				//addtional
				if($row->as_laptop_mon_id != 0){
					$this->_tarik_barang(2, $row->as_laptop_mon_id);
				}

				if($row->as_laptop_mouse_id != 0){
					$this->_tarik_barang(4, $row->as_laptop_mouse_id);
				}
			}

			$query = $this->MBarang->delete('as_laptop', 'as_laptop_id', $id);

		}elseif($jenis_barang == 200){
			$query = $this->MBarang->get_data('as_smartphone', array('as_smartphone_id' => $id) );
			
			//tarik barang
			foreach($query->result() as $row){

				//tarik barang
				$this->_tarik_smartphone($row->as_smartphone_smartphone_id);
			}
			$query = $this->MBarang->delete('as_smartphone', 'as_smartphone_id', $id);
		}elseif($jenis_barang == 300){
			$query = $this->MBarang->get_data('as_imac', array('as_imac_id' => $id) );

			foreach($query->result() as $row){

				//tarik laptop
				$this->_tarik_imac($row->as_imac_imac_id);

				//addtional
				if($row->as_imac_ups_id != 0){
					$this->_tarik_barang(5, $row->as_imac_ups_id);
				}
			}

			$query = $this->MBarang->delete('as_imac', 'as_imac_id', $id);
		}else{
			$query = $this->MBarang->get_data('as_barang', array('as_barang_id' => $id) );
			
			//tarik barang
			foreach($query->result() as $row){

				//tarik barang
				$this->_tarik_barang($jenis_barang, $row->as_barang_barang_id);
			}
			$query = $this->MBarang->delete('as_barang', 'as_barang_id', $id);
		}

		$this->db->trans_complete();

		if($query){
			$this->set_message(1, "Success.");
		}else{
			$this->set_message(0, "Data gagal diupdate, silahkan ulangi lagi.");
		}
		redirect(site_url('assigment/daftar/'.$jenis_barang),'refresh');
	}

	private function set_message($type, $msg)
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

	private function get_sn_barang($id)
	{
		$q = $this->MBarang->get_data('barang',array('barang_id' => $id));

		foreach($q->result() as $row){
			$name = $row->barang_sn;
		}
		return $name;
	}

	//function penarikan cpu
	private function _tarik_cpu($id = null)
	{
		$query = $this->MBarang->get_data('cpu', array('cpu_id' => $id) );

		foreach($query->result() as $row){
			$data = array(	'cpu_id' => $row->cpu_id,
							'cpu_no_po' => $row->cpu_no_po,
							'cpu_rekap_dtl_id' => $row->cpu_rekap_dtl_id,
							'cpu_no_asset' => $row->cpu_no_asset,
							'cpu_no_it' => $row->cpu_no_it,
							'cpu_service_tag' => $row->cpu_service_tag,
							'cpu_sn' => $row->cpu_sn,
							'cpu_hostname' => $row->cpu_hostname,
							'cpu_user' => $row->cpu_user,
							'cpu_department' => $row->cpu_department,
							'cpu_location' => $row->cpu_location,
							'cpu_sub_location' => $row->cpu_sub_location,
							'cpu_status' => 0,
							'cpu_ket' => $row->cpu_ket,
							'cpu_id_creator' => 1,
							'cpu_time_create' => date('Y-m-d H:i:s')
				);
		}
		$query1 = $this->MBarang->add('ex_cpu', $data);
		$location_home = $this->_get_sn('home_location', 'home_location_id', 1, 'home_location_location');

		//update table
		$data2 = array(	'cpu_user' => NULL,
						'cpu_department' => NULL,
						'cpu_location' => $location_home,
						// 'cpu_sub_location' => 0,
						'cpu_status' => 0
						);

		$query2 = $this->MBarang->update_table('cpu_id', $id, 'cpu', $data2);
	}

	//function penarikan cpu
	private function _tarik_imac($id = null)
	{
		$query = $this->MBarang->get_data('imac', array('imac_id' => $id) );

		foreach($query->result() as $row){
			$data = array(	'imac_id' => $row->imac_id,
							'imac_no_po' => $row->imac_no_po,
							'imac_rekap_dtl_id' => $row->imac_rekap_dtl_id,
							'imac_no_asset' => $row->imac_no_asset,
							'imac_no_it' => $row->imac_no_it,
							'imac_sn' => $row->imac_sn,
							'imac_sn_keyboard' => $row->imac_sn_keyboard,
							'imac_sn_mouse' => $row->imac_sn_mouse,
							'imac_user' => $row->imac_user,
							'imac_department' => $row->imac_department,
							'imac_location' => $row->imac_location,
							'imac_sub_location' => $row->imac_sub_location,
							'imac_status' => 0,
							'imac_ket' => $row->imac_ket,
							'imac_id_creator' => 1,
							'imac_time_create' => date('Y-m-d H:i:s')
				);
		}
		$query1 = $this->MBarang->add('ex_imac', $data);
		$location_home = $this->_get_sn('home_location', 'home_location_id', 1, 'home_location_location');
		//update table
		$data2 = array(	'imac_user' => NULL,
						'imac_department' => NULL,
						'imac_location' => $home_location,
						//'imac_sub_location' => NULL,
						'imac_status' => 0
						);

		$query2 = $this->MBarang->update_table('imac_id', $id, 'imac', $data2);
	}

	//function penarikan laptop
	private function _tarik_laptop($id = null)
	{
		$query = $this->MBarang->get_data('laptop', array('laptop_id' => $id) );

		foreach($query->result() as $row){
			$data = array(	'laptop_id' => $row->laptop_id,
							'laptop_no_po' => $row->laptop_no_po,
							'laptop_rekap_dtl_id' => $row->laptop_rekap_dtl_id,
							'laptop_no_asset' => $row->laptop_no_asset,
							'laptop_no_it' => $row->laptop_no_it,
							'laptop_sn_lp' => $row->laptop_sn_lp,
							'laptop_sn_hd' => $row->laptop_sn_hd,
							'laptop_sn_baterai' => $row->laptop_sn_baterai,
							'laptop_sn_charger' => $row->laptop_sn_charger,
							'laptop_nama' => $row->laptop_nama,
							'laptop_kode' => $row->laptop_kode,
							'laptop_user' => $row->laptop_user,
							'laptop_department' => $row->laptop_department,
							'laptop_location' => $row->laptop_location,
							'laptop_sub_location' => $row->laptop_sub_location,
							'laptop_status' => 0,
							'laptop_ket' => $row->laptop_ket,
							'laptop_id_creator' => 1,
							'laptop_time_create' => date('Y-m-d H:i:s')
				);
		}
		$query1 = $this->MBarang->add('ex_laptop', $data);

		$location_home = $this->_get_sn('home_location', 'home_location_id', 1, 'home_location_location');
		//update table
		$data2 = array(	'laptop_user' => NULL,
						'laptop_department' => NULL,
						'laptop_location' => $location_home,
						// 'laptop_sub_location' => 0,
						'laptop_status' => 0
						);

		$query2 = $this->MBarang->update_table('laptop_id', $id, 'laptop', $data2);
	}

	private function _tarik_smartphone($id = null)
	{
		$query = $this->MBarang->get_data('smartphone', array('smartphone_id' => $id) );

		foreach($query->result() as $row){
			$data = array(	'smartphone_id' => $row->smartphone_id,
							'smartphone_no_po' => $row->smartphone_no_po,
							'smartphone_rekap_dtl_id' => $row->smartphone_rekap_dtl_id,
							'smartphone_no_asset' => $row->smartphone_no_asset,
							'smartphone_no_it' => $row->smartphone_no_it,
							'smartphone_imei1' => $row->smartphone_imei1,
							'smartphone_imei2' => $row->smartphone_imei2,
							'smartphone_user' => $row->smartphone_user,
							'smartphone_department' => $row->smartphone_department,
							'smartphone_location' => $row->smartphone_location,
							'smartphone_sub_location' => $row->smartphone_sub_location,
							'smartphone_status' => 0,
							'smartphone_ket' => $row->smartphone_ket,
							'smartphone_id_creator' => 1,
							'smartphone_time_create' => date('Y-m-d H:i:s')
				);
		}
		$query1 = $this->MBarang->add('ex_smartphone', $data);
		$location_home = $this->_get_sn('home_location', 'home_location_id', 1, 'home_location_location');
		//update table
		$data2 = array(	'smartphone_user' => NULL,
						'smartphone_department' => 0,
						'smartphone_location' => $location_home,
						// 'smartphone_sub_location' => 0,
						'smartphone_status' => 0
						);

		$query2 = $this->MBarang->update_table('smartphone_id', $id, 'smartphone', $data2);
	}

	//function penarikan barang
	private function _tarik_barang($jenis_barang = null, $id = null)
	{
		$query = $this->MBarang->get_data('barang', array('barang_id' => $id, 'barang_jenis_barang_id' => $jenis_barang) );

		foreach($query->result() as $row){
			$data = array(	'barang_id' => $row->barang_id,
							'barang_no_po' => $row->barang_no_po,
							'barang_rekap_dtl_id' => $row->barang_rekap_dtl_id,
							'barang_jenis_barang_id' => $row->barang_jenis_barang_id,
							'barang_no_asset' => $row->barang_no_asset,
							'barang_no_it' => $row->barang_no_it,
							'barang_sn' => $row->barang_sn,
							'barang_user' => $row->barang_user,
							'barang_department' => $row->barang_department,
							'barang_location' => $row->barang_location,
							'barang_sub_location' => $row->barang_sub_location,
							'barang_status' => 0,
							'barang_ket' => $row->barang_ket,
							'barang_id_creator' => 1,
							'barang_time_create' => date('Y-m-d H:i:s')
				);
		}

		$query1 = $this->MBarang->add('ex_barang', $data);
		$location_home = $this->_get_sn('home_location', 'home_location_id', 1, 'home_location_location');
		//update table
		$data2 = array(	'barang_user' => NULL,
						'barang_department' => 0,
						'barang_location' => $location_home,
						// 'barang_sub_location' => 0,
						'barang_status' => 0
						);

		$query2 = $this->MBarang->update_table('barang_id', $id, 'barang', $data2);
	}


}