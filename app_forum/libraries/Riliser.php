<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riliser
{

	protected $CI;

	public function __construct(){

		$this->CI=& get_instance();
		
	}

	function user_riliser(){

		$data=$this->CI->db->query("SELECT id_user AS id, name_user AS username, nama_lengkap AS nama, avatar_user as foto_user, terdaftar AS tanggal FROM user
		 WHERE terhapus='N' ORDER BY id_user DESC LIMIT 8

		 ");

		return $data->result_array();


	}
	function list_riliser(){

		$data=$this->CI->db->query("SELECT id_user AS id, name_user AS username, nama_lengkap AS nama, avatar_user as foto_user, terdaftar AS tanggal FROM user
		 WHERE terhapus='N' ORDER BY id_user DESC LIMIT 5

		 ");

		return $data->result_array();


	}
	
	function get_riliser(){
	$data=$this->CI->db->query("SELECT id_user AS nomor_user,
	 nama_lengkap AS nama_panjang,
	 name_user AS username
	 FROM user WHERE terhapus='N' AND  status_user='Y' ORDER BY id_user DESC");
	return $data->result_array();

	}

	function detail_riliser($id){

		$id=intval($id);


		$data=$this->CI->db->query("SELECT id_user AS id,
		 name_user AS username,
		 nama_lengkap AS nama_user,
		 email AS email,
		 password_user AS password,
		 level_user AS level,
		 avatar_user AS foto_user,
		 status_user AS status,
		 terdaftar AS bergabung,
		 terhapus AS terhapus
		 FROM user WHERE id_user='$id' AND status_user='Y' AND terhapus='N'");

		if($data->num_rows()>0){

		$data=$data->row_array();

		return $data;

		} else {
			return false;
		}

	}

	function hitung_semua_artikel_per_user($id_slug){

		$id_slug=intval($id_slug);

		$data=$this->CI->db->query("SELECT artikel.artikel_id AS id,
		 artikel.artikel_judul AS judul, 
		 artikel.artikel_isi AS isi,
		 artikel.artikel_tgl_posting AS tanggal,
		 artikel.artikel_dibaca AS dibaca,
		 artikel.artikel_seo_url AS slug,		 
		 artikel.artikel_tags as tags,
		 kategori.id_kategori,
		 kategori.nama_kategori,
		 user.nama_lengkap AS nama_admin,
		 user.id_user AS id_admin,
		 foto_artikel.nama_foto AS foto
		 FROM artikel,kategori,user,foto_artikel
		 WHERE FIND_IN_SET('$id_slug',artikel.artikel_id_user) AND  artikel.artikel_status='publish' AND kategori.terhapus='N' AND user.status_user='Y' AND user.terhapus='N' AND artikel.artikel_id_user=user.id_user AND artikel.artikel_kategori=kategori.id_kategori AND foto_artikel.id_foto=(SELECT CASE  foto_artikel.featured WHEN 'Y' THEN id_foto WHEN 'N' THEN id_foto END AS 'id_foto'  FROM foto_artikel WHERE foto_artikel.id_artikel=artikel.artikel_id ORDER BY featured ASC LIMIT 1) ORDER BY artikel.artikel_id DESC

		 ");

		return $data->num_rows();

	}

	function artikel_per_user($id_slug,$limit,$offset){

		$id_slug=intval($id_slug);
		$limit=intval($limit);
		$offset=intval($offset);

		$data=$this->CI->db->query("SELECT artikel.artikel_id AS id,
		 artikel.artikel_judul AS judul, 
		 artikel.artikel_isi AS isi,
		 artikel.artikel_tgl_posting AS tanggal,
		 artikel.artikel_dibaca AS dibaca,
		 artikel.artikel_seo_url AS slug,		 
		 artikel.artikel_tags as tags,
		 kategori.id_kategori,
		 kategori.nama_kategori,
		 user.nama_lengkap AS nama_admin,
		 user.id_user AS id_admin,
		 foto_artikel.nama_foto AS foto
		 FROM artikel,kategori,user,foto_artikel
		 WHERE FIND_IN_SET('$id_slug',artikel.artikel_id_user) AND  artikel.artikel_status='publish' AND kategori.aktif='Y' AND kategori.terhapus='N' AND user.status_user='Y' AND user.terhapus='N' AND artikel.artikel_id_user=user.id_user AND artikel.artikel_kategori=kategori.id_kategori AND foto_artikel.id_foto=(SELECT CASE  foto_artikel.featured WHEN 'Y' THEN id_foto WHEN 'N' THEN id_foto END AS 'id_foto'  FROM foto_artikel WHERE foto_artikel.id_artikel=artikel.artikel_id ORDER BY featured ASC LIMIT 1) ORDER BY artikel.artikel_id DESC LIMIT $offset,$limit

		 ");

		return $data->result_array();		

	}
		function hitung_artikel_riliser($id_slug){
		$id_slug=intval($id_slug);
    	$query =$this->CI->db->query("SELECT * FROM artikel WHERE FIND_IN_SET('$id_slug',artikel.artikel_id_user) AND artikel_status='publish'");//cahnge table name, and argument that you want
    	$result = $query->result_array();
    	$count = count($result);
    	return $count;

	}

}