<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rekap extends CI_Controller {

	private $data;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('BarangModel', 'MBarang');
	}

	public function index()
	{
		$this->data['listPO'] = $this->MBarang->get_data('rekap','');

		$this->data['title'] = 'Daftar Rekap PO';
		$this->load->template('rekap/v_list_rekap', $this->data);
	}

	public function add()
	{
		$this->data['isEditing'] = false;
		$this->data['additional'] = "input_rekap.php";
		$this->data['jmlBarang'] = 0;
		$this->data['action'] = 'rekap/save/add/';
		$this->data['listLocation'] = $this->MBarang->get_data('location','');
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['title'] = "Tambah Rekap Data";
		$this->load->template('rekap/v_tambah_rekap', $this->data);
	}

	public function edit($id = null)
	{
		$this->data['additional'] = "input_rekap.php";
		$this->data['isEditing'] = true;
		
		$this->data['detailRekapDtl'] = $this->MBarang->get_data('rekap_dtl',array('rekap_dtl_id_rekap' => $id));
		$this->data['detailRekap'] = $this->MBarang->get_data('rekap',array('rekap_id' => $id));

		foreach($this->data['detailRekap']->result() as $row){
			$this->data['id_rekap'] = $id;
			$this->data['no_po'] = $row->rekap_no_po;
			$this->data['no_cp'] = $row->rekap_cp;
			$this->data['vendor'] = $row->rekap_vendor;
			$this->data['location'] = $row->rekap_lokasi;
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
			$jmlBarang++;
		}
		$this->data['jmlBarang'] = $jmlBarang;
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

	public function save($param1 = null, $id = null)
	{
		$this->data['no_po'] = $this->input->post('no_po');
		$this->data['cp'] = $this->input->post('no_cp');
		$this->data['vendor'] = $this->input->post('vendor');
		$this->data['lokasi'] = $this->input->post('lokasi');
		$this->data['diterima_supplier'] = $this->input->post('diterima_supplier');
		$this->data['invoice'] = $this->input->post('invoice');
		$this->data['tgl_terima'] = $this->input->post('tgl_terima');
		$data = array('rekap_no_po' => $this->data['no_po'],
						'rekap_cp' => $this->data['cp'],
						'rekap_vendor' => $this->data['vendor'],
						'rekap_lokasi' => $this->data['lokasi'],
						'rekap_diterima_supplier' => $this->data['diterima_supplier'],
						'rekap_invoice' => $this->data['invoice'],
						'rekap_tgl_terima' => $this->data['tgl_terima']
						);


		if($param1 == 'add'){
			$data = array_merge($data, array('rekap_id_creator' => 1,
												'rekap_time_create' => date('Y-m-d H:i:s') ));
			$this->db->trans_start();
			$insert = $this->MBarang->insert_rekap('rekap', $data);
			$data_barang = $this->input->post('nama_barang');

			foreach ($data_barang as $key=>$value) {
				if($this->input->post('nama_barang['.$key.']')!=""){
						$this->data['nama_barang'][$key] = $this->input->post('nama_barang['.$key.']');
						$this->data['harga'][$key] = $this->input->post('harga['.$key.']');
						$this->data['jml'][$key] = $this->input->post('jml['.$key.']');

						$data2 = array('rekap_dtl_id_rekap' => $insert['rekap_id'],
										'rekap_dtl_nama' => $this->data['nama_barang'][$key],
										'rekap_dtl_harga' => $this->data['harga'][$key],
										'rekap_dtl_jml' => $this->data['jml'][$key]
										);
						$query = $this->MBarang->add('rekap_dtl', $data2);
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
			$data = array_merge($data, array('rekap_id_editor' => 1,
												'rekap_time_edit' => date('Y-m-d H:i:s') ));
			$this->db->trans_start();
			//first update on rekap table
			$insert = $this->MBarang->update_rekap($id, $data);
			//second, delete all detail barang on rekap_dtl
			$delete = $this->MBarang->delete('rekap_dtl', 'rekap_dtl_id_rekap', $id);
			$data_barang = $this->input->post('nama_barang');
			//last, update on data rekap_dtl, with insert data
			foreach ($data_barang as $key=>$value) {
				if($this->input->post('nama_barang['.$key.']')!=""){
						$this->data['nama_barang'][$key] = $this->input->post('nama_barang['.$key.']');
						$this->data['harga'][$key] = $this->input->post('harga['.$key.']');
						$this->data['jml'][$key] = $this->input->post('jml['.$key.']');
						$data2 = array('rekap_dtl_id_rekap' => $id,
										'rekap_dtl_nama' => $this->data['nama_barang'][$key],
										'rekap_dtl_harga' => $this->data['harga'][$key],
										'rekap_dtl_jml' => $this->data['jml'][$key]
										);
						$query = $this->MBarang->add('rekap_dtl', $data2);
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

}