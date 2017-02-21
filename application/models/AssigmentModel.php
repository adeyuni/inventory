<?php

class AssigmentModel extends CI_Model {
	
	public function get_list_barang($table1, $table2, $condition, $criteria)
	{
		$this->db->select('*');
		$this->db->from($table1);
		$this->db->join($table2, $condition);
		$this->db->where($criteria);
		$query = $this->db->get();

		return $query;
	}
}