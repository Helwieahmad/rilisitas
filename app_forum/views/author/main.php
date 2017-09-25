<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

     <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Selamat datang
            <small>Di Halaman Riliser</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $burl; ?>/"><i class="fa fa-dashboard"></i> Halaman Utama</a></li>
           
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-lg-4 col-xs-6">
             <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $data['jumlah_artikel']; ?> Artikel</h3>
                  <p>Tersimpan di Sistem Kami</p>
                </div>
                <div class="icon">
                  <i class="ion ion-edit"></i>
                </div>
                <a href="<?php echo base_url('author/artikel') ?>" class="small-box-footer">klik untuk mulai menulis <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>Profil</h3>
                  <p>Nama, Email, foto dll</p>
                </div>
                <div class="icon">
                  <i class="ion-android-person"></i>
                </div>
                <a href="<?php echo base_url('author/edit_profil') ?>" class="small-box-footer">Klik Untuk Mengedit Profil <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-4 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>Artikelku</h3>
                  <p>Seluruh Artikel Yang Pernah Anda Tulis</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-browsers"></i>
                </div>
                <a class="small-box-footer" href="<?php echo base_url('author/all_artikel') ?>">Klik disini untuk melihat <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>

          </div>

        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="box box-info">
                <div class="box-header with-border text-center">
                  Seluruh Judul Artikel Dari Seluruh Riliser, Mungkin Bisa Menjadi Referensi Bagi Anda
                </div>
                <div class="box-body">

                  <table class="table table-condensed">
                    <?php 

                    foreach ($data["artikel_terbaru"] as $artikel ) {
                       $label=$artikel['artikel_status']=='draft'?"label-warning":"label-primary";
                       echo "<tr><td style='font-family: \"Source Sans Pro\" ;'><a style='color:#337ab7; '><strong>".character_limiter($artikel['artikel_judul'],75)."</strong></a>

                       </td></tr>";
                    }

                     ?>
                  </table>
                </div>
                <div class="box-footer"></div>
              </div>
            </div>
                    


            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="box text-green">
                <div class="box-header with-border text-center">
                  Artikel Populer Saat Ini Yang Sering Dibaca Oleh Pengunjung. Mungkin BIsa Menginspirasi Tulisan Anda.
                </div>
                <div class="box-body">
                  <table class="table table-striped">
                    <?php 

                    foreach ($data["hit_artikel"] as $artikel ) {
                       $label=$artikel['artikel_status']=='draft'?"label-warning":"label-info";
                       echo "<tr><td style='font-family: \"Source Sans Pro\" ;'><a style='color:#00a65a ;'>".character_limiter($artikel['artikel_judul'],70)."</a> 
                       <span class='label pull-right $label'>$artikel[artikel_dibaca]x</span>

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

   