<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Main extends CI_Model{

	protected $data=array();


	function __construct(){
		parent::__construct();
	}


	function get(){

		$this->data["jumlah_artikel"] =$this->db->count_all("artikel");
		$this->data["jumlah_diskusi"] =$this->db->count_all("diskusi");
		$this->data["jumlah_halaman"] =$this->db->count_all("pages");
		$this->data["jumlah_user"] =$this->db->count_all("user");
		$this->data["jumlah_komentar"] =$this->db->count_all("komentar");

		$this->db->where("dibaca","N");
		$this->db->from("kontak_masuk");
		$this->data["jumlah_inbox"]   =$this->db->count_all_results();

		$this->data["jumlah_gambar_artikel"] =$this->db->count_all("foto_artikel");
		$this->data["jumlah_gambar_diskusi"] =$this->db->count_all("foto_diskusi");

		$this->db->where("terhapus","N");
		$this->db->from("kategori");
		$this->data["jumlah_kategori_artikel"] =$this->db->count_all_results();

		$this->data["jumlah_tags"] =$this->db->count_all("tags");

		$artikel=$this->db->order_by("artikel_id","DESC")->limit(7)->get("artikel");
		$this->data["artikel_terbaru"]=$artikel->result_array();

		$hit_artikel=$this->db->order_by("artikel_dibaca","DESC")->limit(7)->get("artikel");	
		$this->data["hit_artikel"]=$hit_artikel->result_array();

		$diskusi=$this->db->order_by("diskusi_id","DESC")->limit(7)->get("diskusi");
		$this->data["diskusi_terbaru"]=$diskusi->result_array();

		$hit_diskusi=$this->db->order_by("diskusi_dibaca","DESC")->limit(7)->get("diskusi");	
		$this->data["hit_diskusi"]=$hit_diskusi->result_array();

		$admin=$this->db->query("SELECT u.name_user, count(a.artikel_id_user) as hasil FROM user AS u LEFT OUTER JOIN artikel AS a ON a.artikel_id_user=u.id_user WHERE u.terhapus='N' GROUP BY u.id_user ");

		$this->data["admin"]=$admin->result_array();


		return $this->data;


	}







}