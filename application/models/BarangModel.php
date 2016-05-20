<?php

class BarangModel extends CI_Model {
	
	//untuk tambah data
	public function add($table,$data)
	{
		
		$q = $this->db->insert($table,$data);
		
		return $q;
	}

	public function get_data($table, $criteria)
	{

		$this->db->select("*");

		if(!empty($criteria)){
			$this->db->where($criteria);
		}

		$this->db->from($table);
		$query = $this->db->get();

		return $query;
	}
	
	public function update_data($id, $table, $criteria)
	{

		$this->db->where('id', $id);
		$query = $this->db->update($table, $criteria);
		
		return $query;
	}

	public function delete($table, $id_table, $id)
	{
		$q = $this->db->delete($table, array($id_table => $id));

		return $q; 
	}

	//update data untuk scanner dan printer
	public function update_peripheral($id, $jenis, $table, $criteria)
	{
		$query = $this->db->update($table, $criteria, array('id' => $id, 'nama' => $jenis));

		return $query;
	}

	//insert rekap
	public function insert_rekap($table, $data){
		$data['query'] = $this->db->insert($table, $data);
		$data['rekap_id'] = $this->db->insert_id();
		
		return $data;
	}

	//delete detail  barang
	public function delete_dtl_barang($id_rekap, $id_dtl)
	{
		$q = $this->db->delete("rekap_dtl", array('rekap_dtl_id_rekap' => $id_rekap, 'rekap_dtl_id' => $id_dtl));

		return $q; 
	}


}