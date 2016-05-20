<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class edit extends CI_Controller {

	const EDITOR = 1;
	const TABEL_BARANG = "barang";

	public function __construct()
	{
		parent::__construct();
		$this->load->model('BarangModel', 'MBarang');
	}

	public function cpu($id = null)
	{
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['listPIC'] = $this->MBarang->get_data('pic','');
		$this->data['listLocation'] = $this->MBarang->get_data('location','');
		
		$this->data['detailCPU'] = $this->MBarang->get_data('cpu',array('id' => $id));
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['additional'] = "edit_form.php";
		$this->data['jenis_barang'] = 1;
		$this->data['msg'] = $this->session->flashdata('msg');
		foreach($this->data['detailCPU']->result() as $row){
			$this->data['no_po'] = $row->no_po;
			$this->data['no_asset'] = $row->no_asset;
			$this->data['no_it'] = $row->no_it;
			$this->data['service_tag'] = $row->service_tag;
			$this->data['sn_cpu'] = $row->sn;
			$this->data['nama_pc'] = $row->nama_pc;
			$this->data['id_mon1'] = $row->id_mon1;
			if($this->data['id_mon1'] != 0){
				$this->data['sn_mon1'] = $this->get_sn($row->id_mon1,'monitor');
			}
			$this->data['id_mon2'] = $row->id_mon2;
			if($this->data['id_mon2'] != 0){
				$this->data['sn_mon2'] = $this->get_sn($row->id_mon2,'monitor');
			}
			$this->data['id_keyboard'] = $row->id_keyboard;
			if($this->data['id_keyboard'] != 0){
				$this->data['sn_keyboard'] = $this->get_sn($row->id_keyboard,'keyboard');
			}
			$this->data['id_mouse'] = $row->id_mouse;
			if($this->data['id_mouse'] != 0){
				$this->data['sn_mouse'] = $this->get_sn($row->id_mouse,'mouse');
			}
			$this->data['id_ups'] = $row->id_ups;
			if($this->data['id_ups'] != 0){
				$this->data['sn_ups'] = $this->get_sn($row->id_ups,'ups');
			}
			
			$this->data['type'] = $row->type;
			$this->data['merk'] = $row->merk;
			$this->data['vendor'] = $row->vendor;
			$this->data['tgl_terima'] = $row->tgl_terima;
			$this->data['listOfPic'] = $row->pic;
			$this->data['user'] = $row->user;
			$this->data['no_do'] = $row->no_do;
			$this->data['location'] = $row->location;
			$this->data['ket'] = $row->ket;
		}

		$this->data['listKeyboard'] = $this->MBarang->get_data('keyboard',array('user is null or user = "" ' => null));
		$this->data['listMouse'] = $this->MBarang->get_data('mouse',array('user is null or user = "" ' => null));
		$this->data['listUPS'] = $this->MBarang->get_data('ups',array('user is null or user = "" ' => null));
		$this->data['listMonitor'] = $this->MBarang->get_data('monitor',array('user is null or user = "" ' => null));

		$this->data['action'] = 'edit/save/cpu/'.$id;
		$this->data['title'] = 'Edit PC';
		$this->load->template('barang/edit/v_form_edit_cpu', $this->data);
	}

	public function imac($id = null)
	{
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['listPIC'] = $this->MBarang->get_data('pic','');
		$this->data['listLocation'] = $this->MBarang->get_data('location','');
		
		$this->data['detailCPU'] = $this->MBarang->get_data('imac',array('id' => $id));
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['additional'] = "edit_form.php";
		$this->data['jenis_barang'] = 300;
		$this->data['msg'] = $this->session->flashdata('msg');
		foreach($this->data['detailCPU']->result() as $row){
			$this->data['no_po'] = $row->no_po;
			$this->data['no_asset'] = $row->no_asset;
			$this->data['no_it'] = $row->no_it;
			$this->data['sn_imac'] = $row->sn_imac;
			$this->data['sn_keyboard'] = $row->sn_keyboard;
			$this->data['sn_mouse'] = $row->sn_mouse;
			$this->data['nama_imac'] = $row->nama_imac;
			
			$this->data['id_ups'] = $row->id_ups;
			if($this->data['id_ups'] != 0){
				$this->data['sn_ups'] = $this->get_sn($row->id_ups,'ups');
			}
			
			$this->data['type'] = $row->type;
			$this->data['merk'] = $row->merk;
			$this->data['vendor'] = $row->vendor;
			$this->data['tgl_terima'] = $row->tgl_terima;
			$this->data['listOfPic'] = $row->pic;
			$this->data['user'] = $row->user;
			$this->data['no_do'] = $row->no_do;
			$this->data['location'] = $row->location;
			$this->data['ket'] = $row->ket;
		}

		$this->data['listUPS'] = $this->MBarang->get_data('ups',array('user is null or user = "" ' => null));

		$this->data['action'] = 'edit/save/imac/'.$id;
		$this->data['title'] = 'Edit IMAC';
		$this->load->template('barang/edit/v_form_edit_imac', $this->data);
	}

	public function laptop($id = null)
	{
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['listPIC'] = $this->MBarang->get_data('pic','');
		$this->data['listLocation'] = $this->MBarang->get_data('location','');
		$this->data['listMouse'] = $this->MBarang->get_data('mouse',array('user is null or user = "" ' => null));
		$this->data['listMonitor'] = $this->MBarang->get_data('monitor',array('user is null or user = "" ' => null));

		$this->data['detailLaptop'] = $this->MBarang->get_data('laptop',array('id' => $id));
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['additional'] = "edit_form.php";
		$this->data['jenis_barang'] = 100;
		$this->data['msg'] = $this->session->flashdata('msg');
		foreach($this->data['detailLaptop']->result() as $row){
			$this->data['no_po'] = $row->no_po;
			$this->data['no_asset'] = $row->no_asset;
			$this->data['no_it'] = $row->no_it;
			$this->data['sn_lp'] = $row->sn_lp;
			$this->data['sn_hdd'] = $row->sn_hd;
			$this->data['sn_baterai'] = $row->sn_baterai;
			$this->data['sn_charger'] = $row->sn_charger;
			$this->data['kode_laptop'] = $row->kode_laptop;
			$this->data['nama_laptop'] = $row->nama_laptop;
			$this->data['id_mon1'] = $row->id_mon1;
			if($this->data['id_mon1'] != 0){
				$this->data['sn_mon1'] = $this->get_sn($row->id_mon1,'monitor');
			}
		
			$this->data['id_mouse'] = $row->id_mouse;
			if($this->data['id_mouse'] != 0){
				$this->data['sn_mouse'] = $this->get_sn($row->id_mouse,'mouse');
			}

			$this->data['type'] = $row->type;
			$this->data['merk'] = $row->merk;
			$this->data['vendor'] = $row->vendor;
			$this->data['tgl_terima'] = $row->tgl_terima;
			$this->data['listOfPic'] = $row->pic;
			$this->data['user'] = $row->user;
			$this->data['no_do'] = $row->no_do;
			$this->data['location'] = $row->location;
			$this->data['ket'] = $row->ket;
		}

		$this->data['action'] = 'edit/save/laptop/'.$id;
		$this->data['title'] = 'Edit Laptop';
		$this->load->template('barang/edit/v_form_edit_laptop', $this->data);
	}

	public function barang($jenis = null, $id = null)
	{
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['listPIC'] = $this->MBarang->get_data('pic','');
		$this->data['listLocation'] = $this->MBarang->get_data('location','');

		if($jenis == 'monitor'){
			$id_jenis_barang = 2;
			$title = "Edit Monitor";
		}elseif($jenis == 'keyboard'){
			$id_jenis_barang = 3;
			$title = "Edit Keyboard";
		}elseif($jenis == 'mouse'){
			$id_jenis_barang = 4;
			$title = "Edit Mouse";
		}elseif($jenis == 'ups'){
			$id_jenis_barang = 5;
			$title = "Edit UPS";
		}

		$this->data['detailBarang'] = $this->MBarang->get_data($jenis,array('id' => $id));
		$this->data['additional'] = "edit_form.php";
		$this->data['jenis_barang'] = $id_jenis_barang;
		$this->data['msg'] = $this->session->flashdata('msg');
		foreach($this->data['detailBarang']->result() as $row){
			$this->data['no_po'] = $row->no_po;
			$this->data['no_asset'] = $row->no_asset;
			$this->data['no_it'] = $row->no_it;
			$this->data['sn'] = $row->sn;
			$this->data['type'] = $row->type;
			$this->data['merk'] = $row->merk;
			$this->data['vendor'] = $row->vendor;
			$this->data['tgl_terima'] = $row->tgl_terima;
			$this->data['listOfPic'] = $row->pic;
			$this->data['user'] = $row->user;
			$this->data['no_do'] = $row->no_do;
			$this->data['location'] = $row->location;
			$this->data['ket'] = $row->ket;
		}

		$this->data['action'] = 'edit/save/'.$jenis.'/'.$id;
		$this->data['title'] = $title;
		$this->load->template('barang/edit/v_form_edit_barang', $this->data);
	}

	public function peripheral($jenis = null, $id = null)
	{
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['listPIC'] = $this->MBarang->get_data('pic','');
		$this->data['listLocation'] = $this->MBarang->get_data('location','');

		$this->data['detailBarang'] = $this->MBarang->get_data($this::TABEL_BARANG,array('id' => $id, 'nama' => $jenis));
		$this->data['additional'] = "edit_form.php";

		if($jenis == 'printer'){
			$jenis_barang = 6;
			$title = "Edit Printer";
		}elseif ($jenis == 'scanner') {
			$jenis_barang = 7;
			$title = "Edit Scanner";
		}
		$this->data['jenis_barang'] = $jenis_barang;
		$this->data['msg'] = $this->session->flashdata('msg');
		foreach($this->data['detailBarang']->result() as $row){
			$this->data['no_po'] = $row->no_po;
			$this->data['no_asset'] = $row->no_asset;
			$this->data['no_it'] = $row->no_it;
			$this->data['sn'] = $row->sn;
			$this->data['type'] = $row->type;
			$this->data['merk'] = $row->merk;
			$this->data['vendor'] = $row->vendor;
			$this->data['tgl_terima'] = $row->tgl_terima;
			$this->data['listOfPic'] = $row->pic;
			$this->data['user'] = $row->user;
			$this->data['no_do'] = $row->no_do;
			$this->data['location'] = $row->location;
			$this->data['ket'] = $row->ket;
		}

		$this->data['action'] = 'edit/save/'.$jenis.'/'.$id;
		$this->data['title'] = $title;
		$this->load->template('barang/edit/v_form_edit_barang', $this->data);
	}

	public function lain($id = null)
	{
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['listPIC'] = $this->MBarang->get_data('pic','');
		$this->data['listLocation'] = $this->MBarang->get_data('location','');

		$this->data['detailBarang'] = $this->MBarang->get_data($this::TABEL_BARANG,array('id' => $id));
		$this->data['additional'] = "edit_form.php";

		$this->data['jenis_barang'] = 999;
		$this->data['msg'] = $this->session->flashdata('msg');
		foreach($this->data['detailBarang']->result() as $row){
			$this->data['no_po'] = $row->no_po;
			$this->data['nama_barang'] = $row->nama;
			$this->data['no_asset'] = $row->no_asset;
			$this->data['no_it'] = $row->no_it;
			$this->data['sn'] = $row->sn;
			$this->data['type'] = $row->type;
			$this->data['merk'] = $row->merk;
			$this->data['vendor'] = $row->vendor;
			$this->data['tgl_terima'] = $row->tgl_terima;
			$this->data['listOfPic'] = $row->pic;
			$this->data['user'] = $row->user;
			$this->data['no_do'] = $row->no_do;
			$this->data['location'] = $row->location;
			$this->data['ket'] = $row->ket;
		}

		$this->data['action'] = 'edit/save/lain/'.$id;
		$this->data['title'] = "Edit ".$this->data['nama_barang'];
		$this->load->template('barang/edit/v_form_edit_lain', $this->data);
	}

	public function smartphone($id = null)
	{
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['listPIC'] = $this->MBarang->get_data('pic','');
		$this->data['listLocation'] = $this->MBarang->get_data('location','');

		$this->data['detailSmartphone'] = $this->MBarang->get_data('smartphone',array('id' => $id));
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['additional'] = "edit_form.php";
		$this->data['jenis_barang'] = 200;
		$this->data['msg'] = $this->session->flashdata('msg');
		foreach($this->data['detailSmartphone']->result() as $row){
			$this->data['no_po'] = $row->no_po;
			$this->data['no_asset'] = $row->no_asset;
			$this->data['no_it'] = $row->no_it;
			$this->data['sn_smartphone'] = $row->sn_smartphone;
			$this->data['imei1'] = $row->imei1;
			$this->data['imei2'] = $row->imei2;
			$this->data['type'] = $row->type;
			$this->data['merk'] = $row->merk;
			$this->data['vendor'] = $row->vendor;
			$this->data['tgl_terima'] = $row->tgl_terima;
			$this->data['listOfPic'] = $row->pic;
			$this->data['user'] = $row->user;
			$this->data['no_do'] = $row->no_do;
			$this->data['location'] = $row->location;
			$this->data['ket'] = $row->ket;
		}

		$this->data['action'] = 'edit/save/smartphone/'.$id;
		$this->data['title'] = 'Edit Smartphone';
		$this->load->template('barang/edit/v_form_edit_smartphone', $this->data);
	}


	public function save($type = null, $id = null)
	{
		$id_editor = $this::EDITOR;
		$jenis_barang = $this->input->post('jenis_barang');
		$pic = $this->input->post('pic');

		$listOfPic = "";
		$n = count($pic);
		for($i=0;$i<$n;$i++){
			if($i==($n-1)){
				$listOfPic .= $pic[$i];
			}else{
				$listOfPic .= $pic[$i].",";
			}	
		}

		$this->data['jenis_barang'] = $jenis_barang;
		$this->data['no_po'] = $this->input->post('no_po');
		$this->data['no_do'] = $this->input->post('no_do');
		$this->data['no_asset'] = $this->input->post('no_asset');
		$this->data['no_it'] = $this->input->post('no_it');
		$this->data['type'] = $this->input->post('type');
		$this->data['merk'] = $this->input->post('merk');
		$this->data['vendor'] = $this->input->post('vendor');
		$this->data['tgl_terima'] = $this->input->post('tgl_terima');
		$this->data['user'] = $this->input->post('user');
		$this->data['location'] = $this->input->post('location');
		$this->data['ket'] = $this->input->post('ket');
		$this->data['listOfPic'] = $listOfPic;

		$data = array(
					'no_po' => $this->data['no_po'],
					'no_do' => $this->data['no_do'],
					'no_asset' => $this->data['no_asset'],
					'no_it' => $this->data['no_it'],
					'type' => $this->data['type'],
					'merk' => $this->input->post('merk'),
					'vendor' => $this->data['vendor'],
					'tgl_terima' => $this->data['tgl_terima'],
					'pic' => $this->data['listOfPic'],
					'id_editor' => $id_editor,
					'user' => $this->data['user'],
					'ket' => $this->data['ket'],
					'location' => $this->data['location'],
					'time_editor' => date('Y-m-d H:i:s')
				);

		if($type == 'cpu'){
			$this->data['action'] = 'edit/save/cpu/'.$id;
			$this->data['service_tag'] = $this->input->post('service_tag');
			$this->data['nama_pc'] = $this->input->post('nama_pc');
			$this->data['sn_cpu'] = $this->input->post('sn_cpu');
			$this->data['id_mon1'] = $this->input->post('mon_cpu1');
			$this->data['id_mon2'] = $this->input->post('mon_cpu2');
			$this->data['id_keyboard'] = $this->input->post('keyboard_cpu');
			$this->data['id_mouse'] = $this->input->post('mouse_cpu');
			$this->data['id_ups'] = $this->input->post('ups_cpu');
			$this->data['jenis_barang'] = 1;
			$data = array_merge($data, array('service_tag' => $this->data['service_tag'],
												'nama_pc' => $this->data['nama_pc'],
												'sn' => $this->data['sn_cpu'],
												'id_mon1' => $this->data['id_mon1'],
												'id_mon2' => $this->data['id_mon2'],
												'id_keyboard' => $this->data['id_keyboard'],
												'id_mouse' => $this->data['id_mouse'],
												'id_ups' => $this->data['id_ups']
								 ));

			if(isset($this->data['id_mon1'])){
				$this->MBarang->update_data($this->input->post('mon_old'),'monitor',array('user' => NULL) );
				$this->MBarang->update_data($this->data['id_mon1'], 'monitor', array('user' => $this->data['user']));
			}
			if(isset($this->data['id_mon2'])){
				$this->MBarang->update_data($this->input->post('mon_old2'),'monitor',array('user' => NULL) );
				$this->MBarang->update_data($this->data['id_mon2'], 'monitor', array('user' => $this->data['user']));
			}
			if(isset($this->data['id_keyboard'])){
				$this->MBarang->update_data($this->input->post('keyboard_old'),'keyboard',array('user' => NULL) );
				$this->MBarang->update_data($this->data['id_keyboard'], 'keyboard', array('user' => $this->data['user']));
			}
			if(isset($this->data['id_mouse'])){
				$this->MBarang->update_data($this->input->post('mouse_old'),'mouse',array('user' => NULL) );
				$this->MBarang->update_data($this->data['id_mouse'], 'mouse', array('user' => $this->data['user']));
			}
			if(isset($this->data['id_ups'])){
				$this->MBarang->update_data($this->input->post('ups_old'),'ups',array('user' => NULL) );
				$this->MBarang->update_data($this->data['id_ups'], 'ups', array('user' => $this->data['user']));
			}
			
			$url_refresh = site_url('/edit/cpu/'.$id);
			$query = $this->MBarang->update_data($id, 'cpu', $data);
		}
		elseif($type == 'imac'){
			$this->data['action'] = 'edit/save/imac/'.$id;
			$this->data['nama_imac'] = $this->input->post('nama_imac');
			$this->data['sn_imac'] = $this->input->post('sn_imac');
			$this->data['sn_keyboard'] = $this->input->post('sn_keyboard');
			$this->data['sn_mouse'] = $this->input->post('sn_mouse');
			$this->data['ups_imac'] = $this->input->post('ups_imac');
			$this->data['jenis_barang'] = 300;
			$data = array_merge($data, array('sn_imac' => $this->data['sn_imac'],
												'nama_imac' => $this->data['nama_imac'],
												'sn_keyboard' => $this->data['sn_keyboard'],
												'sn_mouse' => $this->data['sn_mouse'],
												'id_ups' => $this->data['ups_imac']
								 ));

			if(isset($this->data['ups_imac'])){
				$this->MBarang->update_data($this->input->post('ups_old'),'ups',array('user' => NULL) );
				$this->MBarang->update_data($this->data['ups_imac'], 'ups', array('user' => $this->data['user']));
			}
			
			$url_refresh = site_url('/edit/imac/'.$id);
			$query = $this->MBarang->update_data($id, 'imac', $data);
		}
		elseif($type == 'laptop'){
			$this->data['action'] = 'edit/save/laptop/'.$id;
			$this->data['sn_lp'] = $this->input->post('sn_lp');
			$this->data['sn_hd'] = $this->input->post('sn_hdd');
			$this->data['sn_baterai'] = $this->input->post('sn_baterai');
			$this->data['sn_charger'] = $this->input->post('sn_charger');
			$this->data['nama_laptop'] = $this->input->post('nama_laptop');
			$this->data['kode_laptop'] = $this->input->post('kode_laptop');
			$this->data['id_mon1'] = $this->input->post('mon_laptop');
			$this->data['id_mouse'] = $this->input->post('mouse_laptop');
			$this->data['jenis_barang'] = 1;
			$data = array_merge($data, array('sn_lp' => $this->data['sn_lp'],
												'sn_hd' => $this->data['sn_hd'],
												'sn_baterai' => $this->data['sn_baterai'],
												'sn_charger' => $this->data['sn_charger'],
												'nama_laptop' => $this->data['nama_laptop'],
												'kode_laptop' => $this->data['kode_laptop'],
												'id_mon1' => $this->data['id_mon1'],
												'id_mouse' => $this->data['id_mouse']
								 ));

			if(isset($this->data['id_mon1'])){
				$this->MBarang->update_data($this->input->post('mon_old'),'monitor',array('user' => NULL) );
				$this->MBarang->update_data($this->data['id_mon1'], 'monitor', array('user' => $this->data['user']));
			}
			
			if(isset($this->data['id_mouse'])){
				$this->MBarang->update_data($this->input->post('mouse_old'),'mouse',array('user' => NULL) );
				$this->MBarang->update_data($this->data['id_mouse'], 'mouse', array('user' => $this->data['user']));
			}
			
			$url_refresh = site_url('/edit/laptop/'.$id);
			$query = $this->MBarang->update_data($id, 'laptop', $data);
		}
		elseif($type == 'monitor' || $type == 'keyboard' || $type == 'mouse' || $type == 'ups'){
			$this->data['sn'] = $this->input->post('sn');
			$data = array_merge($data, array('sn' => $this->data['sn']));
			$url_refresh = site_url('/edit/barang/'.$type.'/'.$id);
			$query = $this->MBarang->update_data($id, $type, $data);
		}
		elseif($type == 'Printer' || $type == 'Scanner' || $type == 'printer' || $type == 'scanner'){
			$this->data['sn'] = $this->input->post('sn');
			$data = array_merge($data, array('sn' => $this->data['sn']));
			$url_refresh = site_url('/edit/peripheral/'.$type.'/'.$id);
			if($type == 'printer'){
				$type = "Printer";
			}elseif($type == 'scanner'){
				$type = "Scanner";
			}
			$query = $this->MBarang->update_peripheral($id, $type, $this::TABEL_BARANG, $data);
		}
		elseif($type == 'smartphone'){
			$this->data['sn_smartphone'] = $this->input->post('sn_smartphone');
			$this->data['imei1'] = $this->input->post('imei1');
			$this->data['imei2'] = $this->input->post('imei2');
			$data = array_merge($data, array(
												'sn_smartphone' => $this->data['sn_smartphone'],
												'imei1' => $this->data['imei1'],
												'imei2' => $this->data['imei2']
											));
			$url_refresh = site_url('/edit/'.$type.'/'.$id);
			$query = $this->MBarang->update_data($id, $type, $data);
		}elseif($type == 'lain'){
			$this->data['nama_barang'] = $this->input->post('nama_barang');
			$data = array_merge($data, array(
												'nama' => $this->data['nama_barang']
											));
			$url_refresh = site_url('/edit/'.$type.'/'.$id);
			$query = $this->MBarang->update_data($id, $this::TABEL_BARANG, $data);
		}
		if($query){
			$msg = "<div class='alert bg-success' role='alert'>
				<svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data berhasil diupdate.
			</div>";
			$this->session->set_flashdata('msg', $msg);
			redirect($url_refresh,'refresh');
			//echo "oke";
		}else{
			$this->data['msg'] = "<div class='alert bg-danger' role='alert'>
				<svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal ditambahkan, silahkan ulangi lagi.
			</div>";
		}
	}

	private function get_sn($id, $table)
	{
		if(isset($id)){
			$q = $this->MBarang->get_data($table,array('id' => $id));

			foreach($q->result() as $row){
				$sn = $row->sn;
			}
		}
		else{
			$sn = null;
		}

		return $sn;
	}

	public function bintang($n = null)
	{
		for($i=1; $i<=$n; $i++){
			for($j=1; $j<=$i; $j++){
				echo " * ";
			}
			echo "<br />";
		}

	}
}