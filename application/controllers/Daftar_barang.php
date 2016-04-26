<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class daftar_barang extends CI_Controller {

	const TABLE_BARANG = "barang";

	public function __construct()
	{
		parent::__construct();
		$this->load->model('BarangModel', 'MBarang');
	}

	public function cpu()
	{
		$this->data['listCPU'] = $this->MBarang->get_data('cpu','');
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['additional'] = "daftar_barang.php";
		$this->data['jenis_barang'] = 1;

		$this->data['title'] = 'Daftar PC';
		$this->data['action'] = 'barang/add';
		$this->load->template('barang/v_list_cpu', $this->data);
	}

	public function monitor()
	{
		$this->data['listMonitor'] = $this->MBarang->get_data('monitor','');
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['additional'] = "daftar_barang.php";
		$this->data['jenis_barang'] = 2;
		
		$this->data['title'] = 'Daftar Monitor';
		$this->data['action'] = 'barang/add';
		$this->load->template('barang/v_list_monitor', $this->data);
	}
}