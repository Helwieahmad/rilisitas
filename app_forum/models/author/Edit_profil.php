<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Edit_profil extends CI_Model {
	public $hasil="";

	function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }

	function show(){
		$query=$this->db->query("SELECT * FROM user WHERE terhapus='N' AND status_user='Y' AND level_user='0' AND id_user = '".$this->session->userdata("id_user")."' ");
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$level=($row['level_user']=='1')?"Super admin":"Admin";
				$tatus=($row['status_user']=='Y')?"<span class='label label-success'>Aktif</span>":"<span class='label label-danger'>Tidak Aktif</span>";
				$id=$row['id_user'];
				$this->hasil.="<tr class='edit' id='$id'>";
				$this->hasil.="
				<td align='center'><span class='editable username'>".$row['name_user']."</span><form class='username'><input type='text' disabled='disabled'></form></td>";
				$this->hasil.="<td align='center'><span class='editable full_name'>".$row['nama_lengkap']."</span><form class='full_name'><input type='text'></form></td>";
				$this->hasil.="<td align='center'><span class='editable email'>".$row['email']."</span><form class='email'><input type='text'></form></td>";
				$levop=($row['level_user']=='1')?"<select class='level'><option value='0' >Admin</option><option value='1' selected>Super Admin</option></select>":"<select class='level'><option value='0' selected>Admin</option><option value='1' >Super Admin</option></select>";
				$this->hasil.="";
				$staop=($row['status_user']=='Y')?"":"";
				$this->hasil.="";
				$pasbut="<button class='btn btn-app btn-danger password'><i class='fa fa-lock'></i>Ganti Password</button>";
				$fotbut="<button class='btn btn-flat btn btn-app btn-warning foto'><i class='fa fa-photo'></i>Ganti Foto</button>";
				$hapus=($this->session->userdata('id_user')!=$row['id_user'])?"<button class='btn btn-xs btn-danger hapus'><i class='fa fa-remove'></i> Hapus</button>":"";
				$this->hasil.="<td align='center'>"."$pasbut &nbsp; $fotbut &nbsp; $hapus"."</td>";
				$this->hasil.="</tr>";

			}

			return true;
		} else {
			return false;
		}
	}
}