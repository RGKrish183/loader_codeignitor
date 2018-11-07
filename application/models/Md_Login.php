<?php

class Md_Login extends CI_Model {

	var $tbl_users = "tbl_users";

	public function login($login_arr=array()) {
		$this->db->select("*");
		$this->db->from($this->tbl_users);
		$this->db->where("user_name", $login_arr["username"]);
		$this->db->where("user_pass", $login_arr["userpass"]);

		$qry = $this->db->get();
		// $result=$qry->result();
		// print_r($result);

		if($qry->num_rows() > 0) {
			return true;
		} else {
			return false;
		}

	}
	
}
