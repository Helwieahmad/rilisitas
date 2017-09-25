<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

 <div class="content-wrapper" style="margin-top:50px; padding:0 20px">
    <div class="fluid-container">

          <!-- Main content -->
          <section class="content">
                <div class="col-md-10 col-md-offset-1">
                  <div class="callout callout-danger">
                    <h4>Ini Tempat Iklan!</h4>
                    <p>tempat iklan disini</p>
                  </div>
                </div>

              <div class="row">
                  
                  <div class="col-md-9">
                  	<div class="row">	
						<h1 class="text-red text-center"><span><?php echo $heading; ?></span></h1>
					</div>
                    	<?php foreach ($semua_artikel as $key => $artikel) {
                  echo"<div class='box box-solid' style='padding:15px'>";
	              echo"<div class='box-body'>";
					echo"<div class='row'>";
						echo"<div class='col-md-5'>";
							echo "<img  class='img-responsive' src='".img_artikel_url($artikel['foto'])."' alt='$artikel[judul]' />";
						echo"</div>";

						echo"<div class='col-md-7'>";
							echo "<a href='".artikel_url($artikel['id'],$artikel['slug'])."'><h2 class='judul no-margin text-red'>$artikel[judul]</h2></a><br>";
							echo "<div class='info'>";
							echo "<span class='tanggal'> <i class='fa fa-calendar'></i>&nbsp; ".format_tanggal($artikel['tanggal'])."</span> 
								  <span class='author'> <i class='fa fa-user'></i>&nbsp; $artikel[nama_admin]</span> 
								  <span class='dibaca'> <i class='fa fa-eye'></i>&nbsp; Dibaca $artikel[dibaca] kali </span>";

							foreach (ambil_tag($artikel['tags']) as  $tag) {
	 						echo "<span class=''><a href='".tag_url($tag['id_tag'],$tag['slug_tag'])."' style='color:#000;'>
	 						<i class='fa fa-tags'></i> $tag[nama_tag]</a></span>";
							}
							echo "</div><br>";
							echo strip_tags(word_limiter($artikel['isi'],45));
						echo"</div>";
					echo"</div>";



					echo "</div>";
					echo "</div>";


					} ?>

					<div style='width:100%;text-align: center'>
					  <?php echo $pagination; ?>

					</div>
                  
                  
                  </div><!-- /.col -->

                  <div class="col-md-3">
                  <?php

					echo"<br/><br/><br/>";

					echo"<h3>TERPOPULER</h3>";
                      foreach ($artikel_populer as $value) { echo "
                        <div class='box box-widget'>
                          <div class='col-md-12 no-padding'>
                            <img class='img-responsive' style='max-height:195px; height:100%; width:100%' src='".img_artikel_url($value['foto'])."' alt='$value[judul]'>
                          </div>
                          <div class='box-footer'>
                            <div class='row'>
                              <div class='col-sm-12'>
                                <h3 class='title'>
                                <a style='color:#333' href='".artikel_url($value['id'],$value['slug'])."'>$value[judul].</a>
                                </h3>
                              </div><!-- /.col -->
                              <div class='col-sm-12'>
                              <div class='row'>
                                <div class='col-sm-6'>
                                  <h5><i class='fa fa-user'></i>&nbsp; <a style='color:#444' href='".user_url($value['id_admin'],$value['username'])."'><strong>".($value['nama_admin'])."</strong></a></h5>
                                </div>
                                <div class='col-sm-6'>
                                  <h5 class='description pull-right'>".format_tanggal($value['tanggal'])."</h5>
                                </div>
                              </div>
                              </div><!-- /.col -->
                            </div><!-- /.row -->
                          </div>
                        </div>
                      "; }?>

						<div class="box box-widget">
            <div class='box box-body'>
            <h4><span>Tags</span></h4>
            <?php
            foreach ($tags as $tag) {
              echo "<div class='btn no-padding'><a class='label label-danger' href='".tag_url($tag['id'],$tag['slug'])."'>$tag[nama]</a>&nbsp</div>";
            }?>
            </div>
            </div>
            </div> 
            </div> 


            </div>
            </div>
            </div><!-- /.col -->
                    

            </div><!-- /.row -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
     
  