<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diskusi extends CI_Model
{
	public $list_kategori;
	public $list_tag;

	function __construct(){
		parent::__construct();
	}

	function get_kategori(){
		$query=$this->db->query("SELECT * FROM kategori WHERE aktif='Y' AND terhapus='N' ORDER BY id_kategori");
		if($query->num_rows()>0){
			foreach($query->result_array() as $data){
				$this->list_kategori.="<option value='$data[id_kategori]' >";
				$this->list_kategori.="$data[nama_kategori]";
				$this->list_kategori.="</option>";
			}
		} else {
			$this->list_kategori=false;
		}
	}

	function get_diskusi_kategori($id){
		$kategori_diskusi='';
		$diskusi=$this->db->query("SELECT diskusi_kategori FROM diskusi WHERE diskusi_id='$id'");
		$_diskusi=$diskusi->row();
		$id_kategori=$_diskusi->diskusi_kategori;

		$query=$this->db->query("SELECT * FROM kategori WHERE aktif='Y' AND terhapus='N' ORDER BY id_kategori");
		if($query->num_rows()>0){
			foreach($query->result_array() as $data){
				$selected=($id_kategori==$data['id_kategori'])?'selected':'';
				$kategori_diskusi.="<option value='$data[id_kategori]' $selected>";
				$kategori_diskusi.="$data[nama_kategori]";
				$kategori_diskusi.="</option>";
			}

			return $kategori_diskusi;
		} else {
			$this->list_kategori=false;
		}
	}

	function get_tags(){
		$query=$this->db->query("SELECT * FROM tags ORDER BY id_tag DESC");
		if($query->num_rows()>0){
			foreach ($query->result_array() as $data) {
				$this->list_tag.="<span class='label label-default span-tag' id='$data[id_tag]' title='not_select'>";
				$this->list_tag.=$data["nama_tag"];
				$this->list_tag.="</span>";
			}
		} else {
			$this->list_tag=false;
		}
	}


	function get_data($id,$user){

		$query=$this->db->query("SELECT * FROM diskusi WHERE diskusi_id='$id' AND diskusi_terhapus='N' ");

		

		if($query->num_rows()>0){

			$data=$query->row();

			if ($user==$data->diskusi_id_user || $this->session->userdata('level_user')==1 || $data->diskusi_editable=="Y") {

			$carifoto=$this->db->query("SELECT * FROM foto_diskusi WHERE id_diskusi='$id' order by id_foto DESC");

			$cari_tag=$this->db->query("SELECT * FROM tags ORDER BY id_tag DESC");
			

			$active_tag="";
			$result_tag=$cari_tag->result_array();

			
			$current_tags=explode(",", $data->diskusi_tags);
			$jumlah_tag=0;
			foreach ($current_tags as $__data) {
				$jumlah_tag++;
			}


			if($jumlah_tag>0){
				$con=0;
				foreach($result_tag as $_data){
					if(in_array($_data['id_tag'],$current_tags)){
						if($con==0){
						$active_tag.=$_data['id_tag'];
					     } else {
					    $active_tag.=','.$_data['id_tag'];
					     }
					     $con++;
					 }
				}
			}

			return array(
				"diskusi_id"=>$data->diskusi_id,
				"diskusi_judul"=>reversequote($data->diskusi_judul,"all"),
				"diskusi_isi"=>reversequote($data->diskusi_isi,"all"),
				"diskusi_kategori"=>$data->diskusi_kategori,
				"diskusi_tags"=>$active_tag,
				"diskusi_foto"=>$data->diskusi_foto,
				"diskusi_sbg_headline"=>$data->diskusi_sbg_headline,
				"diskusi_id_user"=>$data->diskusi_id_user,
				"diskusi_editable"=>$data->diskusi_editable,
				"diskusi_seo_url"=>$data->diskusi_seo_url,
				"diskusi_meta_description"=>$data->diskusi_meta_description,
				"diskusi_meta_author"=>$data->diskusi_meta_author,
				"diskusi_meta_keyword"=>$data->diskusi_meta_keyword,
				"diskusi_og_image"=>$data->diskusi_og_image,
				"diskusi_og_title"=>$data->diskusi_og_title,
				"diskusi_og_description"=>$data->diskusi_og_description,
				"diskusi_in_draft"=>$data->diskusi_in_draft,
				"diskusi_status"=>$data->diskusi_status,
				"diskusi_aktif"=>$data->diskusi_aktif,
				"diskusi_photos"=>($carifoto->num_rows()>0)?$carifoto->result_array():false
				);

			} else {
				return false;
			}
		} else {
			return false;
		}
	}



}