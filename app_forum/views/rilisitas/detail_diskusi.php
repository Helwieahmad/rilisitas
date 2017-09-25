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
                  <div class="box box-solid" style="padding:30px">
                    <div class="box-body">

                      <div itemscope style="margin-bottom: 10px;">
                        <meta itemscope itemprop="mainEntityOfPage" itemid="<?php echo current_url(); ?>" >
                          <?php 

                            echo "<h1 itemprop='headline'>$diskusi[judul]</h1>";

                          ?>

                        <div class='info'>
                          <meta itemprop="dateModified" content="<?php if($diskusi['tanggal_edit']=='0000-00-00 00:00:00'){
                            echo cuma_tanggal($diskusi['tanggal']);
                            } else {
                            echo cuma_tanggal($diskusi['tanggal_edit']);
                            }
                            ?>"/><hr>
                            <?php 
                            echo "<span class='margin' itemprop='datePublished' content='".cuma_tanggal($diskusi['tanggal'])."'> 
                                    <i class='fa fa-user'></i> 
                                    <span class='margin' itemprop='author' itemscope itemtype='http://schema.org/Person' itemprop='name' class='author'><a class='text-black' href='".user_url($diskusi['id_admin'],$diskusi['username'])."'><strong>".($diskusi['nama_admin'])."</strong></a></span> 
                                    
                                    <i class='fa fa-calendar'></i>&nbsp; ".format_tanggal($diskusi['tanggal'])."</span>
                                    </span>
                                    <span class='margin'> <i class='fa fa-eye'></i>&nbsp; Dibaca $diskusi[dibaca] kali </span>";
                                    foreach (ambil_tag($diskusi['tags']) as  $tag) {
                                    echo "&nbsp<span><small class='label bg-red'><a href='".tag_url($tag['id_tag'],$tag['slug_tag'])."' style='color:#fff;'><i class='fa fa-tags'></i> $tag[nama_tag]</a></small></span>";
                                    }
                            ?>
                            <hr>
                        </div>
                      </div><br>

                      <span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                      <center><img  class="img-responsive pad" src="<?php echo img_diskusi_url($diskusi['foto']); ?>" alt='$diskusi[judul]' /></center>
                        <meta itemprop="url" content="<?php echo img_diskusi_url($diskusi['foto']); ?>">
                        <meta itemprop="width" content="1000">
                        <meta itemprop="height" content="600">
                      </span>

                      <div itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                        <div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                          <meta itemprop="url" content="http://www.sandro.id/an-component/media/upload-gambar-pendukung/Rilisitas.jpg">
                          <meta itemprop="width" content="286">
                          <meta itemprop="height" content="82">
                        </div>
                        <meta itemprop="name" content="Rilisitas">
                      </div><br>

                      <div  itemprop="articleBody" style="color: #555;font-size: 1.5em;line-height: 1.9em;">
                        <?php 
                        echo set_tag($diskusi['isi']);
                         ?>
                      </div>

                    </div>
                    
                  </div>
                  <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#setuju" aria-expanded="true"><i class="fa fa-thumbs-o-up text-red"></i><span class='text-red'>&nbsp Setuju &nbsp <small class="label pull-right bg-red">
                  <?php echo $hitung_setuju ?></small></span></a></li>
                  <li class=""><a data-toggle="tab" href="#tidak-setuju" aria-expanded="false"><i class="fa fa-thumbs-o-down text-red"></i><span class='text-red'> Tidak Setuju &nbsp <small class="label pull-right bg-red">
                  <?php echo $hitung_tidak_setuju ?></small></span></a></li>
                  <li class=""><a data-toggle="tab" href="#netral" aria-expanded="false"><i class="fa fa-arrows-h text-red"></i><span class='text-red'> Netral &nbsp <small class="label pull-right bg-red">
                  <?php echo $hitung_netral?></small></span></a></li>
                </ul>
                <div class="tab-content">
                  <div id="setuju" class="tab-pane active">
                    <?php
                     foreach ($setuju AS $value) {
                      echo "<div class='box-body'>
                      <div class='row'>
                          <div class='col-md-3'>
                            <div class='box-profile'>"; ?>
                              <img alt='user image' style='margin-top:10px;height:75px; width:75px;' class='profile-user-img img-responsive img-circle' src='<?php echo img_user_url('user.png'); ?>'>
                              <?php echo"
                              <h4><center>$value[nama]</center</h4>
                            </div>
                          </div>
                          <div class='col-md-9'>
                              <div class='callout callout-danger lead'><span class='pull-right'><h5>".format_tanggal($value['tanggal'])."</h5></span><br>
                               <p>$value[pesan]</p>
                              </div>
                          </div>
                      </div>
                    </div><hr>";
                    }?>
                    
                  </div><!-- /.tab-pane -->
                  <div id="tidak-setuju" class="tab-pane">
                    <?php
                    foreach ($tidak_setuju AS $value) {
                      echo "<div class='box box-body no-border'>
                      <div class='row'>
                          <div class='col-md-3'>
                            <div class='box-profile'>"; ?>
                              <img alt='user image' style='margin-top:10px;height:75px; width:75px;' class='profile-user-img img-responsive img-circle' src='<?php echo img_user_url('user.png'); ?>'>
                              <?php echo"
                              <h4><center>$value[nama]</center</h4>
                            </div>
                          </div>
                          <div class='col-md-9'>
                              <div class='callout callout-danger lead'><span class='pull-right'><h5>".format_tanggal($value['tanggal'])."</h5></span><br>
                               <p>$value[pesan]</p>
                              </div>
                          </div>
                      </div>
                    </div>";}?>
                  </div><!-- /.tab-pane -->
                  <div id="netral" class="tab-pane">
                    <?php
                    foreach ($netral AS $value) {
                      echo "<div class='box box-body no-border'>
                      <div class='row'>
                          <div class='col-md-3'>
                            <div class='box-profile'>"; ?>
                              <img alt='user image' style='margin-top:10px;height:75px; width:75px;' class='profile-user-img img-responsive img-circle' src='<?php echo img_user_url('user.png'); ?>'>
                              <?php echo"
                              <h4><center>$value[nama]</center</h4>
                            </div>
                          </div>
                          <div class='col-md-9'>
                              <div class='callout callout-danger lead'><span class='pull-right'><h5>".format_tanggal($value['tanggal'])."</h5></span><br>
                               <p>$value[pesan]</p>
                              </div>
                          </div>
                      </div>
                    </div>";
                    }?>
                  </div><!-- /.tab-pane -->

                  
                </div><!-- /.tab-content -->
              </div>

                  <div class="box box-danger">
                  <div class="box-header with-border">
                  <div class="user-block">
                    <h3 class="no-margin">Tinggalkan Komentar</h3>
                  </div><!-- /.user-block -->
                  <div class="box-tools">
                    <button data-widget="collapse" class="btn btn-danger btn-sm"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div>
                    <div class="box-body">
                          <form method='POST' id='pesan' action='<?php echo baseURL('form_visitors/komentar'); ?>' autocomplete='off' class="form-horizontal">
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputName">Nama</label>
                        <div class="col-sm-10">
                          <input type="hidden" name="diskusi_id" value="<?php echo $diskusi['id'];?>">
                          <input type="text" placeholder="Nama" maxlength="50" data-original-title="Masukkan Nama" required='required' name="nama" id="inputName" class="form-control">                          
                          <input type='hidden' class='form-control' name='url' value='<?php echo current_url() ?>' />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputEmail">Email</label>
                        <div class="col-sm-10">
                          <input type="email" name="email" maxlength="85" data-original-title="Masukkan Email" placeholder="Email" required='required' id="inputEmail" class="form-control">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-10">
                            <div class="checkbox">
                            <label>
                            <input type="radio" name="pilih" value="1"> <i class="fa fa-thumbs-o-up margin-r-5 text-red"> <b>Setuju</b></i>
                            </label>
                            <label>
                              <input type="radio" name="pilih" value="3"> <i class="fa fa-thumbs-o-down margin-r-5 text-red"> <b>Tidak Setuju</b></i>
                             </label>
                            <label>
                              <input type="radio" name="pilih" value="2"> <i class="fa fa-square margin-r-5 text-red"> <b>Netral</b></i>  
                            </label>
                            </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="inputExperience">Komentar</label>
                        <div class="col-sm-10">
                          <textarea placeholder="Komentar" name="pesan" id="inputExperience" required='required' class="form-control"></textarea>
                        </div>
                      </div>
                      <div class='form-group'>
                      <label class="col-sm-2 control-label" for="inputExperience"></label>
                        <div class="col-sm-10">
                        <div id='recaptcha1'></div>
                      </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button class="btn btn-danger" type="submit" id="submit">Submit</button>
                          <div class="cssload" style="display: none; width: 100px">
                          <div class="cssload-tube-tunnel"></div>
                          </div>
                        </div>
                      </div>
                    </form>
                    </div>
                  </div>
          </div><!-- /.col -->

                  <div class="col-md-3">

                      <h3>DISKUSI POPULER</h3>
                      <?php
                      foreach ($diskusi_populer as $value) { echo "
                        <div class='box box-widget'>
                          <div class='col-md-12 no-padding'>
                            <img class='img-responsive' style='max-height:195px; height:100%; width:100%' src='".img_diskusi_url($value['foto'])."' alt='$value[judul]'>
                          </div>
                          <div class='box-footer'>
                            <div class='row'>
                              <div class='col-sm-12'>
                                <h3 class='title'>
                                <a style='color:#333' href='".diskusi_url($value['id'],$value['slug'])."'>$value[judul].</a>
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
                  </div><!-- /.col -->
                    

            </div><!-- /.row -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
     
  