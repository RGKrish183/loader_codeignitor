<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Md_User");
	}

	/**
	 * To list data from db controlling routes
	 */
	public function index() {
		$data = $this->Md_User->get();
		$params = array();
		$params["data"] = $data;
		$this->load->view('users_list', $params);
	}

	/**
	 * Viewing for Add screen
	 */
	public function add(){
		$fakekey = rand();
		$this->session->set_userdata("user_addfakekey", $fakekey);
		$params = array();
		$params["skey"] = $fakekey;
		$this->load->view('users_add', $params);
	}

	/**
	 * insert into db
	 */
	public function insert() {
		// print_r($this->input->post());
		$formvalidator = ($this->input->post("useradd_action")=="Add") ? true : false;
		
		if($this->session->userdata("user_addfakekey")==$this->input->post("skey") && $formvalidator ){
			
			if($this->input->post("user_pass") != "" && $this->input->post("user_name") != "") {
				
				$this->session->set_userdata("user_addfakekey", "");
				$add_arr = array(); 
				$add_arr["user_firstname"] = $this->input->post("user_firstname");	
				$add_arr["user_name"] = $this->input->post("user_name");	
				$add_arr["user_pass"] = $this->input->post("user_pass");	
				$data = $this->Md_User->dml($add_arr, "insert");
				($data) ? redirect("user/index","refresh") : redirect("user/index","refresh");
			} else {
				// print_r($this->input->post());
				redirect("user/index","refresh");
			}
		} else {
			redirect("user/index","refresh");
		}
	}

	/**
	 * Viewing for Edit screen
	 */
	public function edit(){
		if($this->input->get("id") > 0){
			$fakekey = rand();
			$this->session->set_userdata("user_editfakekey", $fakekey);
			$data = $this->Md_User->get($this->input->get("id"));
			$params = array();
			$params["skey"] = $fakekey;
			$params["data"] = $data[0];

			$this->load->view('users_edit', $params);
		} else {
			redirect("user/index", "refresh");
		}
	}

	/**
	 * insert into db
	 */
	public function update() {
		// print_r($this->input->post());
		$formvalidator = ($this->input->post("userupdate_action")=="Update") ? true : false;
		
		if($this->session->userdata("user_editfakekey")==$this->input->post("skey") && $formvalidator ){
			
			// if($this->input->post("user_pass") != "" && $this->input->post("user_name") != "") {
				
				$this->session->set_userdata("user_addfakekey", "");
				$add_arr = array(); 
				$add_arr["id"] = $this->input->post("id");	
				
				$add_arr["user_firstname"] = $this->input->post("user_firstname");	
				$add_arr["user_name"] = $this->input->post("user_name");	
				$add_arr["user_pass"] = $this->input->post("user_pass");	
				$data = $this->Md_User->dml($add_arr, "update");
				($data) ? redirect("user/index","refresh") : redirect("user/index","refresh");
			// } else {
			// 	// print_r($this->input->post());
			// 	redirect("user/index","refresh");
			// }
		} else {
			redirect("user/index","refresh");
		}
	}

	/**
	 * Remove data from database controlling routes
	 */
	public function delete(){
		if($this->input->get("id") > 0){
			$dml_arr = array(); 
			$dml_arr["id"] = $this->input->get("id");	
			$data = $this->Md_User->dml($dml_arr, "delete");
			($data) ? redirect("user/index","refresh") : redirect("login/index","refresh");
		} else {
			redirect("user/index", "refresh");
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect("login/index","refresh");
	}

	public function chart(){
		$this->load->view('users_chart');
	}
	public function chartdata(){

		$data = $this->Md_User->chart();

		$final = array();
		foreach($data as $chart){
			$temp = array();
			$temp["y"] = $chart->count;
			$temp["name"] = $chart->user_cdt;
			array_push($final, $temp);			
		}
		echo json_encode($final);
		exit;
	}

}
