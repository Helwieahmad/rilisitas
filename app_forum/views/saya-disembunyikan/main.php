<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

     <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Selamat datang
            <small>Di Halaman administrator</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $burl; ?>/"><i class="fa fa-dashboard"></i> Halaman Utama</a></li>
           
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

         

<div class="row">
            
                <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-yellow"><i class="fa fa-image"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Gambar Artikel </span>
          <span class="info-box-number"><?php echo $data['jumlah_gambar_artikel']; ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-image"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Gambar Diskusi</span>
          <span class="info-box-number"><?php echo $data['jumlah_gambar_diskusi']; ?></span></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-navicon"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Kategori Artikel</span>
          <span class="info-box-number"><?php echo $data['jumlah_kategori_artikel']; ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-tags"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Tags</span>
          <span class="info-box-number"><?php echo $data['jumlah_tags']; ?></span>
        </div><!-- /.info-box-content -->
      </div><!-- /.info-box -->
    </div><!-- /.col -->


          </div>





  <div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
      <div class="box box-info">
        <div class="box-header with-border">
          Artikel Terbaru
        </div>
        <div class="box-body">
          <table class="table table-striped">
            <?php 

            foreach ($data["artikel_terbaru"] as $artikel ) {
               $label=$artikel['artikel_status']=='draft'?"label-warning":"label-primary";
               echo "<tr><td style='font-family: \"Source Sans Pro\" ;'><a style='color:#00c0ef; ' href='".base_url("saya-disembunyikan/artikel/$artikel[artikel_id]")."'><strong>".character_limiter($artikel['artikel_judul'],55)."</a>

               <span class='label pull-right $label'>$artikel[artikel_status]</span>

               </td></tr>";
            }

             ?>
          </table>
        </div>
        <div class="box-footer"></div>
      </div>
    </div>

  <div class="col-md-6 col-sm-12 col-xs-12">
      <div class="box box-danger">
        <div class="box-header with-border">
          artikel Terpopuler
        </div>
        <div class="box-body">
          <table class="table table-striped">
            <?php 

            foreach ($data["hit_artikel"] as $artikel ) {
               $label=$artikel['artikel_status']=='draft'?"label-warning":"label-danger";
               echo "<tr><td style='font-family: \"Source Sans Pro\" ;'><a style='color:blue; ' href='".base_url("saya-disembunyikan/artikel/$artikel[artikel_id]")."'>".character_limiter($artikel['artikel_judul'],55)."</a> 
               <span class='badge badge-info bg-green pull-right'>$artikel[artikel_dibaca]x</span>

               </td></tr>";
            }

             ?>
          </table>
        </div>
        <div class="box-footer"></div>
      </div>
    </div>

    


<div class="row">
    <div class="col-md-8 col-sm-12 col-xs-12">

            <div class="col-md-6 col-sm-6 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $data['jumlah_artikel']; ?></h3>
                  <p>Artikel Tersimpan</p>
                </div>
                <div class="icon">
                  <i class="ion ion-edit"></i>
                </div>
                <a href="<?php echo base_url('saya-disembunyikan/all_artikel') ?>" class="small-box-footer">Seluruh Artikel <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-md-6 col-sm-6 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3><?php echo $data['jumlah_diskusi']; ?></h3>
                  <p>Diskusi Tersimpan</p>
                </div>
                <div class="icon">
                  <i class="ion-ios-book"></i>
                </div>
                <a class="small-box-footer" href="<?php echo base_url('saya-disembunyikan/all_diskusi') ?>">Tinjau Diskusi <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-maroon">
                <div class="inner">
                  <h3><?php echo $data['jumlah_komentar']; ?></h3>
                  <p>Komentar Tersimpan</p>
                </div>
                <div class="icon">
                  <i class="ion-ios-chatboxes"></i>
                </div>
                <a href="<?php echo base_url('saya-disembunyikan/all_komentar') ?>" class="small-box-footer">Menejemen Komentar <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-md-6 col-sm-6 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-primary">
                <div class="inner">
                  <h3><?php echo $data['jumlah_user']; ?></h3>
                  <p>User Terdaftar</p>
                </div>
                <div class="icon">
                  <i class="ion-android-contacts"></i>
                </div>
                <a href="<?php echo base_url('saya-disembunyikan/all_user') ?>" class="small-box-footer">Daftar User <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-md-6 col-sm-6 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $data['jumlah_halaman']; ?></h3>
                  <p>Halaman</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-browsers"></i>
                </div>
                <a href="<?php echo base_url('saya-disembunyikan/all_page') ?>" class="small-box-footer">Menuju Halaman <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-md-6 col-sm-6 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3><?php echo $data['jumlah_inbox']; ?></h3>
                  <p>Pesan belum dibaca</p>
                </div>
                <div class="icon">
                  <i class="ion ion-email-unread"></i>
                </div>
                <a href="<?php echo base_url('saya-disembunyikan/kontak_masuk') ?>" class="small-box-footer">Kotak Masuk <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
    </div>
    <div class="col-md-4 col-sm-12 col-xs-12">
        <div class="box box-danger">
          <div class="box-header with-border">
            Seluruh Artikel
          </div>
          <div class="box-body">
          <center>
       <canvas id="chart-area" height="300" width="300"></canvas>
          </center>
          </div>
          <div class="box-footer"></div>
        </div>
    </div> 
  </div>
</div>

  

  <div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
      <div class="box box-info">
        <div class="box-header with-border">
          Diskusi Terbaru
        </div>
        <div class="box-body">
          <table class="table table-striped">
            <?php 

            foreach ($data["diskusi_terbaru"] as $diskusi ) {
               $label=$diskusi['diskusi_status']=='draft'?"label-warning":"label-primary";
               echo "<tr><td style='font-family: \"Source Sans Pro\" ;'><a style='color:#00c0ef; ' href='".base_url("saya-disembunyikan/diskusi/$diskusi[diskusi_id]")."'>".character_limiter($diskusi['diskusi_judul'],55)."</a>

               <span class='label pull-right $label'>$diskusi[diskusi_status]</span>

               </td></tr>";
            }

             ?>
          </table>
        </div>
        <div class="box-footer"></div>
      </div>
    </div>

    <div class="col-md-6 col-sm-12 col-xs-12">
      <div class="box box-danger">
        <div class="box-header with-border">
          diskusi Terpopuler
        </div>
        <div class="box-body">
          <table class="table table-striped">
            <?php 

            foreach ($data["hit_diskusi"] as $diskusi ) {
               $label=$diskusi['diskusi_status']=='draft'?"label-warning":"label-danger";
               echo "<tr><td style='font-family: \"Source Sans Pro\" ;'><a style='color:blue; ' href='".base_url("saya-disembunyikan/diskusi/$diskusi[diskusi_id]")."'>".character_limiter($diskusi['diskusi_judul'],55)."</a> 
               <span class='badge badge-info bg-green pull-right'>$diskusi[diskusi_dibaca]x</span>

               </td></tr>";
            }

             ?>
          </table>
        </div>
        <div class="box-footer"></div>
      </div>
    </div>  
  </div>


        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

   