<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class lapor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('BarangModel', 'MBarang');
		if (!$this->load->check_session_admin()) return;
	}

	public function peminjaman($param = null, $param1 = null)
	{
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['additional'] = "include/plus_peminjaman.php";

		if($param == 'add'){
			$this->data['action'] = 'lapor/peminjaman_barang/';
			$this->data['title'] = 'Peminjaman';
			$this->load->template('lapor/v_peminjaman', $this->data);
		}elseif($param == 'daftar'){
			$this->data['selectedStatus'] = $param1;
			$this->data['listPIC'] = $this->MBarang->get_data('pic','');
			//$this->data['listPeminjaman'] = $this->MBarang->get_data_table('laporan_peminjaman', array('laporan_peminjaman_status' => $param1), 'laporan_peminjaman_id', 'desc');
			$this->data['listPeminjaman'] = $this->MBarang->list_pinjaman('peminjaman', 'laporan_peminjaman', 'peminjaman_laporan_id = laporan_peminjaman_id', array('laporan_peminjaman_status' => $param1), 'peminjaman_id','DESC');
			$this->data['title'] = 'Daftar Peminjaman';
			$this->load->template('lapor/v_list_peminjaman', $this->data);
		}
		
	}

	public function search_peminjaman($search = null, $sn = null)
	{
		$this->data['additional'] = "include/plus_peminjaman.php";
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['action'] = 'lapor/search_peminjaman/search';
		$this->data['listPIC'] = $this->MBarang->get_data('pic','');
		$this->data['title'] = 'Cari Peminjaman';

		if($search != null){
			if($sn == null){
				$this->data['sn'] = $sn = $this->input->post('sn');	
			}

			$this->data['url_back'] = site_url('lapor/search_peminjaman/search/'.$sn);
			$this->data['listPeminjaman'] = $this->MBarang->search_pinjaman('peminjaman', 'laporan_peminjaman', 'peminjaman_laporan_id = laporan_peminjaman_id', 'peminjaman_barang_sn', $sn, 'peminjaman_id', 'DESC');
			$this->load->template('lapor/v_cari_peminjaman', $this->data);
		}else{
			$param1 = 999;
			
			$this->data['listPeminjaman'] = $this->MBarang->get_data_table('laporan_peminjaman', array('laporan_peminjaman_status' => $param1), 'laporan_peminjaman_id', 'desc');
			$this->load->template('lapor/v_list_peminjaman', $this->data);
		}
	}

	public function terima_barang_pinjaman($id)
	{
		$this->db->trans_start();

		$penerima = $this->input->post('penerima');
		$tgl_kembali = $this->input->post('tgl_kembali');
		$query = $this->MBarang->update_table('laporan_peminjaman_id', $id, 'laporan_peminjaman', 
			array(	'laporan_peminjaman_status' => 1, 
					'laporan_peminjaman_penerima' => $penerima, 
					'laporan_peminjaman_tgl_kembali' => $tgl_kembali,
					'laporan_peminjaman_editor_id' =>$_SESSION["user_id"],
					'laporan_peminjaman_edit_time' =>date('Y-m-d H:i:s')
				));

		//cek barang yg dipinjam
		$query1 = $this->MBarang->get_data_table('peminjaman', array('peminjaman_laporan_id' => $id), 'peminjaman_id', 'desc');
		foreach($query1->result() as $row){

			if($row->peminjaman_jenis_barang == 1){
				$this->MBarang->update_table('cpu_id', $row->peminjaman_barang_id, 'cpu', array('cpu_status' => 0, 'cpu_user' => NULL) );
			}elseif($row->peminjaman_jenis_barang == 100){
				$this->MBarang->update_table('laptop_id', $row->peminjaman_barang_id, 'laptop', array('laptop_status' => 0, 'laptop_user' => NULL) );
			}elseif($row->peminjaman_jenis_barang == 200){
				$this->MBarang->update_table('smartphone_id', $row->peminjaman_barang_id, 'smartphone', array('smartphone_status' => 0, 'smartphone_user' => NULL) );
			}elseif($row->peminjaman_jenis_barang == 300){
				$this->MBarang->update_table('imac_id', $row->peminjaman_barang_id, 'imac', array('imac_status' => 0, 'imac_user' => NULL) );
			}else{
				$this->MBarang->update_table('barang_id', $row->peminjaman_barang_id, 'barang', array('barang_status' => 0, 'barang_user' => NULL) );
			}
		}

		$this->db->trans_complete();

		if($query){
			$this->set_message(1, "Success.");
		}else{
			$this->set_message(0, "Data gagal ditambahkan, silahkan ulangi lagi.");
		}
		redirect(site_url('lapor/peminjaman/daftar/1'),'refresh');

	}

	public function detail_peminjaman($id = null)
	{
		$query = $this->MBarang->get_data_table('laporan_peminjaman', array('laporan_peminjaman_id' => $id), 'laporan_peminjaman_id', 'desc');
		$this->data['additional'] = "include/plus_peminjaman.php";
		$this->data['listPIC'] = $this->MBarang->get_data('pic','');
		$this->data['action'] = 'lapor/terima_barang_pinjaman/'.$id;

		foreach($query->result() as $row){
			$this->data['tgl_pinjam'] = $row->laporan_peminjaman_tgl_pinjam;
			$this->data['tgl_estimasi'] = $row->laporan_peminjaman_estimasi;
			$this->data['user'] = $row->laporan_peminjaman_user;
			$this->data['penyerah'] = $row->laporan_peminjaman_penyerah;
			$this->data['penerima'] = $row->laporan_peminjaman_penerima;
			$this->data['status'] = $row->laporan_peminjaman_status;
			$this->data['ket'] = $row->laporan_peminjaman_ket;
			$this->data['creator'] = $this->_get_username($row->laporan_peminjaman_create_id);
			$this->data['time_create'] = $row->laporan_peminjaman_create_time;
			if($row->laporan_peminjaman_status != 0){
				$this->data['tgl_kembali'] = $row->laporan_peminjaman_tgl_kembali;
				$this->data['penerima_id'] = $this->_get_username($row->laporan_peminjaman_editor_id);
				$this->data['terima_create'] = $row->laporan_peminjaman_edit_time;
			}
		}

		//cek barang yg dipinjam
		$query1 = $this->MBarang->get_data_table('peminjaman', array('peminjaman_laporan_id' => $id), 'peminjaman_id', 'desc');
		foreach($query1->result() as $row){
			$this->data['jenis_barang'][] = $this->_get_sn_barang('type_barang', array('id'=>$row->peminjaman_jenis_barang), 'nama');
			//$this->data['barang'][] = $row->peminjaman_barang_id;

			if($row->peminjaman_jenis_barang == 1){
				$this->data['barang'][] = $this->_get_sn('cpu', 'cpu_id', $row->peminjaman_barang_id, 'cpu_service_tag');
			}elseif($row->peminjaman_jenis_barang == 100){
				$this->data['barang'][] = $this->_get_sn('laptop', 'laptop_id', $row->peminjaman_barang_id, 'laptop_kode');
			}elseif($row->peminjaman_jenis_barang == 200){
				$this->data['barang'][] = $this->_get_sn('smartphone', 'smartphone_id', $row->peminjaman_barang_id, 'smartphone_sn');
			}elseif($row->peminjaman_jenis_barang == 300){
				$this->data['barang'][] = $this->_get_sn('imac', 'imac_id', $row->peminjaman_barang_id, 'imac_sn');
			}else{
				$this->data['barang'][] = $this->_get_sn_barang('barang', array('barang_jenis_barang_id' => $row->peminjaman_jenis_barang, 'barang_id' => $row->peminjaman_barang_id), 'barang_sn');
			}
		}

		$this->data['url_back'] = site_url('lapor/peminjaman/daftar/0');
		$this->data['title'] = 'Detail Peminjaman';
		$this->load->template('lapor/v_detail_peminjaman', $this->data);
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

	//get something search
	private function _get_sn_barang($table = null, $criteria, $column = null)
	{
		$q = $this->MBarang->get_data($table, $criteria);

		foreach($q->result() as $row){
			$name = $row->$column;
		}
		return $name;
	}

	public function peminjaman_barang()
	{
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['listPIC'] = $this->MBarang->get_data('pic','');
		$this->data['jenis_barang'] = $jenis_barang = $this->input->post('jenis_barang');
		$this->data['jenis_barang_nama'] = $jenis_barang = $this->input->post('jenis_barang_nama');
		$jml = $this->input->post('jml');

		//cek apakah 0 semua
		$sum = 0;
		foreach ($jml as $key=>$value) {
			$sum = $sum + $jml[$key];	
		}

		if($sum == 0){
			$this->set_message(0, "Maaf jumlah barang harus lebih dari 0, silahkan ulangi lagi.");
			redirect(site_url('lapor/peminjaman/add'),'refresh');
		}

		$this->data['jml'] = $jml;
		$this->data['location_home'] = $location_home = $this->_get_sn('home_location', 'home_location_id', 1, 'home_location_location');
		$this->data['listCPU'] = $this->MBarang->get_data('cpu',array('cpu_status' => 0, 'cpu_kondisi' => 1, 'cpu_location' => $location_home));
		$this->data['listLaptop'] = $this->MBarang->get_data('laptop',array('laptop_status' => 0, 'laptop_kondisi' => 1, 'laptop_location' => $location_home));
		$this->data['listSmartphone'] = $this->MBarang->get_data('smartphone',array('smartphone_status' => 0, 'smartphone_kondisi' => 1, 'smartphone_location' => $location_home));
		$this->data['listIMAC'] = $this->MBarang->get_data('imac',array('imac_status' => 0, 'imac_kondisi' => 1, 'imac_location' => $location_home));
		
		$this->data['action'] = 'lapor/save_peminjaman_barang';
		$this->data['additional'] = "include/plus_peminjaman.php";
		$this->data['title'] = 'Peminjaman';
		$this->load->template('lapor/v_peminjaman_barang', $this->data);
	}

	public function save_peminjaman_barang()
	{
		$jenis_barang = $this->input->post('jenis_barang');
		$barang = $this->input->post('barang');
		$tgl_pinjam = $this->input->post('tgl_pinjam');
		$tgl_estimasi = $this->input->post('tgl_estimasi');
		$user = $this->input->post('user');
		$penyerah = $this->input->post('penyerah');
		$ket = $this->input->post('ket');

		$data = array( 'laporan_peminjaman_tgl_pinjam' => $tgl_pinjam,
						'laporan_peminjaman_estimasi' =>$tgl_estimasi,
						'laporan_peminjaman_user' =>$user,
						'laporan_peminjaman_penyerah' =>$penyerah,
						'laporan_peminjaman_ket' =>$ket,
						'laporan_peminjaman_create_id' =>$_SESSION["user_id"],
						'laporan_peminjaman_create_time' =>date('Y-m-d H:i:s')
			);

		//cek sn yg sama
		foreach ($jenis_barang as $key=>$value) {
			if($jenis_barang[$key] !=""){
				if($key > 0){
					if($jenis_barang[$key] == $jenis_barang[$key-1]){
						if ($barang[$key] == $barang[$key-1]) {
							$this->set_message(0, "Terdapat SN yang sama, silahkan ulangi lagi.");
							redirect(site_url('lapor/peminjaman/add'),'refresh');
						}
					}
				}
			}
		}

		$this->db->trans_start();
		$insert = $this->MBarang->insert_peminjaman('laporan_peminjaman', $data);
		foreach ($jenis_barang as $key=>$value) {
			if($jenis_barang[$key] !=""){

				$data2 = array('peminjaman_laporan_id' => $insert['laporan_peminjaman_id'],
													'peminjaman_jenis_barang' => $jenis_barang[$key],
													'peminjaman_barang_id' => $barang[$key]
								);

				if($jenis_barang[$key] == 1){
					$qq = $this->MBarang->update_table('cpu_id', $barang[$key], 'cpu', array('cpu_status' => 1, 'cpu_user' => $user) );
					$sn = $this->_get_sn('cpu', 'cpu_id', $barang[$key], 'cpu_service_tag');
				}elseif($jenis_barang[$key] == 100){
					$qq = $this->MBarang->update_table('laptop_id', $barang[$key], 'laptop', array('laptop_status' => 1, 'laptop_user' => $user) );
					$sn = $this->_get_sn('laptop', 'laptop_id', $barang[$key], 'laptop_sn_lp');
				}elseif($jenis_barang[$key] == 200){
					$qq = $this->MBarang->update_table('smartphone_id', $barang[$key], 'smartphone', array('smartphone_status' => 1, 'smartphone_user' => $user) );
					$sn = $this->_get_sn('smartphone', 'smartphone_id', $barang[$key], 'smartphone_sn');
				}elseif($jenis_barang[$key] == 300){
					$qq = $this->MBarang->update_table('imac_id', $barang[$key], 'imac', array('imac_status' => 1, 'imac_user' => $user) );
					$sn = $this->_get_sn('imac', 'imac_id', $barang[$key], 'imac_sn');
				}else{
					$qq = $this->MBarang->update_table('barang_id', $barang[$key], 'barang', array('barang_status' => 1, 'barang_user' => $user) );
					$sn = $this->_get_sn('barang', 'barang_id', $barang[$key], 'barang_sn');
				}

				$data2 = array_merge($data2, array('peminjaman_barang_sn' => $sn));
				$query = $this->MBarang->add('peminjaman', $data2);
			}
		}

		$this->db->trans_complete();

		if($query){
			$this->set_message(1, "Success.");
		}else{
			$this->set_message(0, "Data gagal ditambahkan, silahkan ulangi lagi.");
		}
		redirect(site_url('lapor/peminjaman/daftar/0'),'refresh');
	}

	//function for search something
	private function _get($table = null, $id_s = null, $id = null, $column = null)
	{
		$q = $this->MBarang->get_data($table,array($id_s => $id));

		foreach($q->result() as $row){
			$name = $row->$column;
		}
		return $name;
	}

	public function lost_damage($id = null)
	{
		$query = $this->MBarang->get_data_table('laporan', '','laporan_id','desc');
		$this->data['jenis_barang'] = null;

		foreach($query->result() as $row){
			$jenis_barang = $row->laporan_jenis_barang;
			$this->data['jenis_barang'][] = $this->_get('type_barang', 'id', $row->laporan_jenis_barang, 'nama');
			

			if($jenis_barang == 1){
				$this->data['barang'][] = $this->_get('cpu', 'cpu_id', $row->laporan_barang_id, 'cpu_service_tag');
			}elseif($jenis_barang == 100){
				$this->data['barang'][] = $this->_get('laptop', 'laptop_id', $row->laporan_barang_id, 'laptop_sn_lp');
			}elseif($jenis_barang == 200){
				$this->data['barang'][] = $this->_get('smartphone', 'smartphone_id', $row->laporan_barang_id, 'smartphone_sn');
			}elseif($jenis_barang == 300){
				$this->data['barang'][] = $this->_get('imac', 'imac_id', $row->laporan_barang_id, 'imac_sn');
			}else{
				$this->data['barang'][] = $this->_get('barang', 'barang_id', $row->laporan_barang_id, 'barang_sn');
			}

			$this->data['jenis_laporan'][] = $this->_conv_jenis_laporan($row->laporan_jenis);
			$this->data['tgl'][] = $row->laporan_tgl;
			$this->data['laporan_id'][] = $row->laporan_id;
		}

		$this->data['additional'] = "include/plus_daftar_barang.php";
		$this->data['title'] = 'Daftar Barang Damage and Lost';
		$this->load->template('lapor/v_list_laporan', $this->data);
	}

	public function detail($id = null)
	{

		$this->data['msg'] = $this->session->flashdata('msg');
		$query = $this->MBarang->get_data('laporan',array('laporan_id' => $id));
		$this->data['laporan_id'] = $id;
		 
		foreach($query->result() as $row){
			$jenis_barang = $row->laporan_jenis_barang;
			$this->data['jenis_barang'] = $this->_get('type_barang', 'id', $row->laporan_jenis_barang, 'nama');
			
			if($jenis_barang == 1){
				$this->data['barang'] = $this->_get('cpu', 'cpu_id', $row->laporan_barang_id, 'cpu_service_tag');
			}elseif($jenis_barang == 100){
				$this->data['barang'] = $this->_get('laptop', 'laptop_id', $row->laporan_barang_id, 'laptop_sn_lp');
			}elseif($jenis_barang == 200){
				$this->data['barang'] = $this->_get('smartphone', 'smartphone_id', $row->laporan_barang_id, 'smartphone_sn');
			}elseif($jenis_barang == 300){
				$this->data['barang'] = $this->_get('imac', 'imac_id', $row->laporan_barang_id, 'imac_sn');
			}else{
				$this->data['barang'] = $this->_get('barang', 'barang_id', $row->laporan_barang_id, 'barang_sn');
			}

			$this->data['creator'] = $this->_get_username($row->laporan_create_id);
			$this->data['time_create'] = $row->laporan_create_time;

			$this->data['jenis_laporan'] = $this->_conv_jenis_laporan($row->laporan_jenis);
			$this->data['tgl'] = $row->laporan_tgl;
			$this->data['ket'] = $row->laporan_ket;
		}

		$this->data['title'] = 'Detail Laporan';
		$this->load->template('lapor/v_detail_laporan', $this->data);
	}

	private function _get_username($id = null)
	{
		$q = $this->MBarang->get_data('user',array('user_id' => $id));
		foreach($q->result() as $row){	
			$name = $row->user_username;
		}	
		return $name;
	}


	private function _conv_jenis_laporan($id = null)
	{
		if($id == 1){
			return "<span class='label label-danger'>Kerusakan</span>";
		}elseif($id == 2){
			return "<span class='label label-info'>Service</span>";
		}elseif($id == 3){
			return "<span class='label label-success'>Selesai Service</span>";
		}else{
			return "<span class='label label-default'>Kehilangan</span>";
		}
	}

	public function pengiriman($location = null, $sublocation = null, $jenis_barang = null)
	{
		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['listLocation'] = $this->MBarang->get_data('location','');
		$this->data['listSubLocation'] = $this->MBarang->get_data('dtl_location',array('location_dtl_location_id' => $location));
		$this->data['jenis_barang'] = $jenis_barang;
		$this->data['selectedBarang'] = NULL;
		$this->data['selectedLocation'] = $location;
		$this->data['selectedSubLocation'] = $sublocation;

		if($jenis_barang == 1){
			$this->data['listCPU'] = $this->MBarang->get_data_table('cpu',array('cpu_status' => 0, 'cpu_kondisi' => 1, 'cpu_location' => $location, 'cpu_sub_location' => $sublocation),'cpu_id','desc');
			$this->data['formAssigmentBarang'] = "kirim/v_form_kirim_cpu.php";
		}elseif($jenis_barang == 100){
			$this->data['listLaptop'] = $this->MBarang->get_data_table('laptop',array('laptop_status' => 0, 'laptop_kondisi' => 1, 'laptop_location' => $location, 'laptop_sub_location' => $sublocation),'laptop_id','desc');
			$this->data['formAssigmentBarang'] = "kirim/v_form_kirim_laptop.php";
		}elseif($jenis_barang == 200){
			$this->data['listSmartphone'] = $this->MBarang->get_data_table('smartphone',array('smartphone_status' => 0, 'smartphone_kondisi' => 1, 'smartphone_location' => $location, 'smartphone_sub_location' => $sublocation),'smartphone_id','desc');
			$this->data['formAssigmentBarang'] = "kirim/v_form_kirim_smartphone.php";
		}elseif($jenis_barang == 300){
			$this->data['listImac'] = $this->MBarang->get_data_table('imac',array('imac_status' => 0, 'imac_kondisi' => 1, 'imac_location' => $location, 'imac_sub_location' => $sublocation),'imac_id','desc');
			$this->data['formAssigmentBarang'] = "kirim/v_form_kirim_imac.php";
		}else{
			$this->data['listBarang2'] = $this->MBarang->get_data_table('barang',array('barang_jenis_barang_id' => $jenis_barang, 'barang_status' => 0, 'barang_kondisi' => 1, 'barang_location' => $location, 'barang_sub_location' => $sublocation),'barang_id','desc');
			$this->data['formAssigmentBarang'] = "kirim/v_form_kirim_barang.php";
		}

		$jenis_laporan = 1;
		$this->data['msg'] = $this->session->flashdata('msg');
		//$this->data['action'] = 'lapor/save/'.$jenis_laporan."/".$jenis_barang;
		$this->data['action'] = 'lapor/save_pengiriman';

		$this->data['selectedJenisBarang'] = $jenis_barang;
		$this->data['additional'] = "include/plus_kirim_barang.php";
		$this->data['title'] = 'Pelaporan Pengiriman Barang';
		$this->load->template('lapor/v_kirim_barang', $this->data);
	}

	public function daftar_pengiriman(){

		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['listPengiriman'] = $this->MBarang->get_data_table('mutasi', '', 'mutasi_id', 'desc');
		$this->data['jenisBarang'] = $this->MBarang->get_data_table('type_barang', '', 'id', 'desc');
		$this->data['location'] = $this->MBarang->get_data_table('location', '', 'location_id', 'desc');
		$this->data['title'] = 'Daftar Pengiriman';
		$this->load->template('lapor/v_list_pengiriman', $this->data);
	}

	public function terima_barang($id = null){

		$this->db->trans_start();

		$query = $this->MBarang->get_data('mutasi',array('mutasi_id' => $id));

		foreach($query->result() as $row){

			$sn = $row->mutasi_sn_barang;
			$jenis_barang = $row->mutasi_jenis_barang;
			$lokasi_tujuan = $row->mutasi_lokasi_tujuan;
		}

		$barang = explode(",", $sn);

		for($i=0; $i<count($barang); $i++){
			//update location
			if($jenis_barang == 1){
				$query = $this->MBarang->update_table('cpu_id', $barang[$i], 'cpu', array('cpu_location' => $lokasi_tujuan));
				$query = $this->MBarang->update_table('cpu_id', $barang[$i], 'cpu', array('cpu_sub_location' => 0));
			}
			elseif($jenis_barang == 100){
				$query = $this->MBarang->update_table('laptop_id', $barang[$i], 'laptop', array('laptop_location' => $lokasi_tujuan));
				$query = $this->MBarang->update_table('laptop_id', $barang[$i], 'laptop', array('laptop_sub_location' => 0));
			}elseif($jenis_barang == 200){
				$query = $this->MBarang->update_table('smartphone_id', $barang[$i], 'smartphone', array('smartphone_location' => $lokasi_tujuan));
				$query = $this->MBarang->update_table('smartphone_id', $barang[$i], 'smartphone', array('smartphone_sub_location' => 0));
			}elseif($jenis_barang == 300){
				$query = $this->MBarang->update_table('imac_id', $barang[$i], 'imac', array('imac_location' => $lokasi_tujuan));
				$query = $this->MBarang->update_table('imac_id', $barang[$i], 'imac', array('imac_sub_location' => 0));
			}else{
				$query = $this->MBarang->update_barang($jenis_barang, $barang[$i], 'barang', array('barang_location'=> $lokasi_tujuan));
				$query = $this->MBarang->update_barang($jenis_barang, $barang[$i], 'barang', array('barang_sub_location'=> 0));
			}
		}

		//update status
		$data = array('mutasi_status' => 1, 'mutasi_tgl_terima' => date('Y-m-d H:i:s'));
		$query = $this->MBarang->update_table('mutasi_id', $id, 'mutasi', $data);

		if($query){
			$this->set_message(1, "Success.");
		}else{
			$this->set_message(0, "Data gagal ditambahkan, silahkan ulangi lagi.");
		}

		echo $jenis_barang;
		$this->db->trans_complete();
		
		$url_redirect = "lapor/detail_pengiriman/".$id;
		redirect(site_url($url_redirect),'refresh');
	}



	public function detail_pengiriman($id = null){

		$this->data['msg'] = $this->session->flashdata('msg');
		$query = $this->MBarang->get_data('mutasi',array('mutasi_id' => $id));
		$this->data['mutasi_id'] = $id;
		 
		foreach($query->result() as $row){
			$this->data['lokasi'] = $this->_get('location', 'location_id', $row->mutasi_lokasi, 'location_nama');
			$this->data['sublokasi'] = $this->_get('dtl_location', 'location_dtl_id', $row->mutasi_sub_lokasi, 'location_dtl_nama');
			$jenis_barang = $row->mutasi_jenis_barang;
			$this->data['jenis_barang'] = $this->_get('type_barang', 'id', $row->mutasi_jenis_barang, 'nama');
			$this->data['lokasi_tujuan'] = $this->_get('location', 'location_id', $row->mutasi_lokasi_tujuan, 'location_nama');
			$this->data['pic'] = $row->mutasi_pic;
			$this->data['tgl_kirim'] = $row->mutasi_tgl_kirim;
			$this->data['tgl_terima'] = $row->mutasi_tgl_terima;
			$this->data['status'] = $this-> _convert_status($row->mutasi_status);
			$this->data['status2'] = $row->mutasi_status;
			$this->data['ket'] = $row->mutasi_ket;
			$this->data['creator'] = $row->mutasi_create_id;
			$this->data['create_time'] = $row->mutasi_create_time;

			$sn = $row->mutasi_sn_barang;
		}

		$sn = explode(",", $sn);

		for($i=0; $i<count($sn); $i++){
			//echo $sn[$i];

			if($jenis_barang == 1){
				$this->data['sn'][] = $this->_get('cpu', 'cpu_id', $sn[$i], 'cpu_sn');
			}
			elseif($jenis_barang == 100){
				$this->data['sn'][] = $this->_get('laptop', 'laptop_id', $sn[$i], 'laptop_sn_lp');
			}elseif($jenis_barang == 200){
				$this->data['sn'][] = $this->_get('smartphone', 'smartphone_id', $sn[$i], 'smartphone_sn');
			}elseif($jenis_barang == 300){
				$this->data['sn'][] = $this->_get('imac', 'imac_id', $sn[$i], 'imac_sn');
			}
			else{
				$this->data['sn'][] = $this->_get('barang', 'barang_id', $sn[$i], 'barang_sn');
			}
		}


		$this->data['title'] = 'Detail Pengiriman';
		$this->load->template('lapor/v_detail_pengiriman', $this->data);
	}

	private function _convert_status($id = null)
	{
		if($id == 0){
			return "Belum Terkirim";
		}else{
			return "Sudah Terkirim";
		}
	}

	public function save_pengiriman()
	{
		$this->db->trans_start();
		$lokasi =  $this->input->post('lokasi');
		$sublokasi =  $this->input->post('sublokasi');
		$jenis_barang =  $this->input->post('jenis_barang');
		$lokasi_tujuan =  $this->input->post('lokasi_tujuan');
		$pic =  $this->input->post('pic');
		$tgl_kirim =  $this->input->post('tgl_kirim');
		$ket =  $this->input->post('ket');
		$barang =  $this->input->post('barang');
		
		$n = count($barang);
		$sn = '';
		for($i=0; $i<$n; $i++){
			
			if($i < $n-1){
				$sn = $sn.$barang[$i].",";
			}else{
				$sn = $sn.$barang[$i];
			}

			//update location
			// if($jenis_barang == 1){
			// 	$this->MBarang->update_table('cpu_id', $barang[$i], 'cpu', array('cpu_location' => $lokasi_tujuan));
			// }
			// elseif($jenis_barang == 100){
			// 	$this->MBarang->update_table('laptop_id', $barang[$i], 'laptop', array('laptop_location' => $lokasi_tujuan));
			// }elseif($jenis_barang == 200){
			// 	$this->MBarang->update_table('smartphone_id', $barang[$i], 'smartphone', array('smartphone_location' => $lokasi_tujuan));
			// }elseif($jenis_barang == 300){
			// 	$this->MBarang->update_table('imac_id', $barang[$i], 'imac', array('imac_location' => $lokasi_tujuan));
			// }else{
			// 	$this->MBarang->update_barang($jenis_barang, $barang[$i], 'barang', ('barang_location' => $lokasi_tujuan));
			// }
		}



		$data = array(	'mutasi_lokasi' => $lokasi,
						'mutasi_sub_lokasi' => $sublokasi,
						'mutasi_jenis_barang' => $jenis_barang,
						'mutasi_sn_barang' => $sn,
						'mutasi_lokasi_tujuan' => $lokasi_tujuan,
						'mutasi_pic' => $pic,
						'mutasi_tgl_kirim' => $tgl_kirim,
						'mutasi_ket' => $ket,
						'mutasi_create_id' => $_SESSION["user_id"],
						'mutasi_create_time' => date('Y-m-d H:i:s')
					);

		$query = $this->MBarang->add('mutasi', $data);
		
		if($query){
			$this->set_message(1, "Success.");
		}else{
			$this->set_message(0, "Data gagal ditambahkan, silahkan ulangi lagi.");
		}
		$this->db->trans_complete();
		$url_redirect = "lapor/pengiriman";
		redirect(site_url($url_redirect),'refresh');
	}

	public function kerusakan($jenis_barang = null)
	{

		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['jenis_barang'] = $jenis_barang;
		$this->data['selectedBarang'] = NULL;

		if($jenis_barang == 1){
			$this->data['listCPU'] = $this->MBarang->get_data_table('cpu',array('cpu_status' => 0, 'cpu_kondisi' => 1),'cpu_id','desc');
			$this->data['formAssigmentBarang'] = "additional/v_form_kerusakan_cpu.php";
		}elseif($jenis_barang == 100){
			$this->data['listLaptop'] = $this->MBarang->get_data_table('laptop',array('laptop_status' => 0, 'laptop_kondisi' => 1),'laptop_id','desc');
			$this->data['formAssigmentBarang'] = "additional/v_form_kerusakan_laptop.php";
		}elseif($jenis_barang == 200){
			$this->data['listSmartphone'] = $this->MBarang->get_data_table('smartphone',array('smartphone_status' => 0, 'smartphone_kondisi' => 1),'smartphone_id','desc');
			$this->data['formAssigmentBarang'] = "additional/v_form_kerusakan_smartphone.php";
		}elseif($jenis_barang == 300){
			$this->data['listImac'] = $this->MBarang->get_data_table('imac',array('imac_status' => 0, 'imac_kondisi' => 1),'imac_id','desc');
			$this->data['formAssigmentBarang'] = "additional/v_form_kerusakan_imac.php";
		}else{
			$this->data['listBarang2'] = $this->MBarang->get_data_table('barang',array('barang_jenis_barang_id' => $jenis_barang, 'barang_status' => 0, 'barang_kondisi' => 1),'barang_id','desc');
			$this->data['formAssigmentBarang'] = "additional/v_form_kerusakan_barang.php";
		}

		$jenis_laporan = 1;
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['action'] = 'lapor/save/'.$jenis_laporan."/".$jenis_barang;

		$this->data['selectedJenisBarang'] = $jenis_barang;
		$this->data['additional'] = "include/plus_form_kerusakan.php";
		$this->data['title'] = 'Pelaporan Barang Rusak';
		$this->load->template('lapor/v_barang_rusak', $this->data);
	}

	public function kehilangan($jenis_barang = null)
	{

		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['jenis_barang'] = $jenis_barang;
		$this->data['selectedBarang'] = NULL;

		if($jenis_barang == 1){
			$this->data['listCPU'] = $this->MBarang->get_data_table('cpu','','cpu_id','desc');
			$this->data['formAssigmentBarang'] = "additional/v_form_kerusakan_cpu.php";
		}elseif($jenis_barang == 100){
			$this->data['listLaptop'] = $this->MBarang->get_data_table('laptop','','laptop_id','desc');
			$this->data['formAssigmentBarang'] = "additional/v_form_kerusakan_laptop.php";
		}elseif($jenis_barang == 200){
			$this->data['listSmartphone'] = $this->MBarang->get_data_table('smartphone','','smartphone_id','desc');
			$this->data['formAssigmentBarang'] = "additional/v_form_kerusakan_smartphone.php";
		}elseif($jenis_barang == 300){
			$this->data['listImac'] = $this->MBarang->get_data_table('imac','','imac_id','desc');
			$this->data['formAssigmentBarang'] = "additional/v_form_kerusakan_imac.php";
		}else{
			$this->data['listBarang2'] = $this->MBarang->get_data_table('barang',array('barang_jenis_barang_id' => $jenis_barang),'barang_id','desc');
			$this->data['formAssigmentBarang'] = "additional/v_form_kerusakan_barang.php";
		}

		$jenis_laporan = 4;
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['action'] = 'lapor/save/'.$jenis_laporan."/".$jenis_barang;

		$this->data['selectedJenisBarang'] = $jenis_barang;
		$this->data['additional'] = "include/plus_form_kehilangan.php";
		$this->data['title'] = 'Pelaporan Barang Hilang';
		$this->load->template('lapor/v_barang_hilang', $this->data);
	}

	public function service($jenis_barang = null, $barang_id = null)
	{

		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['jenis_barang'] = $jenis_barang;
		$this->data['selectedBarang'] = $barang_id;
		$this->data['dtl'] = $this->MBarang->get_data('laporan',array('laporan_jenis_barang' => $jenis_barang, 'laporan_barang_id' => $barang_id));

		if($jenis_barang == 1){
			$this->data['listCPU'] = $this->MBarang->get_data_table('cpu',array('cpu_status' => 0, 'cpu_kondisi' => 2),'cpu_id','desc');
			$this->data['formAssigmentBarang'] = "additional/v_form_kerusakan_cpu.php";
		}elseif($jenis_barang == 100){
			$this->data['listLaptop'] = $this->MBarang->get_data_table('laptop',array('laptop_status' => 0, 'laptop_kondisi' => 2),'laptop_id','desc');
			$this->data['formAssigmentBarang'] = "additional/v_form_kerusakan_laptop.php";
		}elseif($jenis_barang == 200){
			$this->data['listSmartphone'] = $this->MBarang->get_data_table('smartphone',array('smartphone_status' => 0, 'smartphone_kondisi' => 2),'smartphone_id','desc');
			$this->data['formAssigmentBarang'] = "additional/v_form_kerusakan_smartphone.php";
		}elseif($jenis_barang == 300){
			$this->data['listImac'] = $this->MBarang->get_data_table('imac',array('imac_status' => 0, 'imac_kondisi' => 2),'imac_id','desc');
			$this->data['formAssigmentBarang'] = "additional/v_form_kerusakan_imac.php";
		}else{
			$this->data['listBarang2'] = $this->MBarang->get_data_table('barang',array('barang_jenis_barang_id' => $jenis_barang, 'barang_status' => 0, 'barang_kondisi' => 2),'barang_id','desc');
			$this->data['formAssigmentBarang'] = "additional/v_form_kerusakan_barang.php";
		}

		$jenis_laporan = 2;
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['action'] = 'lapor/save/'.$jenis_laporan."/".$jenis_barang;

		$this->data['selectedJenisBarang'] = $jenis_barang;
		$this->data['additional'] = "include/plus_form_servis.php";
		$this->data['title'] = 'Pelaporan Servis Barang';
		$this->load->template('lapor/v_barang_rusak', $this->data);
	}

	public function after_service($jenis_barang = null, $barang_id = null)
	{

		$this->data['listBarang'] = $this->MBarang->get_data('type_barang','');
		$this->data['jenis_barang'] = $jenis_barang;
		$this->data['selectedBarang'] = $barang_id;
		$this->data['dtl'] = $this->MBarang->get_data('laporan',array('laporan_jenis' => 1,'laporan_jenis_barang' => $jenis_barang, 'laporan_barang_id' => $barang_id));
		$this->data['dtlService'] = $this->MBarang->get_data('laporan',array('laporan_jenis' => 2,'laporan_jenis_barang' => $jenis_barang, 'laporan_barang_id' => $barang_id));

		if($jenis_barang == 1){
			$this->data['listCPU'] = $this->MBarang->get_data_table('cpu',array('cpu_status' => 0, 'cpu_kondisi' => 3),'cpu_id','desc');
			$this->data['formAssigmentBarang'] = "additional/v_form_kerusakan_cpu.php";
		}elseif($jenis_barang == 100){
			$this->data['listLaptop'] = $this->MBarang->get_data_table('laptop',array('laptop_status' => 0, 'laptop_kondisi' => 3),'laptop_id','desc');
			$this->data['formAssigmentBarang'] = "additional/v_form_kerusakan_laptop.php";
		}elseif($jenis_barang == 200){
			$this->data['listSmartphone'] = $this->MBarang->get_data_table('smartphone',array('smartphone_status' => 0, 'smartphone_kondisi' => 3),'smartphone_id','desc');
			$this->data['formAssigmentBarang'] = "additional/v_form_kerusakan_smartphone.php";
		}elseif($jenis_barang == 300){
			$this->data['listImac'] = $this->MBarang->get_data_table('imac',array('imac_status' => 0, 'imac_kondisi' => 3),'imac_id','desc');
			$this->data['formAssigmentBarang'] = "additional/v_form_kerusakan_imac.php";
		}else{
			$this->data['listBarang2'] = $this->MBarang->get_data_table('barang',array('barang_jenis_barang_id' => $jenis_barang, 'barang_status' => 0, 'barang_kondisi' => 3),'barang_id','desc');
			$this->data['formAssigmentBarang'] = "additional/v_form_kerusakan_barang.php";
		}

		$jenis_laporan = 3;
		$this->data['msg'] = $this->session->flashdata('msg');
		$this->data['action'] = 'lapor/save/'.$jenis_laporan."/".$jenis_barang;

		$this->data['selectedJenisBarang'] = $jenis_barang;
		$this->data['additional'] = "include/plus_form_after_servis.php";
		$this->data['title'] = 'Pelaporan After Servis Barang';
		$this->load->template('lapor/v_barang_rusak', $this->data);
	}

	public function save($jenis_laporan = null, $jenis_barang = null)
	{	
		$this->db->trans_start();
		$barang_id = $this->input->post('barang_id');
		$tgl = $this->input->post('tgl');
		$ket = $this->input->post('ket');

		//laporan 1, kerusakan
		if($jenis_laporan == 1){
			$kondisi = 2;
			$method = 'kerusakan';
		}elseif($jenis_laporan == 2){
			//service
			$kondisi = 3;
			$method = 'service';
		}elseif($jenis_laporan == 3){
			//after service
			$kondisi = 1;
			$method = 'after_service';
		}else{
			$kondisi = 4;
			$method = 'kehilangan';
		}

		$data = array(	'laporan_jenis' => $jenis_laporan,
						'laporan_barang_id' => $barang_id,
						'laporan_jenis_barang' => $jenis_barang,
						'laporan_tgl' => $tgl,
						'laporan_ket' => $ket,
						'laporan_create_id' => $_SESSION["user_id"],
						'laporan_create_time' => date('Y-m-d H:i:s')
					);
		$url_redirect = "lapor/".$method."/".$jenis_barang;
		if($jenis_barang == 1){
			$qq = $this->MBarang->update_table('cpu_id', $barang_id, 'cpu', array('cpu_kondisi' => $kondisi) );
		}elseif($jenis_barang == 100){
			$qq = $this->MBarang->update_table('laptop_id', $barang_id, 'laptop', array('laptop_kondisi' => $kondisi) );
		}elseif($jenis_barang == 200){
			$qq = $this->MBarang->update_table('smartphone_id', $barang_id, 'smartphone', array('smartphone_kondisi' => $kondisi) );
		}elseif($jenis_barang == 300){
			$qq = $this->MBarang->update_table('imac_id', $barang_id, 'imac', array('imac_kondisi' => $kondisi) );
		}else{
			$qq = $this->MBarang->update_table('barang_id', $barang_id, 'barang', array('barang_kondisi' => $kondisi) );
		}
		
		$query = $this->MBarang->add('laporan', $data);

		if($query){
			$this->set_message(1, "Success.");
		}else{
			$this->set_message(0, "Data gagal ditambahkan, silahkan ulangi lagi.");
		}

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
}