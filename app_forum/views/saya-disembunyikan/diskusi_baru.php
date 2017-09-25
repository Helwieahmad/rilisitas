<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
?>

<div class="content-wrapper">
	<section class="content-header">
		<h1><?php echo ($modul=='edit')?"Edit diskusi":"diskusi Baru" ?> 
			<small><?php echo ($modul=='edit')?"Edit diskusi anda":"Masukan diskusi baru" ?></small></h1>
			<ol class="breadcrumb">
            <li><a href="<?php echo $burl; ?>/"><i class="fa fa-dashboard"></i> Halaman Utama</a></li><li class="active"><?php echo ($modul=='edit')?"Edit diskusi":"diskusi Baru" ?></li>
           
          </ol>
	</section>

	<section class="content">
		<div class="box box-danger">
		<div class="box-body">
				<div class="row">
					<div class="col-md-12 col-xs-12">

						<div class="form-group">
							<label for="judul_diskusi">Judul diskusi</label>
							<input type="text" class="form-control" name="judul_diskusi" id="judul_diskusi" value='<?php echo $diskusi_judul ?>' >
						</div>

						<div class='form-group'>
          					<label for='seo_url'>SEO URL</label>
	          					<div class="input-group">
	          						<div class="input-group-addon"><?php echo base_url() ?>diskusi/00-</div>
			          				 <input type='text' class='form-control' name='seo_url' id='seo_url' placeholder='field ini akan otomatis terisi ketika anda mengetikan judul diskusi. Tentu saja anda dapat mengeditnya' value='<?php echo $diskusi_seo_url  ?>' >
			          				
		          				</div>
          				</div>

						<div class="form-group">
							<label for="isi_diskusi">Isi diskusi</label>
							<textarea  id='isi_diskusi' class='isi_diskusi form-control'><?php echo $diskusi_isi ?></textarea>
						</div>

						<div class="form-group">
                   		 <input type='hidden' class='sesi-from_diskusi' value='<?php echo rand(0,100).rand(10,500).date('dym') ?>' >
                   		 <input type='hidden' class='id_diskusi' value='<?php echo $diskusi_id ?>' >
						</div>

						<div class="form-group">
							<label for="kategori_diskusi">Kategori</label>
							<select name="kategori_diskusi" id="kategori_diskusi" class="form-control">
								<option value="0" selected>Pilih kategori</option>
								<?php
								if($list_kategori!=false){
									echo $list_kategori;
								}
								 ?>
							</select>
						</div>

						<div class="form-group">
							<label for="">Tags</label> <small>terpilih <span class="area_count">0</span> tag(s)</small>
							<div class="well well-sm well-tag">
								<?php
								if($tag_kategori!=false){
									echo $tag_kategori;
								}
								?>
							</div>
						</div>

						<div class="form-group">
							<label>Foto Gallery</label> <small>foto boleh banyak</small>
							<div class="dropzone well well-sm foto_gallery_diskusi">
							</div>
						</div>

						<div class="form-group" style="height:30px">
							<button class='btn btn-sm btn-danger tbl-hapus-multi'><i class='glyphicon glyphicon-trash'></i>  Hapus Foto Terpilih </button>
						 </div>

						<div class="form-group"><div class="row foto-diskusi-area"><?php 
						if($diskusi_photos!=false){
							foreach ($diskusi_photos as  $value) {
								$featured=($value["featured"]=="Y")?"<span class='label label-primary featured-label'>Featured</span>":"";
								$ftrue=($value["featured"]=="Y")?"featured-true":"";
								echo "
								<div class='aPhotoThumb col-md-4 col-xs-4 $ftrue'>
								$featured
								<span class='label label-danger hapus_label'> menghapus... </span>
								<button class='btn btn-warning btn-sm featured-tombol'>jadikan featured image</button>
								<span class='glyphicon glyphicon-remove hapus_foto_diskusi' id='$value[id_foto]'></span>
								
								<div class='hover_foto_diskusi' ></div>";
								echo "<img src='$path_art_photo_thumb/$value[nama_foto]'>";
								echo "</div>";
							}
						}
						?></div></div>

						<div class="form-group"> 
							<button class='btn btn-xs btn-danger tampilkan-meta' alt='0'>Tampilkan Informasi Tambahan</button>
						</div>

						<div class="tambahan_p_diskusi" style="display: none;">	

						<div class="form-group">
							<label>Jadikan Headline</label>
							<div class="cek_headline">YES</div>
						</div>

						<?php
						if($diskusi_id_user==false OR $diskusi_id_user==$id_user OR $user_level==1){
						echo '<div class="form-group">
							<label>Izinkan User lain Untuk Mengedit diskusi</label>
							<div class="iz_edit">YES</div>
						</div>';
						}
						?>

						<div class="form-group">
							<label for="meta_description">Meta Description</label>
							<input type="text" class="form-control" id="meta_description" placeholder="optional. jika anda kosongkan, meta ini tidak akan tampil di website anda" value="<?php echo $diskusi_meta_description; ?>">
						</div>
						<div class="form-group">
							<label for="meta_author">Meta author</label>
							<input type="text" class="form-control" id="meta_author" placeholder="optional. jika anda kosongkan, meta ini tidak akan tampil di website anda" value="<?php echo $diskusi_meta_author ?>">
						</div>

						<div class="form-group">							
							<label for="meta_keyword">Meta Keyword</label>
							<input type="text" class="form-control" id="meta_keyword" placeholder="optional. pisahkan dengan koma. jika anda kosongkan, meta ini tidak akan tampil di website anda"  value="<?php echo $diskusi_meta_keyword ?>">
						</div>
						<br>
						<br>

						<div class="form-group">
							<label for="og_title">Facebook  Meta Tag Open Graph Title</label>
							<input type="text" class="form-control" id="og_title" placeholder="optional" value="<?php echo $diskusi_og_title ?>">
						</div>

						<div class="form-group">
							<label for="og_description">Facebook  Meta Tag Open Graph Description</label>
							<input type="text" class="form-control" id="og_description" placeholder="optional" value="<?php echo $diskusi_og_description ?>" >
						</div>

						<div class="form-group">
							<label for="og_image">Facebook  Meta Tag Open Graph Image <small>(Harus awali dengan http:// atau https://) </small></label>
							 <div class="input-group">
							<input type="text" class="form-control" id="og_image" placeholder="optional. Masukan url gambar" value="<?php echo $diskusi_og_image ?>"><span class="input-group-addon pilih-fb-url">Pilih</span>
							</div>
						</div>

						<div class="form-group"></div>

						
						</div>

						<div class="form-group">
							

							 <button class="btn btn-sm btn-danger save-diskusi"><?php echo ($diskusi_id==0 || $diskusi_status=='draft')?'Publish':'Update' ?></button>
							
							&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 

							<button class="btn btn-xs  draft-diskusi"><?php echo ($diskusi_status=='publish')?"kembalikan ke draft":"Save draft"?></button> <small class='time-draft'></small><small class='pesan-draft'></small> 

						</div>
					</div>
				</div>
			<div class="box-body">
			</div>
		</div>
		</div>


	</section>
</div>