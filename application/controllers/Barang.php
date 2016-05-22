<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class barang extends CI_Controller {

	const TABLE_BARANG = "barang";
	const CREATOR = 1;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('BarangModel', 'MBarang');
	}

	public function add($no_po = null, $dtl_barang = null, $jenis_barang = null)
	{
		$this->data['listPO'] = $this->MBarang->get_data('rekap','');
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['selectedPO'] = $no_po;
		$this->data['selectedJenisBarang'] = $jenis_barang;
		$this->data['showDtl'] = false;
		$this->data['showJenisBarang'] = false;
		if($no_po != 999999 and $no_po != null){
			$this->data['showDtl'] = true;
			$this->data['showJenisBarang'] = true;
			$this->data['viewDtl'] = "additional/detail_barang.php";

			if($dtl_barang != null){
				$this->data['selectedDtlBarang'] = $dtl_barang;
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
		$this->data['title'] = 'Asseting Barang';
		$this->data['action'] = 'barang/add';
		$this->data['additional'] = "include/plus_form_add_barang.php";
		$this->load->template('barang/add/v_form_add_barang', $this->data);
	}
	
	//ajax to get barang
	public function get_barang($no_po = null)
	{
		$data['listDtlBarang'] = $this->MBarang->get_data('rekap_dtl',array('rekap_dtl_id_rekap' => $no_po));

		$this->load->view('ajax/daftar_barang',$data);
	}

	//ajax to get form-input
	public function get_form_input($jenis_barang = null)
	{
		if($jenis_barang == 1){
			$this->data['listKeyboard'] = $this->MBarang->get_data('keyboard',array('user is null or user = ""' => null));
			$this->data['listMouse'] = $this->MBarang->get_data('mouse',array('user is null or user = ""' => null));
			$this->data['listUPS'] = $this->MBarang->get_data('ups',array('user is null or user = ""' => null));
			$this->data['listMonitor'] = $this->MBarang->get_data('monitor',array('user is null or user = ""' => null));
			$this->load->view('ajax/v_form_input_cpu', $this->data);
		}else{
			$this->load->view('ajax/v_form_input_barang');
		}
	}

	public function add2()
	{
		$this->data['msg'] = '';
		$submit = $this->input->post('submit');

		if($submit == 'Tambah'){
			$id_creator = $this::CREATOR;
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

			//'nama' => $this->getNamaBarang($jenis_barang),
			$data = array(
							'no_po' => $this->data['no_po'],
							'no_do' => $this->data['no_do'],
							'no_asset' => $this->data['no_asset'],
							'no_it' => $this->data['no_it'],
							'type' => $this->data['type'],
							'merk' => $this->input->post('merk'),
							'vendor' => $this->data['merk'],
							'tgl_terima' => $this->data['tgl_terima'],
							'pic' => $this->data['listOfPic'],
							'id_creator' => $id_creator,
							'user' => $this->data['user'],
							'location' => $this->data['location'],
							'ket' => $this->data['ket'],
							'time_create' => date('Y-m-d H:i:s')
						);

			if($jenis_barang == 1){
				//cpu
				$this->data['service_tag'] = $this->input->post('service_tag');
				$this->data['nama_pc'] = $this->input->post('nama_pc');
				$this->data['sn_cpu'] = $this->input->post('sn_cpu');
				$this->data['id_mon1'] = $this->input->post('mon_cpu1');
				$this->data['id_mon2'] = $this->input->post('mon_cpu2');
				$this->data['id_keyboard'] = $this->input->post('keyboard_cpu');
				$this->data['id_mouse'] = $this->input->post('mouse_cpu');
				$this->data['id_ups'] = $this->input->post('ups_cpu');
				$data = array_merge($data, array('service_tag' => $this->data['service_tag'],
													'nama_pc' => $this->data['nama_pc'],
													'sn' => $this->data['sn_cpu'],
													'id_mon1' => $this->data['id_mon1'],
													'id_mon2' => $this->data['id_mon2'],
													'id_keyboard' => $this->data['id_keyboard'],
													'id_mouse' => $this->data['id_mouse'],
													'id_ups' => $this->data['id_ups']
									 ));

				if(isset($this->data['id_keyboard'])){
					$this->MBarang->update_data($this->data['id_keyboard'], 'keyboard', array('user' => $this->data['user']));
				}
				
				if(isset($this->data['id_mon1'])){
					$this->MBarang->update_data($this->data['id_mon1'], 'monitor', array('user' => $this->data['user']));
				}

				if(isset($this->data['id_mon2'])){
					$this->MBarang->update_data($this->data['id_mon2'], 'monitor', array('user' => $this->data['user']));
				}
				
				if(isset($this->data['id_keyboard'])){
					$this->MBarang->update_data($this->data['id_keyboard'], 'keyboard', array('user' => $this->data['user']));
				}

				if(isset($this->data['id_mouse'])){
					$this->MBarang->update_data($this->data['id_mouse'], 'mouse', array('user' => $this->data['user']));
				}

				if(isset($this->data['id_ups'])){
					$this->MBarang->update_data($this->data['id_ups'], 'ups', array('user' => $this->data['user']));
				}

				$query = $this->MBarang->add('cpu', $data);
				//$query = true;
			}
			else if($jenis_barang == 2 || $jenis_barang == 3 || $jenis_barang == 4 || $jenis_barang == 5){
				// 2=monitor, 3=keyboard, 4=mouse, 5=ups
				$this->data['sn'] = $this->input->post('sn');
				$data = array_merge($data, array('sn' => $this->data['sn']));

				if($jenis_barang == 2){
					$table = 'monitor';
				}else if($jenis_barang == 3){
					$table = 'keyboard';
				}else if($jenis_barang == 4){
					$table = 'mouse';
				}else if($jenis_barang == 5){
					$table = 'ups';
				}
				$query = $this->MBarang->add($table, $data);
			}
			else if($jenis_barang == 100){
				//laptop
				$this->data['sn_laptop'] = $this->input->post('sn_laptop');
				$this->data['sn_hd'] = $this->input->post('sn_hd');
				$this->data['sn_baterai'] = $this->input->post('sn_baterai');
				$this->data['sn_charger'] = $this->input->post('sn_charger');
				$this->data['nama_laptop'] = $this->input->post('nama_laptop');
				$this->data['kode_laptop'] = $this->input->post('kode_laptop');
				$this->data['mon_laptop'] = $this->input->post('mon_laptop');
				$this->data['mouse_laptop'] = $this->input->post('mouse_laptop');
				$data = array_merge($data, 
						array('sn_lp' => $this->data['sn_laptop'],
								'sn_hd' => $this->data['sn_hd'],
								'sn_baterai' => $this->data['sn_baterai'],
								'sn_charger' => $this->data['sn_charger'],
								'nama_laptop' => $this->data['nama_laptop'],
								'kode_laptop' => $this->data['kode_laptop'],
								'id_mon1' => $this->data['mon_laptop'],
								'id_mouse' => $this->data['mouse_laptop']
							));

				if(isset($this->data['mon_laptop'])){
					$this->MBarang->update_data($this->data['mon_laptop'], 'monitor', array('user' => $this->data['user']));
				}
				
				if(isset($this->data['mouse_laptop'])){
					$this->MBarang->update_data($this->data['mouse_laptop'], 'mouse', array('user' => $this->data['user']));
				}

				$query = $this->MBarang->add('laptop', $data);
				
			}else if($jenis_barang == 200){
				//smartphone
				$this->data['sn_smartphone'] = $this->input->post('sn_smartphone');
				$this->data['imei1'] = $this->input->post('imei1');
				$this->data['imei2'] = $this->input->post('imei2');
				$data = array_merge($data, 
						array('sn_smartphone' => $this->data['sn_smartphone'],
								'imei1' => $this->data['imei1'],
								'imei2' => $this->data['imei2']
							));

				$query = $this->MBarang->add('smartphone', $data);

			}else if($jenis_barang == 300){
				//smartphone
				$this->data['sn_imac'] = $this->input->post('sn_imac');
				$this->data['sn_keyboard_imac'] = $this->input->post('sn_keyboard_imac');
				$this->data['sn_mouse_imac'] = $this->input->post('sn_mouse_imac');
				$this->data['nama_imac'] = $this->input->post('nama_imac');
				$this->data['id_ups'] = $this->input->post('ups_imac');
				$data = array_merge($data, 
						array('sn_imac' => $this->data['sn_imac'],
								'sn_keyboard' => $this->data['sn_keyboard_imac'],
								'sn_mouse' => $this->data['sn_mouse_imac'],
								'nama_imac' => $this->data['nama_imac'],
								'id_ups' => $this->data['id_ups']
							));

				if(isset($this->data['id_ups'])){
					$this->MBarang->update_data($this->data['id_ups'], 'ups', array('user' => $this->data['user']));
				}

				$query = $this->MBarang->add('imac', $data);

			}else if($jenis_barang == 999){
				//lainnya
				$this->data['sn_other'] = $this->input->post('sn_other');
				$this->data['nama_barang_lain'] = $this->input->post('nama_barang_lain');
				$data = array_merge($data, array( 'sn' => $this->data['sn_other'], 
													'nama' => $this->data['nama_barang_lain']
						));
				$query = $this->MBarang->add($this::TABLE_BARANG, $data);
			}else{
				$this->data['sn'] = $this->input->post('sn');
				$data = array_merge($data, array( 'sn' => $this->data['sn'], 
													'nama' => $this->getNamaBarang($jenis_barang)
						));
				$query = $this->MBarang->add($this::TABLE_BARANG, $data);
			}

			if($query){
				$this->data['msg'] = "<div class='alert bg-success' role='alert'>
					<svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data berhasil ditambahkan.
				</div>";
			}else{
				$this->data['msg'] = "<div class='alert bg-danger' role='alert'>
					<svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal ditambahkan, silahkan ulangi lagi.
				</div>";
			}
		}

		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['listPIC'] = $this->MBarang->get_data('pic','');
		$this->data['listLocation'] = $this->MBarang->get_data('location ','');
		$this->data['listKeyboard'] = $this->MBarang->get_data('keyboard',array('user is null or user = ""' => null));
		$this->data['listMouse'] = $this->MBarang->get_data('mouse',array('user is null or user = ""' => null));
		$this->data['listUPS'] = $this->MBarang->get_data('ups',array('user is null or user = ""' => null));
		$this->data['listMonitor'] = $this->MBarang->get_data('monitor',array('user is null or user = ""' => null));
		$this->data['additional'] = "input.php";
		$this->data['title'] = 'Penambahan Barang';
		$this->data['action'] = 'barang/add';
		$this->load->template('barang/v_form_input_barang', $this->data);
	}

	private function getNamaBarang($id_barang)
	{
		$q = $this->MBarang->get_data('type_barang',array('id' => $id_barang));

		foreach($q->result() as $row){
			$name = $row->nama;
		}

		return $name;
	}
}