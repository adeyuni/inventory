<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class assigment extends CI_Controller {

	const TABLE_BARANG = "barang";
	const CREATOR = 1;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('BarangModel', 'MBarang');
	}

	public function barang($jenis_barang = null)
	{
		$this->data['title'] = 'Serah Terima Barang';
		$this->data['selectedJenisBarang'] = $jenis_barang;
		$this->data['listJenisBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['listLocation'] = $this->MBarang->get_data('location ','');
		$this->data['selectedLocation'] = null;
		$this->data['selectedCPU'] = null;
		$this->data['selectedMon1'] = null;
		$this->data['selectedMon2'] = null;
		$this->data['selectedMouse'] = null;
		$this->data['selectedKeyboard'] = null;
		$this->data['selectedUPS'] = null;
		$this->data['selectedBarang'] = null;
		$this->data['selectedSmartphone'] = null;
		$this->data['selectedIMAC'] = null;

		if($jenis_barang == 1){

			$this->data['listCPU'] = $this->MBarang->get_data('cpu',array('cpu_status' => 0));
			$this->data['listMonitor'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 2));
			$this->data['listKeyboard'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 3));
			$this->data['listMouse'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 4));
			$this->data['listUPS'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 5));
			$this->data['formAssigmentBarang'] = "additional/v_form_assigment_cpu.php";
		}elseif($jenis_barang >= 2 AND $jenis_barang <= 7){

			$this->data['listBarang'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => $jenis_barang));
			$this->data['formAssigmentBarang'] = "additional/v_form_assigment_barang.php";
		}elseif($jenis_barang == 100){
			$this->data['listLaptop'] = $this->MBarang->get_data('laptop',array('laptop_status' => 0));
			$this->data['listMonitor'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 2));
			$this->data['listMouse'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 4));
			$this->data['formAssigmentBarang'] = "additional/v_form_assigment_laptop.php";
		}elseif($jenis_barang == 200){

			$this->data['listSmartphone'] = $this->MBarang->get_data('smartphone',array('smartphone_status' => 0));
			$this->data['formAssigmentBarang'] = "additional/v_form_assigment_smartphone.php";
		}elseif($jenis_barang == 300){
			$this->data['listIMAC'] = $this->MBarang->get_data('imac',array('imac_status' => 0));
			$this->data['listUPS'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 5));
			$this->data['formAssigmentBarang'] = "additional/v_form_assigment_imac.php";
		}

		$this->data['additional'] = "include/plus_form_assigment.php";
		$this->data['action'] = 'barang/add';
		$this->load->template('assigment/v_form_assigment', $this->data);
	}
}
