<?php

class Md_User extends CI_Model {

	var $tbl_users = "tbl_users";

	/**
	 * TO GET DATA FROM DATABASE
	 */
	public function get($id=0) {
		$this->db->select("*");
		$this->db->from($this->tbl_users);

		if($id>0)
			$this->db->where("id", $id);
		
		$qry = $this->db->get();
		$result=$qry->result();

		if($qry->num_rows() > 0) {
			return $result;
		} else {
			return false;
		}
	}

	/**
	 * for chart
	 */
	public function chart() {

		$qry = $this->db->query('SELECT count(*) as count, user_cdt FROM demo.tbl_users group by user_cdt;');

		// $qry = $this->db->get();
		$result=$qry->result();
		if($qry->num_rows() > 0) {
			return $result;
		} else {
			return false;
		}
	}
	
	/**
	 * FOR DML STATE OPERATIONS
	 */
	public function dml($data_arr, $action) {

		try {
			if($action=="delete"){
				$this->db->delete($this->tbl_users, $data_arr);
				return true;
			} else if ($action=="insert") {
				$this->db->insert($this->tbl_users, $data_arr);
				return true;
			} else if ($action=="update") {
				$id = $data_arr["id"];
				unset($data_arr["id"]);
				$this->db->where("id", $id);
				$this->db->update($this->tbl_users, $data_arr);
				return true;
			}
		} catch(Exception $e){
			echo $e->getMessage();
			return false;
		}
	}	
}
