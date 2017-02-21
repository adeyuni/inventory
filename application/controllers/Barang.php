<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class barang extends CI_Controller {

	const TABLE_BARANG = "barang";
	const CREATOR = 1;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('BarangModel', 'MBarang');
		if (!$this->load->check_session_admin()) return;
	}

	public function daftar($jenis_barang = null)
	{
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		if($jenis_barang == 1){
			$this->data['listSelectedBarang'] = "v_list_cpu.php";
			$this->data['listCPU'] = $this->MBarang->get_five_table('cpu', 'rekap', 'rekap_dtl', 'location', 'department', 'cpu_no_po = rekap_id', 'cpu_rekap_dtl_id = rekap_dtl_id','cpu_location = location_id','cpu_department = department_id', 'cpu_id', 'desc');
		}elseif($jenis_barang == 100){
			$this->data['listSelectedBarang'] = "v_list_laptop.php";
			$this->data['listLaptop'] = $this->MBarang->get_five_table('laptop', 'rekap', 'rekap_dtl', 'location', 'department', 'laptop_no_po = rekap_id', 'laptop_rekap_dtl_id = rekap_dtl_id','laptop_location = location_id','laptop_department = department_id', 'rekap_id', 'asc');
		}elseif($jenis_barang == 200){
			$this->data['listSelectedBarang'] = "v_list_smartphone.php";
			$this->data['listSmartphone'] = $this->MBarang->get_five_table('smartphone', 'rekap', 'rekap_dtl', 'location', 'department', 'smartphone_no_po = rekap_id', 'smartphone_rekap_dtl_id = rekap_dtl_id','smartphone_location = location_id','smartphone_department = department_id', 'rekap_id', 'asc');
		}elseif($jenis_barang == 300){
			$this->data['listSelectedBarang'] = "v_list_imac.php";
			$this->data['listIMAC'] = $this->MBarang->get_five_table('imac', 'rekap', 'rekap_dtl', 'location', 'department', 'imac_no_po = rekap_id', 'imac_rekap_dtl_id = rekap_dtl_id','imac_location = location_id','imac_department = department_id', 'rekap_id', 'asc');
		}else{
			$this->data['jenis_barang'] = $jenis_barang;
			$this->data['listSelectedBarang'] = "v_list_barang2.php";
			$this->data['listBarang2'] = $this->MBarang->search_detail('barang', 'rekap', 'rekap_dtl', 'location', 'department', 'barang_no_po = rekap_id', 'barang_rekap_dtl_id = rekap_dtl_id','barang_location = location_id','barang_department = department_id', 'rekap_id', 'asc', 'barang_jenis_barang_id', $jenis_barang);
		}

		$this->data['jenis_barang'] = $jenis_barang;
		$this->data['additional'] = "include/plus_daftar_barang.php";
		$this->data['title'] = 'Daftar Barang';
		$this->load->template('barang/list/v_list_barang', $this->data);
	}

	private function _get_nama_jenis_barang($jenis_barang_id = null)
	{
		$query = $this->MBarang->get_data('type_barang', array('id' => $jenis_barang_id) );

		foreach($query->result() as $row){
			$nama = $row->nama;
		}

		return $nama;
	}

	public function detail($jenis_barang = null, $id = null, $delete = null)
	{
		$this->data['isDelete'] = false;
		$this->data['isExist'] = false;
		if($delete == 'delete'){
			$this->data['isDelete'] = true;
		}
		$this->data['jenis_barang2'] = $jenis_barang;
		$this->data['jenis_barang'] = $this->_get_nama_jenis_barang($jenis_barang);

		$jenis_barang_temp = $jenis_barang;
		if($jenis_barang == 1){
			
			$query = $this->MBarang->search_detail('cpu', 'rekap', 'rekap_dtl', 'location', 'department','cpu_no_po = rekap_id', 'cpu_rekap_dtl_id = rekap_dtl_id','cpu_location = location_id','cpu_department = department_id', 'rekap_id', 'asc', 'cpu_id', $id);

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
				$this->data['user'] = $row->cpu_user;
				$this->data['hostname'] = $row->cpu_hostname;
				$this->data['service_tag'] = $row->cpu_service_tag;
				$this->data['department'] = $row->department_nama;
				$this->data['creator'] = $this->_get_username($row->cpu_id_creator);
				$this->data['time_create'] = $row->cpu_time_create;
				$this->data['ket'] = $row->cpu_ket;
				$this->data['cpu_id'] = $row->cpu_id;
				if(isset($row->cpu_id_editor)){
					$this->data['editor'] = $this->_get_username($row->cpu_id_editor);
					$this->data['time_edit'] = $row->cpu_time_edit;
				}
			}

			$cek = $this->MBarang->is_exist('as_cpu', array('as_cpu_cpu_id' =>  $id));

			if($cek == true){
				$query = $this->MBarang->relation_checking('cpu', 'as_cpu', 'cpu_id = as_cpu_cpu_id', array('cpu_id' => $id));

				foreach($query->result() as $row) {

					$this->data['id_mon1'] = $row->as_cpu_mon1_id;
					$this->data['sn_mon1'] = $this->get_sn_barang($row->as_cpu_mon1_id);
					$this->data['listBrg'][] = "Monitor : ".$this->data['sn_mon1'];

					if($row->as_cpu_mon2_id != 0){
						$this->data['id_mon2'] = $row->as_cpu_mon2_id;
						$this->data['sn_mon2'] = $this->get_sn_barang($row->as_cpu_mon2_id);
						$this->data['listBrg'][] = "Monitor : ".$this->data['sn_mon2'];
					}
					if($row->as_cpu_dongle_id != 0){
						$this->data['id_dongle'] = $row->as_cpu_dongle_id;
						$this->data['sn_dongle'] = $this->get_sn_barang($row->as_cpu_dongle_id);
						$this->data['listBrg'][] = "Dongle : ".$this->data['sn_dongle'];
					}
					$this->data['id_keyboard'] = $row->as_cpu_keyboard_id;
					$this->data['sn_keyboard'] = $this->get_sn_barang($row->as_cpu_keyboard_id);
					$this->data['listBrg'][] = "Keyboard : ".$this->data['sn_keyboard'];
					$this->data['id_mouse'] = $row->as_cpu_mouse_id;
					$this->data['sn_mouse'] = $this->get_sn_barang($row->as_cpu_mouse_id);
					$this->data['listBrg'][] = "Mouse : ".$this->data['sn_mouse'];
					$this->data['id_ups'] = $row->as_cpu_ups_id;
					$this->data['sn_ups'] = $this->get_sn_barang($row->as_cpu_ups_id);
					$this->data['listBrg'][] = "UPS : ".$this->data['sn_ups'];

					$this->data['isExist'] = true;
				}
			}
			
			//cek history
			$history = $this->MBarang->get_data_table('ex_cpu', array('cpu_id' => $id), 'cpu_id', 'asc');
			foreach ($history->result() as $row) {
				$this->data['history'][] = $row->cpu_user;
			}

			$viewDtl = 'barang/detail/v_detail_cpu';
		}elseif($jenis_barang == 100){
			$query = $this->MBarang->search_detail('laptop', 'rekap', 'rekap_dtl', 'location', 'department','laptop_no_po = rekap_id', 'laptop_rekap_dtl_id = rekap_dtl_id','laptop_location = location_id','laptop_department = department_id', 'rekap_id', 'asc', 'laptop_id', $id);

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
				$this->data['user'] = $row->laptop_user;
				$this->data['kode_laptop'] = $row->laptop_kode;
				$this->data['nama_laptop'] = $row->laptop_nama;
				$this->data['department'] = $row->department_nama;
				$this->data['ket'] = $row->laptop_ket;
				if($row->laptop_id_creator != 0){
					$this->data['creator'] = $this->_get_username($row->laptop_id_creator);
					$this->data['time_create'] = $row->laptop_time_create;
				}
				
				if(isset($row->laptop_id_editor)){
					$this->data['editor'] = $this->_get_username($row->laptop_id_editor);
					$this->data['time_edit'] = $row->laptop_time_edit;
				}
				
				$this->data['laptop_id'] = $row->laptop_id;
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
					$this->data['sn_mouse'] = $this->get_sn_barang($row->as_laptop_mouse_id);
					
				}
			}

			//cek history
			$history = $this->MBarang->get_data_table('ex_laptop', array('laptop_id' => $id), 'laptop_id', 'asc');
			foreach ($history->result() as $row) {
				$this->data['history'][] = $row->laptop_user;
			}

			$viewDtl = 'barang/detail/v_detail_laptop';
		}elseif($jenis_barang == 200){

			$query = $this->MBarang->search_detail('smartphone', 'rekap', 'rekap_dtl', 'location', 'department','smartphone_no_po = rekap_id', 'smartphone_rekap_dtl_id = rekap_dtl_id','smartphone_location = location_id','smartphone_department = department_id', 'rekap_id', 'asc', 'smartphone_id', $id);

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
				$this->data['user'] = $row->smartphone_user;
				$this->data['department'] = $row->department_nama;
				$this->data['creator'] = $this->_get_username($row->smartphone_id_creator);
				$this->data['time_create'] = $row->smartphone_time_create;
				$this->data['ket'] = $row->smartphone_ket;
				if(isset($row->smartphone_id_editor)){
					$this->data['editor'] = $this->_get_username($row->smartphone_id_editor);
					$this->data['time_edit'] = $row->smartphone_time_edit;
				}
				
				$this->data['smartphone_id'] = $row->smartphone_id;
			}

			//cek history
			$history = $this->MBarang->get_data_table('ex_smartphone', array('smartphone_id' => $id), 'smartphone_id', 'asc');
			foreach ($history->result() as $row) {
				$this->data['history'][] = $row->smartphone_user;
			}

			$viewDtl = 'barang/detail/v_detail_smartphone';
		}elseif($jenis_barang == 300){
			$query = $this->MBarang->search_detail('imac', 'rekap', 'rekap_dtl', 'location', 'department','imac_no_po = rekap_id', 'imac_rekap_dtl_id = rekap_dtl_id','imac_location = location_id','imac_department = department_id', 'rekap_id', 'asc', 'imac_id', $id);

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
				$this->data['user'] = $row->imac_user;
				$this->data['imac_nama'] = $row->imac_nama;
				$this->data['department'] = $row->department_nama;
				$this->data['creator'] = $this->_get_username($row->imac_id_creator);
				$this->data['time_create'] = $row->imac_time_create;
				$this->data['ket'] = $row->imac_ket;
				if(isset($row->imac_id_editor)){
					$this->data['editor'] = $this->_get_username($row->imac_id_editor);
					$this->data['time_edit'] = $row->imac_time_edit;
				}
				
				$this->data['imac_id'] = $row->imac_id;
			}

			$cek = $this->MBarang->is_exist('as_imac', array('as_imac_imac_id' =>  $id));

			if($cek == true){
				$query = $this->MBarang->relation_checking('imac', 'as_imac', 'imac_id = as_imac_imac_id', array('imac_id' => $id));

				foreach($query->result() as $row) {
					if($row->as_imac_ups_id != 0){
						$this->data['id_ups'] = $row->as_imac_ups_id;
						$this->data['sn_ups'] = $this->get_sn_barang($row->as_imac_ups_id);
					}					
				}
			}

			//cek history
			$history = $this->MBarang->get_data_table('ex_imac', array('imac_id' => $id), 'imac_id', 'asc');
			foreach ($history->result() as $row) {
				$this->data['history'][] = $row->imac_user;
			}

			$viewDtl = 'barang/detail/v_detail_imac';
		}else{

			$query = $this->MBarang->search_detail('barang', 'rekap', 'rekap_dtl', 'location', 'department','barang_no_po = rekap_id', 'barang_rekap_dtl_id = rekap_dtl_id','barang_location = location_id','barang_department = department_id', 'rekap_id', 'asc', 'barang_id', $id);

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
				$this->data['user'] = $row->barang_user;
				$this->data['department'] = $row->department_nama;
				$this->data['creator'] = $this->_get_username($row->barang_id_creator);
				$this->data['time_create'] = $row->barang_time_create;
				$this->data['ket'] = $row->barang_ket;
				if(isset($row->barang_id_editor)){
					$this->data['editor'] = $this->_get_username($row->barang_id_editor);
					$this->data['time_edit'] = $row->barang_time_edit;
				}
				
				$this->data['barang_id'] = $row->barang_id;
			}

			//cek history
			$history = $this->MBarang->get_data_table('ex_barang', array('barang_id' => $id), 'barang_id', 'asc');
			foreach ($history->result() as $row) {
				$this->data['history'][] = $row->barang_user;
			}

			$viewDtl = 'barang/detail/v_detail_barang';
		}
		
		$this->data['url_edit'] = 'barang/edit/'.$this->data['id_po'].'/'.$this->data['id_rekap_dtl'].'/'.$jenis_barang_temp.'/'.$id;
		$this->data['title'] = 'Detail Barang';
		$this->load->template($viewDtl, $this->data);
	}

	public function edit($no_po = null, $dtl_barang = null, $jenis_barang = null, $id = null)
	{
		$this->data['listPO'] = $this->MBarang->get_data('rekap','');
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['selectedPO'] = $no_po;
		$this->data['selectedJenisBarang'] = $jenis_barang;
		$this->data['showDtl'] = false;
		$this->data['showJenisBarang'] = false;
		$this->data['isEditing'] = true;
		$this->data['isDtl'] = false;
		$this->data['isEnabled'] = false;
		
		if($no_po != 999999 and $no_po != null){
			$this->data['showDtl'] = true;
			$this->data['showJenisBarang'] = true;
			$this->data['viewDtl'] = "additional/detail_barang.php";

			if($dtl_barang != null){
				$query = $this->MBarang->get_data('rekap_dtl', array('rekap_dtl_id' => $dtl_barang) );
				foreach($query->result() as $row){
					$this->data['stok_awal'] = $row->rekap_dtl_jml; 
				}

				//count barang beredar
				$count_cpu = $this->MBarang->count_rows('cpu', array('cpu_rekap_dtl_id' => $dtl_barang, 'cpu_status' => 1));
				$count_laptop = $this->MBarang->count_rows('laptop', array('laptop_rekap_dtl_id' => $dtl_barang, 'laptop_status' => 1));
				$count_smartphone = $this->MBarang->count_rows('smartphone', array('smartphone_rekap_dtl_id' => $dtl_barang, 'smartphone_status' => 1));
				$count_imac = $this->MBarang->count_rows('imac', array('imac_rekap_dtl_id' => $dtl_barang, 'imac_status' => 1));
				$count_barang = $this->MBarang->count_rows('barang', array('barang_rekap_dtl_id' => $dtl_barang, 'barang_status' => 1));

				$this->data['jml_beredar'] = $count_cpu + $count_laptop + $count_smartphone + $count_imac + $count_barang;
				$this->data['selectedDtlBarang'] = $dtl_barang;
			}
			$this->data['listDtlBarang'] = $this->MBarang->get_data('rekap_dtl',array('rekap_dtl_id_rekap' => $no_po));
		}elseif($no_po == 999999){
			$this->data['showJenisBarang'] = true;
		}

		$action = 'barang/save/edit/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang.'/'.$id;

		//for form used
		if($jenis_barang == 1){
			$query = $this->MBarang->get_data('cpu',array('cpu_id' => $id));
			foreach ($query->result() as $row) {
				$this->data['no_asset'] = $row->cpu_no_asset;
				$this->data['no_it'] = $row->cpu_no_it;
				$this->data['sn_cpu'] = $row->cpu_sn;
				$this->data['service_tag'] = $row->cpu_service_tag;
				$this->data['ket'] = $row->cpu_ket;
			}
			$this->data['formInputBarang'] = "additional/v_form_cpu.php";
		}elseif($jenis_barang == 100){
			$query = $this->MBarang->get_data('laptop',array('laptop_id' => $id));
			foreach ($query->result() as $row) {
				$this->data['no_asset'] = $row->laptop_no_asset;
				$this->data['no_it'] = $row->laptop_no_it;
				$this->data['sn_laptop'] = $row->laptop_sn_lp;
				$this->data['sn_hd'] = $row->laptop_sn_hd;
				$this->data['sn_baterai'] = $row->laptop_sn_baterai;
				$this->data['sn_charger'] = $row->laptop_sn_charger;
				$this->data['ket'] = $row->laptop_ket;
			}
			$this->data['formInputBarang'] = "additional/v_form_laptop.php";
		}elseif($jenis_barang == 200){
			$query = $this->MBarang->get_data('smartphone',array('smartphone_id' => $id));
			foreach ($query->result() as $row) {
				$this->data['no_asset'] = $row->smartphone_no_asset;
				$this->data['no_it'] = $row->smartphone_no_it;
				$this->data['sn_smartphone'] = $row->smartphone_sn;
				$this->data['imei1'] = $row->smartphone_imei1;
				$this->data['imei2'] = $row->smartphone_imei2;
				$this->data['ket'] = $row->smartphone_ket;
			}
			$this->data['formInputBarang'] = "additional/v_form_smartphone.php";
		}elseif($jenis_barang == 300){
			$query = $this->MBarang->get_data('imac',array('imac_id' => $id));
			foreach ($query->result() as $row) {
				$this->data['no_asset'] = $row->imac_no_asset;
				$this->data['no_it'] = $row->imac_no_it;
				$this->data['sn_imac'] = $row->imac_sn;
				$this->data['sn_mouse_imac'] = $row->imac_sn_mouse;
				$this->data['sn_keyboard_imac'] = $row->imac_sn_keyboard;
				$this->data['ket'] = $row->imac_ket;
			}
			$this->data['formInputBarang'] = "additional/v_form_imac.php";
		}else{
			$query = $this->MBarang->get_data('barang',array('barang_id' => $id, 'barang_jenis_barang_id' => $jenis_barang));
			foreach ($query->result() as $row) {
				$this->data['no_asset'] = $row->barang_no_asset;
				$this->data['no_it'] = $row->barang_no_it;
				$this->data['sn'] = $row->barang_sn;
				$this->data['ket'] = $row->barang_ket;
			}
			$this->data['formInputBarang'] = "additional/v_form_barang.php";
		}
		$this->data['title'] = 'Edit Barang';
		$this->data['action'] = $action;
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['additional'] = "include/plus_form_add_barang.php";
		$this->load->template('barang/add/v_form_add_barang', $this->data);
	}
	public function add($no_po = null, $dtl_barang = null, $jenis_barang = null)
	{
		$this->data['listPO'] = $this->MBarang->get_data('rekap','');
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['selectedPO'] = $no_po;
		$this->data['selectedJenisBarang'] = $jenis_barang;
		$this->data['showDtl'] = false;
		$this->data['showJenisBarang'] = false;
		$this->data['isEditing'] = false;
		$this->data['isEnabled'] = false;
		$this->data['isDtl'] = false;
		if($no_po != 999999 and $no_po != null){
			$this->data['showDtl'] = true;
			$this->data['showJenisBarang'] = true;
			$this->data['isEnabled'] = true;
			$this->data['viewDtl'] = "additional/detail_barang.php";

			if($dtl_barang != null){
				$query = $this->MBarang->get_data('rekap_dtl', array('rekap_dtl_id' => $dtl_barang) );
				foreach($query->result() as $row){
					$this->data['stok_awal'] = $row->rekap_dtl_jml; 
				}

				$this->data['isDtl'] = true;
				//count barang beredar
				$count_cpu = $this->MBarang->count_rows('cpu', array('cpu_rekap_dtl_id' => $dtl_barang, 'cpu_status' => 1));
				$count_laptop = $this->MBarang->count_rows('laptop', array('laptop_rekap_dtl_id' => $dtl_barang, 'laptop_status' => 1));
				$count_smartphone = $this->MBarang->count_rows('smartphone', array('smartphone_rekap_dtl_id' => $dtl_barang, 'smartphone_status' => 1));
				$count_imac = $this->MBarang->count_rows('imac', array('imac_rekap_dtl_id' => $dtl_barang, 'imac_status' => 1));
				$count_barang = $this->MBarang->count_rows('barang', array('barang_rekap_dtl_id' => $dtl_barang, 'barang_status' => 1));

				//count barang ditambahkan 
				$d_count_cpu = $this->MBarang->count_rows('cpu', array('cpu_rekap_dtl_id' => $dtl_barang));
				$d_count_laptop = $this->MBarang->count_rows('laptop', array('laptop_rekap_dtl_id' => $dtl_barang));
				$d_count_smartphone = $this->MBarang->count_rows('smartphone', array('smartphone_rekap_dtl_id' => $dtl_barang));
				$d_count_imac = $this->MBarang->count_rows('imac', array('imac_rekap_dtl_id' => $dtl_barang));
				$d_count_barang = $this->MBarang->count_rows('barang', array('barang_rekap_dtl_id' => $dtl_barang));

				$this->data['jml_ditambahkan'] = $d_count_cpu + $d_count_laptop + $d_count_smartphone + $d_count_imac + $d_count_barang;
				$this->data['jml_beredar'] = $count_cpu + $count_laptop + $count_smartphone + $count_imac + $count_barang;
				$this->data['selectedDtlBarang'] = $dtl_barang;

				if($this->data['stok_awal'] == $this->data['jml_ditambahkan']){
					$this->data['isDtl'] = false;
					echo "<script>alert('Stok Habis.');</script>";
				}
			}
			$this->data['listDtlBarang'] = $this->MBarang->get_data('rekap_dtl',array('rekap_dtl_id_rekap' => $no_po));
		}elseif($no_po == 999999){
			$this->data['showJenisBarang'] = true;
		}

		//for form used
		if($jenis_barang == 1){
			$this->data['formInputBarang'] = "additional/v_form_cpu.php";
		}elseif($jenis_barang == 100){
			$this->data['formInputBarang'] = "additional/v_form_laptop.php";
		}elseif($jenis_barang == 200){
			$this->data['formInputBarang'] = "additional/v_form_smartphone.php";
		}elseif($jenis_barang == 300){
			$this->data['formInputBarang'] = "additional/v_form_imac.php";
		}else{
			$this->data['formInputBarang'] = "additional/v_form_barang.php";
		}
		$this->data['title'] = 'Tambah Barang';
		$this->data['action'] = 'barang/save/add';
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['additional'] = "include/plus_form_add_barang.php";
		$this->load->template('barang/add/v_form_add_barang', $this->data);
	}

	public function save($param1 = null, $param_no_po = null, $param_dtl_barang = null, $param_jenis_barang = null, $id = null)
	{
		$this->db->trans_start();

		if($param1 == 'add'){
			$jenis_barang = $this->input->post('jenis_barang');
			$no_po = $this->input->post('no_po');
			$no_asset = $this->input->post('no_asset');
			$no_it = $this->_getNumber();
			$ket = $this->input->post('ket');
			if($jenis_barang == 1){
				$dtl = $this->input->post('dtl_barang');

				$data = array(	'cpu_no_po' => $no_po,
								'cpu_rekap_dtl_id' => $dtl,
								'cpu_no_asset' => $no_asset, 
								'cpu_no_it' => $no_it, 
								'cpu_service_tag' => $this->input->post('service_tag'), 
								'cpu_sn' => $this->input->post('sn_cpu'),
								'cpu_ket' => $ket,
								'cpu_id_creator' => $_SESSION["user_id"],
								'cpu_time_create' => date('Y-m-d H:i:s')
							);
				$url_redirect = "barang/add/".$no_po."/".$dtl."/".$jenis_barang;
				$cek_no_it = $this->MBarang->is_exist('cpu', array('cpu_no_it' =>  $no_it));
				$table = "cpu";
			}elseif($jenis_barang == 100){
				$dtl = $this->input->post('dtl_barang');

				$data = array(	'laptop_no_po' => $no_po,
								'laptop_rekap_dtl_id' => $dtl,
								'laptop_no_asset' => $no_asset, 
								'laptop_no_it' => $no_it, 
								'laptop_sn_lp' => $this->input->post('sn_laptop'), 
								'laptop_sn_hd' => $this->input->post('sn_hd'), 
								'laptop_sn_baterai' => $this->input->post('sn_baterai'), 
								'laptop_sn_charger' => $this->input->post('sn_charger'),
								'laptop_ket' => $ket, 
								'laptop_id_creator' => $_SESSION["user_id"],
								'laptop_time_create' => date('Y-m-d H:i:s')
							);

				$cek_no_it = $this->MBarang->is_exist('laptop', array('laptop_no_it' =>  $no_it));
				$table = "laptop";
			}elseif($jenis_barang == 200){
				$dtl = $this->input->post('dtl_barang');

				$data = array(	'smartphone_no_po' => $no_po,
								'smartphone_rekap_dtl_id' => $dtl,
								'smartphone_no_asset' => $no_asset, 
								'smartphone_no_it' => $no_it, 
								'smartphone_sn' => $this->input->post('sn_smartphone'), 
								'smartphone_imei1' => $this->input->post('imei1'), 
								'smartphone_imei2' => $this->input->post('imei2'), 
								'smartphone_ket' => $ket, 
								'smartphone_id_creator' => $_SESSION["user_id"],
								'smartphone_time_create' => date('Y-m-d H:i:s')
							);

				$cek_no_it = $this->MBarang->is_exist('smartphone', array('smartphone_no_it' =>  $no_it));
				$table = "smartphone";
			}elseif($jenis_barang == 300){
				$dtl = $this->input->post('dtl_barang');

				$data = array(	'imac_no_po' => $no_po,
								'imac_rekap_dtl_id' => $dtl,
								'imac_no_asset' => $no_asset, 
								'imac_no_it' => $no_it, 
								'imac_sn' => $this->input->post('sn_imac'), 
								'imac_sn_keyboard' => $this->input->post('sn_keyboard_imac'), 
								'imac_sn_mouse' => $this->input->post('sn_mouse_imac'), 
								'imac_ket' => $ket, 
								'imac_id_creator' => $_SESSION["user_id"],
								'imac_time_create' => date('Y-m-d H:i:s')
							);

				$cek_no_it = $this->MBarang->is_exist('imac', array('imac_no_it' =>  $no_it));
				$table = "imac";
			}else{
				$dtl = $this->input->post('dtl_barang');

				$data = array(	'barang_no_po' => $no_po,
								'barang_rekap_dtl_id' => $dtl,
								'barang_no_asset' => $no_asset, 
								'barang_no_it' => $no_it, 
								'barang_jenis_barang_id' => $jenis_barang, 
								'barang_sn' => $this->input->post('sn'), 
								'barang_ket' => $ket, 
								'barang_id_creator' => $_SESSION["user_id"],
								'barang_time_create' => date('Y-m-d H:i:s')
							);

				$cek_no_it = $this->MBarang->is_exist('barang', array('barang_no_it' =>  $no_it));
				$table = "barang";
			}

			$url_redirect = "barang/add/".$no_po."/".$dtl."/".$jenis_barang;

			if($cek_no_it == true){
				$this->set_message(0, "NO IT ".$no_it." sudah ada di database.");
				redirect(site_url($url_redirect),'refresh');
			}else{
				$query = $this->MBarang->add($table, $data);
			}
			if($query){
				$this->set_message(1, "Data berhasil ditambahkan.");
			}else{
				$this->set_message(0, "Data gagal ditambahkan, silahkan ulangi lagi.");
			}
		}elseif($param1 == 'edit'){
			$no_po = $this->input->post('no_po');
			$no_asset = $this->input->post('no_asset');
			$no_it = $this->input->post('no_it');
			$ket = $this->input->post('ket');
			$no_it_old = $this->input->post('no_it_old');
			$url_redirect = "barang/edit/".$param_no_po."/".$param_dtl_barang."/".$param_jenis_barang."/".$id;

			if($param_jenis_barang == 1){
				$data = array('cpu_no_asset' => $no_asset, 
								'cpu_no_it' => $no_it, 
								'cpu_service_tag' => $this->input->post('service_tag'), 
								'cpu_sn' => $this->input->post('sn_cpu'),
								'cpu_ket' => $ket,
								'cpu_id_editor' => $_SESSION["user_id"],
								'cpu_time_edit' => date('Y-m-d H:i:s')
							);

				$cek_no_it = false;
				if($no_it != $no_it_old){
					$cek_no_it = $this->MBarang->is_exist('cpu', array('cpu_no_it' =>  $no_it));
				}
				$id_table = "cpu_id";
				$table = "cpu";
			}elseif($param_jenis_barang == 100){
				$data = array('laptop_no_asset' => $no_asset, 
								'laptop_no_it' => $no_it, 
								'laptop_sn_lp' => $this->input->post('sn_laptop'),
								'laptop_sn_hd' => $this->input->post('sn_hd'),
								'laptop_sn_baterai' => $this->input->post('sn_baterai'),
								'laptop_sn_charger' => $this->input->post('sn_charger'),
								'laptop_ket' => $ket,
								'laptop_id_editor' => $_SESSION["user_id"],
								'laptop_time_edit' => date('Y-m-d H:i:s')
							);

				$cek_no_it = false;
				if($no_it != $no_it_old){
					$cek_no_it = $this->MBarang->is_exist('cpu', array('cpu_no_it' =>  $no_it));
				}
				$id_table = "laptop_id";
				$table = "laptop";
			}elseif($param_jenis_barang == 200){
				$data = array('smartphone_no_asset' => $no_asset, 
								'smartphone_no_it' => $no_it, 
								'smartphone_sn' => $this->input->post('sn_smartphone'),
								'smartphone_imei1' => $this->input->post('imei1'),
								'smartphone_imei2' => $this->input->post('imei2'),
								'smartphone_ket' => $ket,
								'smartphone_id_editor' => $_SESSION["user_id"],
								'smartphone_time_edit' => date('Y-m-d H:i:s')
							);

				$cek_no_it = false;
				if($no_it != $no_it_old){
					$cek_no_it = $this->MBarang->is_exist('smartphone', array('smartphone_no_it' =>  $no_it));
				}
				$id_table = "smartphone_id";
				$table = "smartphone";
			}elseif($param_jenis_barang == 300){
				$data = array('imac_no_asset' => $no_asset, 
								'imac_no_it' => $no_it, 
								'imac_sn' => $this->input->post('sn_imac'),
								'imac_sn_keyboard' => $this->input->post('sn_keyboard_imac'),
								'imac_sn_mouse' => $this->input->post('sn_mouse_imac'),
								'imac_ket' => $ket,
								'imac_id_editor' => $_SESSION["user_id"],
								'imac_time_edit' => date('Y-m-d H:i:s')
							);

				$cek_no_it = false;
				if($no_it != $no_it_old){
					$cek_no_it = $this->MBarang->is_exist('imac', array('imac_no_it' =>  $no_it));
				}
				$id_table = "imac_id";
				$table = "imac";
			}else {
				$data = array(	'barang_no_asset' => $no_asset, 
								'barang_no_it' => $no_it, 
								'barang_sn' => $this->input->post('sn'), 
								'barang_ket' => $ket,
								'barang_id_editor' => $_SESSION["user_id"],
								'barang_time_edit' => date('Y-m-d H:i:s')
							);

				$cek_no_it = false;
				if($no_it != $no_it_old){
					$cek_no_it = $this->MBarang->is_exist('barang', array('barang_no_it' =>  $no_it));
				}
				$id_table = "barang_id";
				$table = "barang";
			}

			if($cek_no_it == true){
				$this->set_message(0, "NO IT ".$no_it." sudah ada di database.");
				redirect(site_url($url_redirect),'refresh');
			}else{
				$query = $this->MBarang->update_table($id_table, $id, $table, $data);
			}
			if($query){
				$this->set_message(1, "Data berhasil diupdate.");
			}else{
				$this->set_message(0, "Data gagal diupdate, silahkan ulangi lagi.");
			}
		}

		$this->db->trans_complete();
		redirect(site_url($url_redirect),'refresh');
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

	private function get_sn_barang($id = null)
	{
		$q = $this->MBarang->get_data('barang',array('barang_id' => $id));

		foreach($q->result() as $row){
			$name = $row->barang_sn;
		}
		return $name;
	}

	public function delete($jenis_barang = null, $id = null)
	{
		$this->data['isThereRelathionship'] = false;
		$this->data['jenis_barang'] = $this->_get_nama_jenis_barang($jenis_barang);
		$this->data['jenis_barang2'] = $jenis_barang;

		if($jenis_barang == 1){
			$query = $this->MBarang->search_detail('cpu', 'rekap', 'rekap_dtl', 'location', 'department','cpu_no_po = rekap_id', 'cpu_rekap_dtl_id = rekap_dtl_id','cpu_location = location_id','cpu_department = department_id', 'rekap_id', 'asc', 'cpu_id', $id);

			foreach ($query->result() as $row) {
				$this->data['id_po'] = $row->rekap_id;
				$this->data['id_rekap_dtl'] = $row->rekap_dtl_id;
				$this->data['no_po'] = $row->rekap_no_po;
				$this->data['no_asset'] = $row->cpu_no_asset;
				$this->data['no_it'] = $row->cpu_no_it;
				$this->data['sn_cpu'] = $row->cpu_sn;
				$this->data['hostname'] = $row->cpu_hostname;
				$this->data['service_tag'] = $row->cpu_service_tag;
				$this->data['cpu_id'] = $row->cpu_id;
			}
			
			$cek = $this->MBarang->is_exist('as_cpu', array('as_cpu_cpu_id' =>  $id));

			if($cek == true){
				$query = $this->MBarang->relation_checking('cpu', 'as_cpu', 'cpu_id = as_cpu_cpu_id', array('cpu_id' => $id));

				foreach($query->result() as $row) {

					$this->data['id_mon1'] = $row->as_cpu_mon1_id;
					$this->data['sn_mon1'] = $this->get_sn_barang($row->as_cpu_mon1_id);
					$this->data['listBrg'][] = "Monitor : ".$this->data['sn_mon1'];

					if($row->as_cpu_mon2_id != 0){
						$this->data['id_mon2'] = $row->as_cpu_mon2_id;
						$this->data['sn_mon2'] = $this->get_sn_barang($row->as_cpu_mon2_id);
						$this->data['listBrg'][] = "Monitor : ".$this->data['sn_mon2'];
					}
					if($row->as_cpu_dongle_id != 0){
						$this->data['id_dongle'] = $row->as_cpu_dongle_id;
						$this->data['sn_dongle'] = $this->get_sn_barang($row->as_cpu_dongle_id);
						$this->data['listBrg'][] = "Dongle : ".$this->data['sn_dongle'];
					}
					$this->data['id_keyboard'] = $row->as_cpu_keyboard_id;
					$this->data['sn_keyboard'] = $this->get_sn_barang($row->as_cpu_keyboard_id);
					$this->data['listBrg'][] = "Keyboard : ".$this->data['sn_keyboard'];
					$this->data['id_mouse'] = $row->as_cpu_mouse_id;
					$this->data['sn_mouse'] = $this->get_sn_barang($row->as_cpu_mouse_id);
					$this->data['listBrg'][] = "Mouse : ".$this->data['sn_mouse'];
					$this->data['id_ups'] = $row->as_cpu_ups_id;
					$this->data['sn_ups'] = $this->get_sn_barang($row->as_cpu_ups_id);
					$this->data['listBrg'][] = "UPS : ".$this->data['sn_ups'];

					$this->data['isThereRelathionship'] = true;
				}
			}

			$view = 'barang/delete/v_delete_cpu';
		}elseif($jenis_barang == 100){
			$query = $this->MBarang->search_detail('laptop', 'rekap', 'rekap_dtl', 'location', 'department','laptop_no_po = rekap_id', 'laptop_rekap_dtl_id = rekap_dtl_id','laptop_location = location_id','laptop_department = department_id', 'rekap_id', 'asc', 'laptop_id', $id);

			foreach ($query->result() as $row) {
				$this->data['id_po'] = $row->rekap_id;
				$this->data['id_rekap_dtl'] = $row->rekap_dtl_id;
				$this->data['no_po'] = $row->rekap_no_po;
				$this->data['no_asset'] = $row->laptop_no_asset;
				$this->data['no_it'] = $row->laptop_no_it;
				$this->data['sn_laptop'] = $row->laptop_sn_lp;
				$this->data['hostname'] = $row->laptop_nama;
				$this->data['laptop_id'] = $row->laptop_id;
			}
			
			$cek = $this->MBarang->is_exist('as_laptop', array('as_laptop_laptop_id' =>  $id));

			if($cek == true){
				$query = $this->MBarang->relation_checking('laptop', 'as_laptop', 'laptop_id = as_laptop_laptop_id', array('laptop_id' => $id));

				foreach($query->result() as $row) {

					if($row->as_laptop_mon_id != 0){
						$this->data['id_mon'] = $row->as_laptop_mon_id;
						$this->data['sn_mon'] = $this->get_sn_barang($row->as_laptop_mon_id);
						$this->data['listBrg'][] = "Monitor : ".$this->data['sn_mon'];
					}
					if($row->as_laptop_mouse_id != 0){
						$this->data['id_mouse'] = $row->as_laptop_mouse_id;
						$this->data['sn_mouse'] = $this->get_sn_barang($row->as_laptop_mouse_id);
						$this->data['listBrg'][] = "Mouse : ".$this->data['sn_mouse'];
					}

					$this->data['isThereRelathionship'] = true;
				}
			}

			$view = 'barang/delete/v_delete_laptop';
		}elseif($jenis_barang == 200){
			$query = $this->MBarang->search_detail('smartphone', 'rekap', 'rekap_dtl', 'location', 'department','smartphone_no_po = rekap_id', 'smartphone_rekap_dtl_id = rekap_dtl_id','smartphone_location = location_id','smartphone_department = department_id', 'rekap_id', 'asc', 'smartphone_id', $id);

			foreach ($query->result() as $row) {
				$this->data['id_po'] = $row->rekap_id;
				$this->data['id_rekap_dtl'] = $row->rekap_dtl_id;
				$this->data['no_po'] = $row->rekap_no_po;
				$this->data['no_asset'] = $row->smartphone_no_asset;
				$this->data['no_it'] = $row->smartphone_no_it;
				$this->data['sn'] = $row->smartphone_sn;
				$this->data['smartphone_id'] = $row->smartphone_id;
			}

			$view = 'barang/delete/v_delete_smartphone';
		}elseif($jenis_barang == 300){
			$query = $this->MBarang->search_detail('imac', 'rekap', 'rekap_dtl', 'location', 'department','imac_no_po = rekap_id', 'imac_rekap_dtl_id = rekap_dtl_id','imac_location = location_id','imac_department = department_id', 'rekap_id', 'asc', 'imac_id', $id);

			foreach ($query->result() as $row) {
				$this->data['id_po'] = $row->rekap_id;
				$this->data['id_rekap_dtl'] = $row->rekap_dtl_id;
				$this->data['no_po'] = $row->rekap_no_po;
				$this->data['no_asset'] = $row->imac_no_asset;
				$this->data['no_it'] = $row->imac_no_it;
				$this->data['sn'] = $row->imac_sn;
				$this->data['hostname'] = $row->imac_nama;
				$this->data['imac_id'] = $row->imac_id;
			}
			
			$cek = $this->MBarang->is_exist('as_laptop', array('as_laptop_laptop_id' =>  $id));

			if($cek == true){
				$query = $this->MBarang->relation_checking('imac', 'as_imac', 'imac_id = as_imac_imac_id', array('imac_id' => $id));

				foreach($query->result() as $row) {

					if($row->as_imac_ups_id != 0){
						$this->data['id_ups'] = $row->as_imac_ups_id;
						$this->data['sn_ups'] = $this->get_sn_barang($row->as_imac_ups_id);
						$this->data['listBrg'][] = "UPS : ".$this->data['sn_ups'];
					}
					$this->data['isThereRelathionship'] = true;
				}
			}

			$view = 'barang/delete/v_delete_imac';
		}else{

			$query = $this->MBarang->search_detail('barang', 'rekap', 'rekap_dtl', 'location', 'department','barang_no_po = rekap_id', 'barang_rekap_dtl_id = rekap_dtl_id','barang_location = location_id','barang_department = department_id', 'rekap_id', 'asc', 'barang_id', $id);

			foreach ($query->result() as $row) {
				$this->data['id_po'] = $row->rekap_id;
				$this->data['id_rekap_dtl'] = $row->rekap_dtl_id;
				$this->data['no_po'] = $row->rekap_no_po;
				$this->data['no_asset'] = $row->barang_no_asset;
				$this->data['no_it'] = $row->barang_no_it;
				$this->data['sn'] = $row->barang_sn;
				$this->data['barang_id'] = $row->barang_id;
			}

			if($jenis_barang == 2){
				$cek1 = $this->MBarang->is_exist('as_cpu', array('as_cpu_mon1_id' =>  $id));
				$cek2 = $this->MBarang->is_exist('as_cpu', array('as_cpu_mon2_id' =>  $id));
				$cek3 = $this->MBarang->is_exist('as_laptop', array('as_laptop_mon_id' =>  $id));

				if($cek1 == true || $cek2 == true || $cek3 == true){
					$this->data['isThereRelathionship'] = true;
					if($cek3 == true){
						$query = $this->MBarang->relation_checking('laptop', 'as_laptop', 'laptop_id = as_laptop_laptop_id', array('as_laptop_mon_id' => $id));

						foreach ($query->result() as $row) {
							$this->data['listBrg'][] = "Laptop : ".$row->laptop_sn_lp;
						}
					}elseif($cek2 == true){
						$query = $this->MBarang->relation_checking('cpu', 'as_cpu', 'cpu_id = as_cpu_cpu_id', array('as_cpu_mon2_id' => $id));

						foreach ($query->result() as $row) {
							$this->data['listBrg'][] = "CPU : ".$row->cpu_service_tag;
						}
					}else{
						$query = $this->MBarang->relation_checking('cpu', 'as_cpu', 'cpu_id = as_cpu_cpu_id', array('as_cpu_mon1_id' => $id));

						foreach ($query->result() as $row) {
							$this->data['listBrg'][] = "CPU : ".$row->cpu_service_tag;
						}
					}
				}
			}elseif($jenis_barang == 3){ //keyboard
				$cek = $this->MBarang->is_exist('as_cpu', array('as_cpu_keyboard_id' =>  $id));
				if($cek == true){
					$this->data['isThereRelathionship'] = true;
					$query = $this->MBarang->relation_checking('cpu', 'as_cpu', 'cpu_id = as_cpu_cpu_id', array('as_cpu_keyboard_id' => $id));
					foreach ($query->result() as $row) {
						$this->data['listBrg'][] = "CPU : ".$row->cpu_service_tag;
					}
				}
			}elseif($jenis_barang == 4){
				$cek1 = $this->MBarang->is_exist('as_cpu', array('as_cpu_mouse_id' =>  $id));
				$cek2 = $this->MBarang->is_exist('as_laptop', array('as_laptop_mouse_id' =>  $id));

				if($cek1 == true || $cek2 == true){
					$this->data['isThereRelathionship'] = true;
					if($cek2 == true){
						$query = $this->MBarang->relation_checking('laptop', 'as_laptop', 'laptop_id = as_laptop_laptop_id', array('as_laptop_mouse_id' => $id));

						foreach ($query->result() as $row) {
							$this->data['listBrg'][] = "Laptop : ".$row->laptop_sn_lp;
						}
					}else{
						$query = $this->MBarang->relation_checking('cpu', 'as_cpu', 'cpu_id = as_cpu_cpu_id', array('as_cpu_mouse_id' => $id));

						foreach ($query->result() as $row) {
							$this->data['listBrg'][] = "CPU : ".$row->cpu_service_tag;
						}
					}
				}
			}elseif($jenis_barang == 5){
				$cek1 = $this->MBarang->is_exist('as_cpu', array('as_cpu_ups_id' =>  $id));
				$cek2 = $this->MBarang->is_exist('as_imac', array('as_imac_ups_id' =>  $id));

				if($cek1 == true || $cek2 == true){
					$this->data['isThereRelathionship'] = true;
					if($cek2 == true){
						$query = $this->MBarang->relation_checking('imac', 'as_imac', 'imac_id = as_imac_imac_id', array('as_imac_ups_id' => $id));

						foreach ($query->result() as $row) {
							$this->data['listBrg'][] = "IMAC : ".$row->imac_sn;
						}
					}else{
						$query = $this->MBarang->relation_checking('cpu', 'as_cpu', 'cpu_id = as_cpu_cpu_id', array('as_cpu_ups_id' => $id));

						foreach ($query->result() as $row) {
							$this->data['listBrg'][] = "CPU : ".$row->cpu_service_tag;
						}
					}
				}
			}elseif($jenis_barang == 6){ //keyboard
				$cek = $this->MBarang->is_exist('as_cpu', array('as_cpu_dongle_id' =>  $id));
				if($cek == true){
					$this->data['isThereRelathionship'] = true;
					$query = $this->MBarang->relation_checking('cpu', 'as_cpu', 'cpu_id = as_cpu_cpu_id', array('as_cpu_dongle_id' => $id));
					foreach ($query->result() as $row) {
						$this->data['listBrg'][] = "CPU : ".$row->cpu_service_tag;
					}
				}
			}

			$view = 'barang/delete/v_delete_barang';
		}

		$this->data['title'] = 'Delete Barang';
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->load->template($view, $this->data);
	}

	public function process_delete($jenis_barang = null, $id = null)
	{
		if($jenis_barang == 1){
			$query = $this->MBarang->delete('cpu', 'cpu_id', $id);
		}elseif($jenis_barang == 100){
			$query = $this->MBarang->delete('laptop', 'laptop_id', $id);
		}elseif($jenis_barang == 200){
			$query = $this->MBarang->delete('smartphone', 'smartphone_id', $id);
		}elseif($jenis_barang == 300){
			$query = $this->MBarang->delete('imac', 'imac_id', $id);
		}else{
			$query = $this->MBarang->delete('barang', 'barang_id', $id);
		}

		if($query){
			$this->set_message(1, "Data berhasil dihapus.");
		}else{
			$this->set_message(0, "Data gagal dihapus, silahkan ulangi lagi.");
		}

		redirect(site_url('barang/daftar/'.$jenis_barang),'refresh');
	}

	private function _get_username($id = null)
	{
		$q = $this->MBarang->get_data('user',array('user_id' => $id));
		foreach($q->result() as $row){	
			$name = $row->user_username;
		}	
		return $name;
	}

	//12-08-2016
	public function import($no_po = null, $dtl_barang = null, $jenis_barang = null)
	{
		$this->data['listPO'] = $this->MBarang->get_data('rekap','');
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['selectedPO'] = $no_po;
		$this->data['selectedJenisBarang'] = $jenis_barang;
		$this->data['showDtl'] = false;
		$this->data['showJenisBarang'] = false;
		$this->data['isEditing'] = false;
		$this->data['isEnabled'] = false;
		$this->data['isDtl'] = false;
		if($no_po != 999999 and $no_po != null){
			$this->data['showDtl'] = true;
			$this->data['showJenisBarang'] = true;
			$this->data['isEnabled'] = true;
			$this->data['viewDtl'] = "additional/detail_barang.php";

			if($dtl_barang != null){
				$query = $this->MBarang->get_data('rekap_dtl', array('rekap_dtl_id' => $dtl_barang) );
				foreach($query->result() as $row){
					$this->data['stok_awal'] = $row->rekap_dtl_jml; 
				}

				$this->data['isDtl'] = true;
				//count barang beredar
				$count_cpu = $this->MBarang->count_rows('cpu', array('cpu_rekap_dtl_id' => $dtl_barang, 'cpu_status' => 1));
				$count_laptop = $this->MBarang->count_rows('laptop', array('laptop_rekap_dtl_id' => $dtl_barang, 'laptop_status' => 1));
				$count_smartphone = $this->MBarang->count_rows('smartphone', array('smartphone_rekap_dtl_id' => $dtl_barang, 'smartphone_status' => 1));
				$count_imac = $this->MBarang->count_rows('imac', array('imac_rekap_dtl_id' => $dtl_barang, 'imac_status' => 1));
				$count_barang = $this->MBarang->count_rows('barang', array('barang_rekap_dtl_id' => $dtl_barang, 'barang_status' => 1));

				//count barang ditambahkan 
				$d_count_cpu = $this->MBarang->count_rows('cpu', array('cpu_rekap_dtl_id' => $dtl_barang));
				$d_count_laptop = $this->MBarang->count_rows('laptop', array('laptop_rekap_dtl_id' => $dtl_barang));
				$d_count_smartphone = $this->MBarang->count_rows('smartphone', array('smartphone_rekap_dtl_id' => $dtl_barang));
				$d_count_imac = $this->MBarang->count_rows('imac', array('imac_rekap_dtl_id' => $dtl_barang));
				$d_count_barang = $this->MBarang->count_rows('barang', array('barang_rekap_dtl_id' => $dtl_barang));

				$this->data['jml_ditambahkan'] = $d_count_cpu + $d_count_laptop + $d_count_smartphone + $d_count_imac + $d_count_barang;
				$this->data['jml_beredar'] = $count_cpu + $count_laptop + $count_smartphone + $count_imac + $count_barang;
				$this->data['selectedDtlBarang'] = $dtl_barang;

				if($this->data['stok_awal'] == $this->data['jml_ditambahkan']){
					$this->data['isDtl'] = false;
					echo "<script>alert('Stok Habis.');</script>";
				}
			}
			$this->data['listDtlBarang'] = $this->MBarang->get_data('rekap_dtl',array('rekap_dtl_id_rekap' => $no_po));
		}elseif($no_po == 999999){
			$this->data['showJenisBarang'] = true;
		}

		$this->data['title'] = 'Import Barang';
		$this->data['action'] = 'barang/process_import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang;
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['additional'] = "include/plus_form_import_barang.php";
		$this->load->template('barang/add/v_form_import_barang', $this->data);
	
	}

	private function _getNumber()
	{
		$q = $this->MBarang->get_data('no_it', array('no_it_id' => 1));

		foreach($q->result() as $row){
			$number = $row->no_it_last;
		}

		$date = date("ym");
		$no_it = $this->_combineNumber($date,$number);
		$number++;
		$this->MBarang->update_table('no_it_id', 1, 'no_it', array('no_it_last' => $number));

		return $no_it;
	}

	private function _combineNumber($str1, $str2)
	{
		if($str2 < 10){
			return "ITA".$str1."000".$str2;
		}elseif($str2 < 100){
			return "ITA".$str1."00".$str2;
		}elseif($str2 < 1000){
			return "ITA".$str1."0".$str2;
		}else{
			return "ITA".$str1.$str2;
		}
	}

	public function process_import($no_po = null, $dtl_barang = null, $jenis_barang = null)
	{
		$this->db->trans_start();
        //count barang ditambahkan 
        $query = $this->MBarang->get_data('rekap_dtl', array('rekap_dtl_id' => $dtl_barang) );
		foreach($query->result() as $row){
			$stok_awal = $row->rekap_dtl_jml; 
		}

		$d_count_cpu = $this->MBarang->count_rows('cpu', array('cpu_rekap_dtl_id' => $dtl_barang));
		$d_count_laptop = $this->MBarang->count_rows('laptop', array('laptop_rekap_dtl_id' => $dtl_barang));
		$d_count_smartphone = $this->MBarang->count_rows('smartphone', array('smartphone_rekap_dtl_id' => $dtl_barang));
		$d_count_imac = $this->MBarang->count_rows('imac', array('imac_rekap_dtl_id' => $dtl_barang));
		$d_count_barang = $this->MBarang->count_rows('barang', array('barang_rekap_dtl_id' => $dtl_barang));

		$stok_sekarang = $d_count_cpu + $d_count_laptop + $d_count_smartphone + $d_count_imac + $d_count_barang;

        $config['upload_path']          = './assets/upload/';
        $config['allowed_types']        = 'csv|xls|xlsx';
        $type_barang = $this->_get_nama_jenis_barang($jenis_barang);
        $file_name = 'file_'.$type_barang.'-'.date('Y-m-d-H-i-s-').$_SESSION["username"].".xlsx";
        $config['file_name']        	= $file_name;
        $this->load->library('upload', $config);

        if($this->upload->do_upload('file_import')){
        	$file = "./assets/upload/".$file_name;
			$this->load->library('excel');

			//read file from path
			$objPHPExcel = PHPExcel_IOFactory::load($file);
			$objWorksheet = $objPHPExcel->getActiveSheet();
			$jmlRecord = $objWorksheet->getHighestRow();

			$added = $stok_sekarang + $jmlRecord - 1; //karena highest row +1
			if($added > $stok_awal){
				echo "<script>alert('Barang yang ditambahkan melebihi stok awal $stok_awal, silahkan ulangi import lagi.')</script>";
				redirect('barang/import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang, 'refresh');
			}	
					
			$row = 2;
			for ($i = 1; $i < $jmlRecord; $i++) {
				$no_asset[$i] = $objWorksheet->getCell("A".$row)->getValue();
			   	//$no_it[$i] = $objWorksheet->getCell("B".$row)->getValue();
			   	$no_it[$i] = $this->_getNumber();
			   	$objWorksheet->setCellValue('B'.$row, $no_it[$i]);
			   	$serial_number[$i] = $objWorksheet->getCell("C".$row)->getValue();
				
				//cek no_it
				if($jenis_barang == 1){
					$service_tag[$i] = $objWorksheet->getCell("D".$row)->getValue();
					$cek_no_it = $this->MBarang->is_exist('cpu', array('cpu_no_it' =>  $no_it[$i]));
					if($cek_no_it == true){
						echo "<script>alert('NO IT $no_it[$i] sudah ada di database. Silahkan ulangi proses import.')</script>";
						$this->db->trans_rollback();
						redirect('barang/import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang, 'refresh');
					}else{
							$data = array(	'cpu_no_po' => $no_po,
									'cpu_rekap_dtl_id' => $dtl_barang,
									'cpu_no_asset' => $no_asset[$i], 
									'cpu_no_it' => $no_it[$i], 
									'cpu_service_tag' => $service_tag[$i], 
									'cpu_sn' => $serial_number[$i],
									'cpu_id_creator' => $_SESSION["user_id"],
									'cpu_time_create' => date('Y-m-d H:i:s')
								);
							$table = "cpu";
					}
				}elseif($jenis_barang == 100){
					$sn_hd[$i] = $objWorksheet->getCell("D".$row)->getValue();
					$sn_baterai[$i] = $objWorksheet->getCell("E".$row)->getValue();
					$sn_charger[$i] = $objWorksheet->getCell("F".$row)->getValue();

					$cek_no_it = $this->MBarang->is_exist('laptop', array('laptop_no_it' =>  $no_it[$i]));
					if($cek_no_it == true){
						echo "<script>alert('NO IT $no_it[$i] sudah ada di database. Silahkan ulangi proses import.')</script>";
						$this->db->trans_rollback();
						redirect('barang/import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang, 'refresh');
					}else{
							$data = array(	'laptop_no_po' => $no_po,
									'laptop_rekap_dtl_id' => $dtl_barang,
									'laptop_no_asset' => $no_asset[$i], 
									'laptop_no_it' => $no_it[$i], 
									'laptop_sn_lp' => $serial_number[$i],
									'laptop_sn_hd' => $sn_hd[$i],
									'laptop_sn_baterai' => $sn_baterai[$i],
									'laptop_sn_charger' => $sn_charger[$i],
									'laptop_id_creator' => $_SESSION["user_id"],
									'laptop_time_create' => date('Y-m-d H:i:s')
								);
							$table = "laptop";
					}
				}elseif($jenis_barang == 200){
					$imei1[$i] = $objWorksheet->getCell("D".$row)->getValue();
					$imei2[$i] = $objWorksheet->getCell("E".$row)->getValue();

					$cek_no_it = $this->MBarang->is_exist('smartphone', array('smartphone_no_it' =>  $no_it[$i]));
					if($cek_no_it == true){
						echo "<script>alert('NO IT $no_it[$i] sudah ada di database. Silahkan ulangi proses import.')</script>";
						$this->db->trans_rollback();
						redirect('barang/import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang, 'refresh');
					}else{
							$data = array(	'smartphone_no_po' => $no_po,
									'smartphone_rekap_dtl_id' => $dtl_barang,
									'smartphone_no_asset' => $no_asset[$i], 
									'smartphone_no_it' => $no_it[$i], 
									'smartphone_sn' => $serial_number[$i],
									'smartphone_imei1' => $imei1[$i],
									'smartphone_imei2' => $imei2[$i],
									'smartphone_id_creator' => $_SESSION["user_id"],
									'smartphone_time_create' => date('Y-m-d H:i:s')
								);
							$table = "smartphone";
					}
				}elseif($jenis_barang == 300){
					$sn_keyboard[$i] = $objWorksheet->getCell("D".$row)->getValue();
					$sn_mouse[$i] = $objWorksheet->getCell("E".$row)->getValue();

					$cek_no_it = $this->MBarang->is_exist('imac', array('imac_no_it' =>  $no_it[$i]));
					if($cek_no_it == true){
						echo "<script>alert('NO IT $no_it[$i] sudah ada di database. Silahkan ulangi proses import.')</script>";
						$this->db->trans_rollback();
						redirect('barang/import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang, 'refresh');
					}else{
							$data = array(	'imac_no_po' => $no_po,
									'imac_rekap_dtl_id' => $dtl_barang,
									'imac_no_asset' => $no_asset[$i], 
									'imac_no_it' => $no_it[$i], 
									'imac_sn' => $serial_number[$i],
									'imac_sn_keyboard' => $sn_keyboard[$i],
									'imac_sn_mouse' => $sn_mouse[$i],
									'imac_id_creator' => $_SESSION["user_id"],
									'imac_time_create' => date('Y-m-d H:i:s')
								);
							$table = "imac";
					}
				}else{

					$cek_no_it = $this->MBarang->is_exist('barang', array('barang_no_it' =>  $no_it[$i]));
					if($cek_no_it == true){
						echo "<script>alert('NO IT $no_it[$i] sudah ada di database. Silahkan ulangi proses import.')</script>";
						$this->db->trans_rollback();
						redirect('barang/import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang, 'refresh');
					}else{
							$data = array(	'barang_jenis_barang_id' => $jenis_barang,
									'barang_no_po' => $no_po,
									'barang_rekap_dtl_id' => $dtl_barang,
									'barang_no_asset' => $no_asset[$i], 
									'barang_no_it' => $no_it[$i], 
									'barang_sn' => $serial_number[$i],
									'barang_id_creator' => $_SESSION["user_id"],
									'barang_time_create' => date('Y-m-d H:i:s')
								);
							$table = "barang";
					}
				}

				$row++;
				$query = $this->MBarang->add($table, $data);
				
			}
        }else{
        	$msg = $this->upload->display_errors();
        	echo "<script>alert('$msg')</script>";
			redirect('barang/import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang, 'refresh');
        }

        $this->db->trans_complete();
        if($query){
        	
        	// Set document properties
			$objPHPExcel->getProperties()->setCreator("Admin")
									 ->setLastModifiedBy("Admin")
									 ->setTitle("Office 2007 XLSX Test Document")
									 ->setSubject("Office 2007 XLSX Test Document")
									 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
									 ->setKeywords("office 2007 openxml php")
									 ->setCategory("Test result file");

        	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename='.$file_name);
			header('Cache-Control: max-age=0');

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');

			echo "<script>alert('Data berhasil di import.')</script>";
			redirect('barang/import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang, 'refresh');
		}
	}

	public function history($jenis_barang = null, $id = null)
	{
		$criteria = array('cpu_id' => $id);
		$query = $this->MBarang->get_data_table('ex_cpu', $criteria, 'cpu_id', 'desc');

		foreach ($query->result() as $row) {
			echo $row->cpu_user;
		}
	}

}