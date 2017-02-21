<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class barang extends CI_Controller {

	const TABLE_BARANG = "barang";
	const CREATOR = 1;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('BarangModel', 'MBarang');
		if (!$this->load->check_session_admin()) return;
	}

	private function _get_kondisi()
	{
		$q = $this->MBarang->get_data('kondisi','');
		
		$i = 1;
		foreach($q->result() as $row){
			$data[$i] = $row->kondisi_status;
			$i++;
		}

		return $data;
	}


	public function daftar($jenis_barang = null, $status = null)
	{
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['listStatus'] = $this->MBarang->get_data('status','');
		$this->data['kondisi'] = $this->_get_kondisi();

		if($status == null){
			$status = 0;
		}
		if($jenis_barang == 1){
			$this->data['listSelectedBarang'] = "v_list_cpu.php";
			$this->data['listCPU'] = $this->MBarang->get_five_table('cpu', 'rekap', 'rekap_dtl', 'location', 'department', 'cpu_no_po = rekap_id', 'cpu_rekap_dtl_id = rekap_dtl_id','cpu_location = location_id','cpu_department = department_id', 'cpu_id', 'desc', 'cpu_status', $status);
		}elseif($jenis_barang == 100){
			$this->data['listSelectedBarang'] = "v_list_laptop.php";
			$this->data['listLaptop'] = $this->MBarang->get_five_table('laptop', 'rekap', 'rekap_dtl', 'location', 'department', 'laptop_no_po = rekap_id', 'laptop_rekap_dtl_id = rekap_dtl_id','laptop_location = location_id','laptop_department = department_id', 'laptop_id', 'desc', 'laptop_status', $status);
		}elseif($jenis_barang == 200){
			$this->data['listSelectedBarang'] = "v_list_smartphone.php";
			$this->data['listSmartphone'] = $this->MBarang->get_five_table('smartphone', 'rekap', 'rekap_dtl', 'location', 'department', 'smartphone_no_po = rekap_id', 'smartphone_rekap_dtl_id = rekap_dtl_id','smartphone_location = location_id','smartphone_department = department_id', 'smartphone_id', 'desc', 'smartphone_status', $status);
		}elseif($jenis_barang == 300){
			$this->data['listSelectedBarang'] = "v_list_imac.php";
			$this->data['listIMAC'] = $this->MBarang->get_five_table('imac', 'rekap', 'rekap_dtl', 'location', 'department', 'imac_no_po = rekap_id', 'imac_rekap_dtl_id = rekap_dtl_id','imac_location = location_id','imac_department = department_id', 'imac_id', 'desc', 'imac_status', $status);
		}else{
			$this->data['jenis_barang'] = $jenis_barang;
			$this->data['listSelectedBarang'] = "v_list_barang2.php";
			$this->data['listBarang2'] = $this->MBarang->search_barang('barang', 'rekap', 'rekap_dtl', 'location', 'department', 'barang_no_po = rekap_id', 'barang_rekap_dtl_id = rekap_dtl_id','barang_location = location_id','barang_department = department_id', 'barang_id', 'desc', 'barang_jenis_barang_id', $jenis_barang, 'barang_status', $status);
		}

		$this->data['jenis_barang'] = $jenis_barang;
		$this->data['status'] = $status;
		$this->data['additional'] = "include/plus_daftar_barang.php";
		$this->data['title'] = 'Daftar Barang';
		$this->load->template('barang/list/v_list_barang', $this->data);
	}


	
	private function _get_nama_jenis_barang($jenis_barang_id = null)
	{
		$query = $this->MBarang->get_data('type_barang', array('id' => $jenis_barang_id) );

		foreach($query->result() as $row){
			$nama = $row->nama;
		}

		return $nama;
	}

	//function for search something
	private function _get_sn($table = null, $id_s = null, $id = null, $column = null)
	{
		$q = $this->MBarang->get_data($table,array($id_s => $id));

		foreach($q->result() as $row){
			$name = $row->$column;
		}
		return $name;
	}

	public function assigment($jenis_barang = null, $id = null)
	{
		$this->data['title'] = 'Serah Terima Barang';
		$this->data['selectedJenisBarang'] = $jenis_barang;
		$this->data['listJenisBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['listLocation'] = $this->MBarang->get_data('location ','');
		$this->data['listSubLocation'] = $this->MBarang->get_data('dtl_location ','');
		$this->data['listDepartment'] = $this->MBarang->get_data('department ','');
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
		$this->data['selectedDepartment'] = null;
		$this->data['selectedDongle'] = null;
		$this->data['sub_lokasi'] = 0;
		$this->data['isEditing'] = true;
		if($jenis_barang == 1){

			$this->data['listCPU'] = $this->MBarang->get_data('cpu',array('cpu_status' => 0));
			$this->data['listMonitor'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 2));
			$this->data['listKeyboard'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 3));
			$this->data['listMouse'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 4));
			$this->data['listUPS'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 5));
			$this->data['listDongle'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 6));
			$this->data['formAssigmentBarang'] = "additional/v_form_assigment_cpu.php";

			$qq = $this->MBarang->get_data('as_cpu',array('as_cpu_cpu_id' => $id));

			$this->data['cpu_id'] = $id;
			$this->data['cpu_service_tag'] = $this->_get_sn('cpu', 'cpu_id', $id, 'cpu_service_tag');
			$this->data['cpu_hostname'] = $this->_get_sn('cpu', 'cpu_id', $id, 'cpu_hostname');
			$this->data['user'] = $this->_get_sn('cpu', 'cpu_id', $id, 'cpu_user');
			$this->data['selectedDepartment'] = $this->_get_sn('cpu', 'cpu_id', $id, 'cpu_department');
			$this->data['selectedLocation'] = $this->_get_sn('cpu', 'cpu_id', $id, 'cpu_location');
			$this->data['sub_lokasi'] = $this->_get_sn('cpu', 'cpu_id', $id, 'cpu_sub_location');
			//echo $this->data['sub_lokasi'];
			foreach($qq->result() as $row){
				$this->data['id_mon1'] = $row->as_cpu_mon1_id;
				if($row->as_cpu_mon1_id != 0){
					$this->data['sn_mon1'] = $this->_get_sn('barang', 'barang_id', $row->as_cpu_mon1_id, 'barang_sn');
				}

				$this->data['id_mon2'] = $row->as_cpu_mon2_id;
				if($row->as_cpu_mon2_id != 0){
					$this->data['sn_mon2'] = $this->_get_sn('barang', 'barang_id', $row->as_cpu_mon2_id, 'barang_sn');
				}
				
				$this->data['id_mouse'] = $row->as_cpu_mouse_id;
				if($row->as_cpu_mouse_id != 0){
					$this->data['sn_mouse'] = $this->_get_sn('barang', 'barang_id', $row->as_cpu_mouse_id, 'barang_sn');
				}
				
				$this->data['id_keyboard'] = $row->as_cpu_keyboard_id;
				if($row->as_cpu_keyboard_id != 0){
					$this->data['sn_keyboard'] = $this->_get_sn('barang', 'barang_id', $row->as_cpu_keyboard_id, 'barang_sn');
				}

				$this->data['id_dongle'] = $row->as_cpu_dongle_id;
				if($row->as_cpu_dongle_id != 0){
					$this->data['sn_dongle'] = $this->_get_sn('barang', 'barang_id', $row->as_cpu_dongle_id, 'barang_sn');
				}

				$this->data['id_ups'] = $row->as_cpu_ups_id;
				if($row->as_cpu_ups_id != 0){
					$this->data['sn_ups'] = $this->_get_sn('barang', 'barang_id', $row->as_cpu_ups_id, 'barang_sn');
				}
			}
		}elseif($jenis_barang == 100){
			$this->data['listLaptop'] = $this->MBarang->get_data('laptop',array('laptop_status' => 0));
			$this->data['listMonitor'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 2));
			$this->data['listMouse'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 4));
			$this->data['formAssigmentBarang'] = "additional/v_form_assigment_laptop.php";

			$qq = $this->MBarang->get_data('as_laptop',array('as_laptop_laptop_id' => $id));

			$this->data['laptop_id'] = $id;
			$this->data['user'] = $this->_get_sn('laptop', 'laptop_id', $id, 'laptop_user');
			$this->data['laptop_sn_lp'] = $this->_get_sn('laptop', 'laptop_id', $id, 'laptop_sn_lp');
			$this->data['nama_laptop'] = $this->_get_sn('laptop', 'laptop_id', $id, 'laptop_nama');
			$this->data['kode_laptop'] = $this->_get_sn('laptop', 'laptop_id', $id, 'laptop_kode');
			$this->data['selectedDepartment'] = $this->_get_sn('laptop', 'laptop_id', $id, 'laptop_department');
			$this->data['selectedLocation'] = $this->_get_sn('laptop', 'laptop_id', $id, 'laptop_location');
			$this->data['sub_lokasi'] = $this->_get_sn('laptop', 'laptop_id', $id, 'laptop_sub_location');

			foreach($qq->result() as $row){
				$this->data['id_mon1'] = $row->as_laptop_mon_id;
				if($row->as_laptop_mon_id != 0){
					$this->data['sn_mon1'] = $this->_get_sn('barang', 'barang_id', $row->as_laptop_mon_id, 'barang_sn');
				}
				$this->data['id_mouse'] = $row->as_laptop_mouse_id;
				if($row->as_laptop_mouse_id != 0){
					$this->data['sn_mouse'] = $this->_get_sn('barang', 'barang_id', $row->as_laptop_mouse_id, 'barang_sn');
				}
			}
		}elseif($jenis_barang == 200){

			$this->data['smartphone_id'] = $id;
			$this->data['user'] = $this->_get_sn('smartphone', 'smartphone_id', $id, 'smartphone_user');
			$this->data['smartphone_sn'] = $this->_get_sn('smartphone', 'smartphone_id', $id, 'smartphone_sn');
			$this->data['selectedDepartment'] = $this->_get_sn('smartphone', 'smartphone_id', $id, 'smartphone_department');
			$this->data['selectedLocation'] = $this->_get_sn('smartphone', 'smartphone_id', $id, 'smartphone_location');
			$this->data['sub_lokasi'] = $this->_get_sn('smartphone', 'smartphone_id', $id, 'smartphone_sub_location');

			$this->data['listSmartphone'] = $this->MBarang->get_data('smartphone',array('smartphone_status' => 0));
			$this->data['formAssigmentBarang'] = "additional/v_form_assigment_smartphone.php";
		}elseif($jenis_barang == 300){
			$this->data['listIMAC'] = $this->MBarang->get_data('imac',array('imac_status' => 0));
			$this->data['listUPS'] = $this->MBarang->get_data('barang',array('barang_status' => 0, 'barang_jenis_barang_id' => 5));
			$this->data['formAssigmentBarang'] = "additional/v_form_assigment_imac.php";

			$qq = $this->MBarang->get_data('as_imac',array('as_imac_imac_id' => $id));

			$this->data['imac_id'] = $id;
			$this->data['imac_sn'] = $this->_get_sn('imac', 'imac_id', $id, 'imac_sn');
			$this->data['user'] = $this->_get_sn('imac', 'imac_id', $id, 'imac_user');
			$this->data['nama_imac'] = $this->_get_sn('imac', 'imac_id', $id, 'imac_nama');
			$this->data['selectedDepartment'] = $this->_get_sn('imac', 'imac_id', $id, 'imac_department');
			$this->data['selectedLocation'] = $this->_get_sn('imac', 'imac_id', $id, 'imac_location');
			$this->data['sub_lokasi'] = $this->_get_sn('imac', 'imac_id', $id, 'imac_sub_location');

			foreach($qq->result() as $row){
				$this->data['id_ups'] = $row->as_imac_ups_id;
				if($row->as_imac_ups_id != 0){
					$this->data['sn_ups'] = $this->_get_sn('barang', 'barang_id', $row->as_imac_ups_id, 'barang_sn');
				}
			}
		}

		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['additional'] = "include/plus_form_assigment.php";
		$this->data['action'] = 'assigment/save/edit/'.$jenis_barang.'/'.$id;
		$this->load->template('assigment/v_form_assigment', $this->data);
	}

	public function cetak_doc($jenis_dok = null, $jenis_barang = null, $data = null)
	{
		$this->load->library('excel');
		$file = "./assets/upload/tes/template.xls";

		// Create new PHPExcel object
		$objPHPExcel = PHPExcel_IOFactory::load($file);
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		//insert data
		$objWorksheet = $objPHPExcel->getActiveSheet();
		$nama = $data['user'];
		$no_dok = $this->_create_no_dok();
		
		$objWorksheet->setCellValue('C4', $no_dok);  //nomor
		$objWorksheet->setCellValue('H4', date('d/m/Y'));  //tanggal
		$objWorksheet->setCellValue('C6', $data['user']); //nama
		$objWorksheet->setCellValue('I7', $data['department']); //department
		$objWorksheet->setCellValue('A11', $data['kat_pemohon']); //kat pemohon

		//Detail Permohonan
		$objWorksheet->setCellValue('D14', $data['merk']); //merk
		$objWorksheet->setCellValue('D15', $data['type']); //type
		$objWorksheet->setCellValue('D16', $data['qty']); //qty
		$objWorksheet->setCellValue('D17', $data['lokasi_tujuan']); //lokasi tujuan
		$objWorksheet->setCellValue('D18', $data['periode_waktu']); //periode waktu

		//Informasi Aset
		$objWorksheet->setCellValue('D21', $data['lokasi_asal']); //lokasi asal
		$objWorksheet->setCellValue('D22', $data['no_asset_it']); //no asset dan IT
		$objWorksheet->setCellValue('D23', $data['produk_number']); //product number
		$objWorksheet->setCellValue('D24', $data['sn']); //serial number
		$objWorksheet->setCellValue('D25', $data['kondisi']); // kondisi
		$objWorksheet->setCellValue('D26', $data['upd_list']); // update lis
		$objWorksheet->setCellValue('D27', $data['tgl_penyerahan']); //tanggal penyerahan
		$objWorksheet->setCellValue('D28', $data['keterangan']); //keterangan

		$filename = "Form_".$nama.".xls";
		

		ob_end_clean(); //menghapus whitescoace
		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.ms-excel');
		header("Content-Disposition: attachment;filename=".$filename);
		header('Cache-Control: max-age=0');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');

		$data = array(	'history_dok_jenis_dok' => $jenis_dok,
						'history_dok_no_dok' => $no_dok,
						'history_dok_jenis_barang' => $jenis_barang,
						'history_dok_barang_id' => $data['id'],
						'history_dok_user' => $data['user'],
						'history_dok_create_id' => $_SESSION["user_id"],
						'history_dok_create_time' => date('Y-m-d H:i:s')
				);
		$this->MBarang->add('history_dok', $data);
		exit;
	}

	public function detail($jenis_barang = null, $id = null, $param = null)
	{
		$this->data['isDelete'] = false;
		$this->data['isExist'] = false;
		if($param == 'delete'){
			$this->data['isDelete'] = true;
		}

		$this->data['jenis_barang2'] = $jenis_barang;
		$this->data['jenis_barang'] = $this->_get_nama_jenis_barang($jenis_barang);
		$qty = 0;

		$jenis_barang_temp = $jenis_barang;
		if($jenis_barang == 1){
			
			$query = $this->MBarang->search_detail('cpu', 'rekap', 'rekap_dtl', 'location', 'department','cpu_no_po = rekap_id', 'cpu_rekap_dtl_id = rekap_dtl_id','cpu_location = location_id','cpu_department = department_id', 'rekap_id', 'asc', 'cpu_id', $id);
			
			foreach ($query->result() as $row) {
				$qty++;
				$this->data['id_po'] = $row->rekap_id;
				$this->data['id_rekap_dtl'] = $row->rekap_dtl_id;
				$this->data['no_po'] = $row->rekap_no_po;
				$this->data['no_asset'] = $row->cpu_no_asset;
				$this->data['no_it'] = $row->cpu_no_it;
				$this->data['sn_cpu'] = $row->cpu_sn;
				$this->data['type'] = $row->rekap_dtl_type;
				$this->data['merk'] = $row->rekap_dtl_merk;
				$this->data['vendor'] = $row->rekap_vendor;
				$this->data['tgl_terima'] = $row->rekap_tgl_terima;
				$this->data['location'] = $row->location_nama;
				$this->data['user'] = $row->cpu_user;
				$this->data['hostname'] = $row->cpu_hostname;
				$this->data['service_tag'] = $row->cpu_service_tag;
				$this->data['department'] = $row->department_nama;
				$this->data['creator'] = $this->_get_username($row->cpu_id_creator);
				$this->data['time_create'] = $row->cpu_time_create;
				$this->data['ket'] = $row->cpu_ket;
				$this->data['cpu_id'] = $row->cpu_id;
				if(isset($row->cpu_id_editor)){
					$this->data['editor'] = $this->_get_username($row->cpu_id_editor);
					$this->data['time_edit'] = $row->cpu_time_edit;
				}

				$no_asset_it = $this->data['no_asset']." ".$this->data['no_it'];
				$sn = $this->data['service_tag']." (CPU)";
			}

			$cek = $this->MBarang->is_exist('as_cpu', array('as_cpu_cpu_id' =>  $id));

			if($cek == true){
				$query = $this->MBarang->relation_checking('cpu', 'as_cpu', 'cpu_id = as_cpu_cpu_id', array('cpu_id' => $id));

				foreach($query->result() as $row) {

					if($row->as_cpu_mon1_id != 0){
						$this->data['id_mon1'] = $row->as_cpu_mon1_id;
						$this->data['sn_mon1'] = $this->get_sn_barang($row->as_cpu_mon1_id);
						$this->data['listBrg'][] = "Monitor : ".$this->data['sn_mon1'];
						$sn = $sn.", ".$this->data['sn_mon1']." (Monitor)";

						$no_asset = $this->_get_sn('barang', 'barang_id', $this->data['id_mon1'], 'barang_no_asset');
						$no_it = $this->_get_sn('barang', 'barang_id', $this->data['id_mon1'], 'barang_no_it');
						$no_asset_it = $no_asset_it.", ".$no_asset." ".$no_it;
						$qty++;
					}
					
					if($row->as_cpu_mon2_id != 0){
						$this->data['id_mon2'] = $row->as_cpu_mon2_id;
						$this->data['sn_mon2'] = $this->get_sn_barang($row->as_cpu_mon2_id);
						$this->data['listBrg'][] = "Monitor : ".$this->data['sn_mon2'];
						$sn = $sn.", ".$this->data['sn_mon2']." (Monitor)";

						$no_asset = $this->_get_sn('barang', 'barang_id', $this->data['id_mon2'], 'barang_no_asset');
						$no_it = $this->_get_sn('barang', 'barang_id', $this->data['id_mon2'], 'barang_no_it');
						$no_asset_it = $no_asset_it.", ".$no_asset." ".$no_it;
						$qty++;
					}
					if($row->as_cpu_dongle_id != 0){
						$this->data['id_dongle'] = $row->as_cpu_dongle_id;
						$this->data['sn_dongle'] = $this->get_sn_barang($row->as_cpu_dongle_id);
						$this->data['listBrg'][] = "Dongle : ".$this->data['sn_dongle'];
						$sn = $sn.", ".$this->data['sn_dongle']." (Dongle)";

						$no_asset = $this->_get_sn('barang', 'barang_id', $this->data['id_dongle'], 'barang_no_asset');
						$no_it = $this->_get_sn('barang', 'barang_id', $this->data['id_dongle'], 'barang_no_it');
						$no_asset_it = $no_asset_it.", ".$no_asset." ".$no_it;
						$qty++;
					}

					if($row->as_cpu_keyboard_id != 0){
						$this->data['id_keyboard'] = $row->as_cpu_keyboard_id;
						$this->data['sn_keyboard'] = $this->get_sn_barang($row->as_cpu_keyboard_id);
						$this->data['listBrg'][] = "Keyboard : ".$this->data['sn_keyboard'];
						$sn = $sn.", ".$this->data['sn_keyboard']." (Keyboard)";

						$no_asset = $this->_get_sn('barang', 'barang_id', $this->data['id_keyboard'], 'barang_no_asset');
						$no_it = $this->_get_sn('barang', 'barang_id', $this->data['id_keyboard'], 'barang_no_it');
						$no_asset_it = $no_asset_it.", ".$no_asset." ".$no_it;
						$qty++;
					}
					
					if($row->as_cpu_mouse_id != 0){
						$this->data['id_mouse'] = $row->as_cpu_mouse_id;
						$this->data['sn_mouse'] = $this->get_sn_barang($row->as_cpu_mouse_id);
						$this->data['listBrg'][] = "Mouse : ".$this->data['sn_mouse'];
						$sn = $sn.", ".$this->data['sn_mouse']." (Mouse)";

						$no_asset = $this->_get_sn('barang', 'barang_id', $this->data['id_mouse'], 'barang_no_asset');
						$no_it = $this->_get_sn('barang', 'barang_id', $this->data['id_mouse'], 'barang_no_it');
						$no_asset_it = $no_asset_it.", ".$no_asset." ".$no_it;
						$qty++;

					}
					
					if($row->as_cpu_ups_id != 0){
						$this->data['id_ups'] = $row->as_cpu_ups_id;
						$this->data['sn_ups'] = $this->get_sn_barang($row->as_cpu_ups_id);
						$this->data['listBrg'][] = "UPS : ".$this->data['sn_ups'];
						$sn = $sn.", ".$this->data['sn_ups']." (UPS)";

						$no_asset = $this->_get_sn('barang', 'barang_id', $this->data['id_ups'], 'barang_no_asset');
						$no_it = $this->_get_sn('barang', 'barang_id', $this->data['id_ups'], 'barang_no_it');
						$no_asset_it = $no_asset_it.", ".$no_asset." ".$no_it;
						$qty++;
					}
					

					$this->data['isExist'] = true;
				}
			}
			
			//cek history
			$history = $this->MBarang->get_data_table('ex_cpu', array('cpu_id' => $id), 'cpu_id', 'asc');
			foreach ($history->result() as $row) {
				$this->data['history'][] = $row->cpu_user;
			}

			$viewDtl = 'barang/detail/v_detail_cpu';
		}elseif($jenis_barang == 100){
			$query = $this->MBarang->search_detail('laptop', 'rekap', 'rekap_dtl', 'location', 'department','laptop_no_po = rekap_id', 'laptop_rekap_dtl_id = rekap_dtl_id','laptop_location = location_id','laptop_department = department_id', 'rekap_id', 'asc', 'laptop_id', $id);

			foreach ($query->result() as $row) {
				$this->data['id_po'] = $row->rekap_id;
				$this->data['id_rekap_dtl'] = $row->rekap_dtl_id;
				$this->data['no_po'] = $row->rekap_no_po;
				$this->data['no_asset'] = $row->laptop_no_asset;
				$this->data['no_it'] = $row->laptop_no_it;
				$this->data['sn'] = $row->laptop_sn_lp;
				$this->data['type'] = $row->rekap_dtl_type;
				$this->data['merk'] = $row->rekap_dtl_merk;
				$this->data['vendor'] = $row->rekap_vendor;
				$this->data['tgl_terima'] = $row->rekap_tgl_terima;
				$this->data['location'] = $row->location_nama;
				$this->data['user'] = $row->laptop_user;
				$this->data['kode_laptop'] = $row->laptop_kode;
				$this->data['nama_laptop'] = $row->laptop_nama;
				$this->data['department'] = $row->department_nama;
				$this->data['ket'] = $row->laptop_ket;
				if($row->laptop_id_creator != 0){
					$this->data['creator'] = $this->_get_username($row->laptop_id_creator);
					$this->data['time_create'] = $row->laptop_time_create;
				}
				
				if(isset($row->laptop_id_editor)){
					$this->data['editor'] = $this->_get_username($row->laptop_id_editor);
					$this->data['time_edit'] = $row->laptop_time_edit;
				}
				
				$this->data['laptop_id'] = $row->laptop_id;

				$qty++;
				$no_asset_it = $this->data['no_asset']." ".$this->data['no_it'];
				$sn = $this->data['sn']."(Laptop)";
			}

			$cek = $this->MBarang->is_exist('as_laptop', array('as_laptop_laptop_id' =>  $id));

			if($cek == true){
				$query = $this->MBarang->relation_checking('laptop', 'as_laptop', 'laptop_id = as_laptop_laptop_id', array('laptop_id' => $id));

				foreach($query->result() as $row) {

					if($row->as_laptop_mon_id != 0){
						$this->data['id_mon1'] = $row->as_laptop_mon_id;
						$this->data['sn_mon1'] = $this->get_sn_barang($row->as_laptop_mon_id);

						$sn = $sn.", ".$this->data['sn_mon1']." (Monitor)";
						$no_asset = $this->_get_sn('barang', 'barang_id', $this->data['id_mon1'], 'barang_no_asset');
						$no_it = $this->_get_sn('barang', 'barang_id', $this->data['id_mon1'], 'barang_no_it');
						$no_asset_it = $no_asset_it.", ".$no_asset." ".$no_it;
						$qty++;
					}

					if($row->as_laptop_mouse_id != 0){
						$this->data['id_mouse'] = $row->as_laptop_mouse_id;
						$this->data['sn_mouse'] = $this->get_sn_barang($row->as_laptop_mouse_id);

						$sn = $sn.", ".$this->data['sn_mouse']." (Mouse)";
						$no_asset = $this->_get_sn('barang', 'barang_id', $this->data['id_mouse'], 'barang_no_asset');
						$no_it = $this->_get_sn('barang', 'barang_id', $this->data['id_mouse'], 'barang_no_it');
						$no_asset_it = $no_asset_it.", ".$no_asset." ".$no_it;
						$qty++;
					}
				}
			}

			//cek history
			$history = $this->MBarang->get_data_table('ex_laptop', array('laptop_id' => $id), 'laptop_id', 'asc');
			foreach ($history->result() as $row) {
				$this->data['history'][] = $row->laptop_user;
			}

			$viewDtl = 'barang/detail/v_detail_laptop';
		}elseif($jenis_barang == 200){

			$query = $this->MBarang->search_detail('smartphone', 'rekap', 'rekap_dtl', 'location', 'department','smartphone_no_po = rekap_id', 'smartphone_rekap_dtl_id = rekap_dtl_id','smartphone_location = location_id','smartphone_department = department_id', 'rekap_id', 'asc', 'smartphone_id', $id);

			foreach ($query->result() as $row) {
				$this->data['id_po'] = $row->rekap_id;
				$this->data['id_rekap_dtl'] = $row->rekap_dtl_id;
				$this->data['no_po'] = $row->rekap_no_po;
				$this->data['no_asset'] = $row->smartphone_no_asset;
				$this->data['no_it'] = $row->smartphone_no_it;
				$this->data['sn'] = $row->smartphone_sn;
				$this->data['type'] = $row->rekap_dtl_type;
				$this->data['merk'] = $row->rekap_dtl_merk;
				$this->data['vendor'] = $row->rekap_vendor;
				$this->data['tgl_terima'] = $row->rekap_tgl_terima;
				$this->data['location'] = $row->location_nama;
				$this->data['user'] = $row->smartphone_user;
				$this->data['department'] = $row->department_nama;
				$this->data['creator'] = $this->_get_username($row->smartphone_id_creator);
				$this->data['time_create'] = $row->smartphone_time_create;
				$this->data['ket'] = $row->smartphone_ket;
				if(isset($row->smartphone_id_editor)){
					$this->data['editor'] = $this->_get_username($row->smartphone_id_editor);
					$this->data['time_edit'] = $row->smartphone_time_edit;
				}
				
				$this->data['smartphone_id'] = $row->smartphone_id;

				$qty++;
				$no_asset_it = $this->data['no_asset']." ".$this->data['no_it'];
				$sn = $this->data['sn'];
			}

			//cek history
			$history = $this->MBarang->get_data_table('ex_smartphone', array('smartphone_id' => $id), 'smartphone_id', 'asc');
			foreach ($history->result() as $row) {
				$this->data['history'][] = $row->smartphone_user;
			}

			$viewDtl = 'barang/detail/v_detail_smartphone';
		}elseif($jenis_barang == 300){
			$query = $this->MBarang->search_detail('imac', 'rekap', 'rekap_dtl', 'location', 'department','imac_no_po = rekap_id', 'imac_rekap_dtl_id = rekap_dtl_id','imac_location = location_id','imac_department = department_id', 'rekap_id', 'asc', 'imac_id', $id);

			foreach ($query->result() as $row) {
				$this->data['id_po'] = $row->rekap_id;
				$this->data['id_rekap_dtl'] = $row->rekap_dtl_id;
				$this->data['no_po'] = $row->rekap_no_po;
				$this->data['no_asset'] = $row->imac_no_asset;
				$this->data['no_it'] = $row->imac_no_it;
				$this->data['sn_imac'] = $row->imac_sn;
				$this->data['sn_keyboard'] = $row->imac_sn_keyboard;
				$this->data['sn_mouse'] = $row->imac_sn_mouse;
				$this->data['type'] = $row->rekap_dtl_type;
				$this->data['merk'] = $row->rekap_dtl_merk;
				$this->data['vendor'] = $row->rekap_vendor;
				$this->data['tgl_terima'] = $row->rekap_tgl_terima;
				$this->data['location'] = $row->location_nama;
				$this->data['user'] = $row->imac_user;
				$this->data['imac_nama'] = $row->imac_nama;
				$this->data['department'] = $row->department_nama;
				$this->data['creator'] = $this->_get_username($row->imac_id_creator);
				$this->data['time_create'] = $row->imac_time_create;
				$this->data['ket'] = $row->imac_ket;
				if(isset($row->imac_id_editor)){
					$this->data['editor'] = $this->_get_username($row->imac_id_editor);
					$this->data['time_edit'] = $row->imac_time_edit;
				}
				
				$this->data['imac_id'] = $row->imac_id;

				$qty++;
				$no_asset_it = $this->data['no_asset']." ".$this->data['no_it'];
				$sn = $this->data['sn_imac']."(IMAC)";
			}

			$cek = $this->MBarang->is_exist('as_imac', array('as_imac_imac_id' =>  $id));

			if($cek == true){
				$query = $this->MBarang->relation_checking('imac', 'as_imac', 'imac_id = as_imac_imac_id', array('imac_id' => $id));

				foreach($query->result() as $row) {
					if($row->as_imac_ups_id != 0){
						$this->data['id_ups'] = $row->as_imac_ups_id;
						$this->data['sn_ups'] = $this->get_sn_barang($row->as_imac_ups_id);

						$sn = $sn.", ".$this->data['sn_ups']." (UPS)";
						$no_asset = $this->_get_sn('barang', 'barang_id', $this->data['id_ups'], 'barang_no_asset');
						$no_it = $this->_get_sn('barang', 'barang_id', $this->data['id_ups'], 'barang_no_it');
						$no_asset_it = $no_asset_it.", ".$no_asset." ".$no_it;
						$qty++;
					}					
				}
			}

			//cek history
			$history = $this->MBarang->get_data_table('ex_imac', array('imac_id' => $id), 'imac_id', 'asc');
			foreach ($history->result() as $row) {
				$this->data['history'][] = $row->imac_user;
			}

			$viewDtl = 'barang/detail/v_detail_imac';
		}else{

			$query = $this->MBarang->search_detail('barang', 'rekap', 'rekap_dtl', 'location', 'department','barang_no_po = rekap_id', 'barang_rekap_dtl_id = rekap_dtl_id','barang_location = location_id','barang_department = department_id', 'rekap_id', 'asc', 'barang_id', $id);

			foreach ($query->result() as $row) {
				
				$this->data['id_po'] = $row->rekap_id;
				$this->data['id_rekap_dtl'] = $row->rekap_dtl_id;
				$this->data['no_po'] = $row->rekap_no_po;
				$this->data['no_asset'] = $row->barang_no_asset;
				$this->data['no_it'] = $row->barang_no_it;
				$this->data['sn'] = $row->barang_sn;
				$this->data['type'] = $row->rekap_dtl_type;
				$this->data['merk'] = $row->rekap_dtl_merk;
				$this->data['vendor'] = $row->rekap_vendor;
				$this->data['tgl_terima'] = $row->rekap_tgl_terima;
				$this->data['location'] = $row->location_nama;
				$this->data['user'] = $row->barang_user;
				$this->data['department'] = $row->department_nama;
				$this->data['creator'] = $this->_get_username($row->barang_id_creator);
				$this->data['time_create'] = $row->barang_time_create;
				$this->data['ket'] = $row->barang_ket;
				if(isset($row->barang_id_editor)){
					$this->data['editor'] = $this->_get_username($row->barang_id_editor);
					$this->data['time_edit'] = $row->barang_time_edit;
				}
				
				$qty++;
				$no_asset_it = $this->data['no_asset']." ".$this->data['no_it'];
				$sn = $this->data['sn'];
				$this->data['barang_id'] = $row->barang_id;
			}

			//cek history
			$history = $this->MBarang->get_data_table('ex_barang', array('barang_id' => $id), 'barang_id', 'asc');
			foreach ($history->result() as $row) {
				$this->data['history'][] = $row->barang_user;
			}

			$viewDtl = 'barang/detail/v_detail_barang';
		}

		$lokasi = $this->data['department']." / ".$this->data['location'];
		//cetak dok
		if($param == 'cetak'){
				
			$url = 'barang/detail/'.$jenis_barang.'/'.$id;
			$data2 = array(		'id' => $id,
								'user' => $this->data['user'],
								'department' => $this->data['department'],
								'kat_pemohon' => '[x] Serah Terima',
								'merk' => $this->data['merk'],
								'type' => $this->data['type'],
								'qty' => $qty,
								'lokasi_tujuan' => $lokasi,
								'periode_waktu' => '-',
								'lokasi_asal' => 'Tubun',
								'no_asset_it' => $no_asset_it,
								'produk_number' => ' - ',
								'sn' => $sn,
								'kondisi' => 'Layak',
								'upd_list' => 'Ya',
								'tgl_penyerahan' => date('d/m/Y'),
								'keterangan' => ' '
				);
			//code 1 for serah terima
			$this->cetak_doc(1, $jenis_barang, $data2);
			//break;
		}
		
		$this->data['url_edit'] = 'barang/edit/'.$this->data['id_po'].'/'.$this->data['id_rekap_dtl'].'/'.$jenis_barang_temp.'/'.$id;
		$this->data['url_cetak'] = 'barang/detail/'.$jenis_barang.'/'.$id.'/cetak';
		$this->data['title'] = 'Detail Barang';
		$this->load->template($viewDtl, $this->data);
	}

	public function edit($no_po = null, $dtl_barang = null, $jenis_barang = null, $id = null)
	{
		$this->data['listPO'] = $this->MBarang->get_data('rekap','');
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['selectedPO'] = $no_po;
		$this->data['selectedJenisBarang'] = $jenis_barang;
		$this->data['showDtl'] = false;
		$this->data['showJenisBarang'] = false;
		$this->data['isEditing'] = true;
		$this->data['isDtl'] = false;
		$this->data['isEnabled'] = false;
		
		if($no_po != 999999 and $no_po != null){
			$this->data['showDtl'] = true;
			$this->data['showJenisBarang'] = true;
			$this->data['viewDtl'] = "additional/detail_barang.php";

			if($dtl_barang != null){
				$query = $this->MBarang->get_data('rekap_dtl', array('rekap_dtl_id' => $dtl_barang) );
				foreach($query->result() as $row){
					$this->data['stok_awal'] = $row->rekap_dtl_jml; 
				}

				//count barang beredar
				$count_cpu = $this->MBarang->count_rows('cpu', array('cpu_rekap_dtl_id' => $dtl_barang, 'cpu_status' => 1));
				$count_laptop = $this->MBarang->count_rows('laptop', array('laptop_rekap_dtl_id' => $dtl_barang, 'laptop_status' => 1));
				$count_smartphone = $this->MBarang->count_rows('smartphone', array('smartphone_rekap_dtl_id' => $dtl_barang, 'smartphone_status' => 1));
				$count_imac = $this->MBarang->count_rows('imac', array('imac_rekap_dtl_id' => $dtl_barang, 'imac_status' => 1));
				$count_barang = $this->MBarang->count_rows('barang', array('barang_rekap_dtl_id' => $dtl_barang, 'barang_status' => 1));

				$this->data['jml_beredar'] = $count_cpu + $count_laptop + $count_smartphone + $count_imac + $count_barang;
				$this->data['selectedDtlBarang'] = $dtl_barang;
			}
			$this->data['listDtlBarang'] = $this->MBarang->get_data('rekap_dtl',array('rekap_dtl_id_rekap' => $no_po));
		}elseif($no_po == 999999){
			$this->data['showJenisBarang'] = true;
		}

		$action = 'barang/save/edit/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang.'/'.$id;

		//for form used
		if($jenis_barang == 1){
			$query = $this->MBarang->get_data('cpu',array('cpu_id' => $id));
			foreach ($query->result() as $row) {
				$this->data['no_asset'] = $row->cpu_no_asset;
				$this->data['no_it'] = $row->cpu_no_it;
				$this->data['sn_cpu'] = $row->cpu_sn;
				$this->data['service_tag'] = $row->cpu_service_tag;
				$this->data['ket'] = $row->cpu_ket;
			}
			$this->data['formInputBarang'] = "additional/v_form_cpu.php";
		}elseif($jenis_barang == 100){
			$query = $this->MBarang->get_data('laptop',array('laptop_id' => $id));
			foreach ($query->result() as $row) {
				$this->data['no_asset'] = $row->laptop_no_asset;
				$this->data['no_it'] = $row->laptop_no_it;
				$this->data['sn_laptop'] = $row->laptop_sn_lp;
				$this->data['sn_hd'] = $row->laptop_sn_hd;
				$this->data['sn_baterai'] = $row->laptop_sn_baterai;
				$this->data['sn_charger'] = $row->laptop_sn_charger;
				$this->data['ket'] = $row->laptop_ket;
			}
			$this->data['formInputBarang'] = "additional/v_form_laptop.php";
		}elseif($jenis_barang == 200){
			$query = $this->MBarang->get_data('smartphone',array('smartphone_id' => $id));
			foreach ($query->result() as $row) {
				$this->data['no_asset'] = $row->smartphone_no_asset;
				$this->data['no_it'] = $row->smartphone_no_it;
				$this->data['sn_smartphone'] = $row->smartphone_sn;
				$this->data['imei1'] = $row->smartphone_imei1;
				$this->data['imei2'] = $row->smartphone_imei2;
				$this->data['ket'] = $row->smartphone_ket;
			}
			$this->data['formInputBarang'] = "additional/v_form_smartphone.php";
		}elseif($jenis_barang == 300){
			$query = $this->MBarang->get_data('imac',array('imac_id' => $id));
			foreach ($query->result() as $row) {
				$this->data['no_asset'] = $row->imac_no_asset;
				$this->data['no_it'] = $row->imac_no_it;
				$this->data['sn_imac'] = $row->imac_sn;
				$this->data['sn_mouse_imac'] = $row->imac_sn_mouse;
				$this->data['sn_keyboard_imac'] = $row->imac_sn_keyboard;
				$this->data['ket'] = $row->imac_ket;
			}
			$this->data['formInputBarang'] = "additional/v_form_imac.php";
		}else{
			$query = $this->MBarang->get_data('barang',array('barang_id' => $id, 'barang_jenis_barang_id' => $jenis_barang));
			foreach ($query->result() as $row) {
				$this->data['no_asset'] = $row->barang_no_asset;
				$this->data['no_it'] = $row->barang_no_it;
				$this->data['sn'] = $row->barang_sn;
				$this->data['ket'] = $row->barang_ket;
			}
			$this->data['formInputBarang'] = "additional/v_form_barang.php";
		}
		$this->data['title'] = 'Edit Barang';
		$this->data['action'] = $action;
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['additional'] = "include/plus_form_add_barang.php";
		$this->load->template('barang/add/v_form_add_barang', $this->data);
	}
	public function add($no_po = null, $dtl_barang = null, $jenis_barang = null)
	{
		$this->data['listPO'] = $this->MBarang->get_data_table('rekap','', 'rekap_id', 'desc');
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['selectedPO'] = $no_po;
		$this->data['selectedJenisBarang'] = $jenis_barang;
		$this->data['showDtl'] = false;
		$this->data['showJenisBarang'] = false;
		$this->data['isEditing'] = false;
		$this->data['isEnabled'] = false;
		$this->data['isDtl'] = false;
		if($no_po != 999999 and $no_po != null){
			$this->data['showDtl'] = true;
			$this->data['showJenisBarang'] = true;
			$this->data['isEnabled'] = true;
			$this->data['viewDtl'] = "additional/detail_barang.php";

			if($dtl_barang != null){
				$query = $this->MBarang->get_data('rekap_dtl', array('rekap_dtl_id' => $dtl_barang) );
				foreach($query->result() as $row){
					$this->data['stok_awal'] = $row->rekap_dtl_jml; 
				}

				$this->data['isDtl'] = true;
				//count barang beredar
				$count_cpu = $this->MBarang->count_rows('cpu', array('cpu_rekap_dtl_id' => $dtl_barang, 'cpu_status' => 1));
				$count_laptop = $this->MBarang->count_rows('laptop', array('laptop_rekap_dtl_id' => $dtl_barang, 'laptop_status' => 1));
				$count_smartphone = $this->MBarang->count_rows('smartphone', array('smartphone_rekap_dtl_id' => $dtl_barang, 'smartphone_status' => 1));
				$count_imac = $this->MBarang->count_rows('imac', array('imac_rekap_dtl_id' => $dtl_barang, 'imac_status' => 1));
				$count_barang = $this->MBarang->count_rows('barang', array('barang_rekap_dtl_id' => $dtl_barang, 'barang_status' => 1));

				//count barang ditambahkan 
				$d_count_cpu = $this->MBarang->count_rows('cpu', array('cpu_rekap_dtl_id' => $dtl_barang));
				$d_count_laptop = $this->MBarang->count_rows('laptop', array('laptop_rekap_dtl_id' => $dtl_barang));
				$d_count_smartphone = $this->MBarang->count_rows('smartphone', array('smartphone_rekap_dtl_id' => $dtl_barang));
				$d_count_imac = $this->MBarang->count_rows('imac', array('imac_rekap_dtl_id' => $dtl_barang));
				$d_count_barang = $this->MBarang->count_rows('barang', array('barang_rekap_dtl_id' => $dtl_barang));

				$this->data['jml_ditambahkan'] = $d_count_cpu + $d_count_laptop + $d_count_smartphone + $d_count_imac + $d_count_barang;
				$this->data['jml_beredar'] = $count_cpu + $count_laptop + $count_smartphone + $count_imac + $count_barang;
				$this->data['selectedDtlBarang'] = $dtl_barang;

				if($this->data['stok_awal'] == $this->data['jml_ditambahkan']){
					$this->data['isDtl'] = false;
					echo "<script>alert('Stok Habis.');</script>";
				}
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
		$this->data['title'] = 'Tambah Barang';
		$this->data['action'] = 'barang/save/add';
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['additional'] = "include/plus_form_add_barang.php";
		$this->load->template('barang/add/v_form_add_barang', $this->data);
	}

	public function save($param1 = null, $param_no_po = null, $param_dtl_barang = null, $param_jenis_barang = null, $id = null)
	{
		$this->db->trans_start();

		if($param1 == 'add'){
			$jenis_barang = $this->input->post('jenis_barang');
			$no_po = $this->input->post('no_po');
			//_get_sn($table = null, $id_s = null, $id = null, $column = null)
			$lokasi = $this->_get_sn('rekap', 'rekap_id', $no_po, 'rekap_lokasi');
			$sub_lokasi = $this->_get_sn('rekap', 'rekap_id', $no_po, 'rekap_sub_lokasi');
			$no_asset = $this->input->post('no_asset');
			$no_it = $this->input->post('no_it');
			$ket = $this->input->post('ket');
			$dtl = $this->input->post('dtl_barang');

			

			//laptop
			$sn_laptop = $this->input->post('sn_laptop');
			$cek_sn_laptop = $this->MBarang->is_exist('laptop', array('laptop_sn_lp' => $sn_laptop));

			if($cek_sn_laptop == true){
				echo "<script>alert('S/N $serial_number sudah ada di database. Silahkan ulangi lagi.')</script>";
				$this->db->trans_rollback();
				redirect('barang/import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang, 'refresh');
			}


			if($jenis_barang == 1){
				

				$data = array(	'cpu_no_po' => $no_po,
								'cpu_rekap_dtl_id' => $dtl,
								'cpu_no_asset' => $no_asset, 
								'cpu_no_it' => $no_it, 
								'cpu_service_tag' => $this->input->post('service_tag'), 
								'cpu_sn' => $this->input->post('sn_cpu'),
								'cpu_ket' => $ket,
								'cpu_location' => $lokasi,
								'cpu_sub_location' => $sub_lokasi,
								'cpu_id_creator' => $_SESSION["user_id"],
								'cpu_time_create' => date('Y-m-d H:i:s')
							);
				$url_redirect = "barang/add/".$no_po."/".$dtl."/".$jenis_barang;
				$cek_no_it = $this->MBarang->is_exist('cpu', array('cpu_no_it' =>  $no_it));
				$table = "cpu";
			}elseif($jenis_barang == 100){
				$dtl = $this->input->post('dtl_barang');

				/*cek cek yg double*/
				$service_tag = $this->input->post('service_tag');
				if($service_tag != ""){
					$cek_service_tag = $this->MBarang->is_exist('cpu', array('cpu_service_tag' =>  $service_tag));
				}

				if($cek_service_tag == true){
					echo "<script>alert('Service Tag $service_tag sudah ada di database. Silahkan ulangi lagi.')</script>";
					$this->db->trans_rollback();
					$url_redirect = "barang/add/".$no_po."/".$dtl."/".$jenis_barang;
				}

				$data = array(	'laptop_no_po' => $no_po,
								'laptop_rekap_dtl_id' => $dtl,
								'laptop_no_asset' => $no_asset, 
								'laptop_no_it' => $no_it, 
								'laptop_sn_lp' => $this->input->post('sn_laptop'), 
								'laptop_sn_hd' => $this->input->post('sn_hd'), 
								'laptop_sn_baterai' => $this->input->post('sn_baterai'), 
								'laptop_sn_charger' => $this->input->post('sn_charger'),
								'laptop_ket' => $ket,
								'laptop_location' => $lokasi,
								'laptop_sub_location' => $sub_lokasi, 
								'laptop_id_creator' => $_SESSION["user_id"],
								'laptop_time_create' => date('Y-m-d H:i:s')
							);

				$cek_no_it = $this->MBarang->is_exist('laptop', array('laptop_no_it' =>  $no_it));
				$table = "laptop";
			}elseif($jenis_barang == 200){
				$dtl = $this->input->post('dtl_barang');

				$data = array(	'smartphone_no_po' => $no_po,
								'smartphone_rekap_dtl_id' => $dtl,
								'smartphone_no_asset' => $no_asset, 
								'smartphone_no_it' => $no_it, 
								'smartphone_sn' => $this->input->post('sn_smartphone'), 
								'smartphone_imei1' => $this->input->post('imei1'), 
								'smartphone_imei2' => $this->input->post('imei2'), 
								'smartphone_ket' => $ket, 
								'smartphone_location' => $lokasi,
								'smartphone_sub_location' => $sub_lokasi,
								'smartphone_id_creator' => $_SESSION["user_id"],
								'smartphone_time_create' => date('Y-m-d H:i:s')
							);

				$cek_no_it = $this->MBarang->is_exist('smartphone', array('smartphone_no_it' =>  $no_it));
				$table = "smartphone";
			}elseif($jenis_barang == 300){
				$dtl = $this->input->post('dtl_barang');

				$data = array(	'imac_no_po' => $no_po,
								'imac_rekap_dtl_id' => $dtl,
								'imac_no_asset' => $no_asset, 
								'imac_no_it' => $no_it, 
								'imac_sn' => $this->input->post('sn_imac'), 
								'imac_sn_keyboard' => $this->input->post('sn_keyboard_imac'), 
								'imac_sn_mouse' => $this->input->post('sn_mouse_imac'), 
								'imac_ket' => $ket, 
								'imac_location' => $lokasi,
								'imac_sub_location' => $sub_lokasi,
								'imac_id_creator' => $_SESSION["user_id"],
								'imac_time_create' => date('Y-m-d H:i:s')
							);

				$cek_no_it = $this->MBarang->is_exist('imac', array('imac_no_it' =>  $no_it));
				$table = "imac";
			}else{
				$dtl = $this->input->post('dtl_barang');

				$data = array(	'barang_no_po' => $no_po,
								'barang_rekap_dtl_id' => $dtl,
								'barang_no_asset' => $no_asset, 
								'barang_no_it' => $no_it, 
								'barang_jenis_barang_id' => $jenis_barang, 
								'barang_sn' => $this->input->post('sn'), 
								'barang_ket' => $ket, 
								'barang_location' => $lokasi,
								'barang_sub_location' => $sub_lokasi,
								'barang_id_creator' => $_SESSION["user_id"],
								'barang_time_create' => date('Y-m-d H:i:s')
							);

				$cek_no_it = $this->MBarang->is_exist('barang', array('barang_no_it' =>  $no_it));
				$table = "barang";
			}

			$url_redirect = "barang/add/".$no_po."/".$dtl."/".$jenis_barang;

			if($lokasi == null || $sub_lokasi == null){
				$this->set_message(0, "Data gagal ditambahkan, Lokasi di PO masih kosong.");
				redirect(site_url($url_redirect),'refresh');
			}
			
			if($cek_no_it == true){
				$this->set_message(0, "NO IT ".$no_it." sudah ada di database.");
				redirect(site_url($url_redirect),'refresh');
			}else{
				$query = $this->MBarang->add($table, $data);
			}
			if($query){
				$this->set_message(1, "Data berhasil ditambahkan.");
			}else{
				$this->set_message(0, "Data gagal ditambahkan, silahkan ulangi lagi ada data yang sama");
			}
		}elseif($param1 == 'edit'){
			$no_po = $this->input->post('no_po');
			$no_asset = $this->input->post('no_asset');
			$no_it = $this->input->post('no_it');
			$ket = $this->input->post('ket');
			$no_it_old = $this->input->post('no_it_old');
			$url_redirect = "barang/edit/".$param_no_po."/".$param_dtl_barang."/".$param_jenis_barang."/".$id;

			if($param_jenis_barang == 1){
				$data = array('cpu_no_asset' => $no_asset, 
								'cpu_no_it' => $no_it, 
								'cpu_service_tag' => $this->input->post('service_tag'), 
								'cpu_sn' => $this->input->post('sn_cpu'),
								'cpu_ket' => $ket,
								'cpu_id_editor' => $_SESSION["user_id"],
								'cpu_time_edit' => date('Y-m-d H:i:s')
							);

				$cek_no_it = false;
				if($no_it != $no_it_old){
					$cek_no_it = $this->MBarang->is_exist('cpu', array('cpu_no_it' =>  $no_it));
				}
				$id_table = "cpu_id";
				$table = "cpu";
			}elseif($param_jenis_barang == 100){
				$data = array('laptop_no_asset' => $no_asset, 
								'laptop_no_it' => $no_it, 
								'laptop_sn_lp' => $this->input->post('sn_laptop'),
								'laptop_sn_hd' => $this->input->post('sn_hd'),
								'laptop_sn_baterai' => $this->input->post('sn_baterai'),
								'laptop_sn_charger' => $this->input->post('sn_charger'),
								'laptop_ket' => $ket,
								'laptop_id_editor' => $_SESSION["user_id"],
								'laptop_time_edit' => date('Y-m-d H:i:s')
							);

				$cek_no_it = false;
				if($no_it != $no_it_old){
					$cek_no_it = $this->MBarang->is_exist('cpu', array('cpu_no_it' =>  $no_it));
				}
				$id_table = "laptop_id";
				$table = "laptop";
			}elseif($param_jenis_barang == 200){
				$data = array('smartphone_no_asset' => $no_asset, 
								'smartphone_no_it' => $no_it, 
								'smartphone_sn' => $this->input->post('sn_smartphone'),
								'smartphone_imei1' => $this->input->post('imei1'),
								'smartphone_imei2' => $this->input->post('imei2'),
								'smartphone_ket' => $ket,
								'smartphone_id_editor' => $_SESSION["user_id"],
								'smartphone_time_edit' => date('Y-m-d H:i:s')
							);

				$cek_no_it = false;
				if($no_it != $no_it_old){
					$cek_no_it = $this->MBarang->is_exist('smartphone', array('smartphone_no_it' =>  $no_it));
				}
				$id_table = "smartphone_id";
				$table = "smartphone";
			}elseif($param_jenis_barang == 300){
				$data = array('imac_no_asset' => $no_asset, 
								'imac_no_it' => $no_it, 
								'imac_sn' => $this->input->post('sn_imac'),
								'imac_sn_keyboard' => $this->input->post('sn_keyboard_imac'),
								'imac_sn_mouse' => $this->input->post('sn_mouse_imac'),
								'imac_ket' => $ket,
								'imac_id_editor' => $_SESSION["user_id"],
								'imac_time_edit' => date('Y-m-d H:i:s')
							);

				$cek_no_it = false;
				if($no_it != $no_it_old){
					$cek_no_it = $this->MBarang->is_exist('imac', array('imac_no_it' =>  $no_it));
				}
				$id_table = "imac_id";
				$table = "imac";
			}else {
				$data = array(	'barang_no_asset' => $no_asset, 
								'barang_no_it' => $no_it, 
								'barang_sn' => $this->input->post('sn'), 
								'barang_ket' => $ket,
								'barang_id_editor' => $_SESSION["user_id"],
								'barang_time_edit' => date('Y-m-d H:i:s')
							);

				$cek_no_it = false;
				if($no_it != $no_it_old){
					$cek_no_it = $this->MBarang->is_exist('barang', array('barang_no_it' =>  $no_it));
				}
				$id_table = "barang_id";
				$table = "barang";
			}

			if($cek_no_it == true){
				$this->set_message(0, "NO IT ".$no_it." sudah ada di database.");
				redirect(site_url($url_redirect),'refresh');
			}else{
				$query = $this->MBarang->update_table($id_table, $id, $table, $data);
			}
			if($query){
				$this->set_message(1, "Data berhasil diupdate.");
			}else{
				$this->set_message(0, "Data gagal diupdate, silahkan ulangi lagi.");
			}
		}

		//print_r($data);
		$this->db->trans_complete();
		redirect(site_url($url_redirect),'refresh');
	}

	private function set_message($type = null, $msg = null)
	{
		if($type == 1){
			$this->data['msg'] = "<div class='alert bg-success' role='alert'>
						<svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg>".$msg."</div>";
		}elseif($type == 0){
			$this->data['msg'] = "<div class='alert bg-danger' role='alert'>
						<svg class='glyph stroked empty-message'><use xlink:href='#stroked-empty-message'></use></svg>".$msg."</div>";
		}

		$this->session->set_flashdata('msg', $this->data['msg']);
	}

	private function get_sn_barang($id = null)
	{
		$q = $this->MBarang->get_data('barang',array('barang_id' => $id));

		foreach($q->result() as $row){
			$name = $row->barang_sn;
		}
		return $name;
	}



	public function tes()
	{
		echo "asdasd <br />";
		echo $this->_get_sn('cpu', 'cpu_id', 3, 'cpu_service_tag');
	}

	public function delete($jenis_barang = null, $id = null)
	{
		$this->data['isThereRelathionship'] = false;
		$this->data['jenis_barang'] = $this->_get_nama_jenis_barang($jenis_barang);
		$this->data['jenis_barang2'] = $jenis_barang;

		if($jenis_barang == 1){
			$query = $this->MBarang->search_detail('cpu', 'rekap', 'rekap_dtl', 'location', 'department','cpu_no_po = rekap_id', 'cpu_rekap_dtl_id = rekap_dtl_id','cpu_location = location_id','cpu_department = department_id', 'rekap_id', 'asc', 'cpu_id', $id);

			foreach ($query->result() as $row) {
				$this->data['id_po'] = $row->rekap_id;
				$this->data['id_rekap_dtl'] = $row->rekap_dtl_id;
				$this->data['no_po'] = $row->rekap_no_po;
				$this->data['no_asset'] = $row->cpu_no_asset;
				$this->data['no_it'] = $row->cpu_no_it;
				$this->data['sn_cpu'] = $row->cpu_sn;
				$this->data['hostname'] = $row->cpu_hostname;
				$this->data['service_tag'] = $row->cpu_service_tag;
				$this->data['cpu_id'] = $row->cpu_id;
			}
			
			$cek = $this->MBarang->is_exist('as_cpu', array('as_cpu_cpu_id' =>  $id));

			if($cek == true){
				$query = $this->MBarang->relation_checking('cpu', 'as_cpu', 'cpu_id = as_cpu_cpu_id', array('cpu_id' => $id));

				foreach($query->result() as $row) {

					$this->data['id_mon1'] = $row->as_cpu_mon1_id;
					$this->data['sn_mon1'] = $this->get_sn_barang($row->as_cpu_mon1_id);
					$this->data['listBrg'][] = "Monitor : ".$this->data['sn_mon1'];

					if($row->as_cpu_mon2_id != 0){
						$this->data['id_mon2'] = $row->as_cpu_mon2_id;
						$this->data['sn_mon2'] = $this->get_sn_barang($row->as_cpu_mon2_id);
						$this->data['listBrg'][] = "Monitor : ".$this->data['sn_mon2'];
					}
					if($row->as_cpu_dongle_id != 0){
						$this->data['id_dongle'] = $row->as_cpu_dongle_id;
						$this->data['sn_dongle'] = $this->get_sn_barang($row->as_cpu_dongle_id);
						$this->data['listBrg'][] = "Dongle : ".$this->data['sn_dongle'];
					}
					$this->data['id_keyboard'] = $row->as_cpu_keyboard_id;
					$this->data['sn_keyboard'] = $this->get_sn_barang($row->as_cpu_keyboard_id);
					$this->data['listBrg'][] = "Keyboard : ".$this->data['sn_keyboard'];
					$this->data['id_mouse'] = $row->as_cpu_mouse_id;
					$this->data['sn_mouse'] = $this->get_sn_barang($row->as_cpu_mouse_id);
					$this->data['listBrg'][] = "Mouse : ".$this->data['sn_mouse'];
					$this->data['id_ups'] = $row->as_cpu_ups_id;
					$this->data['sn_ups'] = $this->get_sn_barang($row->as_cpu_ups_id);
					$this->data['listBrg'][] = "UPS : ".$this->data['sn_ups'];

					$this->data['isThereRelathionship'] = true;
				}
			}

			$view = 'barang/delete/v_delete_cpu';
		}elseif($jenis_barang == 100){
			$query = $this->MBarang->search_detail('laptop', 'rekap', 'rekap_dtl', 'location', 'department','laptop_no_po = rekap_id', 'laptop_rekap_dtl_id = rekap_dtl_id','laptop_location = location_id','laptop_department = department_id', 'rekap_id', 'asc', 'laptop_id', $id);

			foreach ($query->result() as $row) {
				$this->data['id_po'] = $row->rekap_id;
				$this->data['id_rekap_dtl'] = $row->rekap_dtl_id;
				$this->data['no_po'] = $row->rekap_no_po;
				$this->data['no_asset'] = $row->laptop_no_asset;
				$this->data['no_it'] = $row->laptop_no_it;
				$this->data['sn_laptop'] = $row->laptop_sn_lp;
				$this->data['hostname'] = $row->laptop_nama;
				$this->data['laptop_id'] = $row->laptop_id;
			}
			
			$cek = $this->MBarang->is_exist('as_laptop', array('as_laptop_laptop_id' =>  $id));

			if($cek == true){
				$query = $this->MBarang->relation_checking('laptop', 'as_laptop', 'laptop_id = as_laptop_laptop_id', array('laptop_id' => $id));

				foreach($query->result() as $row) {

					if($row->as_laptop_mon_id != 0){
						$this->data['id_mon'] = $row->as_laptop_mon_id;
						$this->data['sn_mon'] = $this->get_sn_barang($row->as_laptop_mon_id);
						$this->data['listBrg'][] = "Monitor : ".$this->data['sn_mon'];
					}
					if($row->as_laptop_mouse_id != 0){
						$this->data['id_mouse'] = $row->as_laptop_mouse_id;
						$this->data['sn_mouse'] = $this->get_sn_barang($row->as_laptop_mouse_id);
						$this->data['listBrg'][] = "Mouse : ".$this->data['sn_mouse'];
					}

					$this->data['isThereRelathionship'] = true;
				}
			}

			$view = 'barang/delete/v_delete_laptop';
		}elseif($jenis_barang == 200){
			$query = $this->MBarang->search_detail('smartphone', 'rekap', 'rekap_dtl', 'location', 'department','smartphone_no_po = rekap_id', 'smartphone_rekap_dtl_id = rekap_dtl_id','smartphone_location = location_id','smartphone_department = department_id', 'rekap_id', 'asc', 'smartphone_id', $id);

			foreach ($query->result() as $row) {
				$this->data['id_po'] = $row->rekap_id;
				$this->data['id_rekap_dtl'] = $row->rekap_dtl_id;
				$this->data['no_po'] = $row->rekap_no_po;
				$this->data['no_asset'] = $row->smartphone_no_asset;
				$this->data['no_it'] = $row->smartphone_no_it;
				$this->data['sn'] = $row->smartphone_sn;
				$this->data['smartphone_id'] = $row->smartphone_id;
			}

			$view = 'barang/delete/v_delete_smartphone';
		}elseif($jenis_barang == 300){
			$query = $this->MBarang->search_detail('imac', 'rekap', 'rekap_dtl', 'location', 'department','imac_no_po = rekap_id', 'imac_rekap_dtl_id = rekap_dtl_id','imac_location = location_id','imac_department = department_id', 'rekap_id', 'asc', 'imac_id', $id);

			foreach ($query->result() as $row) {
				$this->data['id_po'] = $row->rekap_id;
				$this->data['id_rekap_dtl'] = $row->rekap_dtl_id;
				$this->data['no_po'] = $row->rekap_no_po;
				$this->data['no_asset'] = $row->imac_no_asset;
				$this->data['no_it'] = $row->imac_no_it;
				$this->data['sn'] = $row->imac_sn;
				$this->data['hostname'] = $row->imac_nama;
				$this->data['imac_id'] = $row->imac_id;
			}
			
			$cek = $this->MBarang->is_exist('as_laptop', array('as_laptop_laptop_id' =>  $id));

			if($cek == true){
				$query = $this->MBarang->relation_checking('imac', 'as_imac', 'imac_id = as_imac_imac_id', array('imac_id' => $id));

				foreach($query->result() as $row) {

					if($row->as_imac_ups_id != 0){
						$this->data['id_ups'] = $row->as_imac_ups_id;
						$this->data['sn_ups'] = $this->get_sn_barang($row->as_imac_ups_id);
						$this->data['listBrg'][] = "UPS : ".$this->data['sn_ups'];
					}
					$this->data['isThereRelathionship'] = true;
				}
			}

			$view = 'barang/delete/v_delete_imac';
		}else{

			$query = $this->MBarang->search_detail('barang', 'rekap', 'rekap_dtl', 'location', 'department','barang_no_po = rekap_id', 'barang_rekap_dtl_id = rekap_dtl_id','barang_location = location_id','barang_department = department_id', 'rekap_id', 'asc', 'barang_id', $id);

			foreach ($query->result() as $row) {
				$this->data['id_po'] = $row->rekap_id;
				$this->data['id_rekap_dtl'] = $row->rekap_dtl_id;
				$this->data['no_po'] = $row->rekap_no_po;
				$this->data['no_asset'] = $row->barang_no_asset;
				$this->data['no_it'] = $row->barang_no_it;
				$this->data['sn'] = $row->barang_sn;
				$this->data['barang_id'] = $row->barang_id;
			}

			if($jenis_barang == 2){
				$cek1 = $this->MBarang->is_exist('as_cpu', array('as_cpu_mon1_id' =>  $id));
				$cek2 = $this->MBarang->is_exist('as_cpu', array('as_cpu_mon2_id' =>  $id));
				$cek3 = $this->MBarang->is_exist('as_laptop', array('as_laptop_mon_id' =>  $id));

				if($cek1 == true || $cek2 == true || $cek3 == true){
					$this->data['isThereRelathionship'] = true;
					if($cek3 == true){
						$query = $this->MBarang->relation_checking('laptop', 'as_laptop', 'laptop_id = as_laptop_laptop_id', array('as_laptop_mon_id' => $id));

						foreach ($query->result() as $row) {
							$this->data['listBrg'][] = "Laptop : ".$row->laptop_sn_lp;
						}
					}elseif($cek2 == true){
						$query = $this->MBarang->relation_checking('cpu', 'as_cpu', 'cpu_id = as_cpu_cpu_id', array('as_cpu_mon2_id' => $id));

						foreach ($query->result() as $row) {
							$this->data['listBrg'][] = "CPU : ".$row->cpu_service_tag;
						}
					}else{
						$query = $this->MBarang->relation_checking('cpu', 'as_cpu', 'cpu_id = as_cpu_cpu_id', array('as_cpu_mon1_id' => $id));

						foreach ($query->result() as $row) {
							$this->data['listBrg'][] = "CPU : ".$row->cpu_service_tag;
						}
					}
				}
			}elseif($jenis_barang == 3){ //keyboard
				$cek = $this->MBarang->is_exist('as_cpu', array('as_cpu_keyboard_id' =>  $id));
				if($cek == true){
					$this->data['isThereRelathionship'] = true;
					$query = $this->MBarang->relation_checking('cpu', 'as_cpu', 'cpu_id = as_cpu_cpu_id', array('as_cpu_keyboard_id' => $id));
					foreach ($query->result() as $row) {
						$this->data['listBrg'][] = "CPU : ".$row->cpu_service_tag;
					}
				}
			}elseif($jenis_barang == 4){
				$cek1 = $this->MBarang->is_exist('as_cpu', array('as_cpu_mouse_id' =>  $id));
				$cek2 = $this->MBarang->is_exist('as_laptop', array('as_laptop_mouse_id' =>  $id));

				if($cek1 == true || $cek2 == true){
					$this->data['isThereRelathionship'] = true;
					if($cek2 == true){
						$query = $this->MBarang->relation_checking('laptop', 'as_laptop', 'laptop_id = as_laptop_laptop_id', array('as_laptop_mouse_id' => $id));

						foreach ($query->result() as $row) {
							$this->data['listBrg'][] = "Laptop : ".$row->laptop_sn_lp;
						}
					}else{
						$query = $this->MBarang->relation_checking('cpu', 'as_cpu', 'cpu_id = as_cpu_cpu_id', array('as_cpu_mouse_id' => $id));

						foreach ($query->result() as $row) {
							$this->data['listBrg'][] = "CPU : ".$row->cpu_service_tag;
						}
					}
				}
			}elseif($jenis_barang == 5){
				$cek1 = $this->MBarang->is_exist('as_cpu', array('as_cpu_ups_id' =>  $id));
				$cek2 = $this->MBarang->is_exist('as_imac', array('as_imac_ups_id' =>  $id));

				if($cek1 == true || $cek2 == true){
					$this->data['isThereRelathionship'] = true;
					if($cek2 == true){
						$query = $this->MBarang->relation_checking('imac', 'as_imac', 'imac_id = as_imac_imac_id', array('as_imac_ups_id' => $id));

						foreach ($query->result() as $row) {
							$this->data['listBrg'][] = "IMAC : ".$row->imac_sn;
						}
					}else{
						$query = $this->MBarang->relation_checking('cpu', 'as_cpu', 'cpu_id = as_cpu_cpu_id', array('as_cpu_ups_id' => $id));

						foreach ($query->result() as $row) {
							$this->data['listBrg'][] = "CPU : ".$row->cpu_service_tag;
						}
					}
				}
			}elseif($jenis_barang == 6){ //keyboard
				$cek = $this->MBarang->is_exist('as_cpu', array('as_cpu_dongle_id' =>  $id));
				if($cek == true){
					$this->data['isThereRelathionship'] = true;
					$query = $this->MBarang->relation_checking('cpu', 'as_cpu', 'cpu_id = as_cpu_cpu_id', array('as_cpu_dongle_id' => $id));
					foreach ($query->result() as $row) {
						$this->data['listBrg'][] = "CPU : ".$row->cpu_service_tag;
					}
				}
			}

			$view = 'barang/delete/v_delete_barang';
		}

		$this->data['title'] = 'Delete Barang';
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->load->template($view, $this->data);
	}

	public function process_delete($jenis_barang = null, $id = null)
	{
		if($jenis_barang == 1){
			$query = $this->MBarang->delete('cpu', 'cpu_id', $id);
		}elseif($jenis_barang == 100){
			$query = $this->MBarang->delete('laptop', 'laptop_id', $id);
		}elseif($jenis_barang == 200){
			$query = $this->MBarang->delete('smartphone', 'smartphone_id', $id);
		}elseif($jenis_barang == 300){
			$query = $this->MBarang->delete('imac', 'imac_id', $id);
		}else{
			$query = $this->MBarang->delete('barang', 'barang_id', $id);
		}

		if($query){
			$this->set_message(1, "Data berhasil dihapus.");
		}else{
			$this->set_message(0, "Data gagal dihapus, silahkan ulangi lagi.");
		}

		redirect(site_url('barang/daftar/'.$jenis_barang),'refresh');
	}

	private function _get_username($id = null)
	{
		$q = $this->MBarang->get_data('user',array('user_id' => $id));
		foreach($q->result() as $row){	
			$name = $row->user_username;
		}	
		return $name;
	}

	//12-08-2016
	public function import($no_po = null, $dtl_barang = null, $jenis_barang = null)
	{
		$this->data['listPO'] = $this->MBarang->get_data('rekap','');
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['selectedPO'] = $no_po;
		$this->data['selectedJenisBarang'] = $jenis_barang;
		$this->data['showDtl'] = false;
		$this->data['showJenisBarang'] = false;
		$this->data['isEditing'] = false;
		$this->data['isEnabled'] = false;
		$this->data['isDtl'] = false;
		if($no_po != 999999 and $no_po != null){
			$this->data['showDtl'] = true;
			$this->data['showJenisBarang'] = true;
			$this->data['isEnabled'] = true;
			$this->data['viewDtl'] = "additional/detail_barang.php";

			if($dtl_barang != null){
				$query = $this->MBarang->get_data('rekap_dtl', array('rekap_dtl_id' => $dtl_barang) );
				foreach($query->result() as $row){
					$this->data['stok_awal'] = $row->rekap_dtl_jml; 
				}

				$this->data['isDtl'] = true;
				//count barang beredar
				$count_cpu = $this->MBarang->count_rows('cpu', array('cpu_rekap_dtl_id' => $dtl_barang, 'cpu_status' => 1));
				$count_laptop = $this->MBarang->count_rows('laptop', array('laptop_rekap_dtl_id' => $dtl_barang, 'laptop_status' => 1));
				$count_smartphone = $this->MBarang->count_rows('smartphone', array('smartphone_rekap_dtl_id' => $dtl_barang, 'smartphone_status' => 1));
				$count_imac = $this->MBarang->count_rows('imac', array('imac_rekap_dtl_id' => $dtl_barang, 'imac_status' => 1));
				$count_barang = $this->MBarang->count_rows('barang', array('barang_rekap_dtl_id' => $dtl_barang, 'barang_status' => 1));

				//count barang ditambahkan 
				$d_count_cpu = $this->MBarang->count_rows('cpu', array('cpu_rekap_dtl_id' => $dtl_barang));
				$d_count_laptop = $this->MBarang->count_rows('laptop', array('laptop_rekap_dtl_id' => $dtl_barang));
				$d_count_smartphone = $this->MBarang->count_rows('smartphone', array('smartphone_rekap_dtl_id' => $dtl_barang));
				$d_count_imac = $this->MBarang->count_rows('imac', array('imac_rekap_dtl_id' => $dtl_barang));
				$d_count_barang = $this->MBarang->count_rows('barang', array('barang_rekap_dtl_id' => $dtl_barang));

				$this->data['jml_ditambahkan'] = $d_count_cpu + $d_count_laptop + $d_count_smartphone + $d_count_imac + $d_count_barang;
				$this->data['jml_beredar'] = $count_cpu + $count_laptop + $count_smartphone + $count_imac + $count_barang;
				$this->data['selectedDtlBarang'] = $dtl_barang;

				if($this->data['stok_awal'] == $this->data['jml_ditambahkan']){
					$this->data['isDtl'] = false;
					echo "<script>alert('Stok Habis.');</script>";
				}
			}
			$this->data['listDtlBarang'] = $this->MBarang->get_data('rekap_dtl',array('rekap_dtl_id_rekap' => $no_po));
		}elseif($no_po == 999999){
			$this->data['showJenisBarang'] = true;
		}

		$this->data['title'] = 'Import Barang';
		$this->data['action'] = 'barang/process_import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang;
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['additional'] = "include/plus_form_import_barang.php";
		$this->load->template('barang/add/v_form_import_barang', $this->data);
	
	}

	public function process_import($no_po = null, $dtl_barang = null, $jenis_barang = null)
	{
		
        //count barang ditambahkan 
        $query = $this->MBarang->get_data('rekap_dtl', array('rekap_dtl_id' => $dtl_barang) );
		foreach($query->result() as $row){
			$stok_awal = $row->rekap_dtl_jml; 
		}

		//lokasi dan sublokasi
		$lokasi = $this->_get_sn('rekap', 'rekap_id', $no_po, 'rekap_lokasi');
		$sub_lokasi = $this->_get_sn('rekap', 'rekap_id', $no_po, 'rekap_sub_lokasi');

		//cek lokasi
		$lokasi = $this->_get_sn('rekap', 'rekap_id', $no_po, 'rekap_lokasi');
		$sub_lokasi = $this->_get_sn('rekap', 'rekap_id', $no_po, 'rekap_sub_lokasi');

		$url_redirect = "barang/import/".$no_po."/".$dtl_barang."/".$jenis_barang;

		if($lokasi == null || $sub_lokasi == null){
			$this->set_message(0, "Data gagal ditambahkan, Lokasi di PO masih kosong.");
			redirect(site_url($url_redirect),'refresh');
		}

		$d_count_cpu = $this->MBarang->count_rows('cpu', array('cpu_rekap_dtl_id' => $dtl_barang));
		$d_count_laptop = $this->MBarang->count_rows('laptop', array('laptop_rekap_dtl_id' => $dtl_barang));
		$d_count_smartphone = $this->MBarang->count_rows('smartphone', array('smartphone_rekap_dtl_id' => $dtl_barang));
		$d_count_imac = $this->MBarang->count_rows('imac', array('imac_rekap_dtl_id' => $dtl_barang));
		$d_count_barang = $this->MBarang->count_rows('barang', array('barang_rekap_dtl_id' => $dtl_barang));

		$stok_sekarang = $d_count_cpu + $d_count_laptop + $d_count_smartphone + $d_count_imac + $d_count_barang;

        $config['upload_path']          = './assets/upload/';
        $config['allowed_types']        = 'csv|xls|xlsx';
        $type_barang = $this->_get_nama_jenis_barang($jenis_barang);
        $file_name = 'file_'.$type_barang.'-'.date('Y-m-d-H-i-s-').$_SESSION["username"].".xlsx";
        $config['file_name']        	= $file_name;
        $this->load->library('upload', $config);

        if($this->upload->do_upload('file_import')){
        	$file = "./assets/upload/".$file_name;
			$this->load->library('excel');

			//read file from path
			$objPHPExcel = PHPExcel_IOFactory::load($file);
			$objWorksheet = $objPHPExcel->getActiveSheet();
			$jmlRecord = $objWorksheet->getHighestRow();

			$added = $stok_sekarang + $jmlRecord - 1; //karena highest row +1
			if($added > $stok_awal){
				echo "<script>alert('Barang yang ditambahkan melebihi stok awal $stok_awal, silahkan ulangi import lagi.')</script>";
				redirect('barang/import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang, 'refresh');
			}	
					
			$row = 2;
			$this->db->trans_start();
			for ($i = 1; $i < $jmlRecord; $i++) {
				$no_asset[$i] = $objWorksheet->getCell("A".$row)->getValue();
			   	$no_it[$i] = $objWorksheet->getCell("B".$row)->getValue();
			   	$serial_number[$i] = $objWorksheet->getCell("C".$row)->getValue();
				
				//cek no_it
				if($jenis_barang == 1){
					$service_tag[$i] = $objWorksheet->getCell("D".$row)->getValue();

					if($service_tag[$i] != ""){
						$cek_service_tag = $this->MBarang->is_exist('cpu', array('cpu_service_tag' =>  $service_tag[$i]));
					}

					if($cek_service_tag == true){
						echo "<script>alert('Service Tag $service_tag[$i] sudah ada di database. Silahkan ulangi proses import.')</script>";
						$this->db->trans_rollback();
						redirect('barang/import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang, 'refresh');
					}


					if($no_it[$i] != ""){
						$cek_no_it = $this->MBarang->is_exist('cpu', array('cpu_no_it' =>  $no_it[$i]));
					}else{
						$cek_no_it = false;
					}
					
					if($cek_no_it == true){
						echo "<script>alert('NO IT $no_it[$i] sudah ada di database. Silahkan ulangi proses import.')</script>";
						$this->db->trans_rollback();
						redirect('barang/import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang, 'refresh');
					}else{
							$data = array(	'cpu_no_po' => $no_po,
									'cpu_rekap_dtl_id' => $dtl_barang,
									'cpu_no_asset' => $no_asset[$i], 
									'cpu_no_it' => $no_it[$i], 
									'cpu_service_tag' => $service_tag[$i], 
									'cpu_sn' => $serial_number[$i],
									'cpu_location' => $lokasi,
									'cpu_sub_location' => $sub_lokasi,
									'cpu_id_creator' => $_SESSION["user_id"],
									'cpu_time_create' => date('Y-m-d H:i:s')
								);
							$table = "cpu";
							//print_r($data);
					}
				}elseif($jenis_barang == 100){
					$sn_hd[$i] = $objWorksheet->getCell("D".$row)->getValue();
					$sn_baterai[$i] = $objWorksheet->getCell("E".$row)->getValue();
					$sn_charger[$i] = $objWorksheet->getCell("F".$row)->getValue();

					$cek_sn = $this->MBarang->is_exist('laptop', array('laptop_sn_lp' =>  $serial_number[$i]));

					if($cek_sn == true){
						echo "<script>alert('S/N $serial_number[$i] sudah ada di database. Silahkan ulangi proses import.')</script>";
						$this->db->trans_rollback();
						redirect('barang/import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang, 'refresh');
					}

					$cek_no_it = $this->MBarang->is_exist('laptop', array('laptop_no_it' =>  $no_it[$i]));
					if($cek_no_it == true){
						echo "<script>alert('NO IT $no_it[$i] sudah ada di database. Silahkan ulangi proses import.')</script>";
						//$this->db->trans_rollback();
						redirect('barang/import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang, 'refresh');
					}else{
							$data = array(	'laptop_no_po' => $no_po,
									'laptop_rekap_dtl_id' => $dtl_barang,
									'laptop_no_asset' => $no_asset[$i], 
									'laptop_no_it' => $no_it[$i], 
									'laptop_sn_lp' => $serial_number[$i],
									'laptop_sn_hd' => $sn_hd[$i],
									'laptop_sn_baterai' => $sn_baterai[$i],
									'laptop_sn_charger' => $sn_charger[$i],
									'laptop_location' => $lokasi,
									'laptop_sub_location' => $sub_lokasi,
									'laptop_id_creator' => $_SESSION["user_id"],
									'laptop_time_create' => date('Y-m-d H:i:s')
								);
							$table = "laptop";
					}
				}elseif($jenis_barang == 200){
					$imei1[$i] = $objWorksheet->getCell("D".$row)->getValue();
					$imei2[$i] = $objWorksheet->getCell("E".$row)->getValue();

					$cek_sn = $this->MBarang->is_exist('smartphone', array('smartphone_sn' =>  $serial_number[$i]));

					if($cek_sn == true){
						echo "<script>alert('S/N $serial_number[$i] sudah ada di database. Silahkan ulangi proses import.')</script>";
						$this->db->trans_rollback();
						redirect('barang/import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang, 'refresh');
					}

					$cek_no_it = $this->MBarang->is_exist('smartphone', array('smartphone_no_it' =>  $no_it[$i]));
					if($cek_no_it == true){
						echo "<script>alert('NO IT $no_it[$i] sudah ada di database. Silahkan ulangi proses import.')</script>";
						$this->db->trans_rollback();
						redirect('barang/import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang, 'refresh');
					}else{
							$data = array(	'smartphone_no_po' => $no_po,
									'smartphone_rekap_dtl_id' => $dtl_barang,
									'smartphone_no_asset' => $no_asset[$i], 
									'smartphone_no_it' => $no_it[$i], 
									'smartphone_sn' => $serial_number[$i],
									'smartphone_imei1' => $imei1[$i],
									'smartphone_imei2' => $imei2[$i],
									'smartphone_location' => $lokasi,
									'smartphone_sub_location' => $sub_lokasi,
									'smartphone_id_creator' => $_SESSION["user_id"],
									'smartphone_time_create' => date('Y-m-d H:i:s')
								);
							$table = "smartphone";
					}
				}elseif($jenis_barang == 300){
					$sn_keyboard[$i] = $objWorksheet->getCell("D".$row)->getValue();
					$sn_mouse[$i] = $objWorksheet->getCell("E".$row)->getValue();

					$cek_sn = $this->MBarang->is_exist('imac', array('imac_sn' =>  $serial_number[$i]));

					if($cek_sn == true){
						echo "<script>alert('S/N $serial_number[$i] sudah ada di database. Silahkan ulangi proses import.')</script>";
						$this->db->trans_rollback();
						redirect('barang/import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang, 'refresh');
					}

					$cek_no_it = $this->MBarang->is_exist('imac', array('imac_no_it' =>  $no_it[$i]));
					if($cek_no_it == true){
						echo "<script>alert('NO IT $no_it[$i] sudah ada di database. Silahkan ulangi proses import.')</script>";
						$this->db->trans_rollback();
						redirect('barang/import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang, 'refresh');
					}else{
							$data = array(	'imac_no_po' => $no_po,
									'imac_rekap_dtl_id' => $dtl_barang,
									'imac_no_asset' => $no_asset[$i], 
									'imac_no_it' => $no_it[$i], 
									'imac_sn' => $serial_number[$i],
									'imac_sn_keyboard' => $sn_keyboard[$i],
									'imac_sn_mouse' => $sn_mouse[$i],
									'imac_location' => $lokasi,
									'imac_sub_location' => $sub_lokasi,
									'imac_id_creator' => $_SESSION["user_id"],
									'imac_time_create' => date('Y-m-d H:i:s')
								);
							$table = "imac";
					}
				}else{

					if($no_it[$i] != ""){
						$cek_no_it = $this->MBarang->is_exist('barang', array('barang_no_it' =>  $no_it[$i]));
					}else{
						$cek_no_it = false;
					}
					
					$cek_sn = $this->MBarang->is_exist('barang', array('barang_sn' =>  $serial_number[$i]));

					if($cek_sn == true){
						echo "<script>alert('S/N $serial_number[$i] sudah ada di database. Silahkan ulangi proses import.')</script>";
						$this->db->trans_rollback();
						redirect('barang/import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang, 'refresh');
					}

					if($cek_no_it == true){
						echo "<script>alert('NO IT $no_it[$i] sudah ada di database. Silahkan ulangi proses import.')</script>";
						$this->db->trans_rollback();
						redirect('barang/import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang, 'refresh');
					}else{
							$data = array(	'barang_jenis_barang_id' => $jenis_barang,
									'barang_no_po' => $no_po,
									'barang_rekap_dtl_id' => $dtl_barang,
									'barang_no_asset' => htmlentities($no_asset[$i]), 
									'barang_no_it' => htmlentities($no_it[$i]), 
									'barang_sn' => htmlentities($serial_number[$i]),
									'barang_location' => $lokasi,
									'barang_sub_location' => $sub_lokasi,
									'barang_id_creator' => $_SESSION["user_id"],
									'barang_time_create' => date('Y-m-d H:i:s')
								);
							$table = "barang";

							//print_r($data);
					}
				}

				$row++;
				$query = $this->MBarang->add($table, $data);
				//echo $row;
			}
        }else{
        	$msg = $this->upload->display_errors();
        	echo "<script>alert('$msg')</script>";
			redirect('barang/import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang, 'refresh');
        }

        $this->db->trans_complete();
        if($query){
			echo "<script>alert('Data berhasil di import.')</script>";
			redirect('barang/import/'.$no_po.'/'.$dtl_barang.'/'.$jenis_barang, 'refresh');
		}
	}

	public function history($jenis_barang = null, $id = null)
	{
		$criteria = array('cpu_id' => $id);
		$query = $this->MBarang->get_data_table('ex_cpu', $criteria, 'cpu_id', 'desc');

		foreach ($query->result() as $row) {
			echo $row->cpu_user;
		}
	}


	//to create nomor dokumen
	private function _create_no_dok()
	{
		$query = $this->MBarang->get_data('no', array('no_id' => 1) );

		$row = $query->row();

		if(isset($row)){
			foreach($query->result() as $row){
				$no = $row->no_val;
				$val = $no;
			}

			if($val < 10 AND $val >= 1){
				$val = "00".$val;
			}elseif($val < 100 AND $val >= 10){
				$val = "0".$val;
			}
		}

		$month = $this->_convert_month(date("m"));
		$year = date("Y");
		$no_dok = "FFFB/".$val."/".$month."/".$year;

		//$this->MBarang->update_table('barang_id', $ups_id[$i], 'barang', $data_ups);
		//update no on table
		$this->MBarang->update_table('no_id', 1, 'no', array('no_val' => $no+1));
		return $no_dok;
	}

	private function _convert_month($val)
	{	
		if($val == 1){
			return "I";
		}elseif($val == 2){
			return "II";
		}elseif($val == 3){
			return "III";
		}elseif($val == 4){
			return "IV";
		}elseif($val == 5){
			return "V";
		}elseif($val == 6){
			return "VI";
		}elseif($val == 7){
			return "VII";
		}elseif($val == 8){
			return "VIII";
		}elseif($val == 9){
			return "IX";
		}elseif($val == 10){
			return "X";
		}elseif($val == 11){
			return "XI";
		}elseif($val == 12){
			return "XII";
		}
	}
}