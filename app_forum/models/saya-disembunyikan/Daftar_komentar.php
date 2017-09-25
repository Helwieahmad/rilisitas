<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Daftar_komentar extends CI_Model {
	public $hasil="";

	function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }
 
	function show(){
		$query=$this->db->query("SELECT * FROM komentar ORDER BY id DESC");
		if($query->num_rows()>0){
			foreach($query->result_array() as $row){
				$id=$row['id'];
				$this->hasil.="<tr class='edit' id='$id'>";
				$this->hasil.="<td><span class='nama'>".$row['nama']."</span><form class='nama'><input type='text' data-original-title='Ketikkan Nama Lalu Enter'></form></td>";
				$this->hasil.="<td><span class='email'>".$row['email']."</span><form class='email'><input type='text' data-original-title='Ketik Email Lalu Enter'></form></td>";
				$this->hasil.="<td><span class='pesan'>".$row['pesan']."</span><form class='pesan'><input type='text' data-original-title=Ketik Pesan Lalu Enter></form></td>";
				$this->hasil.="<td><span class='tanggal'>".$row['tanggal']."</span><form disabled class='tanggal'><input type='text' data-original-title='Tidak Bisa diganti'></form></td>";
				$this->hasil.="<td><span class='ip'>".$row['ip']."</span><form class='ip'><input title='Tidak Bisa diedit' disabled type='text' data-original-title='Tidak Bisa Diganti'></form></td>";
				$hapus=($this->session->userdata('id_user')!=$row['id'])?"<button class='btn btn-xs btn-danger hapus'><i class='fa fa-remove'></i> Hapus</button>":"<button class='btn btn-xs btn-danger disabled'><i class='fa fa-remove'></i> Hapus</button>";
				$this->hasil.="<td>"."&nbsp; $hapus"."</td>";
				$this->hasil.="</tr>";

			}

			return true;
		} else {
			return false;
		}
	}

}