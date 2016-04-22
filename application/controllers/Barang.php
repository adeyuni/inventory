<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class barang extends CI_Controller {

	const TABLE_BARANG = "barang";

	public function __construct()
	{
		parent::__construct();
		$this->load->model('BarangModel', 'MBarang');
	}


	public function add()
	{
		$q = $this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$q = $this->data['listPIC'] = $this->MBarang->get_data('pic','');
		$this->data['msg'] = '';

		$submit = $this->input->post('submit');

		if($submit == 'Tambah'){
			$id_creator = 1;
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
			$this->data['listOfPic'] = $listOfPic;

			//'nama' => $this->getNamaBarang($jenis_barang),
			$data = array(
							'no_po' => $this->data['no_po'],
							'no_asset' => $this->data['no_asset'],
							'no_it' => $this->data['no_it'],
							'type' => $this->data['type'],
							'merk' => $this->input->post('merk'),
							'vendor' => $this->data['merk'],
							'tgl_terima' => $this->data['tgl_terima'],
							'pic' => $this->data['listOfPic'],
							'id_creator' => $id_creator,
							'time_create' => date('Y-m-d H:i:s')
						);

			if($jenis_barang == 1){
				//cpu
				$this->data['service_tag'] = $this->input->post('service_tag');
				$this->data['sn_cpu'] = $this->input->post('sn_cpu');
				$data = array_merge($data, array('service_tag' => $this->data['service_tag'],
													'sn' => $this->data['sn_cpu']
									 ));
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
				$data = array_merge($data, 
						array('sn_lp' => $this->data['sn_laptop'],
								'sn_hd' => $this->data['sn_hd'],
								'sn_baterai' => $this->data['sn_baterai'],
								'sn_charger' => $this->data['sn_charger'],
								'nama_laptop' => $this->data['nama_laptop'],
								'kode_laptop' => $this->data['kode_laptop']
							));

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
