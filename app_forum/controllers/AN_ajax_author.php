<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class AN_ajax_author extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
		
		if(!$this->input->is_ajax_request()){
			exit('No direct script access allowed :)');
		}  

		if(!$this->session->userdata("login")){
			exit("Akses Ditolak!");
		}
		
		$this->load->helper(array('filter','url','file','tambahan'));


		$this->load->library(array('Slugify','zip'));


		$this->load->model("author/otorisasi");	

	}

	function edit_fullname(){
		$id=changequote($this->input->post("id"));
		$name=trim(changequote($this->input->post("name")));
		$query=$this->db->query("UPDATE user SET nama_lengkap='$name' WHERE id_user='$id'");
		if($query){
			echo "ok";
		}
	}

	function edit_email(){
		$id=changequote($this->input->post("id"));
		$email=trim(changequote($this->input->post("email")));
		$query=$this->db->query("UPDATE user SET email='$email' WHERE id_user='$id'");
		if($query){
			echo "ok";
		}
	}

	function edit_password(){
		$id=changequote($this->input->post("id"));
		$password=md5($this->input->post("password"));
		$query=$this->db->query("UPDATE user SET password_user='$password' WHERE id_user='$id'");
		if($query){
			echo "ok";
		}
	}

	function update_user(){

		$email=changequote($this->input->post("email"));		
		$nama_lengkap=changequote($this->input->post("nama_lengkap"));
		$password=md5($this->input->post("password_user"));
		$avatar=changequote($this->input->post("avatar_user"));
		$user=$this->db->query("SELECT * FROM user WHERE level_user='0' AND status_user='Y' AND terhapus='N' AND id_user= '".$this->session->userdata("id_user")."' ");
		if($user->num_rows()>0){
			echo "taken";
		}else{
			$photo="";
			$savatar=$this->db->query("SELECT * FROM foto_user_tmp WHERE sesi_from='$sessi'");
			if($avatar=="0"){
				//echo "No avatar";
				if($savatar->num_rows()>0){
					foreach($savatar->result_array() as $row){
						$this->db->query("DELETE FROM foto_user_tmp WHERE id_foto='$row[id_foto]'");
						unlink(FCPATH."an-component/media/upload-user-avatar/".$row["nama_foto"]);
					}
				}
				$photo="default.jpg";
				} else {
					$row2=$savatar->row();
					$photo=$row2->nama_foto;
					$this->db->query("DELETE FROM foto_user_tmp WHERE sesi_from='$sessi'");

					//echo "ada avatar";
				}
			$query=$this->db->query("INSERT INTO user (nama_lengkap,email,password_user,avatar_user) VALUES ('$nama_lengkap','$email','$password','$photo')");
			if($query){
				echo "ok";
			}

}
		}

	function avatar_update(){
		
		$config=array(
			"upload_path"=>FCPATH."an-component/media/upload-user-avatar/",
			"allowed_types"=>"gif|jpg|jpeg|png"
			);
		$this->load->library('upload', $config);
		 if ( ! $this->upload->do_upload())
                {
                        $error = array('error' => $this->upload->display_errors());

                       echo $error['error'];
                }
                else
                {
                	$id=changequote($this->input->post('id')); //????????????
                	$nama=$this->upload->data('file_name');
                	$token_foto=changequote($this->input->post('token_foto'));
                	$query=$this->db->query("INSERT INTO foto_user_tmp (nama_foto,token_foto,id_user) VALUES ('$nama','$token_foto','$id')");
                	echo 'ok';
                }

	}


	function ganti_user_avatar(){
		$id=changequote($this->input->post("id"));
		$cari=$this->db->query("SELECT * FROM foto_user_tmp WHERE id_user='$id' ORDER BY id_foto DESC");
		if($cari->num_rows()>0){
			$cari_foto_lama=$this->db->query("SELECT * FROM user WHERE id_user='$id'");
			$_row=$cari_foto_lama->row();
			$foto_lama=$_row->avatar_user;
			if($foto_lama!="dafault.jpg"){
				unlink(FCPATH."an-component/media/upload-user-avatar/".$foto_lama);
			}
			$row=$cari->row();
			$query=$this->db->query("UPDATE user SET avatar_user='".$row->nama_foto."' WHERE id_user='$id' ");

			//Hapus SEMUA yg punya ID user sama
			$hapus=$this->db->query("DELETE FROM foto_user_tmp WHERE id_user='$id' ");
			if($hapus){
				echo "ok";
			}
		}
	}


	function foto_gallery_artikel(){

		$config=array(
			"upload_path"=>FCPATH."an-component/media/upload-gambar-artikel/",
			"allowed_types"=>"gif|jpg|jpeg|png"
			);
		$this->load->library('upload', $config);
		 if ( ! $this->upload->do_upload())
                {
                        $error = array('error' => $this->upload->display_errors());

                       echo $error['error'];
                }
                else
                {
                	//$id=$this->input->post('id');
                	$id=changequote($this->input->post("id"));
                	$sesi=changequote($this->input->post("sesi"));
                	$nama=$this->upload->data('file_name');
                	$token_foto=changequote($this->input->post('token_foto'));

                	if($id==0){
                	$query=$this->db->query("INSERT INTO foto_artikel_temp (nama_foto,token_foto,sesi_form,id_user) VALUES ('$nama','$token_foto','$sesi','$id')");
                	} else {
                	$query=$this->db->query("INSERT INTO foto_artikel (id_artikel,nama_foto,token_foto) VALUES ('$id','$nama','$token_foto')");
               		 }

               		$width_thumb=300;
					$cari_width=$this->db->query("SELECT width_thumb_artikel FROM informasi WHERE id='1'");               		
					if($cari_width->num_rows()>0){
						$datW=$cari_width->row();
						if($datW->width_thumb_artikel>99){
							$width_thumb=$datW->width_thumb_artikel;
						}
					}

                	$config2=array(
                		"source_image"=>$this->upload->data('full_path'),
                		"maintain_ratio"=>TRUE,
                		"new_image"=>FCPATH."an-component/media/upload-gambar-artikel-thumbs/",
                		//"create_thumb"=>TRUE,
                		"width"=>$width_thumb
                		);

                	$this->load->library('image_lib', $config2);
					$this->image_lib->resize();

                	if ( ! $this->image_lib->resize())
							{
							        echo $this->image_lib->display_errors();
							} else {
								if($id==0){
								echo "ok";
								} else {
								$search=$this->db->query("SELECT id_foto FROM foto_artikel WHERE token_foto='$token_foto' ");
								$dat=$search->row();
								$dat_id=$dat->id_foto;
								echo '{"gambar":"'.$nama.'","id":"'.$dat_id.'"}';
								}
								//echo $this->upload->data('full_path');
							}
                }
	}

	function avatar_new(){
		$config=array(
			"upload_path"=>FCPATH."an-component/media/upload-user-avatar/",
			"allowed_types"=>"gif|jpg|jpeg|png"
			);
		$this->load->library('upload', $config);
		 if ( ! $this->upload->do_upload())
                {
                        $error = array('error' => $this->upload->display_errors());

                       echo $error['error'];
                       echo "<br>";
                       echo base_url()."an-component/media/upload-user-avatar/";
                }
                else
                {

                	$nama=$this->upload->data('file_name');
                	$sesi_form=changequote($this->input->post('sesi'));
                	$token_foto=changequote($this->input->post('token_foto'));
                	$query=$this->db->query("INSERT into foto_user_tmp (nama_foto,token_foto,sesi_from) VALUES ('$nama','$token_foto','$sesi_form')");
                	echo 'ok';
                }

	}

	function delete_foto_temp(){
		$token_foto=changequote($this->input->post('foto_token'));
		$query=$this->db->query("SELECT * FROM foto_user_tmp WHERE token_foto='$token_foto'");
		if($query->num_rows()>0){
			$row=$query->row();
			$query2=$this->db->query("DELETE FROM foto_user_tmp WHERE token_foto='$token_foto'");
			if($query){
				unlink(FCPATH."an-component/media/upload-user-avatar/".$row->nama_foto);
			}
		}

	}

	function set_featured_image(){
		$id=changequote($this->input->post("id"));
		$artikel_id=changequote($this->input->post("artikel_id"));
		$reset=$this->db->query("UPDATE foto_artikel SET featured='N' WHERE featured='Y' AND id_artikel='$artikel_id' ");
		$update=$this->db->query("UPDATE foto_artikel SET featured='Y' WHERE id_foto='$id'");
	     echo "ok";
	}


	function delete_foto_artikel_temp(){
		$token_foto=changequote($this->input->post("token"));
		$query=$this->db->query("SELECT * FROM foto_artikel_temp WHERE token_foto='$token_foto' ");
		if($query->num_rows()>0){
			$data=$query->row();
			$file=FCPATH."an-component/media/upload-gambar-artikel/".$data->nama_foto;
			$thumbnail=FCPATH."an-component/media/upload-gambar-artikel-thumbs/".$data->nama_foto;
			$query2=$this->db->query("DELETE FROM foto_artikel_temp WHERE token_foto='$token_foto' ");
			unlink($file);
			unlink($thumbnail);
		}
	}

	function submit_artikel($i=0){
		$judul=changequote($this->input->post('judul'));
		$sesi=changequote($this->input->post('sesi'));
		$id=changequote($this->input->post('id'));
		$seo=changequote($this->input->post('seo'));
		$isi=filterquote($this->input->post('isi'),"all");
		$kategori=changequote($this->input->post('kategori'));
		$tag=changequote($this->input->post('tags'));
		$headline=changequote($this->input->post('headline'));
		$editable=changequote($this->input->post('editable'));
		$meta_description=changequote($this->input->post('meta_description'));
		$meta_author=changequote($this->input->post('meta_author'));
		$meta_keyword=changequote($this->input->post('meta_keyword'));
		$og_description=changequote($this->input->post('og_description'));
		$og_title=changequote($this->input->post('og_title'));
		$og_image=changequote($this->input->post('og_image'));
		$sesi_artikel=changequote($this->input->post('sesi_artikel'));
		$aStatus=changequote($this->input->post('aStatus'));

		$tanggal_posting=date("Y:m:d H:i:s",now());
		$id_user_input=$this->session->userdata('id_user');

		if($i==0){

			$stats=($this->input->post('returnDraft')=='true')?"draft":"publish";
			$was_published=($this->input->post('returnDraft')=='true')?"N":"Y";
			$tgl_posting=($this->input->post('returnDraft')=='true')?"0000-00-00 00:00:00":$tanggal_posting;
			//id masih kosong berati baru pertama kali posting

			//cek apakah sudah pernah ada sbg draft
			$search=$this->db->query("SELECT * FROM artikel WHERE artikel_sesi_id='$sesi' ");
			if($search->num_rows()>0){
				$update="UPDATE artikel SET 
									artikel_judul='$judul',
									artikel_isi='$isi',
									artikel_kategori='$kategori',
									artikel_tags='$tag',
									artikel_sbg_headline='$headline',
									artikel_tgl_posting='$tgl_posting',
									artikel_id_user='$id_user_input',
									artikel_editable='$editable',
									artikel_seo_url='$seo',
									artikel_meta_description='$meta_description',
									artikel_meta_author='$meta_author',
									artikel_meta_keyword='$meta_keyword',
									artikel_og_image='$og_image',
									artikel_og_title='$og_title',
									artikel_og_description='$og_description',
									artikel_status='$stats',
									artikel_was_published='$was_published'
									WHERE
									artikel_sesi_id='$sesi'
							";
					$query=$this->db->query($update);
			} else {
				//belum ada di draft
				
				$ready= "INSERT INTO artikel (
									artikel_judul,
									artikel_isi,
									artikel_kategori,
									artikel_tags,
									artikel_sbg_headline,
									artikel_tgl_posting,
									artikel_id_user,
									artikel_editable,
									artikel_seo_url,
									artikel_meta_description,
									artikel_meta_author,
									artikel_meta_keyword,
									artikel_og_image,
									artikel_og_title,
									artikel_og_description,
									artikel_status,
									artikel_was_published,
									artikel_sesi_id) 
									VALUES (
									'$judul',
									'$isi',
									'$kategori',
									'$tag',
									'$headline',
									'$tgl_posting',
									'$id_user_input',
									'$editable',
									'$seo',
									'$meta_description',
									'$meta_author',
									'$meta_keyword',
									'$og_image',
									'$og_title',
									'$og_description',
									'$stats',
									'$was_published',
									'$sesi')";
		
				$query=$this->db->query($ready);

				//memindahkan gambar ke artikel


			}

			$tok=($this->input->post('returnDraft')=='true')?"artikel_sesi_id='$sesi'":"artikel_tgl_posting='$tanggal_posting'";	
				$sinc_artikel=$this->db->query("SELECT artikel_id FROM artikel WHERE $tok");
				if($sinc_artikel->num_rows()>0){
					$_id_artikel=$sinc_artikel->row();
					$_id_artikel=$_id_artikel->artikel_id;


					$foto=$this->db->query("SELECT * FROM foto_artikel_temp WHERE sesi_form='$sesi'");
					if($foto->num_rows()>0){
						foreach($foto->result_array() as $data){
							$this->db->query("INSERT INTO foto_artikel (id_artikel,nama_foto) VALUES ('$_id_artikel','$data[nama_foto]') ");
							//delete row
							$this->db->query("DELETE FROM foto_artikel_temp WHERE id_foto='$data[id_foto]'");
							
						}
					}
				}

				echo ($this->input->post('returnDraft')=='true')?"draftSaved":$_id_artikel; 			
			
		} 

		else if($i==1){
			//$status='draft';
		} 

		else if($i==2){
			//$status='publish';
		}

		else if($i==3){


		$test=$this->db->query("SELECT * FROM artikel WHERE artikel_id='$id'");
		$ddd=$test->row();

		if($this->input->post('returnDraft')=='true') {
			$status='draft';
			$add="";
			$published=($ddd->artikel_was_published=="Y")?"Y":"N";
		} else {
			$status='publish';			
			$published="Y";
			$add="";
			if($ddd->artikel_tgl_posting=='0000-00-00 00:00:00'){
					$add="artikel_tgl_posting='$tanggal_posting',";
				} 
		} 

			

		
		$update="UPDATE artikel SET 
									artikel_judul='$judul',
									artikel_isi='$isi',
									artikel_kategori='$kategori',
									artikel_tags='$tag',
									artikel_sbg_headline='$headline',
									$add
									artikel_tgl_last_edit='$tanggal_posting',
									artikel_id_user_last_edit='$id_user_input',
									artikel_editable='$editable',
									artikel_seo_url='$seo',
									artikel_meta_description='$meta_description',
									artikel_meta_author='$meta_author',
									artikel_meta_keyword='$meta_keyword',
									artikel_og_image='$og_image',
									artikel_og_title='$og_title',
									artikel_og_description='$og_description',
									artikel_status='$status',
									artikel_was_published='$published'
									WHERE
									artikel_id='$id';
							";
				$this->db->query($update);

							echo $status;

		}


		



		

	}


	function delete_artikel(){
		$id=changequote($this->input->post('id'));
		$artikel_sql=$this->db->query("DELETE FROM artikel WHERE artikel_id='$id'");
		$foto_artikel=$this->db->query("SELECT * FROM foto_artikel WHERE id_artikel='$id'");
		if($foto_artikel->num_rows()>0){
			foreach ($foto_artikel->result_array() as $row){
				//hapus file foto

				unlink(FCPATH."an-component/media/upload-gambar-artikel/".$row['nama_foto']);

				unlink(FCPATH."an-component/media/upload-gambar-artikel-thumbs/".$row['nama_foto']);

			}
			// hapus database foto
			$this->db->query("DELETE FROM foto_artikel WHERE id_artikel='$id'");
		}

		echo 'ok';
	}

	function delete_atikel_foto(){
		$id=changequote($this->input->post('id'));
		$cari_foto=$this->db->query("SELECT * FROM foto_artikel WHERE id_foto='$id'");
		if($cari_foto->num_rows()>0){
			$data=$cari_foto->row();
			//hapus file foto

				unlink(FCPATH."an-component/media/upload-gambar-artikel/".$data->nama_foto);

				unlink(FCPATH."an-component/media/upload-gambar-artikel-thumbs/".$data->nama_foto);

			//hapus  foto dari database
				$query=$this->db->query("DELETE FROM foto_artikel WHERE id_foto='$id' ");
				if($query){
					echo "sukses";
				}

			
		} else {
			//error
			echo "deleted";
		}

	}

	function delete_multi_photos(){
		$id=explode(",",changequote($this->input->post("id")));
		foreach ($id as $value) {
			$cari=$this->db->query("SELECT * FROM foto_artikel WHERE id_foto='$value'");
			if($cari->num_rows()>0){
				$data=$cari->row();

				unlink(FCPATH."an-component/media/upload-gambar-artikel/".$data->nama_foto);

				unlink(FCPATH."an-component/media/upload-gambar-artikel-thumbs/".$data->nama_foto);
				$this->db->query("DELETE FROM foto_artikel WHERE id_foto='$value'");
			}
		}

		echo "ok";

	}

	function delete_media(){
		$value=changequote($this->input->post('id'));
		$cari=$this->db->query("SELECT * FROM foto_artikel WHERE id_foto='$value'");
			if($cari->num_rows()>0){
				$data=$cari->row();

				unlink(FCPATH."an-component/media/upload-gambar-artikel/".$data->nama_foto);

				unlink(FCPATH."an-component/media/upload-gambar-artikel-thumbs/".$data->nama_foto);
				$this->db->query("DELETE FROM foto_artikel WHERE id_foto='$value'");
		}
		echo "ok";
	}





	
	function sesi(){
		echo $this->session->userdata('level_user');
	}


}
?>