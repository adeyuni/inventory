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
		$this->load->template('barang/v_list_monitor', $this->data);
	}

	public function keyboard()
	{
		$this->data['listKeyboard'] = $this->MBarang->get_data('keyboard','');
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['additional'] = "daftar_barang.php";
		$this->data['jenis_barang'] = 3;
		
		$this->data['title'] = 'Daftar Keyboard';
		$this->load->template('barang/v_list_keyboard', $this->data);
	}

	public function mouse()
	{
		$this->data['listMouse'] = $this->MBarang->get_data('mouse','');
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['additional'] = "daftar_barang.php";
		$this->data['jenis_barang'] = 4;
		
		$this->data['title'] = 'Daftar Mouse';
		$this->load->template('barang/v_list_mouse', $this->data);
	}

	public function ups()
	{
		$this->data['listUPS'] = $this->MBarang->get_data('ups','');
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['additional'] = "daftar_barang.php";
		$this->data['jenis_barang'] = 5;
		
		$this->data['title'] = 'Daftar UPS';
		$this->load->template('barang/v_list_ups', $this->data);
	}

	public function printer()
	{
		$this->data['listPrinter'] = $this->MBarang->get_data('barang',array('nama' => 'Printer'));
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['additional'] = "daftar_barang.php";
		$this->data['jenis_barang'] = 6;
		
		$this->data['title'] = 'Daftar Printer';
		$this->load->template('barang/v_list_printer', $this->data);
	}

	public function scanner()
	{
		$this->data['listScanner'] = $this->MBarang->get_data('barang',array('nama' => 'Scanner'));
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['additional'] = "daftar_barang.php";
		$this->data['jenis_barang'] = 7;
		
		$this->data['title'] = 'Daftar Scanner';
		$this->load->template('barang/v_list_scanner', $this->data);
	}

	public function laptop()
	{
		$this->data['listLaptop'] = $this->MBarang->get_data('laptop','');
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['additional'] = "daftar_barang.php";
		$this->data['jenis_barang'] = 100;
		
		$this->data['title'] = 'Daftar Laptop';
		$this->load->template('barang/v_list_laptop', $this->data);
	}

	public function smartphone()
	{
		$this->data['listSmartphone'] = $this->MBarang->get_data('smartphone','');
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['additional'] = "daftar_barang.php";
		$this->data['jenis_barang'] = 200;
		
		$this->data['title'] = 'Daftar Smartphone';
		$this->load->template('barang/v_list_smartphone', $this->data);
	}

	public function imac()
	{
		$this->data['listImac'] = $this->MBarang->get_data('imac','');
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['additional'] = "daftar_barang.php";
		$this->data['jenis_barang'] = 300;
		
		$this->data['title'] = 'Daftar IMAC';
		$this->load->template('barang/v_list_imac', $this->data);
	}

	public function lain()
	{
		$this->data['listLain'] = $this->MBarang->get_data('barang',array('nama != "Printer"' => null, 'nama != "Scanner"' => null ));
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['additional'] = "daftar_barang.php";
		$this->data['jenis_barang'] = 999;
		
		$this->data['title'] = 'Daftar Lainnya';
		$this->load->template('barang/v_list_lain', $this->data);
	}
}