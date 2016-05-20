<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class detail extends CI_Controller {

	const TABEL_BARANG = "barang";

	public function __construct()
	{
		parent::__construct();
		$this->load->model('BarangModel', 'MBarang');
	}

	public function cpu($id = null)
	{
		$this->data['detailCPU'] = $this->MBarang->get_data('cpu',array('id' => $id));
		$this->data['additional'] = "edit_form.php";
		$this->data['jenis_barang'] = $this->getNamaBarang(1);
		$this->data['listPIC'] = $this->MBarang->get_data('pic','');

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
			$this->data['user'] = $row->user;
			$this->data['no_do'] = $row->no_do;
			$this->data['ket'] = $row->ket;
			$this->data['location'] = $this->getNamaLocation($row->location);
			$pic= $row->pic;
			$pic = explode(",", $pic);
			$listPIC = "";
			foreach ($pic as $ppic) {
				$nameppic = $this->getNamaPIC($ppic);
				$listPIC = $listPIC." ".$nameppic;
			}
			$this->data['pic'] = $listPIC;
			$this->data['creator'] = $this->getNamaPIC($row->id_creator);
			$this->data['time_create'] = $row->time_create;
			if($row->id_editor != 0){
				$this->data['editor'] = $this->getNamaPIC($row->id_editor);
				$this->data['time_edit'] = $row->time_editor;
			}else{
				$this->data['editor'] = "-";
				$this->data['time_edit'] = "-";
			}
		}

		$this->data['url_edit'] = "edit/cpu/".$id;
		$this->data['title'] = 'Detail PC';
		$this->load->template('barang/detail/v_detail_cpu', $this->data);
	}

	public function imac($id = null)
	{
		$this->data['detailImac'] = $this->MBarang->get_data('imac',array('id' => $id));
		$this->data['additional'] = "edit_form.php";
		$this->data['jenis_barang'] = $this->getNamaBarang(300);
		$this->data['listPIC'] = $this->MBarang->get_data('pic','');

		foreach($this->data['detailImac']->result() as $row){
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
			$this->data['user'] = $row->user;
			$this->data['no_do'] = $row->no_do;
			$this->data['ket'] = $row->ket;
			$this->data['location'] = $this->getNamaLocation($row->location);
			$pic= $row->pic;
			$pic = explode(",", $pic);
			$listPIC = "";
			foreach ($pic as $ppic) {
				$nameppic = $this->getNamaPIC($ppic);
				$listPIC = $listPIC." ".$nameppic;
			}
			$this->data['pic'] = $listPIC;
			$this->data['creator'] = $this->getNamaPIC($row->id_creator);
			$this->data['time_create'] = $row->time_create;
			if($row->id_editor != 0){
				$this->data['editor'] = $this->getNamaPIC($row->id_editor);
				$this->data['time_edit'] = $row->time_editor;
			}else{
				$this->data['editor'] = "-";
				$this->data['time_edit'] = "-";
			}
		}

		$this->data['url_edit'] = "edit/imac/".$id;
		$this->data['title'] = 'Detail IMAC';
		$this->load->template('barang/detail/v_detail_imac', $this->data);
	}
	public function laptop($id = null)
	{
		$this->data['detailLaptop'] = $this->MBarang->get_data('laptop',array('id' => $id));
		$this->data['additional'] = "edit_form.php";
		$this->data['jenis_barang'] = $this->getNamaBarang(100);
		$this->data['listPIC'] = $this->MBarang->get_data('pic','');

		foreach($this->data['detailLaptop']->result() as $row){
			$this->data['no_po'] = $row->no_po;
			$this->data['no_asset'] = $row->no_asset;
			$this->data['no_it'] = $row->no_it;
			$this->data['sn_lp'] = $row->sn_lp;
			$this->data['sn_hd'] = $row->sn_hd;
			$this->data['sn_baterai'] = $row->sn_baterai;
			$this->data['sn_charger'] = $row->sn_charger;
			$this->data['nama_laptop'] = $row->nama_laptop;
			$this->data['kode_laptop'] = $row->kode_laptop;
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
			$this->data['user'] = $row->user;
			$this->data['no_do'] = $row->no_do;
			$this->data['ket'] = $row->ket;
			$this->data['location'] = $this->getNamaLocation($row->location);

			$pic= $row->pic;
			$pic = explode(",", $pic);
			$listPIC = "";
			foreach ($pic as $ppic) {
				$nameppic = $this->getNamaPIC($ppic);
				$listPIC = $listPIC." ".$nameppic;
			}
			$this->data['pic'] = $listPIC;
			$this->data['creator'] = $this->getNamaPIC($row->id_creator);
			$this->data['time_create'] = $row->time_create;
			if($row->id_editor != 0){
				$this->data['editor'] = $this->getNamaPIC($row->id_editor);
				$this->data['time_edit'] = $row->time_editor;
			}else{
				$this->data['editor'] = "-";
				$this->data['time_edit'] = "-";
			}
		}

		$this->data['url_edit'] = "edit/laptop/".$id;
		$this->data['title'] = 'Detail Laptop';
		$this->load->template('barang/detail/v_detail_laptop', $this->data);
	}

	public function barang($jenis = null, $id = null)
	{
		$this->data['detailBarang'] = $this->MBarang->get_data($jenis,array('id' => $id));
		$this->data['additional'] = "edit_form.php";
		$listPIC = $this->MBarang->get_data('pic','');
		$view = "barang/detail/v_detail_barang";

		if($jenis == 'monitor'){
			$id_jenis_barang = 2;
			$title = "Detail Monitor";
		}elseif($jenis == 'keyboard'){
			$id_jenis_barang = 3;
			$title = "Detail Keyboard";
		}elseif($jenis == 'mouse'){
			$id_jenis_barang = 4;
			$title = "Detail Mouse";
		}elseif($jenis == 'ups'){
			$id_jenis_barang = 5;
			$title = "Detail UPS";
		}
		$this->data['jenis_barang'] = $this->getNamaBarang($id_jenis_barang);
		
		foreach($this->data['detailBarang']->result() as $row){
			$this->data['no_po'] = $row->no_po;
			$this->data['no_asset'] = $row->no_asset;
			$this->data['no_it'] = $row->no_it;
			$this->data['sn'] = $row->sn;
			$this->data['type'] = $row->type;
			$this->data['merk'] = $row->merk;
			$this->data['vendor'] = $row->vendor;
			$this->data['tgl_terima'] = $row->tgl_terima;
			$this->data['user'] = $row->user;
			$this->data['no_do'] = $row->no_do;
			$this->data['ket'] = $row->ket;
			$this->data['location'] = $this->getNamaLocation($row->location);
			$pic= $row->pic;
			$pic = explode(",", $pic);
			$listPIC = "";
			foreach ($pic as $ppic) {
				$nameppic = $this->getNamaPIC($ppic);
				$listPIC = $listPIC." ".$nameppic;
			}
			$this->data['pic'] = $listPIC;
			$this->data['creator'] = $this->getNamaPIC($row->id_creator);
			$this->data['time_create'] = $row->time_create;
			if($row->id_editor != 0){
				$this->data['editor'] = $this->getNamaPIC($row->id_editor);
				$this->data['time_edit'] = $row->time_editor;
			}else{
				$this->data['editor'] = "-";
				$this->data['time_edit'] = "-";
			}
		}

		$this->data['title'] = $title;
		$this->data['url_edit'] = "edit/barang/".$jenis."/".$id;
		$this->load->template($view, $this->data);
	}

	public function smartphone($id = null)
	{
		$this->data['detailSmartphone'] = $this->MBarang->get_data('smartphone',array('id' => $id));
		$this->data['additional'] = "edit_form.php";
		$this->data['jenis_barang'] = $this->getNamaBarang(100);
		$this->data['listPIC'] = $this->MBarang->get_data('pic','');

		foreach($this->data['detailSmartphone']->result() as $row){
			$this->data['no_po'] = $row->no_po;
			$this->data['no_do'] = $row->no_do;
			$this->data['no_asset'] = $row->no_asset;
			$this->data['no_it'] = $row->no_it;
			$this->data['sn_smartphone'] = $row->sn_smartphone;
			$this->data['imei1'] = $row->imei1;
			$this->data['imei2'] = $row->imei2;
			$this->data['type'] = $row->type;
			$this->data['merk'] = $row->merk;
			$this->data['vendor'] = $row->vendor;
			$this->data['tgl_terima'] = $row->tgl_terima;
			$this->data['user'] = $row->user;
			$this->data['ket'] = $row->ket;
			$this->data['location'] = $this->getNamaLocation($row->location);

			$pic= $row->pic;
			$pic = explode(",", $pic);
			$listPIC = "";
			foreach ($pic as $ppic) {
				$nameppic = $this->getNamaPIC($ppic);
				$listPIC = $listPIC." ".$nameppic;
			}
			$this->data['pic'] = $listPIC;
			$this->data['creator'] = $this->getNamaPIC($row->id_creator);
			$this->data['time_create'] = $row->time_create;
			if($row->id_editor != 0){
				$this->data['editor'] = $this->getNamaPIC($row->id_editor);
				$this->data['time_edit'] = $row->time_editor;
			}else{
				$this->data['editor'] = "-";
				$this->data['time_edit'] = "-";
			}
		}

		$this->data['url_edit'] = "edit/smartphone/".$id;
		$this->data['title'] = 'Detail Smartphone';
		$this->load->template('barang/detail/v_detail_smartphone', $this->data);
	}

	public function peripheral($jenis = null, $id = null)
	{
		if($jenis == 'printer'){
			$id_jenis_barang = 6;
			$type = "Printer";
			$title = "Detail Printer";
		}elseif($jenis == 'scanner'){
			$id_jenis_barang = 7;
			$type = "Scanner";
			$title = "Detail Scanner";
		}

		$this->data['detailBarang'] = $this->MBarang->get_data($this::TABEL_BARANG,array('id' => $id, 'nama' => $type));
		$this->data['additional'] = "edit_form.php";
		$listPIC = $this->MBarang->get_data('pic','');
		$view = "barang/detail/v_detail_barang";

		$this->data['jenis_barang'] = $this->getNamaBarang($id_jenis_barang);
		
		foreach($this->data['detailBarang']->result() as $row){
			$this->data['no_po'] = $row->no_po;
			$this->data['no_asset'] = $row->no_asset;
			$this->data['no_it'] = $row->no_it;
			$this->data['sn'] = $row->sn;
			$this->data['type'] = $row->type;
			$this->data['merk'] = $row->merk;
			$this->data['vendor'] = $row->vendor;
			$this->data['tgl_terima'] = $row->tgl_terima;
			$this->data['user'] = $row->user;
			$this->data['no_do'] = $row->no_do;
			$this->data['ket'] = $row->ket;
			$this->data['location'] = $this->getNamaLocation($row->location);
			$pic= $row->pic;
			$pic = explode(",", $pic);
			$listPIC = "";
			foreach ($pic as $ppic) {
				$nameppic = $this->getNamaPIC($ppic);
				$listPIC = $listPIC." ".$nameppic;
			}
			$this->data['pic'] = $listPIC;
			$this->data['creator'] = $this->getNamaPIC($row->id_creator);
			$this->data['time_create'] = $row->time_create;
			if($row->id_editor != 0){
				$this->data['editor'] = $this->getNamaPIC($row->id_editor);
				$this->data['time_edit'] = $row->time_editor;
			}else{
				$this->data['editor'] = "-";
				$this->data['time_edit'] = "-";
			}
		}

		$this->data['url_edit'] = "edit/peripheral/".$jenis."/".$id;
		$this->data['title'] = $title;
		$this->load->template($view, $this->data);
	}

	public function lain($id = null)
	{

		$this->data['detailBarang'] = $this->MBarang->get_data($this::TABEL_BARANG,array('id' => $id));
		$this->data['additional'] = "edit_form.php";
		$listPIC = $this->MBarang->get_data('pic','');
		$view = "barang/detail/v_detail_lain";
		
		foreach($this->data['detailBarang']->result() as $row){
			$this->data['jenis_barang'] = $row->nama;
			$this->data['no_po'] = $row->no_po;
			$this->data['no_asset'] = $row->no_asset;
			$this->data['no_it'] = $row->no_it;
			$this->data['sn'] = $row->sn;
			$this->data['type'] = $row->type;
			$this->data['merk'] = $row->merk;
			$this->data['vendor'] = $row->vendor;
			$this->data['tgl_terima'] = $row->tgl_terima;
			$this->data['user'] = $row->user;
			$this->data['no_do'] = $row->no_do;
			$this->data['ket'] = $row->ket;
			$this->data['location'] = $this->getNamaLocation($row->location);
			$pic= $row->pic;
			$pic = explode(",", $pic);
			$listPIC = "";
			foreach ($pic as $ppic) {
				$nameppic = $this->getNamaPIC($ppic);
				$listPIC = $listPIC." ".$nameppic;
			}
			$this->data['pic'] = $listPIC;
			$this->data['creator'] = $this->getNamaPIC($row->id_creator);
			$this->data['time_create'] = $row->time_create;
			if($row->id_editor != 0){
				$this->data['editor'] = $this->getNamaPIC($row->id_editor);
				$this->data['time_edit'] = $row->time_editor;
			}else{
				$this->data['editor'] = "-";
				$this->data['time_edit'] = "-";
			}
		}

		$this->data['url_edit'] = "edit/lain/".$id;
		$this->data['title'] = "Detail ".$this->data['jenis_barang'];
		$this->load->template($view, $this->data);
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

	private function getNamaBarang($id_barang)
	{
		$q = $this->MBarang->get_data('type_barang',array('id' => $id_barang));

		foreach($q->result() as $row){
			$name = $row->nama;
		}

		return $name;
	}

	private function getNamaPIC($id = null)
	{
		$q = $this->MBarang->get_data('pic', array('id' => $id));

		if($q){
			foreach ($q->result() as $row) {
				$name = $row->nama;
			}
			return $name;
		}else{
			return "";
		}
	}

	private function getNamaLocation($id_location)
	{
		$q = $this->MBarang->get_data('location',array('id' => $id_location));

		foreach($q->result() as $row){
			$name = $row->nama;
		}

		return $name;
	}
}