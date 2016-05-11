<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class edit extends CI_Controller {

	const EDITOR = 1;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('BarangModel', 'MBarang');
	}

	public function cpu($id = null)
	{
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['listPIC'] = $this->MBarang->get_data('pic','');
		$this->data['listKeyboard'] = $this->MBarang->get_data('keyboard',array('user is null or user = "" ' => null));
		$this->data['listMouse'] = $this->MBarang->get_data('mouse',array('user is null or user = "" ' => null));
		$this->data['listUPS'] = $this->MBarang->get_data('ups',array('user is null or user = "" ' => null));
		$this->data['listMonitor'] = $this->MBarang->get_data('monitor',array('user is null or user = "" ' => null));

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
			$this->data['pic'] = $row->pic;
			$this->data['user'] = $row->user;
		}

		$this->data['action'] = 'edit/save/cpu/'.$id;
		$this->data['title'] = 'Edit PC';
		$this->load->template('barang/edit/v_form_edit_cpu', $this->data);
	}

	public function monitor($id = null)
	{
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['listPIC'] = $this->MBarang->get_data('pic','');

		$this->data['detailMonitor'] = $this->MBarang->get_data('monitor',array('id' => $id));
		$this->data['additional'] = "edit_form.php";
		$this->data['jenis_barang'] = 2;
		$this->data['msg'] = $this->session->flashdata('msg');
		foreach($this->data['detailMonitor']->result() as $row){
			$this->data['no_po'] = $row->no_po;
			$this->data['no_asset'] = $row->no_asset;
			$this->data['no_it'] = $row->no_it;
			$this->data['sn'] = $row->sn;
			$this->data['type'] = $row->type;
			$this->data['merk'] = $row->merk;
			$this->data['vendor'] = $row->vendor;
			$this->data['tgl_terima'] = $row->tgl_terima;
			$this->data['pic'] = $row->pic;
			$this->data['user'] = $row->user;
		}

		$this->data['action'] = 'edit/save/monitor/'.$id;
		$this->data['title'] = 'Edit Monitor';
		$this->load->template('barang/edit/v_form_edit_monitor', $this->data);
	}

	public function keyboard($id = null)
	{
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['listPIC'] = $this->MBarang->get_data('pic','');

		$this->data['detailKeyboard'] = $this->MBarang->get_data('keyboard',array('id' => $id));
		$this->data['additional'] = "edit_form.php";
		$this->data['jenis_barang'] = 3;
		$this->data['msg'] = $this->session->flashdata('msg');
		foreach($this->data['detailKeyboard']->result() as $row){
			$this->data['no_po'] = $row->no_po;
			$this->data['no_asset'] = $row->no_asset;
			$this->data['no_it'] = $row->no_it;
			$this->data['sn'] = $row->sn;
			$this->data['type'] = $row->type;
			$this->data['merk'] = $row->merk;
			$this->data['vendor'] = $row->vendor;
			$this->data['tgl_terima'] = $row->tgl_terima;
			$this->data['pic'] = $row->pic;
			$this->data['user'] = $row->user;
		}

		$this->data['action'] = 'edit/save/keyboard/'.$id;
		$this->data['title'] = 'Edit Keyboard';
		$this->load->template('barang/edit/v_form_edit_keyboard', $this->data);
	}

	public function mouse($id = null)
	{
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['listPIC'] = $this->MBarang->get_data('pic','');

		$this->data['detailKeyboard'] = $this->MBarang->get_data('mouse',array('id' => $id));
		$this->data['additional'] = "edit_form.php";
		$this->data['jenis_barang'] = 4;
		$this->data['msg'] = $this->session->flashdata('msg');
		foreach($this->data['detailKeyboard']->result() as $row){
			$this->data['no_po'] = $row->no_po;
			$this->data['no_asset'] = $row->no_asset;
			$this->data['no_it'] = $row->no_it;
			$this->data['sn'] = $row->sn;
			$this->data['type'] = $row->type;
			$this->data['merk'] = $row->merk;
			$this->data['vendor'] = $row->vendor;
			$this->data['tgl_terima'] = $row->tgl_terima;
			$this->data['pic'] = $row->pic;
			$this->data['user'] = $row->user;
		}

		$this->data['action'] = 'edit/save/mouse/'.$id;
		$this->data['title'] = 'Edit Mouse';
		$this->load->template('barang/edit/v_form_edit_mouse', $this->data);
	}

	public function barang($jenis = null, $id = null)
	{
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['listPIC'] = $this->MBarang->get_data('pic','');

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
			$this->data['pic'] = $row->pic;
			$this->data['user'] = $row->user;
		}

		$this->data['action'] = 'edit/save/'.$jenis.'/'.$id;
		$this->data['title'] = $title;
		$this->load->template('barang/edit/v_form_edit_barang', $this->data);
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
		$this->data['no_asset'] = $this->input->post('no_asset');
		$this->data['no_it'] = $this->input->post('no_it');
		$this->data['type'] = $this->input->post('type');
		$this->data['merk'] = $this->input->post('merk');
		$this->data['vendor'] = $this->input->post('vendor');
		$this->data['tgl_terima'] = $this->input->post('tgl_terima');
		$this->data['user'] = $this->input->post('user');
		$this->data['listOfPic'] = $listOfPic;

		$data = array(
					'no_po' => $this->data['no_po'],
					'no_asset' => $this->data['no_asset'],
					'no_it' => $this->data['no_it'],
					'type' => $this->data['type'],
					'merk' => $this->input->post('merk'),
					'vendor' => $this->data['vendor'],
					'tgl_terima' => $this->data['tgl_terima'],
					'pic' => $this->data['listOfPic'],
					'id_editor' => $id_editor,
					'user' => $this->data['user'],
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

			$this->data['sn_keyboard'] = $this->get_sn($this->data['id_keyboard'],'keyboard');
			$this->data['sn_mouse'] = $this->get_sn($this->data['id_mouse'],'mouse');
			$this->data['sn_ups'] = $this->get_sn($this->data['id_ups'],'ups');

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
		elseif($type == 'monitor'){
			$this->data['sn'] = $this->input->post('sn');
			$data = array_merge($data, array('sn' => $this->data['sn']));
			$url_refresh = site_url('/edit/monitor/'.$id);
			$query = $this->MBarang->update_data($id, 'monitor', $data);
		}elseif($type == 'keyboard'){
			$this->data['sn'] = $this->input->post('sn');
			$data = array_merge($data, array('sn' => $this->data['sn']));
			$url_refresh = site_url('/edit/keyboard/'.$id);
			$query = $this->MBarang->update_data($id, 'keyboard', $data);
		}elseif($type == 'mouse'){
			$this->data['sn'] = $this->input->post('sn');
			$data = array_merge($data, array('sn' => $this->data['sn']));
			$url_refresh = site_url('/edit/mouse/'.$id);
			$query = $this->MBarang->update_data($id, 'mouse', $data);
		}


		if($query){

			$msg = "<div class='alert bg-success' role='alert'>
				<svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data berhasil diupdate.
			</div>";
			$this->session->set_flashdata('msg', $msg);
			redirect($url_refresh,'refresh');
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
}