<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_us extends AN_Rilisitas

{


	function __construct(){
		parent::__construct();
	}

	
	function index(){

		$data=$this->public_data;

		$data["informasi"]["title"]=$this->title->contact_us("Tentang Kami");
		$data["informasi"]["current_page"]="about-us";
		$data["informasi"]["uniqueid"]="about-us";

		$data["informasi"]["og-url"]=current_url();
		$data["informasi"]["og-title"]=$data["informasi"]["title"];

		$this->load->view($this->tema."/header",$data);
		$this->load->view($this->tema."/contact_us",$data);
		$this->load->view($this->tema."/footer",$data);


	}



}