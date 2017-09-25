<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends AN_Rilisitas{

	public function __construct(){
		parent::__construct();
		
	}

	function index(){

		$data=$this->public_data;
		$data["informasi"]["title"]=$this->title->home();
		$data["informasi"]["current_page"]="home";
		$data["informasi"]["uniqueid"]="home-page";

		$data["informasi"]["og-title"]=$data["informasi"]["title"];
		
		$data["artikel_headline"]=$this->artikel->artikel_headline($this->system_info["max_headline_artikel"]);
		$data["pilihan_editor"]=$this->artikel->pilihan_editor($this->system_info["max_headline_artikel"]);
		$data["user_riliser"]=$this->riliser->user_riliser($this->system_info["max_headline_artikel"]);
		$data["list_riliser"]=$this->riliser->list_riliser();
		$data["get_riliser"]=$this->riliser->get_riliser();
		$this->load->view($this->tema."/header",$data);
		$this->load->view($this->tema."/home",$data);
		$this->load->view($this->tema."/footer",$data);

	}
}
