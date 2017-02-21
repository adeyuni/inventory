<?php

class RekapModel extends CI_Model {
	
	public function count_beredar($table1, $table2, $condition, $criteria)
	{
		$this->db->select('*');
		$this->db->from($table1);
		$this->db->join($table2, $condition);
		$this->db->where($criteria);
		$query = $this->db->count_all_results();

		return $query;
	}
}