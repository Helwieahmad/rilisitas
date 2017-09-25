<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Full Width Column -->
      <div class='content-wrapper' style='margin-top:50px; padding:0 20px'>
        <div class='fluid-container'>

          <!-- Main content -->
          <section class='content'>
                <div class='col-md-10 col-md-offset-1'>
                  <div class='callout callout-danger'>
                    <h4>Ini Tempat Iklan!</h4>
                    <p>tempat iklan disini</p>
                  </div>
                </div>
          <div class='row'>
          <div class="col-md-4">
                <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-red">
                  <div class='row'>
                    <div class='col-sm-12'>
                  <div class="widget-user-image"><br>
                    <?php echo"
                    <center><img src='".img_user_url($riliser['foto_user'])."' alt='$riliser[nama_user]' style='height:125px; width:125px;' class='profile-user-img img-responsive img-circle'></center>
                    ";?>
                    </div><br>
                    <div class='col-sm-12'>
                  <h3 class="widget-user-username no-margin"><center><?php echo $riliser['nama_user'];?></center></h3><br>
                  <h5 class="widget-user-desc no-margin"><center>About Riliser</center></h5>
                  </div>
                  </div>
                  </div>
                </div>
                <div class="box-footer no-padding">
                  <ul class="nav nav-stacked">
                   <?php echo"
                    <li><a>Bergabung <span class='pull-right badge bg-red'>".format_tanggal($riliser['bergabung'])."</span></a></li>
                    <li><a>Publish Artikel <span class='pull-right badge bg-red'>";?><?php echo $hitung_artikel_riliser?><?php echo"</span></a></li>
                    ";?>
                  </ul>
                </div>
              </div>
          </div>
            <div class='col-md-8 no-padding'>
                      
                      <?php
                      foreach ($Semua_riliser as $value) { echo "
                      <div class='col-sm-6'>
                        <div class='box box-widget' style='height:335px'>
                          <div class='col-md-12 no-padding'>
                            <img class='img-responsive' style='max-height:225px; height:100%; width:100%' src='".img_artikel_url($value['foto'])."' alt='$value[judul]'>
                          </div>
                          <div class='box-footer'>
                            <div class='row'>
                              <div class='col-sm-12'>
                                <h3 class='title'>
                                <a style='color:#333' href='".artikel_url($value['id'],$value['slug'])."'>$value[judul].</a>
                                </h3>
                              </div><!-- /.col -->
                              <div class='col-sm-12'>
                                <span class='description pull-right'>".format_tanggal($value['tanggal'])."</span>
                              </div><!-- /.col -->
                            </div><!-- /.row -->
                          </div>
                        </div>
                      </div><!-- /.col -->
                      "; }?>
            </div><!-- /.col -->
          </div><!-- /.row -->
          </section>
        </div>
      </div>