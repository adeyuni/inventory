<?php

class LaptopModel extends CI_Model {
	const TABLE_BARANG = "barang";

	public function __construct()
	{
		parent::__construct();
	}


	public function add($data)
	{
		$data = array('nama' => $nama,
						'no_it' => $no_it,
						'no_asset' => $no_asset,
						'sn' => $sn,
						'type' => $type,
						'merk' => $merk,
						'vendor' => $vendor,
						'no_po' => $no_po,
						'tgl_terima' => $tgl_terima,
						'pic' => $pic,
						'id_creator' => $id_creator,
						'time_create' => date('Y-m-d H:i:s')
					);

		$q = $this->db->insert($this::TABLE_BARANG,$data);
		
		return $q;
	}
	
}