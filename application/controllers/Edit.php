<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class edit extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('BarangModel', 'MBarang');
	}

	public function cpu($id = null)
	{
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['listPIC'] = $this->MBarang->get_data('pic','');
		$this->data['listKeyboard'] = $this->MBarang->get_data('keyboard',array('user is null' => null));
		$this->data['listMouse'] = $this->MBarang->get_data('mouse',array('user is null' => null));
		$this->data['listUPS'] = $this->MBarang->get_data('ups',array('user is null' => null));
		$this->data['listMonitor'] = $this->MBarang->get_data('monitor',array('user is null' => null));

		$this->data['detailCPU'] = $this->MBarang->get_data('cpu',array('id' => $id));
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['additional'] = "edit_form.php";
		$this->data['jenis_barang'] = 2;

		foreach($this->data['detailCPU']->result() as $row){
			$this->data['no_po'] = $row->no_po;
			$this->data['no_asset'] = $row->no_asset;
			$this->data['no_it'] = $row->no_it;
			$this->data['service_tag'] = $row->service_tag;
			$this->data['sn_cpu'] = $row->sn;
			$this->data['nama_pc'] = $row->nama_pc;
			$this->data['id_mon1'] = $row->id_mon1;
			$this->data['sn_mon1'] = $this->get_sn($row->id_mon1,'monitor');
			$this->data['id_mon2'] = $row->id_mon2;
			$this->data['sn_mon2'] = $this->get_sn($row->id_mon2,'monitor');
			$this->data['id_keyboard'] = $row->id_keyboard;
			$this->data['sn_keyboard'] = $this->get_sn($row->id_keyboard,'keyboard');
			$this->data['id_mouse'] = $row->id_mouse;
			$this->data['sn_mouse'] = $this->get_sn($row->id_mouse,'mouse');
			$this->data['id_ups'] = $row->id_ups;
			$this->data['sn_ups'] = $this->get_sn($row->id_ups,'ups');
			$this->data['type'] = $row->type;
			$this->data['merk'] = $row->merk;
			$this->data['vendor'] = $row->vendor;
			$this->data['tgl_terima'] = $row->tgl_terima;
			$this->data['pic'] = $row->pic;
			$this->data['user'] = $row->user;
		}

		$this->data['action'] = 'edit/save/cpu/'.$id;
		$this->data['title'] = 'Edit PC';
		$this->load->template('barang/edit/v_form_edit_cpu', $this->data);
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

	private function get_sn($id, $table)
	{
		if(isset($id)){
			$q = $this->MBarang->get_data($table,array('id' => $id));

			foreach($q->result() as $row){
				$sn = $row->sn;
			}
		}
		else{
			$sn = "";
		}

		return $sn;
	}
}