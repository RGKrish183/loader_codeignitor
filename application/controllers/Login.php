<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Md_Login");
	}

	public function index() {
		$fakekey = rand();
		$this->session->set_userdata("fakekey", $fakekey);
		$params = array();
		$params["skey"] = $fakekey;
		$this->load->view('login', $params);
	}

	public function login() {
		
		$formvalidator = ($this->input->post("login_action")=="Login") ? true : false;
		
		if($this->session->userdata("fakekey")==$this->input->post("skey") && $formvalidator ){
			
			if($this->input->post("user_pass") != "" && $this->input->post("user_name") != "") {
				
				$this->session->set_userdata("fakekey", "");
				$login_arr = array(); 
				$login_arr["username"] = $this->input->post("user_name");	
				$login_arr["userpass"] = $this->input->post("user_pass");	
				$data = $this->Md_Login->login($login_arr);
				($data) ? redirect("user/index","refresh") : redirect("login/index","refresh");
			} else {
				// print_r($this->input->post());
				redirect("login/index","refresh");
			}
		} else {
			redirect("login/index","refresh");
		}
	}
}
