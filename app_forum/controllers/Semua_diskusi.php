<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Semua_diskusi extends AN_Rilisitas{


	function __construct(){
		parent::__construct();

	}

	function index(){
		redirect("diskusi/semua");
	}

	function semua($page=0){


		$this->load->library("pagination");

		$config['full_tag_open'] = "<nav> <ul class='pagination pagination-sm' style='background-color:#a80000;'>";
		$config['full_tag_close'] = "</ul> </nav>";


		$config['first_tag_open'] = "<li>";
		$config['first_tag_close'] = "</li>";


		$config['last_tag_open'] = "<li>";
		$config['last_tag_close'] = "</li>";

		$config['prev_tag_open'] = "<li>";
		$config['prev_tag_close'] = "</li>";

		$config['num_tag_open'] = "<li>";
		$config['num_tag_close'] = "</li>";		

		$config['cur_tag_open'] = "<li class='active'><a href='#'>";
		$config['cur_tag_close'] = "</a></li>";				

		$config['next_tag_open'] = "<li>";
		$config['next_tag_close'] = "</li>";



		$config['uri_segment'] = 2;

		$config['base_url']=baseURL($this->uri->segment(1));
		$config['total_rows']=$this->diskusi->hitung_semua_diskusi();
		$config['per_page']=$this->system_info['max_tampil_artikel'];
		$this->pagination->initialize($config);

		$data=$this->public_data;
		$data["informasi"]["title"]=$this->title->semua_diskusi();
		$data["informasi"]["current_page"]="semua-diskusi";	
		$data["informasi"]["uniqueid"]="semua-diskusi-page";

		$data["informasi"]["og-url"]=current_url();
		$data["informasi"]["og-title"]=$data["informasi"]["title"];


		$data["heading"]="Semua diskusi";		
		$data["semua_diskusi"]=$this->diskusi->diskusi_semua($config['per_page'],$page);
		$data["pagination"]=$this->pagination->create_links();

		$this->load->view($this->tema."/header",$data);
		$this->load->view($this->tema."/semua_diskusi",$data);
		$this->load->view($this->tema."/footer",$data);


	}

	function detail($id=0){
		if($id>0 AND ($diskusi=$this->diskusi->detail_diskusi($id))!=false){
		$this->diskusi->dibaca($id);
		$config['uri_segment'] = 2;
		$config['base_url']=baseURL($this->uri->segment(1));
		
		$data=$this->public_data;
		$data["informasi"]["title"]=$this->title->diskusi($diskusi['judul']);
		$data["informasi"]["current_page"]="detail-diskusi";
		$data["informasi"]["uniqueid"]="diskusi_".$id;

		$data["informasi"]["meta_deskripsi"]=$diskusi["meta_description"]==""?$data["informasi"]["meta_deskripsi"]:$diskusi["meta_description"];

		$data["informasi"]["meta_keyword"]=$diskusi["meta_keyword"]==""?$data["informasi"]["meta_keyword"]:$diskusi["meta_keyword"];
		//$data["informasi"]["author"]=$diskusi["nama_admin"];

		$data["informasi"]["og-type"]="diskusi";
		$data["informasi"]["og-url"]=current_url();
		$data["informasi"]["og-title"]=$diskusi["og_title"]==""?$data["informasi"]["title"]:$diskusi["og_title"];
		$data["informasi"]["og-description"]=$diskusi["og_description"]==""?$data["informasi"]["meta_deskripsi"]:$diskusi["og_description"];
		$data["informasi"]["og-image"]=$diskusi["og_image"]==""?img_diskusi_url($diskusi["foto"]):$diskusi["og_image"];
		$data["informasi"]["discussion-published_time"]=cuma_tanggal($diskusi["tanggal"]);

		
		$data['setuju']=$this->diskusi->setuju($id);
		$data['hitung_setuju']=$this->diskusi->hitung_setuju($id);
		$data['netral']=$this->diskusi->netral($id);
		$data['hitung_netral']=$this->diskusi->hitung_netral($id);
		$data['tidak_setuju']=$this->diskusi->tidak_setuju($id);
		$data['hitung_tidak_setuju']=$this->diskusi->hitung_tidak_setuju($id);
		$data["diskusi_related_per_kategori"]=$this->diskusi->related_diskusi_per_kategori($id,$diskusi['id_kategori']);

		$data["diskusi"]=$diskusi;
		

		$this->load->view($this->tema."/header",$data);
		$this->load->view($this->tema."/detail_diskusi",$data);
		$this->load->view($this->tema."/footer",$data);
		
		} else {
			show_404();
		}

	}

}