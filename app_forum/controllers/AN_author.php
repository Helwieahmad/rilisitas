<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class AN_author extends CI_Controller {
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
		$this->load->library(array('session', 'form_validation', 'email'));
		$this->login=$this->session->userdata('login');	


		//panggil helper	
		$this->load->helper(array('filter','url','text','form','security'));

		$this->load->model("author/Myuser","user");

		$this->load->model("author/Otorisasi");
		

		$this->login= $this->user->set($this->session->userdata('id_user'),$this->session->userdata('name_user'),$this->session->userdata('password_user'));
		
			$this->id_user=$this->user->id;
			$this->name_user=$this->user->name;
			$this->password_user=$this->user->password;
			$this->level_user=$this->user->level;
			$this->avatar_user=$this->user->avatar;
	
	}


	private function home(){ //Halaman Home
		
		if(!$this->login){
			redirect("author/login");
		}
		else {

		$this->load->model("author/main");

		$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>'Rilisitas - Halaman Utama',
				'user'=>"$this->name_user",
				'user_level'=>$this->level_user,
				'npage'=>1,
				'burl'=>base_url()."author",
				'data'=>$this->main->get()
				);
		$this->load->view('author/header',$data);
		$this->load->view('author/main',$data);
		$this->load->view('author/footer',$data);
		}
		
	}

	function index(){
		$this->home();
	}
	
	function register()
    {
		//set validation rules
		$this->form_validation->set_rules('name_user', 'Username', 'trim|required|alpha|min_length[5]|max_length[30]|is_unique[user.name_user]|xss_clean');
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'trim|required|min_length[5]|max_length[30]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password_user', 'Password', 'trim|required|min_length[5]|required|matches[cpassword]|md5');
		$this->form_validation->set_rules('cpassword', 'Konfirmasi Password', 'trim|required|md5');
	
		//validate form input
		if ($this->form_validation->run() == FALSE)
        {
			// fails
			$this->load->view('author/register');
        }
		else
		{
			//insert the user registration details into database
			$data = array(
				'name_user' => $this->input->post('name_user'),
				'nama_lengkap' => $this->input->post('nama_lengkap'),
				'email' => $this->input->post('email'),
				'password_user' => $this->input->post('password_user'),
				'avatar_user' => $this->input->post('avatar_user'),
				'status_user' => $this->input->post('status_user'),
				'terdaftar' => $this->input->post('terdaftar'),
				'terhapus' => $this->input->post('terhapus')

			);
	
			// insert form data into database
			if ($this->user->insertUser($data))
			{
				$this->session->set_flashdata('msg','<div class="alert alert-success alert-dismissable">
<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Anda telah berhasil mendaftar! Hubungi Editor Untuk mengaktifkan akun Anda! Terima Kasih.</div>');
					redirect('author/register');
			}
			else
			{
				// error
				$this->session->set_flashdata('msg','<div class="alert alert-danger alert-dismissable">
<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Oops! Error. Sepertinya Kami tidak bisa menghubungi system database Kami. Mungkin karena server database kammi Offline !!!</div>');
				redirect('author/register');
			}
		}
	}
	
	function verify($hash=NULL)
	{
		if ($this->user_model->verifyEmailID($hash))
		{
			$this->session->set_flashdata('verify_msg','<div class="alert alert-danger alert-dismissable">
<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Email Anda telah terverifikasi! Silahkan Login ke akun Anda!</div>');
			redirect('author/register');
		}
		else
		{
			$this->session->set_flashdata('verify_msg','<div class="alert alert-danger alert-dismissable">
<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>Maaf! Ada Error ketika mencoba Memverifikasi. Silahkan hubungi Administrator atau coba Mendaftar Kembali dengan Email & Username lain!</div>');
			redirect('author/register');
		}
	}

	function artikel($id=0){
		if(!$this->login){
			redirect("author/login");
		}

		else { 
			$this->load->model("author/artikel","modul");
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
					'path_art_photo_thumb'=>base_url()."an-component/media/upload-gambar-artikel-thumbs",
					"title"=>"Edit Baru",
					"user"=>$this->name_user,
					'user_level'=>$this->level_user,
					'npage'=>6,
					'burl'=>base_url()."author",
					'id_user'=>$this->id_user,
					'list_kategori'=>$this->modul->get_artikel_kategori($id),
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
					"title"=>"Artikel Baru",
					"user"=>$this->name_user,
					'user_level'=>$this->level_user,
					'npage'=>6,
					'burl'=>base_url()."author",
					'id_user'=>$this->id_user,
					'list_kategori'=>$this->modul->list_kategori,
					'tag_kategori'=>$this->modul->list_tag,
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

				$this->load->view('author/header',$data);
				$this->load->view('author/artikel_baru',$data);
				$this->load->view('author/footer',$data);
		}



	}

	function edit_profil(){
		if(!$this->login){
			redirect("author/login");
		}

		else {
			if($this->level_user==0){
				$this->load->model("author/edit_profil");
				$this->edit_profil->show();
				$data=array(
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					"title"=>"Edit Profil",
					"user"=>$this->name_user,
					'user_level'=>$this->level_user,
					'npage'=>5,
					'burl'=>base_url()."author",
					'data'=>$this->edit_profil->hasil
					);
				$this->load->view('author/header',$data);
				$this->load->view('author/edit_profil',$data);
				$this->load->view('author/footer',$data);
			} else {
				show_404();
			}
		}
	}

	function all_artikel(){
		if(!$this->login){
			redirect("author/login");
		}

		else {

			$artikel=$this->load->model('author/all_artikel','articles');


			$data= array(				
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					"title"=>"Semua Artikel",
					"user"=>$this->name_user,
					'user_level'=>$this->level_user,
					'npage'=>7,
					'burl'=>base_url()."author",
					'id_user'=>$this->id_user,
					'artikels'=>$this->articles->get_artikel()
				);


				$this->load->view('author/header',$data);
				$this->load->view('author/all_artikel',$data);
				$this->load->view('author/footer',$data);
		}


	}

	function informasi(){
		if(!$this->login){
			redirect("author/login");
		}

		else {

			$this->load->model("author/informasi","info");

			$data=array(
					'avatar'=>$this->avatar_user,
					'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
					'title'=>"Pengaturan",
					'user'=>$this->name_user,
					'user_level'=>$this->level_user,
					'npage'=>10,
					'burl'=>base_url()."author",
					'id_user'=>$this->id_user,
					'data'=>$this->info->get_informasi()
				);
			$this->load->view('author/header',$data);
			$this->load->view('author/informasi',$data);
			$this->load->view('author/footer',$data);

		}
	}

	function biodata(){
		if(!$this->login){
			redirect("author/login");
		}
		else {
			$this->load->model("author/biodata","bio");
			$data=array(
				'avatar'=>$this->avatar_user,
				'path_avatar'=>base_url()."an-component/media/upload-user-avatar/".$this->avatar_user,
				'title'=>"Biodata",
				'user'=>$this->name_user,
				'user_level'=>$this->level_user,
				'npage'=>11,
				'burl'=>base_url()."author",
				'id_user'=>$this->id_user,
				'data'=>$this->bio->get_biodata()
				);

			$this->load->view('author/header',$data);
			$this->load->view('author/biodata',$data);
			$this->load->view('author/footer',$data);

		}		
	}

	function layout_widget(){

		if(!$this->login){
			redirect("author/login");
		} else {
			
		}		

	}

	function login($x=''){
		if($this->login){
			redirect('author');
		}
		$data['status']=$x;
		$this->load->view("author/login",$data);
	}


	 function proseslogin(){
	 	if($this->input->post()){
	 		$user=filterquote($this->input->post("username",TRUE),"all");
	 		$pass=md5($this->input->post("password"));

	 		$cari=$this->db->get_where("user",array("name_user"=>$user,"password_user"=>$pass,"status_user"=>"Y","terhapus"=>"N"));

	 		if($cari->num_rows()<1){
	 			redirect("author/login/1");
	 		}
	 		else{
	 			$row=$cari->row();
	 			$data_sessi=array('login'=>true,
	 						'id_user'=>$row->id_user,
	 						'name_user'=>$row->name_user,
	 						'password_user'=>$row->password_user,
	 						'level_user'=>$row->level_user);
	 			$this->session->set_userdata($data_sessi);
	 			redirect("author");
	 		}

	 	}
	 	else{
	 		show_404();
	 	}
	 }

	function logout(){
		$data= array("login","id_user","name_user","password_user","level_user","random_filemanager_key");
		$this->session->unset_userdata($data);
		redirect("author");
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