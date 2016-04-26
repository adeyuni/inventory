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
}