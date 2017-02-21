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
	
	public function get_data_table($table, $criteria, $id, $type)
	{

		$this->db->select("*");

		if(!empty($criteria)){
			$this->db->where($criteria);
		}

		$this->db->from($table);
		$this->db->order_by($id, $type); 
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
	public function update_peripheral($id, $jenis, $table, $data)
	{
		$query = $this->db->update($table, $data, array('id' => $id, 'nama' => $jenis));

		return $query;
	}

	//update data untuk jenis barang lainnya
	public function update_barang($jenis, $id, $table, $data)
	{
		$query = $this->db->update($table, $data, array('barang_id' => $id, 'barang_jenis_barang_id' => $jenis));

		return $query;
	}

	/* on controller rekap*/
	//insert rekap
	public function insert_rekap($table, $data){
		$data['query'] = $this->db->insert($table, $data);
		$data['rekap_id'] = $this->db->insert_id();
		
		return $data;
	}

	public function insert_peminjaman($table, $data){
		$data['query'] = $this->db->insert($table, $data);
		$data['laporan_peminjaman_id'] = $this->db->insert_id();
		
		return $data;
	}

	//insert lokasi
	public function insert_location($table, $data){
		$data['query'] = $this->db->insert($table, $data);
		$data['location_id'] = $this->db->insert_id();
		
		return $data;
	}


	public function update_rekap($id_rekap, $data)
	{
		$update = $this->db->update('rekap', $data, array('rekap_id' => $id_rekap));

		return $update;
	}

	//delete detail  barang
	public function delete_dtl_barang($id_rekap, $id_dtl)
	{
		$q = $this->db->delete("rekap_dtl", array('rekap_dtl_id_rekap' => $id_rekap, 'rekap_dtl_id' => $id_dtl));

		return $q; 
	}

	//delete no do  barang
	public function delete_do_barang($id_rekap, $id_detail)
	{
		$q = $this->db->delete("do_dtl", array('do_dtl_rekap_id' => $id_rekap, 'do_dtl_id' => $id_detail));

		return $q; 
	}

	public function delete_sub_location($location_id, $sublocation_id)
	{
		$q = $this->db->delete("dtl_location", array('location_dtl_location_id' => $location_id, 'location_dtl_id' => $sublocation_id));

		return $q; 
	}


	//count is there no_it
	public function is_exist($table, $criteria)
	{
		$this->db->select("*");
		$this->db->where($criteria);
		$this->db->from($table);
		$query = $this->db->count_all_results();

		if($query >= 1){
			return true;
		}else{
			return false;
		}
	}

	public function count_rows($table, $criteria)
	{
		$this->db->select("*");
		$this->db->where($criteria);
		$this->db->from($table);
		$query = $this->db->count_all_results();

		return $query;
	}

	//for update on assigment
	public function update_table($id_table, $id, $table, $criteria)
	{

		$this->db->where($id_table, $id);
		$query = $this->db->update($table, $criteria);
		
		return $query;
	}

	public function get_two_table($table1, $table2, $condition, $id_order,$type_order)
	{
		$this->db->select('*');
		$this->db->from($table1);
		$this->db->join($table2, $condition);
		$this->db->order_by($id_order, $type_order);

		$query = $this->db->get();

		return $query;
	}

	//search peminjaman by sn
	public function search_pinjaman($table1, $table2, $condition, $column, $like, $id_order,$type_order)
	{
		$this->db->select('*');
		$this->db->from($table1);
		$this->db->join($table2, $condition);
		$this->db->like($column, $like);
		$this->db->order_by($id_order, $type_order);

		$query = $this->db->get();

		return $query;
	}

	//list pinjaman
	public function list_pinjaman($table1, $table2, $condition, $criteria, $id_order,$type_order)
	{
		$this->db->select('*');
		$this->db->from($table1);
		$this->db->join($table2, $condition);
		$this->db->where($criteria);
		$this->db->order_by($id_order, $type_order);

		$query = $this->db->get();

		return $query;
	}

	public function get_five_table($table1, $table2, $table3, $table4, $table5, $condition1, $condition2, $condition3, $condition4, $id_order, $type_order, $id_s, $id)
	{
		$this->db->select('*');
		$this->db->from($table1);
		$this->db->join($table2, $condition1, 'LEFT');
		$this->db->join($table3, $condition2, 'LEFT');
		$this->db->join($table4, $condition3, 'LEFT');
		$this->db->join($table5, $condition4, 'LEFT');
		$this->db->where($id_s, $id);
		$this->db->order_by($id_order, $type_order);

		$query = $this->db->get();

		return $query;
	}

	//for search detail
	public function search_detail($table1, $table2, $table3, $table4, $table5, $condition1, $condition2, $condition3, $condition4, $id_order, $type_order, $id_s, $id)
	{

		$this->db->select('*');
		$this->db->from($table1); //cpu
		$this->db->join($table2, $condition1, 'LEFT'); //rekap
		$this->db->join($table3, $condition2, 'LEFT'); //rekap_dtl
		$this->db->join($table4, $condition3, 'LEFT'); //location
		$this->db->join($table5, $condition4, 'LEFT'); //department
		//$this->db->join($table6, $condition5, 'LEFT');
		$this->db->order_by($id_order, $type_order);
		$this->db->where($id_s, $id);

		$query = $this->db->get();

		return $query;
	}

	public function search_barang($table1, $table2, $table3, $table4, $table5, $condition1, $condition2, $condition3, $condition4, $id_order, $type_order, $id_s, $id, $id_s2, $id2)
	{

		$this->db->select('*');
		$this->db->from($table1); //cpu
		$this->db->join($table2, $condition1, 'LEFT'); //rekap
		$this->db->join($table3, $condition2, 'LEFT'); //rekap_dtl
		$this->db->join($table4, $condition3, 'LEFT'); //location
		$this->db->join($table5, $condition4, 'LEFT'); //department
		$this->db->where($id_s, $id);
		$this->db->where($id_s2, $id2);
		//$this->db->join($table6, $condition5, 'LEFT');
		$this->db->order_by($id_order, $type_order);
		

		$query = $this->db->get();

		return $query;
	}

	//
	public function cek_relation($table1, $criteria)
	{
		$this->db->select('*');
		$this->db->from($table1);
		$this->db->where($criteria);
	}

	public function relation_checking($table1, $table2, $condition, $criteria)
	{
		$this->db->select('*');
		$this->db->from($table1);
		$this->db->join($table2, $condition);
		$this->db->where($criteria);
		$query = $this->db->get();

		return $query;
	}
}