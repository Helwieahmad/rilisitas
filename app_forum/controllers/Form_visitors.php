<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Form_visitors extends AN_Rilisitas{

	function __construct(){
	 parent::__construct();
	if($this->input->server('REQUEST_METHOD')!='POST'){
		exit("Stop...! Anda Berada di Halaman Yang Salah");
	}

	$this->load->helper(array('url'));
	}

	function contact(){
		$nama=$this->input->post('nama',TRUE);
		$email=$this->input->post('email',TRUE);
		$phone=$this->input->post('phone',TRUE);
		$pesan=$this->input->post('pesan',TRUE);
		$url=$this->input->post('url',TRUE);
		$tanggal=date("Y:m:d H:i:s",now());



		if( $this->input->post('g-recaptcha-response')!=FALSE){

			$secret=$this->recaptcha['secret_key'];
			$ip=$this->input->ip_address();
			$chaptcha=$this->input->post('g-recaptcha-response');
			$rsp=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$chaptcha&remoteip=$ip");

			$hasil=json_decode($rsp,true);
			if($hasil['success']==true){

					$this->db->insert("kontak_masuk",array("nama"=>$nama,"email"=>$email,"phone"=>$phone,"pesan"=>$pesan,"tanggal"=>$tanggal,"ip"=>$ip));


					if($this->input->is_ajax_request()){
						echo json_encode(array("status"=>"sukses"));
						
					} else {
						redirect($url);
					}

			}	else {
						if($this->input->is_ajax_request()){
							echo json_encode(array("status"=>"error","name"=>"chaptcha yang Anda Masukkan Salah...!"));
						} else {
							redirect($url);
						}

			}		


		} else {
			
			if($this->input->is_ajax_request()){
				echo json_encode(array("status"=>"error","name"=>"chaptcha belum terisi"));
			} else {
				redirect($url);
			}
		}

	} 
	function komentar(){
		$diskusi_id=$this->input->post('diskusi_id',TRUE);
		$pilih=$this->input->post('pilih',TRUE);
		$nama=$this->input->post('nama',TRUE);
		$email=$this->input->post('email',TRUE);
		$pesan=$this->input->post('pesan',TRUE);
		$url=$this->input->post('url',TRUE);
		$tanggal=date("Y:m:d H:i:s",now());



		if( $this->input->post('g-recaptcha-response')!=FALSE){

			$secret=$this->recaptcha['secret_key'];
			$ip=$this->input->ip_address();
			$chaptcha=$this->input->post('g-recaptcha-response');
			$rsp=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$chaptcha&remoteip=$ip");

			$hasil=json_decode($rsp,true);
			if($hasil['success']==true){

					$this->db->insert("komentar",array("diskusi_id"=>$diskusi_id,"pilih"=>$pilih,"nama"=>$nama,"email"=>$email,"pesan"=>$pesan,"tanggal"=>$tanggal,"ip"=>$ip));


					if($this->input->is_ajax_request()){
						echo json_encode(array("status"=>"sukses"));
						
					} else {
						redirect($url);
					}

			}	else {
						if($this->input->is_ajax_request()){
							echo json_encode(array("status"=>"error","name"=>"Captcha Yang Anda Masukkan Salah...!"));
						} else {
							redirect($url);
						}

			}		


		} else {
			
			if($this->input->is_ajax_request()){
				echo json_encode(array("status"=>"error","name"=>"Captcha Belum Anda Isi...!"));
			} else {
				redirect($url);
			}
		}

	}  



	function search_article(){

		$keyword=$this->input->post('keyword',TRUE);
		$clean=trim(preg_replace("/[^A-Za-z0-9-_\s]/","",$keyword));
		$ip=$this->input->ip_address();

		$tanggal=date("Y:m:d H:i:s",now());

		if(strlen($clean)>=3){

		$this->db->insert("pencarian_artikel",array("keyword"=>$keyword,"clean_keyword"=>$clean,"tanggal"=>$tanggal,"ip"=>$ip));
		redirect(baseURL('search/article/'.$clean));


		} else {
			echo "Butuh Lebih Dari Tiga Karakter
				<script>

				window.setTimeout(function(){
					window.history.back(-1);
				},3000)

				</script>
			";
		}



	}

}