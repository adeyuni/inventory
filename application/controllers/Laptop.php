<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laptop extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('LaptopModel', 'MLaptop');
	}


	public function index()
	{
		$this->data['title'] = 'Penambahan Barang';
		$this->data['data']='';
		$this->load->template('laptop/v_form_laptop', $this->data);
	}

	public function add()
	{
		$this->input->post('jenis_barang');
	}
}
