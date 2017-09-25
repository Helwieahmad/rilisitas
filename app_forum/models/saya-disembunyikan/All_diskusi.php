<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class All_diskusi extends CI_Model {

	function __construct()
        {
                parent::__construct();
        }

	function get_diskusi(){
		$cari=$this->db->query("SELECT * FROM diskusi WHERE diskusi_terhapus='N' ORDER BY diskusi_id DESC");
		$kategori=$this->db->query("SELECT * FROM kategori WHERE aktif='Y' AND terhapus='N'");
		$arKat=array();
		$arKat[0]="";
		if($kategori->num_rows()>0){
			foreach ($kategori->result_array() as  $value) {
				$arKat[$value['id_kategori']]=$value['nama_kategori'];
			}			
		}

		$result="";
		if($cari->num_rows()>0){
			
			foreach ($cari->result_array() as $value) {
				if($this->session->userdata('id_user')==$value['diskusi_id_user'] || $this->session->userdata('id_user')==1 || $value['diskusi_editable']=='Y'){
					$delete_button="<i id='$value[diskusi_id]' style='color: red;cursor:pointer;' class='fa fa-times-circle btn-hapus-diskusi'></i>";
					$edit_button="<a href='".base_url()."saya-disembunyikan/diskusi/$value[diskusi_id]'><i class='fa fa-edit btn-edit-diskusi'></i></a>";
				}else{
					$delete_button="<i class='fa fa-times-circle' disabled='disabled'></i>";
					$edit_button="<i class='fa fa-edit' disabled='disabled'></i>";
				}

				$result.="<tr class='diskusi_tr' id='$value[diskusi_id]'>";
				$result.="<td>$value[diskusi_judul]</td>";
				$result.="<td>".@$arKat[$value['diskusi_kategori']]."</td>";
				$result.="<td>$value[diskusi_status]</td>";
				$result.="<td>$value[diskusi_tgl_posting]</td>";
				$result.="<td>$value[diskusi_tgl_last_edit]</td>";
				$result.="<td>$edit_button &nbsp; $delete_button</td>";
				$result.="</tr>";
				
			}
		}

		return $result;
	}
}

?>