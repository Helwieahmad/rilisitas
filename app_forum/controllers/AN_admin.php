<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class AN_admin extends CI_Controller {
	protected $login=false;
	//user data
	protected $id_user;
	protected $name_user;
	protected $password_user;
	protected $level_user;
	protected $avatar_user;

	protected $c;
	
	function __construct(){
		parent::__construct();

		//Panggil database
		$this->load->database();

		//session
		$this->load->library(array(''));
		$this->login=$this->session->userdata('login');	


		//panggil helper	
		$this->load->helper(array('filter','url','text'));

		$this->load->model("saya-disembunyikan/Myuser","user");

		$this->load->model("saya-disembunyikan/Otorisasi");

		$this->login= $this->user->set($this->session->userdata('id_user'),$this->session->userdata('name_user'),$this->session->userdata('password_user'));
		
			$this->id_user=$this->user->id;
			$this->name_user=$this->user->name;
			$this->password_user=$this->user->password;
			$this->level_user=$this->user->level;
			$this->avatar_user=$this->user->avatar;
	
	}

	private function home(){ //Halaman Home
		
		if(!$this->login){
			redirect("saya-disembunyikan/login");
		}
		else {

		$this->load->model("saya-disembunyikan/main");

		$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>'Rilisitas - Halaman Utama',
				'user'=>"$this->name_user",
				'user_level'=>$this->level_user,
				'npage'=>1,
				'burl'=>base_url()."saya-disembunyikan",
				'data'=>$this->main->get()
				);
		$this->load->view('saya-disembunyikan/header',$data);
		$this->load->view('saya-disembunyikan/main',$data);
		$this->load->view('saya-disembunyikan/footer',$data);
		}
		
	}


	function index(){
		$this->home();
	}


	function kategori(){
		if(!$this->login){
			redirect("saya-disembunyikan/login");
		}
		
		else{
		$this->load->model('saya-disembunyikan/list_kategori');
		$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>'Semua Kategori',
				'user'=>"$this->name_user",
				'user_level'=>$this->level_user,
				'npage'=>2,
				'burl'=>base_url()."saya-disembunyikan",
				'list'=>$this->list_kategori->kategori()
				);
		$this->load->view('saya-disembunyikan/header',$data);
		$this->load->view('saya-disembunyikan/kategori',$data);
		$this->load->view('saya-disembunyikan/footer',$data);
		}

	}



	function user_baru(){
		if(!$this->login){
			redirect("saya-disembunyikan/login");
		}
		
		else{
			if($this->level_user==1){
				$data=array(
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					'title'=>'User Baru',
					'user'=>$this->name_user,
					'user_level'=>$this->level_user,
					'npage'=>3,
					'burl'=>base_url()."saya-disembunyikan",
					);

			$this->load->view('saya-disembunyikan/header',$data);
			$this->load->view('saya-disembunyikan/user',$data);
			$this->load->view('saya-disembunyikan/footer',$data);

			} else {
				show_404();
			}
		}
	}

	function all_user(){
		if(!$this->login){
			redirect("saya-disembunyikan/login");
		}

		else {
			if($this->level_user==1){
				$this->load->model("saya-disembunyikan/daftar_user");
				$this->daftar_user->show();
				$data=array(
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					"title"=>"Managemen User",
					"user"=>$this->name_user,
					'user_level'=>$this->level_user,
					'npage'=>4,
					'burl'=>base_url()."saya-disembunyikan",
					'table'=>$this->daftar_user->hasil
					);
				$this->load->view('saya-disembunyikan/header',$data);
				$this->load->view('saya-disembunyikan/all_user',$data);
				$this->load->view('saya-disembunyikan/footer',$data);
			} else {
				show_404();
			}
		}

	}

	function all_komentar(){
		if(!$this->login){
			redirect("saya-disembunyikan/login");
		}

		else {
			if($this->level_user==1){
				$this->load->model("saya-disembunyikan/daftar_komentar");
				$this->daftar_komentar->show();
				$data=array(
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					"title"=>"Managemen Komentar",
					"user"=>$this->name_user,
					'user_level'=>$this->level_user,
					'npage'=>75,
					'burl'=>base_url()."saya-disembunyikan",
					'table'=>$this->daftar_komentar->hasil
					);
				$this->load->view('saya-disembunyikan/header',$data);
				$this->load->view('saya-disembunyikan/all_komentar',$data);
				$this->load->view('saya-disembunyikan/footer',$data);
			} else {
				show_404();
			}
		}

	}

	function profil_user(){
		if(!$this->login){
			redirect("saya-disembunyikan/login");
		}

		else {
			
				$data=array(
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					"title"=>"Profil Anda",
					"user"=>$this->name_user,
					'user_level'=>$this->level_user,
					'npage'=>5,
					'burl'=>base_url()."saya-disembunyikan"
					);
				$this->load->view('saya-disembunyikan/header',$data);
				$this->load->view('saya-disembunyikan/profil_user',$data);
				$this->load->view('saya-disembunyikan/footer',$data);
		}
	}

	function artikel($id=0){
		if(!$this->login){
			redirect("saya-disembunyikan/login");
		}

		else { 
			$this->load->model("saya-disembunyikan/artikel","modul");
			$this->modul->get_kategori();
			$this->modul->get_tags();

			if($id!==0){
				$hasil=$this->modul->get_data($id,$this->id_user);
				if($hasil==false){
					show_404();
				} else {
					$data=array(
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					'path_art_photo_thumb'=>base_url()."an-component/media/upload-gambar-artikel-thumbs",
					"title"=>"Edit Baru",
					"user"=>$this->name_user,
					'user_level'=>$this->level_user,
					'npage'=>6,
					'burl'=>base_url()."saya-disembunyikan",
					'id_user'=>$this->id_user,
					'list_kategori'=>$this->modul->get_artikel_kategori($id),
					'list_tag'=>$this->modul->list_tag,
					'data'=>$hasil,
					'modul'=>"edit"
					);

					$data=array_merge($data,$hasil);
				}

			} else {

			$data=array(
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					"title"=>"Artikel Baru",
					"user"=>$this->name_user,
					'user_level'=>$this->level_user,
					'npage'=>6,
					'burl'=>base_url()."saya-disembunyikan",
					'id_user'=>$this->id_user,
					'list_kategori'=>$this->modul->list_kategori,
					'list_tag'=>$this->modul->list_tag,
					'modul'=>"new",
					"artikel_id"=>0,
					"artikel_judul"=>'',
					"artikel_isi"=>'',
					"artikel_kategori"=>false,
					"artikel_tags"=>false,
					"artikel_foto"=>false,
					"artikel_sbg_headline"=>false,
					"artikel_id_user"=>false,
					"artikel_editable"=>false,
					"artikel_seo_url"=>'',
					"artikel_meta_description"=>'',
					"artikel_meta_author"=>'',
					"artikel_meta_keyword"=>'',
					"artikel_og_image"=>'',
					"artikel_og_title"=>'',
					"artikel_og_description"=>'',
					"artikel_in_draft"=>false,
					"artikel_status"=>false,
					"artikel_aktif"=>false,
					"artikel_photos"=>false
					);
			}

				$this->load->view('saya-disembunyikan/header',$data);
				$this->load->view('saya-disembunyikan/artikel_baru',$data);
				$this->load->view('saya-disembunyikan/footer',$data);
		}
	}

	function all_artikel(){
		if(!$this->login){
			redirect("saya-disembunyikan/login");
		}

		else {

			$artikel=$this->load->model('saya-disembunyikan/all_artikel','articles');

			$data= array(				
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					"title"=>"Semua Artikel",
					"user"=>$this->name_user,
					'user_level'=>$this->level_user,
					'npage'=>7,
					'burl'=>base_url()."saya-disembunyikan",
					'id_user'=>$this->id_user,
					'artikels'=>$this->articles->get_artikel()
				);


				$this->load->view('saya-disembunyikan/header',$data);
				$this->load->view('saya-disembunyikan/all_artikel',$data);
				$this->load->view('saya-disembunyikan/footer',$data);
		}


	}

	function diskusi($id=0){
		if(!$this->login){
			redirect("saya-disembunyikan/login");
		}

		else { 
			$this->load->model("saya-disembunyikan/diskusi","modul");
			$this->modul->get_kategori();
			$this->modul->get_tags();

			if($id!==0){
				$hasil=$this->modul->get_data($id,$this->id_user);
				if($hasil==false){
					show_404();
				} else {
					$_data=array(
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					'path_art_photo_thumb'=>base_url()."an-component/media/upload-gambar-diskusi-thumbs",
					"title"=>"Edit Baru",
					"user"=>$this->name_user,
					'user_level'=>$this->level_user,
					'npage'=>35,
					'burl'=>base_url()."saya-disembunyikan",
					'id_user'=>$this->id_user,
					'list_kategori'=>$this->modul->get_diskusi_kategori($id),
					'tag_kategori'=>$this->modul->list_tag,
					'data'=>$hasil,
					'modul'=>"edit"
					);

					$data=array_merge($_data,$hasil);
				}

			} else {

			$data=array(
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					"title"=>"diskusi Baru",
					"user"=>$this->name_user,
					'user_level'=>$this->level_user,
					'npage'=>35,
					'burl'=>base_url()."saya-disembunyikan",
					'id_user'=>$this->id_user,
					'list_kategori'=>$this->modul->list_kategori,
					'tag_kategori'=>$this->modul->list_tag,
					'modul'=>"new",
					"diskusi_id"=>0,
					"diskusi_judul"=>'',
					"diskusi_isi"=>'',
					"diskusi_kategori"=>false,
					"diskusi_tags"=>false,
					"diskusi_foto"=>false,
					"diskusi_sbg_headline"=>false,
					"diskusi_id_user"=>false,
					"diskusi_editable"=>false,
					"diskusi_seo_url"=>'',
					"diskusi_meta_description"=>'',
					"diskusi_meta_author"=>'',
					"diskusi_meta_keyword"=>'',
					"diskusi_og_image"=>'',
					"diskusi_og_title"=>'',
					"diskusi_og_description"=>'',
					"diskusi_in_draft"=>false,
					"diskusi_status"=>false,
					"diskusi_aktif"=>false,
					"diskusi_photos"=>false
					);
			}

				$this->load->view('saya-disembunyikan/header',$data);
				$this->load->view('saya-disembunyikan/diskusi_baru',$data);
				$this->load->view('saya-disembunyikan/footer',$data);
		}



	}

	function all_diskusi(){
		if(!$this->login){
			redirect("saya-disembunyikan/login");
		}

		else {

			$diskusi=$this->load->model('saya-disembunyikan/all_diskusi','discussions');


			$data= array(				
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					"title"=>"Semua diskusi",
					"user"=>$this->name_user,
					'user_level'=>$this->level_user,
					'npage'=>36,
					'burl'=>base_url()."saya-disembunyikan",
					'id_user'=>$this->id_user,
					'discussions'=>$this->discussions->get_diskusi()
				);


				$this->load->view('saya-disembunyikan/header',$data);
				$this->load->view('saya-disembunyikan/all_diskusi',$data);
				$this->load->view('saya-disembunyikan/footer',$data);
		}


	}

	function tags(){
		if(!$this->login){
			redirect("saya-disembunyikan/login");
		}

		else {
			$this->load->model("saya-disembunyikan/all_tags");
			$hasil=$this->all_tags->get_tags();
			$hasil=$this->all_tags->hasil;

			$data=array(
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					"title"=>"Tags",
					"user"=>$this->name_user,
					'user_level'=>$this->level_user,
					'npage'=>8,
					'burl'=>base_url()."saya-disembunyikan",
					'id_user'=>$this->id_user,
					'hasil'=>$hasil
					);
				$this->load->view('saya-disembunyikan/header',$data);
				$this->load->view('saya-disembunyikan/tags',$data);
				$this->load->view('saya-disembunyikan/footer',$data);
		}
	}



	function media(){
		if(!$this->login){
			redirect("saya-disembunyikan/login");
		}

		else {
			$this->load->helper('file');
			$this->load->helper('number');
			$this->load->helper('date');
			$this->load->model("saya-disembunyikan/media","show_media");

			$data=array(
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					'title'=>"Media",
					'user'=>$this->name_user,
					'user_level'=>$this->level_user,
					'npage'=>9,
					'burl'=>base_url()."saya-disembunyikan",
					'id_user'=>$this->id_user,
					'hasil'=>$this->show_media->all_media(),
					'daftar_foto'=>$this->show_media->foto_pendukung()
					);
				$this->load->view('saya-disembunyikan/header',$data);
				$this->load->view('saya-disembunyikan/media',$data);
				$this->load->view('saya-disembunyikan/footer',$data);

			
		}		
		
	}



	function informasi(){
		if(!$this->login){
			redirect("saya-disembunyikan/login");
		}

		else {

			$this->load->model("saya-disembunyikan/informasi","info");

			$data=array(
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					'title'=>"Pengaturan",
					'user'=>$this->name_user,
					'user_level'=>$this->level_user,
					'npage'=>10,
					'burl'=>base_url()."saya-disembunyikan",
					'id_user'=>$this->id_user,
					'data'=>$this->info->get_informasi()
				);
			$this->load->view('saya-disembunyikan/header',$data);
			$this->load->view('saya-disembunyikan/informasi',$data);
			$this->load->view('saya-disembunyikan/footer',$data);

		}
	}

	function biodata(){
		if(!$this->login){
			redirect("saya-disembunyikan/login");
		}
		else {
			$this->load->model("saya-disembunyikan/biodata","bio");
			$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>"Biodata",
				'user'=>$this->name_user,
				'user_level'=>$this->level_user,
				'npage'=>11,
				'burl'=>base_url()."saya-disembunyikan",
				'id_user'=>$this->id_user,
				'data'=>$this->bio->get_biodata()
				);

			$this->load->view('saya-disembunyikan/header',$data);
			$this->load->view('saya-disembunyikan/biodata',$data);
			$this->load->view('saya-disembunyikan/footer',$data);

		}		
	}


	function page($id=0){
		$id=abs($id);
		if(!$this->login){
			redirect("saya-disembunyikan/login");
		}
		else {
			if($this->level_user==1){
			$this->load->model("saya-disembunyikan/page","halaman");

			if(!$this->halaman->get_page($id)){
				show_404();
			} else {

			$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>($id==0)?"Page Baru":"Edit Page",
				'user'=>$this->name_user,
				'user_level'=>$this->level_user,
				'npage'=>12,
				'burl'=>base_url()."saya-disembunyikan",
				'id_user'=>$this->id_user,
				'data'=>$this->halaman->hasil
				);
			$this->load->view('saya-disembunyikan/header',$data);
			$this->load->view('saya-disembunyikan/page',$data);
			$this->load->view('saya-disembunyikan/footer',$data);


			}

			} else {
				show_404();
			}
		}		
	}





	function all_page(){
		if(!$this->login){
			redirect("saya-disembunyikan/login");
		} else {
			if($this->level_user==1){
			$this->load->model("saya-disembunyikan/all_page","all_halaman");
			$this->all_halaman->all_pages();
			$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>"Semua Page",
				'user'=>$this->name_user,
				'user_level'=>$this->level_user,
				'npage'=>13,
				'burl'=>base_url()."saya-disembunyikan",
				'id_user'=>$this->id_user,
				'hasil'=>$this->all_halaman->hasil,
				);			

			$this->load->view('saya-disembunyikan/header',$data);
			$this->load->view('saya-disembunyikan/all_page',$data);
			$this->load->view('saya-disembunyikan/footer',$data);				

			} else {
				show_404();
			}
		}		
	}

	function menu($id=0){
		if(!$this->login){
			redirect("saya-disembunyikan/login");
		} else {

			$this->load->model("saya-disembunyikan/menu","set_menu");

			if(!$this->set_menu->get_menu($id)){
				show_404();
				exit();
			}

			$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>"Pengaturan Menu",
				'user'=>$this->name_user,
				'user_level'=>$this->level_user,
				'npage'=>16,
				'burl'=>base_url()."saya-disembunyikan",
				'id_user'=>$this->id_user,
				'hasil'=>$this->set_menu->hasil,
				'id'=>$id,
				'nama_menu'=>$this->set_menu->namaMenu,
				);	


			$this->load->view("saya-disembunyikan/header",$data);
			$this->load->view("saya-disembunyikan/menu",$data);
			$this->load->view("saya-disembunyikan/footer",$data);

		}
	}


	function all_menu(){
		if(!$this->login){
			redirect("saya-disembunyikan/login");
		} else {

			$this->load->model("saya-disembunyikan/all_menu","semua_menu");
			$this->semua_menu->get_all_menu();

			$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>"Menu",
				'user'=>$this->name_user,
				'user_level'=>$this->level_user,
				'npage'=>17,
				'burl'=>base_url()."saya-disembunyikan",
				'id_user'=>$this->id_user,
				'hasil'=>$this->semua_menu->hasil
				);	


			$this->load->view("saya-disembunyikan/header",$data);
			$this->load->view("saya-disembunyikan/all_menu",$data);
			$this->load->view("saya-disembunyikan/footer",$data);
		}		
	}

	function pihak_ketiga(){
		if(!$this->login){
			redirect("saya-disembunyikan/login");
		} else {

			$this->load->model('saya-disembunyikan/pihak_ketiga','pihakketiga');

			$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>"Pihak Ketiga",
				'user'=>$this->name_user,
				'user_level'=>$this->level_user,
				'npage'=>22,
				'burl'=>base_url()."saya-disembunyikan",
				'id_user'=>$this->id_user,
				'pihakketiga'=>$this->pihakketiga->get_data()
				);	

			$this->load->view("saya-disembunyikan/header",$data);
			$this->load->view("saya-disembunyikan/pihak_ketiga",$data);
			$this->load->view("saya-disembunyikan/footer",$data);
		

	}
	}


	function kontak_masuk(){

		if(!$this->login){
			redirect("saya-disembunyikan/login");
		} else {

			$this->load->model('saya-disembunyikan/kontak_masuk','inbox');

			$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>"Kontak Masuk",
				'user'=>$this->name_user,
				'user_level'=>$this->level_user,
				'npage'=>23,
				'burl'=>base_url()."saya-disembunyikan",
				'id_user'=>$this->id_user,
				'kontakmasuk'=>$this->inbox->get_data()
				);	

			$this->load->view("saya-disembunyikan/header",$data);
			$this->load->view("saya-disembunyikan/kontak_masuk",$data);
			$this->load->view("saya-disembunyikan/footer",$data);						

		}		

	}


	function distribusi_tema(){

		if(!$this->login){
			redirect("saya-disembunyikan/login");
		} else {

			$this->load->model('saya-disembunyikan/distribusi_tema','distribusi');

			$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>"Distribusi Tema",
				'user'=>$this->name_user,
				'user_level'=>$this->level_user,
				'npage'=>24,
				'burl'=>base_url()."saya-disembunyikan",
				'id_user'=>$this->id_user,
				'temas'=>$this->distribusi->get_tema()
				);	

			$this->load->view("saya-disembunyikan/header",$data);
			$this->load->view("saya-disembunyikan/distribusi_tema",$data);
			$this->load->view("saya-disembunyikan/footer",$data);						

		}


	}

	function pengaturan_tema(){

		if(!$this->login){
			redirect("saya-disembunyikan/login");
		} else {

			$this->load->model('saya-disembunyikan/pengaturan_tema','pengatuan_tem');

			$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>"Pengaturan Tema",
				'user'=>$this->name_user,
				'user_level'=>$this->level_user,
				'npage'=>25,
				'burl'=>base_url()."saya-disembunyikan",
				'id_user'=>$this->id_user,
				'tema_terinstal'=>$this->pengatuan_tem->get_tema()
				);	

			$this->load->view("saya-disembunyikan/header",$data);
			$this->load->view("saya-disembunyikan/pengaturan_tema",$data);
			$this->load->view("saya-disembunyikan/footer",$data);						

		}

	}


	function layout_widget(){

		if(!$this->login){
			redirect("saya-disembunyikan/login");
		} else {
			
		}		

	}






	function login($x=''){
		if($this->login){
			redirect('saya-disembunyikan');
		}
		$data['status']=$x;
		$this->load->view("saya-disembunyikan/login",$data);
	}

	 function proseslogin(){
	 	if($this->input->post()){
	 		$user=filterquote($this->input->post("username",TRUE),"all");
	 		$pass=md5($this->input->post("password"));

	 		$cari=$this->db->get_where("user",array("name_user"=>$user,"password_user"=>$pass,"status_user"=>"Y","terhapus"=>"N"));

	 		if($cari->num_rows()<1){
	 			redirect("saya-disembunyikan/login/1");
	 		}
	 		else{
	 			$row=$cari->row();
	 			$data_sessi=array('login'=>true,
	 						'id_user'=>$row->id_user,
	 						'name_user'=>$row->name_user,
	 						'password_user'=>$row->password_user,
	 						'level_user'=>$row->level_user);
	 			$this->session->set_userdata($data_sessi);
	 			redirect("saya-disembunyikan");
	 		}

	 	}
	 	else{
	 		show_404();
	 	}
	 }




	function logout(){
		$data= array("login","id_user","name_user","password_user","level_user","random_filemanager_key");
		$this->session->unset_userdata($data);
		redirect("saya-disembunyikan");
	}


	function debug(){



		$this->load->library("pembilang");


		
		 $this->pembilang->_set(190000111);
		 echo $this->pembilang->terbilang;
	}



	function test(){

			$data=$this->db->query("SELECT SUBSTRING_INDEX(artikel.artikel_tags,',','-1') AS tag FROM artikel WHERE artikel_id='7'");

			print_r($data->result_array());


	}

	function form(){
		echo "
		<form method='post' action='test'>
		<input type='text' name='data' value='ando\"sasss'>
		</form>
		";
	}


 



 }

?>