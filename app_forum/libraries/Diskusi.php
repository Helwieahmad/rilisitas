<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diskusi
{

	protected $CI;

	public function __construct(){

		$this->CI=& get_instance();

	}
	
	public function setuju($id_slug){
		$id_slug=intval($id_slug);
		$data=$this->CI->db->query("SELECT komentar.id AS id,
		 komentar.diskusi_id AS id_diskusi,
		 komentar.pilih AS pilih,
		 komentar.nama AS nama,
		 komentar.email AS email,
		 komentar.pesan AS pesan,
		 komentar.tanggal AS tanggal
		 FROM diskusi, komentar
		 WHERE FIND_IN_SET('$id_slug',komentar.diskusi_id) AND diskusi.diskusi_status='publish' AND komentar.diskusi_id=diskusi.diskusi_id AND komentar.pilih='1' ORDER BY komentar.id DESC");

		return $data->result_array();

	}

	public function hitung_setuju($id_slug){
		$id_slug=intval($id_slug);
    	$query =$this->CI->db->query("SELECT * FROM komentar WHERE FIND_IN_SET('$id_slug',komentar.diskusi_id) AND pilih='1'");//cahnge table name, and argument that you want
    	$result = $query->result_array();
    	$count = count($result);
    	return $count;

	}
	
	public function netral($id_slug){
		$id_slug=intval($id_slug);
		$data=$this->CI->db->query("SELECT komentar.id AS id,
		 komentar.diskusi_id AS id_diskusi,
		 komentar.pilih AS pilih,
		 komentar.nama AS nama,
		 komentar.email AS email,
		 komentar.pesan AS pesan,
		 komentar.tanggal AS tanggal
		 FROM diskusi, komentar
		 WHERE FIND_IN_SET('$id_slug',komentar.diskusi_id) AND diskusi.diskusi_status='publish' AND komentar.diskusi_id=diskusi.diskusi_id AND komentar.pilih='2' ORDER BY komentar.id DESC");

		return $data->result_array();

	}

	public function hitung_netral($id_slug){
		$id_slug=intval($id_slug);
    	$query =$this->CI->db->query("SELECT * FROM komentar WHERE FIND_IN_SET('$id_slug',komentar.diskusi_id) AND pilih='2'");//cahnge table name, and argument that you want
    	$result = $query->result_array();
    	$count = count($result);
    	return $count;

	}

	public function tidak_setuju($id_slug){
		$id_slug=intval($id_slug);
		$data=$this->CI->db->query("SELECT komentar.id AS id,
		 komentar.diskusi_id AS id_diskusi,
		 komentar.pilih AS pilih,
		 komentar.nama AS nama,
		 komentar.email AS email,
		 komentar.pesan AS pesan,
		 komentar.tanggal AS tanggal
		 FROM diskusi, komentar
		 WHERE FIND_IN_SET('$id_slug',komentar.diskusi_id) AND diskusi.diskusi_status='publish' AND komentar.diskusi_id=diskusi.diskusi_id AND komentar.pilih='3' ORDER BY komentar.id DESC");

		return $data->result_array();

	}

	public function hitung_tidak_setuju($id_slug){
		$id_slug=intval($id_slug);
    	$query =$this->CI->db->query("SELECT * FROM komentar WHERE FIND_IN_SET('$id_slug',komentar.diskusi_id) AND pilih='3'");//cahnge table name, and argument that you want
    	$result = $query->result_array();
    	$count = count($result);
    	return $count;

	}

	

	public function diskusi_populer($max=7){

		$max=intval($max);

		$data=$this->CI->db->query("SELECT diskusi.diskusi_id AS id,
		 diskusi.diskusi_judul AS judul, 
		 diskusi.diskusi_isi AS isi,
		 diskusi.diskusi_tags as tags,
		 diskusi.diskusi_tgl_posting AS tanggal,
		 diskusi.diskusi_dibaca AS dibaca,
		 diskusi.diskusi_seo_url AS slug,
		 kategori.id_kategori,
		 kategori.nama_kategori,
		 user.name_user AS username,
		 user.nama_lengkap AS nama_admin,
		 user.id_user AS id_admin,
		 foto_diskusi.nama_foto AS foto
		 FROM diskusi,kategori,user ,foto_diskusi
		 WHERE diskusi.diskusi_status='publish' AND kategori.aktif='Y' AND kategori.terhapus='N' AND user.status_user='Y' AND user.terhapus='N' AND diskusi.diskusi_id_user=user.id_user AND diskusi.diskusi_kategori=kategori.id_kategori AND   foto_diskusi.id_foto=(SELECT CASE  foto_diskusi.featured WHEN 'Y' THEN id_foto WHEN 'N' THEN id_foto END AS 'id_foto'  FROM foto_diskusi WHERE foto_diskusi.id_diskusi=diskusi.diskusi_id ORDER BY featured ASC LIMIT 1)  ORDER BY diskusi.diskusi_dibaca DESC LIMIT $max

		 ");

		return $data->result_array();

	}


	function related_diskusi_per_kategori($diskusi_aktif,$id_kategori,$limit=5){

		
		$diskusi_aktif=intval($diskusi_aktif);
		$id_kategori=intval($id_kategori);
		$limit=intval($limit);



		$data=$this->CI->db->query("SELECT diskusi.diskusi_id AS id,
		 diskusi.diskusi_judul AS judul, 
		 diskusi.diskusi_isi AS isi,
		 diskusi.diskusi_tgl_posting AS tanggal,
		 diskusi.diskusi_dibaca AS dibaca,
		 diskusi.diskusi_seo_url AS slug,		 
		 diskusi.diskusi_tags as tags,
		 kategori.id_kategori,
		 kategori.nama_kategori,
		 user.nama_lengkap AS nama_admin,
		 user.id_user AS id_admin,
		 foto_diskusi.nama_foto AS foto
		 FROM diskusi,kategori,user,foto_diskusi
		 WHERE diskusi.diskusi_id!='$diskusi_aktif' AND diskusi.diskusi_kategori='$id_kategori' AND  diskusi.diskusi_status='publish' AND kategori.aktif='Y' AND kategori.terhapus='N' AND user.status_user='Y' AND user.terhapus='N' AND diskusi.diskusi_id_user=user.id_user AND diskusi.diskusi_kategori=kategori.id_kategori AND foto_diskusi.id_foto=(SELECT CASE  foto_diskusi.featured WHEN 'Y' THEN id_foto WHEN 'N' THEN id_foto END AS 'id_foto'  FROM foto_diskusi WHERE foto_diskusi.id_diskusi=diskusi.diskusi_id ORDER BY featured ASC LIMIT 1) ORDER BY rand() LIMIT $limit

		 ");

		return $data->result_array();		

	}



	function diskusi_per_kategori($id_kategori,$limit,$offset){

		$id_kategori=intval($id_kategori);
		$limit=intval($limit);
		$offset=intval($offset);

		$data=$this->CI->db->query("SELECT diskusi.diskusi_id AS id,
		 diskusi.diskusi_judul AS judul, 
		 diskusi.diskusi_isi AS isi,
		 diskusi.diskusi_tgl_posting AS tanggal,
		 diskusi.diskusi_dibaca AS dibaca,
		 diskusi.diskusi_seo_url AS slug,		 
		 diskusi.diskusi_tags as tags,
		 kategori.id_kategori,
		 kategori.nama_kategori,
		 user.nama_lengkap AS nama_admin,
		 user.id_user AS id_admin,
		 foto_diskusi.nama_foto AS foto
		 FROM diskusi,kategori,user,foto_diskusi
		 WHERE diskusi.diskusi_kategori='$id_kategori' AND  diskusi.diskusi_status='publish' AND kategori.aktif='Y' AND kategori.terhapus='N' AND user.status_user='Y' AND user.terhapus='N' AND diskusi.diskusi_id_user=user.id_user AND diskusi.diskusi_kategori=kategori.id_kategori AND foto_diskusi.id_foto=(SELECT CASE  foto_diskusi.featured WHEN 'Y' THEN id_foto WHEN 'N' THEN id_foto END AS 'id_foto'  FROM foto_diskusi WHERE foto_diskusi.id_diskusi=diskusi.diskusi_id ORDER BY featured ASC LIMIT 1) ORDER BY diskusi.diskusi_id DESC LIMIT $offset,$limit

		 ");

		return $data->result_array();		

	}

	function hitung_semua_diskusi_per_kategori($id_kategori){

		$id_kategori=intval($id_kategori);


		$data=$this->CI->db->query("SELECT diskusi.diskusi_id AS id,
		 diskusi.diskusi_judul AS judul, 
		 diskusi.diskusi_isi AS isi,
		 diskusi.diskusi_tgl_posting AS tanggal,
		 diskusi.diskusi_dibaca AS dibaca,
		 diskusi.diskusi_seo_url AS slug,		 
		 diskusi.diskusi_tags as tags,
		 kategori.id_kategori,
		 kategori.nama_kategori,
		 user.nama_lengkap AS nama_admin,
		 user.id_user AS id_admin,
		 foto_diskusi.nama_foto AS foto
		 FROM diskusi,kategori,user,foto_diskusi
		 WHERE diskusi.diskusi_kategori='$id_kategori' AND  diskusi.diskusi_status='publish' AND kategori.aktif='Y' AND kategori.terhapus='N' AND user.status_user='Y' AND user.terhapus='N' AND diskusi.diskusi_id_user=user.id_user AND diskusi.diskusi_kategori=kategori.id_kategori AND foto_diskusi.id_foto=(SELECT CASE  foto_diskusi.featured WHEN 'Y' THEN id_foto WHEN 'N' THEN id_foto END AS 'id_foto'  FROM foto_diskusi WHERE foto_diskusi.id_diskusi=diskusi.diskusi_id ORDER BY featured ASC LIMIT 1) ORDER BY diskusi.diskusi_id DESC

		 ");

		return $data->num_rows();

	}

	function diskusi_per_tag($id_slug,$limit,$offset){

		$id_slug=intval($id_slug);
		$limit=intval($limit);
		$offset=intval($offset);



		$data=$this->CI->db->query("SELECT diskusi.diskusi_id AS id,
		 diskusi.diskusi_judul AS judul, 
		 diskusi.diskusi_isi AS isi,
		 diskusi.diskusi_tgl_posting AS tanggal,
		 diskusi.diskusi_dibaca AS dibaca,
		 diskusi.diskusi_seo_url AS slug,		 
		 diskusi.diskusi_tags as tags,
		 kategori.id_kategori,
		 kategori.nama_kategori,
		 user.nama_lengkap AS nama_admin,
		 user.id_user AS id_admin,
		 foto_diskusi.nama_foto AS foto
		 FROM diskusi,kategori,user,foto_diskusi
		 WHERE FIND_IN_SET('$id_slug',diskusi.diskusi_tags) AND  diskusi.diskusi_status='publish' AND kategori.aktif='Y' AND kategori.terhapus='N' AND user.status_user='Y' AND user.terhapus='N' AND diskusi.diskusi_id_user=user.id_user AND diskusi.diskusi_kategori=kategori.id_kategori AND foto_diskusi.id_foto=(SELECT CASE  foto_diskusi.featured WHEN 'Y' THEN id_foto WHEN 'N' THEN id_foto END AS 'id_foto'  FROM foto_diskusi WHERE foto_diskusi.id_diskusi=diskusi.diskusi_id ORDER BY featured ASC LIMIT 1) ORDER BY diskusi.diskusi_id DESC LIMIT $offset,$limit

		 ");

		return $data->result_array();		

	}

	function hitung_semua_diskusi_per_tag($id_slug){

		$id_slug=intval($id_slug);


		$data=$this->CI->db->query("SELECT diskusi.diskusi_id AS id,
		 diskusi.diskusi_judul AS judul, 
		 diskusi.diskusi_isi AS isi,
		 diskusi.diskusi_tgl_posting AS tanggal,
		 diskusi.diskusi_dibaca AS dibaca,
		 diskusi.diskusi_seo_url AS slug,		 
		 diskusi.diskusi_tags as tags,
		 kategori.id_kategori,
		 kategori.nama_kategori,
		 user.nama_lengkap AS nama_admin,
		 user.id_user AS id_admin,
		 foto_diskusi.nama_foto AS foto
		 FROM diskusi,kategori,user,foto_diskusi
		 WHERE FIND_IN_SET('$id_slug',diskusi.diskusi_tags) AND  diskusi.diskusi_status='publish' AND kategori.aktif='Y' AND kategori.terhapus='N' AND user.status_user='Y' AND user.terhapus='N' AND diskusi.diskusi_id_user=user.id_user AND diskusi.diskusi_kategori=kategori.id_kategori AND foto_diskusi.id_foto=(SELECT CASE  foto_diskusi.featured WHEN 'Y' THEN id_foto WHEN 'N' THEN id_foto END AS 'id_foto'  FROM foto_diskusi WHERE foto_diskusi.id_diskusi=diskusi.diskusi_id ORDER BY featured ASC LIMIT 1) ORDER BY diskusi.diskusi_id DESC

		 ");

		return $data->num_rows();

	}


	function search_article($keyword,$limit,$offset){


		$limit=intval($limit);
		$offset=intval($offset);


		$data=$this->CI->db->query("SELECT diskusi.diskusi_id AS id,
		 diskusi.diskusi_judul AS judul, 
		 diskusi.diskusi_isi AS isi,
		 diskusi.diskusi_tgl_posting AS tanggal,
		 diskusi.diskusi_dibaca AS dibaca,
		 diskusi.diskusi_seo_url AS slug,		 
		 diskusi.diskusi_tags as tags,
		 kategori.id_kategori,
		 kategori.nama_kategori,
		 user.nama_lengkap AS nama_admin,
		 user.id_user AS id_admin,
		 foto_diskusi.nama_foto AS foto
		 FROM diskusi,kategori,user,foto_diskusi
		 WHERE diskusi.diskusi_isi LIKE '%$keyword%' AND  diskusi.diskusi_status='publish' AND kategori.aktif='Y' AND kategori.terhapus='N' AND user.status_user='Y' AND user.terhapus='N' AND diskusi.diskusi_id_user=user.id_user AND diskusi.diskusi_kategori=kategori.id_kategori AND foto_diskusi.id_foto=(SELECT CASE  foto_diskusi.featured WHEN 'Y' THEN id_foto WHEN 'N' THEN id_foto END AS 'id_foto'  FROM foto_diskusi WHERE foto_diskusi.id_diskusi=diskusi.diskusi_id ORDER BY featured ASC LIMIT 1) ORDER BY diskusi.diskusi_id DESC LIMIT $offset,$limit

		 ");

		return $data->result_array();		

	}

	function hitung_search_article($keyword){

		$data=$this->CI->db->query("SELECT diskusi.diskusi_id AS id,
		 diskusi.diskusi_judul AS judul, 
		 diskusi.diskusi_isi AS isi,
		 diskusi.diskusi_tgl_posting AS tanggal,
		 diskusi.diskusi_dibaca AS dibaca,
		 diskusi.diskusi_seo_url AS slug,		 
		 diskusi.diskusi_tags as tags,
		 kategori.id_kategori,
		 kategori.nama_kategori,
		 user.nama_lengkap AS nama_admin,
		 user.id_user AS id_admin,
		 foto_diskusi.nama_foto AS foto
		 FROM diskusi,kategori,user,foto_diskusi
		 WHERE diskusi.diskusi_isi LIKE '%$keyword%'  AND  diskusi.diskusi_status='publish' AND kategori.aktif='Y' AND kategori.terhapus='N' AND user.status_user='Y' AND user.terhapus='N' AND diskusi.diskusi_id_user=user.id_user AND diskusi.diskusi_kategori=kategori.id_kategori AND foto_diskusi.id_foto=(SELECT CASE  foto_diskusi.featured WHEN 'Y' THEN id_foto WHEN 'N' THEN id_foto END AS 'id_foto'  FROM foto_diskusi WHERE foto_diskusi.id_diskusi=diskusi.diskusi_id ORDER BY featured ASC LIMIT 1) ORDER BY diskusi.diskusi_id DESC

		 ");

		return $data->num_rows();

	}


	function diskusi_semua($limit,$offset){

		$limit=intval($limit);
		$offset=intval($offset);


		$data=$this->CI->db->query("SELECT diskusi.diskusi_id AS id,
		 diskusi.diskusi_judul AS judul, 
		 diskusi.diskusi_isi AS isi,
		 diskusi.diskusi_tgl_posting AS tanggal,
		 diskusi.diskusi_dibaca AS dibaca,
		 diskusi.diskusi_seo_url AS slug,		 
		 diskusi.diskusi_tags as tags,
		 kategori.id_kategori,
		 kategori.nama_kategori,
		 user.nama_lengkap AS nama_admin,
		 user.id_user AS id_admin,
		 foto_diskusi.nama_foto AS foto
		 FROM diskusi,kategori,user,foto_diskusi
		 WHERE  diskusi.diskusi_status='publish' AND kategori.aktif='Y' AND kategori.terhapus='N' AND user.status_user='Y' AND user.terhapus='N' AND diskusi.diskusi_id_user=user.id_user AND diskusi.diskusi_kategori=kategori.id_kategori AND foto_diskusi.id_foto=(SELECT CASE  foto_diskusi.featured WHEN 'Y' THEN id_foto WHEN 'N' THEN id_foto END AS 'id_foto'  FROM foto_diskusi WHERE foto_diskusi.id_diskusi=diskusi.diskusi_id ORDER BY featured ASC LIMIT 1) ORDER BY diskusi.diskusi_id DESC LIMIT $offset,$limit

		 ");

		return $data->result_array();		

	}

	function hitung_semua_diskusi(){

		$data=$this->CI->db->query("SELECT diskusi.diskusi_id AS id,
		 diskusi.diskusi_judul AS judul, 
		 diskusi.diskusi_isi AS isi,
		 diskusi.diskusi_tgl_posting AS tanggal,
		 diskusi.diskusi_dibaca AS dibaca,
		 diskusi.diskusi_seo_url AS slug,		 
		 kategori.nama_kategori,
		 user.nama_lengkap AS nama_admin,
		 user.id_user AS id_admin,
		 foto_diskusi.nama_foto AS foto
		 FROM diskusi,kategori,user,foto_diskusi
		 WHERE  diskusi.diskusi_status='publish' AND kategori.aktif='Y' AND kategori.terhapus='N' AND user.status_user='Y' AND user.terhapus='N' AND diskusi.diskusi_id_user=user.id_user AND diskusi.diskusi_kategori=kategori.id_kategori AND foto_diskusi.id_foto=(SELECT CASE  foto_diskusi.featured WHEN 'Y' THEN id_foto WHEN 'N' THEN id_foto END AS 'id_foto'  FROM foto_diskusi WHERE foto_diskusi.id_diskusi=diskusi.diskusi_id ORDER BY featured ASC LIMIT 1)

		 ");

		return $data->num_rows();		
	}


	function detail_diskusi($id){

		$id=intval($id);


		$data=$this->CI->db->query("SELECT diskusi.diskusi_id AS id,
		 diskusi.diskusi_judul AS judul, 
		 diskusi.diskusi_isi AS isi,
		 diskusi.diskusi_tgl_posting AS tanggal,
		 diskusi.diskusi_tgl_last_edit AS tanggal_edit,
		 diskusi.diskusi_dibaca AS dibaca,
		 diskusi.diskusi_seo_url AS slug,		 
		 diskusi.diskusi_tags as tags,

		 diskusi.diskusi_meta_description AS meta_description,
		 diskusi.diskusi_meta_author AS meta_author,
		 diskusi.diskusi_meta_keyword AS meta_keyword,

		 diskusi.diskusi_og_image AS og_image,
		 diskusi.diskusi_og_title AS og_title,
		 diskusi.diskusi_og_description AS og_description,

		 kategori.id_kategori,
		 kategori.nama_kategori,
		 user.name_user AS username,
		 user.nama_lengkap AS nama_admin,
		 user.id_user AS id_admin,
		 foto_diskusi.nama_foto AS foto
		 FROM diskusi,kategori,user,foto_diskusi
		 WHERE diskusi.diskusi_id='$id' AND diskusi.diskusi_status='publish' AND kategori.aktif='Y' AND kategori.terhapus='N' AND user.status_user='Y' AND user.terhapus='N' AND diskusi.diskusi_id_user=user.id_user AND diskusi.diskusi_kategori=kategori.id_kategori AND foto_diskusi.id_foto=(SELECT CASE  foto_diskusi.featured WHEN 'Y' THEN id_foto WHEN 'N' THEN id_foto END AS 'id_foto'  FROM foto_diskusi WHERE foto_diskusi.id_diskusi=diskusi.diskusi_id ORDER BY featured ASC LIMIT 1) ");

		if($data->num_rows()>0){

		$data=$data->row_array();

		$foto=$this->CI->db->query("SELECT id_foto AS id, nama_foto AS nama FROM foto_diskusi WHERE id_diskusi='$id' ORDER BY id_foto DESC ");

		$data["isi"]=reversequote($data["isi"],"all");
		$data["og_title"]=trim($data["og_title"]);
		$data["og_image"]=trim($data["og_image"]);
		$data["og_description"]=trim($data["og_description"]);
		$data["meta_keyword"]=trim($data["meta_keyword"]);
		$data["meta_description"]=trim($data["meta_description"]);

		return $data;

		} else {
			return false;
		}

	}

	function dibaca($id){
		$id=intval($id);		
		$this->CI->db->query("UPDATE diskusi SET diskusi_dibaca= diskusi_dibaca+1 WHERE diskusi_id='$id' ");
	}


}