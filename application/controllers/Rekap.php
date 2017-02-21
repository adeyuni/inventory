<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rekap extends CI_Controller {

	private $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('BarangModel', 'MBarang');
		$this->load->model('RekapModel', 'MRekap');
		if (!$this->load->check_session_admin()) return;
	}

	public function index()
	{
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['listPO'] = $this->MBarang->get_data_table('rekap', '', 'rekap_id', 'desc');
		$this->data['title'] = 'Daftar Rekap PO';
		$this->load->template('rekap/v_list_rekap', $this->data);
	}

	public function add()
	{
		$this->data['isEditing'] = false;
		$this->data['diterima_supplier'] = null;
		$this->data['sub_lokasi'] = 0;
		$this->data['invoice'] = null;
		$this->data['additional'] = "input_rekap.php";
		$this->data['jmlBarang'] = 0;
		$this->data['jmlDO'] = 0;
		$this->data['action'] = 'rekap/save/add/';
		$this->data['listLocation'] = $this->MBarang->get_data('location','');
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['title'] = "Tambah Rekap Data";
		$this->load->template('rekap/v_tambah_rekap', $this->data);
	}

	public function get_sub_location($location_id = null)
	{
		$this->data['listSubLocation'] = $this->MBarang->get_data('dtl_location',array('location_dtl_location_id' => $location_id) );
		$this->load->view('ajax/v_sub_location',$this->data);
	}

	public function detail($id = null)
	{
		$this->data['additional'] = "input_rekap.php";
		$this->data['url_edit'] = "/rekap/edit/".$id;
		
		$this->data['detailRekapDtl'] = $this->MBarang->get_data('rekap_dtl',array('rekap_dtl_id_rekap' => $id));
		$this->data['detailRekap'] = $this->MBarang->get_data('rekap',array('rekap_id' => $id));
		$this->data['detailDO'] = $this->MBarang->get_data('do_dtl',array('do_dtl_rekap_id' => $id));

		$jmlDtl = 0;
		foreach($this->data['detailRekapDtl']->result() as $row){
			$this->data['dtl_nama'][] = $row->rekap_dtl_nama;
			$this->data['dtl_harga'][] = $row->rekap_dtl_harga;
			$jml = $this->data['dtl_jml'][] = $row->rekap_dtl_jml;
			$count_cpu = $this->MRekap->count_beredar('cpu', 'rekap_dtl', 'cpu_rekap_dtl_id = rekap_dtl_id', array('rekap_dtl_id' => $row->rekap_dtl_id, 'cpu_status' => 1) );
			$count_imac = $this->MRekap->count_beredar('imac', 'rekap_dtl', 'imac_rekap_dtl_id = rekap_dtl_id', array('rekap_dtl_id' => $row->rekap_dtl_id, 'imac_status' => 1) );
			$count_laptop = $this->MRekap->count_beredar('laptop', 'rekap_dtl', 'laptop_rekap_dtl_id = rekap_dtl_id', array('rekap_dtl_id' => $row->rekap_dtl_id, 'laptop_status' => 1) );
			$count_smartphone = $this->MRekap->count_beredar('smartphone', 'rekap_dtl', 'smartphone_rekap_dtl_id = rekap_dtl_id', array('rekap_dtl_id' => $row->rekap_dtl_id, 'smartphone_status' => 1) );
			$count_barang = $this->MRekap->count_beredar('barang', 'rekap_dtl', 'barang_rekap_dtl_id = rekap_dtl_id', array('rekap_dtl_id' => $row->rekap_dtl_id, 'barang_status' => 1) );

			$beredar = $this->data['dtl_beredar'][] = $count_barang + $count_cpu + $count_imac + $count_laptop + $count_smartphone;
			$this->data['dtl_sisa'][] = $jml - $beredar;
			$this->data['dtl_type'][] = $row->rekap_dtl_type;
			$this->data['dtl_merk'][] = $row->rekap_dtl_merk;
			$jmlDtl++;
		}	
		$this->data['jmlDtl'] = $jmlDtl;
		foreach($this->data['detailRekap']->result() as $row){
			$this->data['id_rekap'] = $id;
			$this->data['no_po'] = $row->rekap_no_po;
			$this->data['no_cp'] = $row->rekap_cp;
			$this->data['vendor'] = $row->rekap_vendor;
			$this->data['diterima_supplier'] = $this->get_status($row->rekap_diterima_supplier);
			$this->data['invoice'] = $this->get_status($row->rekap_invoice);
			$this->data['tgl_terima'] = $row->rekap_tgl_terima;
			$this->data['time_create'] = $row->rekap_time_create;
			$this->data['creator'] = $this->_get_username($row->rekap_id_creator);
			
			if($row->rekap_lokasi != 0){
				$this->data['location'] = $this->get_location_name('location',$row->rekap_lokasi);
				$this->data['sub_location'] = $this->get_location_name('sub_location',$row->rekap_sub_lokasi);
			}

			if(isset($row->rekap_id_editor)){
				$this->data['time_edit'] = $row->rekap_time_edit;
				$this->data['editor'] = $this->_get_username($row->rekap_id_editor);
			}
		}

		$this->data['listLocation'] = $this->MBarang->get_data('location','');
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['title'] = "Detail PO ".$this->data['no_po'];
		$this->load->template('rekap/v_detail_rekap', $this->data);
	}
	
	private function _get_jenis_barang($id = null)
	{
		$q = $this->MBarang->get_data('type_barang', array('id' => $id) );

		foreach($q->result() as $row){
			$nama = $row->nama;
		}

		return $nama;
	}

	public function delete($id = null)
	{
		if($this->MBarang->is_exist('cpu', array('cpu_no_po' => $id)) == true){
			$q_cpu = $this->MBarang->get_data('cpu', array('cpu_no_po' => $id) );
			foreach($q_cpu->result() as $row){
				$this->data['jenis'][] = "CPU";
				$this->data['sn'][] = $row->cpu_service_tag;
			}
		}

		if($this->MBarang->is_exist('laptop', array('laptop_no_po' => $id)) == true){
			$q_laptop = $this->MBarang->get_data('laptop', array('laptop_no_po' => $id) );
			foreach($q_laptop->result() as $row){
				$this->data['jenis'][] = "Laptop";
				$this->data['sn'][] = $row->laptop_sn_lp;
			}
		}
		
		if($this->MBarang->is_exist('imac', array('imac_no_po' => $id)) == true){
			$q_imac = $this->MBarang->get_data('imac', array('imac_no_po' => $id) );
			foreach($q_imac->result() as $row){
				$this->data['jenis'][] = "Imac";
				$this->data['sn'][] = $row->imac_sn;
			}
		}

		if($this->MBarang->is_exist('barang', array('barang_no_po' => $id)) == true){
			$q_barang = $this->MBarang->get_data('barang', array('barang_no_po' => $id) );

			foreach($q_barang->result() as $row){
				$this->data['jenisBarang'][] = $this->_get_jenis_barang($row->barang_jenis_barang_id);
				$this->data['snBarang'][] = $row->barang_sn;
			}
		}

		if($this->MBarang->is_exist('smartphone', array('smartphone_no_po' => $id)) == true){
			$q_smartphone = $this->MBarang->get_data('smartphone', array('smartphone_no_po' => $id) );

			foreach($q_smartphone->result() as $row){
				$this->data['jenis'][] = "Smartphone";
				$this->data['sn'][] = $row->smartphone_sn;
			}
		}

		$this->data['rekap_id'] = $id;
		$this->data['title'] = "Delete PO ";
		$this->load->template('rekap/v_delete_rekap', $this->data);
	}

	public function process_delete_rekap($id = null)
	{
		$this->db->trans_start();
		$this->MBarang->delete('rekap', 'rekap_id', $id);
		$this->MBarang->delete('rekap_dtl', 'rekap_dtl_id_rekap', $id);
		$this->MBarang->delete('barang', 'barang_no_po', $id);
		$this->MBarang->delete('cpu', 'cpu_no_po', $id);
		$this->MBarang->delete('laptop', 'laptop_no_po', $id);
		$this->MBarang->delete('imac', 'imac_no_po', $id);
		$this->MBarang->delete('smartphone', 'smartphone_no_po', $id);
		$this->db->trans_complete();

		if ($this->db->trans_status() === TRUE)
		{
			$this->data['msg'] = "<div class='alert bg-success' role='alert'>
				<svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data berhasil Dihapus.
			</div>";
			$this->session->set_flashdata('msg', $this->data['msg']);
		}else{
			$this->data['msg'] = "<div class='alert bg-danger' role='alert'>
				<svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal ditambahkan, silahkan ulangi lagi.
			</div>";
			$this->session->set_flashdata('msg', $this->data['msg']);
		}
		redirect(site_url('rekap'),'refresh');
		
	}

	public function edit($id = null)
	{
		$this->data['additional'] = "input_rekap.php";
		$this->data['isEditing'] = true;

		$this->data['detailRekapDtl'] = $this->MBarang->get_data('rekap_dtl',array('rekap_dtl_id_rekap' => $id));
		$this->data['detailRekap'] = $this->MBarang->get_data('rekap',array('rekap_id' => $id));
		$this->data['detailDO'] = $this->MBarang->get_data('do_dtl',array('do_dtl_rekap_id' => $id));

		foreach($this->data['detailRekap']->result() as $row){
			$this->data['id_rekap'] = $id;
			$this->data['no_po'] = $row->rekap_no_po;
			$this->data['no_cp'] = $row->rekap_cp;
			$this->data['vendor'] = $row->rekap_vendor;
			$this->data['location'] = $row->rekap_lokasi;
			$this->data['sub_lokasi'] = $row->rekap_sub_lokasi;
			$this->data['listSubLocation'] = $this->MBarang->get_data('dtl_location',array('location_dtl_location_id' => $this->data['location']) );
			$this->data['diterima_supplier'] = $row->rekap_diterima_supplier;
			$this->data['invoice'] = $row->rekap_invoice;
			$this->data['tgl_terima'] = $row->rekap_tgl_terima;
		}

		$jmlBarang = 0;
		foreach ($this->data['detailRekapDtl']->result() as $row) {

			$this->data['id_dtl'][$jmlBarang] = $row->rekap_dtl_id;
			$this->data['nama_barang'][$jmlBarang] = $row->rekap_dtl_nama;
			$this->data['harga'][$jmlBarang] = $row->rekap_dtl_harga;
			$this->data['jml'][$jmlBarang] = $row->rekap_dtl_jml;
			$this->data['type'][$jmlBarang] = $row->rekap_dtl_type;
			$this->data['merk'][$jmlBarang] = $row->rekap_dtl_merk;
			$jmlBarang++;
		}

		$jmlDO = 0;
		foreach ($this->data['detailDO']->result() as $row) {

			$this->data['no_do_id'][$jmlDO] = $row->do_dtl_id;
			$this->data['no_do'][$jmlDO] = $row->do_dtl_no_do;
			$this->data['ket'][$jmlDO] = $row->do_dtl_ket;
			$jmlDO++;
		}

		$this->data['jmlBarang'] = $jmlBarang;
		$this->data['jmlDO'] = $jmlDO;
		$this->data['action'] = 'rekap/save/edit/'.$id;
		$this->data['listLocation'] = $this->MBarang->get_data('location','');
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['title'] = "Edit Rekap Data";
		$this->load->template('rekap/v_tambah_rekap', $this->data);
	}

	public function deleteDtlBarang($id_rekap = null, $id_dtl = null)
	{
		$delete = $this->MBarang->delete_dtl_barang($id_rekap, $id_dtl);

		if($delete){
			$this->data['msg'] = "<div class='alert bg-success' role='alert'>
					<svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data berhasil dihapus.
				</div>";
				$this->session->set_flashdata('msg', $this->data['msg']);
		}else{
			$this->data['msg'] = "<div class='alert bg-danger' role='alert'>
				<svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal dihapus, silahkan ulangi lagi.
			</div>";
			$this->session->set_flashdata('msg', $this->data['msg']);
		}
		redirect(site_url('rekap/edit/'.$id_rekap),'refresh');
	}

	public function deleteDO($id_rekap = null, $id_dtl = null)
	{
		$delete = $this->MBarang->delete_do_barang($id_rekap, $id_dtl);

		if($delete){
			$this->data['msg'] = "<div class='alert bg-success' role='alert'>
					<svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data berhasil dihapus.
				</div>";
				$this->session->set_flashdata('msg', $this->data['msg']);
		}else{
			$this->data['msg'] = "<div class='alert bg-danger' role='alert'>
				<svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal dihapus, silahkan ulangi lagi.
			</div>";
			$this->session->set_flashdata('msg', $this->data['msg']);
		}
		redirect(site_url('rekap/edit/'.$id_rekap),'refresh');
	}

	public function save($param1 = null, $id = null)
	{
		$this->data['no_po'] = $this->input->post('no_po');
		$this->data['cp'] = $this->input->post('no_cp');
		$this->data['vendor'] = $this->input->post('vendor');
		$this->data['lokasi'] = $this->input->post('lokasi');
		$this->data['sub_lokasi'] = $this->input->post('sub_lokasi');
		$this->data['diterima_supplier'] = $this->input->post('diterima_supplier');
		$this->data['invoice'] = $this->input->post('invoice');
		$this->data['tgl_terima'] = $this->input->post('tgl_terima');
		$data = array('rekap_no_po' => $this->data['no_po'],
						'rekap_cp' => $this->data['cp'],
						'rekap_vendor' => $this->data['vendor'],
						'rekap_lokasi' => $this->data['lokasi'],
						'rekap_sub_lokasi' => $this->data['sub_lokasi'],
						'rekap_diterima_supplier' => $this->data['diterima_supplier'],
						'rekap_invoice' => $this->data['invoice'],
						'rekap_tgl_terima' => $this->data['tgl_terima']
						);


		if($param1 == 'add'){
			$data = array_merge($data, array('rekap_id_creator' => $_SESSION["user_id"],
												'rekap_time_create' => date('Y-m-d H:i:s') ));
			$this->db->trans_start();
			$insert = $this->MBarang->insert_rekap('rekap', $data);
			$data_barang = $this->input->post('nama_barang');

			//insert to rekap_dtl
			foreach ($data_barang as $key=>$value) {
				if($this->input->post('nama_barang['.$key.']')!=""){
						$this->data['nama_barang'][$key] = $this->input->post('nama_barang['.$key.']');
						$this->data['harga'][$key] = $this->input->post('harga['.$key.']');
						$this->data['jml'][$key] = $this->input->post('jml['.$key.']');
						$this->data['type'][$key] = $this->input->post('type['.$key.']');
						$this->data['merk'][$key] = $this->input->post('merk['.$key.']');

						$data2 = array('rekap_dtl_id_rekap' => $insert['rekap_id'],
										'rekap_dtl_nama' => $this->data['nama_barang'][$key],
										'rekap_dtl_harga' => $this->data['harga'][$key],
										'rekap_dtl_jml' => $this->data['jml'][$key],
										'rekap_dtl_type' => $this->data['type'][$key],
										'rekap_dtl_merk' => $this->data['merk'][$key]
										);
						$query = $this->MBarang->add('rekap_dtl', $data2);
				}
			}

			$is_do = $this->input->post('is_do');
			if($is_do == 1){
				$no_do = $this->input->post('no_do');

				//insert to do_dtl
				foreach ($no_do as $key=>$value) {
					if($this->input->post('no_do['.$key.']')!=""){
							$this->data['no_do'][$key] = $this->input->post('no_do['.$key.']');
							$this->data['ket'][$key] = $this->input->post('ket['.$key.']');

							$data3 = array('do_dtl_rekap_id' => $insert['rekap_id'],
											'do_dtl_no_do' => $this->data['no_do'][$key],
											'do_dtl_ket' => $this->data['ket'][$key]
											);
							$query = $this->MBarang->add('do_dtl', $data3);
					}
				}
			}
			

			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE)
			{
				$this->data['msg'] = "<div class='alert bg-success' role='alert'>
					<svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data berhasil ditambahkan.
				</div>";
				$this->session->set_flashdata('msg', $this->data['msg']);
			}else{
				$this->data['msg'] = "<div class='alert bg-danger' role='alert'>
					<svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal ditambahkan, silahkan ulangi lagi.
				</div>";
				$this->session->set_flashdata('msg', $this->data['msg']);
			}
			redirect(site_url('rekap/add'),'refresh');
		}
		elseif($param1 == 'edit'){
			$data = array_merge($data, array('rekap_id_editor' => $_SESSION["user_id"],
												'rekap_time_edit' => date('Y-m-d H:i:s') ));
			$this->db->trans_start();
			//first update on rekap table
			$insert = $this->MBarang->update_rekap($id, $data);
			//second, delete all detail barang on rekap_dtl
			//$deleteRekap = $this->MBarang->delete('rekap_dtl', 'rekap_dtl_id_rekap', $id);
			//third, delete all no do on do_dtl
			$deleteDO = $this->MBarang->delete('do_dtl', 'do_dtl_rekap_id', $id);

			$data_barang = $this->input->post('nama_barang');
			
			//last, update on data rekap_dtl, with insert data
			foreach ($data_barang as $key=>$value) {
				if($this->input->post('nama_barang['.$key.']')!=""){
						$this->data['nama_barang'][$key] = $this->input->post('nama_barang['.$key.']');
						$this->data['harga'][$key] = $this->input->post('harga['.$key.']');
						$this->data['jml'][$key] = $this->input->post('jml['.$key.']');
						$this->data['type'][$key] = $this->input->post('type['.$key.']');
						$this->data['merk'][$key] = $this->input->post('merk['.$key.']');
						$data2 = array('rekap_dtl_id_rekap' => $id,
										'rekap_dtl_nama' => $this->data['nama_barang'][$key],
										'rekap_dtl_harga' => $this->data['harga'][$key],
										'rekap_dtl_jml' => $this->data['jml'][$key],
										'rekap_dtl_type' => $this->data['type'][$key],
										'rekap_dtl_merk' => $this->data['merk'][$key]
										);

						$id_dtl = $this->input->post('id_dtl['.$key.']');

						$query = $this->MBarang->update_table("rekap_dtl_id", $id_dtl, "rekap_dtl", $data2);
				}
			} 

			$is_do = $this->input->post('is_do');
			if($is_do == 1){
				$data_do = $this->input->post('no_do');
				//update detail do
				foreach ($data_do as $key=>$value) {
					if($this->input->post('no_do['.$key.']')!=""){
							$this->data['no_do'][$key] = $this->input->post('no_do['.$key.']');
							$this->data['ket'][$key] = $this->input->post('ket['.$key.']');
							$data3 = array('do_dtl_rekap_id' => $id,
											'do_dtl_no_do' => $this->data['no_do'][$key],
											'do_dtl_ket' => $this->data['ket'][$key]
											);
							$query = $this->MBarang->add('do_dtl', $data3);
					}
				} 
			}
			$this->db->trans_complete();
			if ($this->db->trans_status() === TRUE)
			{
				$this->data['msg'] = "<div class='alert bg-success' role='alert'>
					<svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data berhasil diupdate.
				</div>";
				$this->session->set_flashdata('msg', $this->data['msg']);
			}else{
				$this->data['msg'] = "<div class='alert bg-danger' role='alert'>
					<svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg> Data gagal diperbarui, silahkan ulangi lagi.
				</div>";
				$this->session->set_flashdata('msg', $this->data['msg']);
			}
			redirect(site_url('rekap/edit/'.$id),'refresh');
		}
	}

	private function get_location_name($type = null, $id = null)
	{
		if($type == "location"){
			$q = $this->MBarang->get_data('location',array('location_id' => $id));
			foreach($q->result() as $row){	
				$name = $row->location_nama;
			}
		}else{
			$q = $this->MBarang->get_data('dtl_location',array('location_dtl_id' => $id));
			foreach($q->result() as $row){	
				$name = $row->location_dtl_nama;
			}
		}
		return $name;
	}

	private function _get_username($id = null)
	{
		$q = $this->MBarang->get_data('user',array('user_id' => $id));
		foreach($q->result() as $row){	
			$name = $row->user_username;
		}	
		return $name;
	}

	private function get_status($id)
	{
		if($id == 0){
			return "Belum";
		}else{
			return "Sudah";
		}
	}

}