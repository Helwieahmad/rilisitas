<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- Full Width Column -->
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

              <div class="col-lg-6 col-md-8 col-sm-12">
              <h4 class="title">TERKINI</h4>
              <?php foreach ($artikel_headline as $key => $value) {
              echo "<div class='box box-solid no-margin no-padding'>
                      <div class='box-body'>
                          <div class='row'>
                              <div class='col-lg-5 col-md-12'>
                                <center><img class='img-responsive pad' src='".img_artikel_url($value['foto'])."' alt='$value[judul]'>
                              </center></div>
                              <div class='col-lg-7 col-md-12'>
                                <a class='text-black' style='font-weight:400;font-size: 1.7em;' href='".artikel_url($value['id'],$value['slug'])."'><span> ".($value['judul'])."</span></a>
                                <div class='box-body'>
                                    <div class='user-block'>
                                      <img class='img-circle img-bordered-md' src='".img_user_url($value['foto_user'])."' alt='$value[judul]'>
                                      <span class='username'><a class='text-black' href='".user_url($value['id_admin'],$value['username'])."'>".($value['nama_admin'])."</a></span>
                                      <span class='description'>Publish &nbsp; ".format_tanggal($value['tanggal'])."</span>
                                    </div><!-- /.user-block -->
                                </div>
                              </div>
                          </div><hr>
                      </div>
                    </div><!-- /.box -->"; }?>
            </div><!-- /.col -->
              <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                  <h4 class="title text-center">RILISER TERBARU</h4>
                  <!-- Profile Image -->
                  <div class="box box-solid">
                <div class="box-body">
                  <ul class="products-list product-list-in-box">
                    <?php
                    foreach ($list_riliser as $key => $value) {
                    echo "<li class='item'>
                      <div class='product-img'>
                        <img class='profile-user-img img-circle img-bordered-md' src='".img_user_url($value['foto_user'])."' alt='$value[nama]'>
                      </div>
                      <div class='product-info'>
                        <a class='text-black' href='".user_url($value['id'],$value['username'])."'><h4>".($value['nama'])."</h4></a>
                        &nbsp;<span class='text-red'> ".format_tanggal($value['tanggal'])."</span>
                      </div>
                    </li><!-- /.item -->
                    ";} ?>
                  </ul>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
              </div>

              <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
              <h4>TERPOPULER</h4>
                  <div class="box box-solid">
                    <div class="box-body">
                      <ul class="products-list product-list-in-box">
                      <?php
                       foreach ($artikel_populer as $val) {
                        echo "
                        <li class='item'>
                          <div class='product-img'>
                            <img src='".img_artikel_url($val['foto'],true)."' alt='$val[judul]'>
                          </div>
                          <div class='product-info'>
                              <a href='".artikel_url($val['id'],$val['slug'])."'><p class='text-black'>$val[judul]</p>
                          
                            <span class='product-description'>
                               <span><a style='color:#999' href='".user_url($val['id_admin'],$val['username'])."'><i class='fa fa-user text-red'></i>&nbsp;&nbsp;".($val['nama_admin'])."</a></span>
                            </span> 
                            
                          </div>
                        </li><!-- /.item -->
                        "; } ?>
                      </ul>
                    </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <h4>PILIHAN EDITOR</h4>
                        <div class="box box-solid">
                          <div class="box-body">
                            <ul class="products-list product-list-in-box">
                            <?php
                             foreach ($pilihan_editor as $val) {
                              echo "
                              <li class='item'>
                                <div class='product-img'>
                                  <img src='".img_artikel_url($val['foto'],true)."' alt='$val[judul]'>
                                </div>
                                <div class='product-info'>
                                    <a href='".artikel_url($val['id'],$val['slug'])."'><p class='text-black'>$val[judul]</p>
                                
                                  <span class='product-description'>
                                      <span><a class='text-red pull-right' href='".user_url($val['id_admin'],$val['username'])."'>".($val['nama_admin'])."</a></span> 
                                  </span> 
                                  
                                </div>
                              </li><!-- /.item -->
                              "; } ?>
                            </ul>
                          </div><!-- /.box-body -->
                        </div><!-- /.box -->
                      </div><!-- /.col -->

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <div class="box box-danger">
                    <div class="box-header with-border">
                      <h5 class="box-title">Riliser</h5>
                      <div class="box-tools">
                          <div class="has-feedback">
                            <select class='chosen-select' style="width:220px;" onchange="top.location.href = '<?php echo baseURL();?>riliser/'+ this.options[ this.selectedIndex ].value">
                            <option value="">Cari Riliser...</option>
                            <?php foreach ($get_riliser as $riliser) {
                            echo "<option value='$riliser[nomor_user]-$riliser[username]'>$riliser[nama_panjang]</a></option>
                            ";}?>
                            <option></option>
                            </select>
                          </div>
                      </div>
                    </div><!-- /.box-header -->
                    <div class="box-body no-padding">
                      <ul class="users-list clearfix">
                      <?php
                    foreach ($user_riliser as $value) {
                    echo "<li class='item'>
                      <div class='product-img'>
                        <a class='text-red pull-right' href='".user_url($value['id'],$value['username'])."'><img class='img-circle img-bordered-md' style='height:55px; Width:55px' src='".img_user_url($value['foto_user'])."' alt='$value[nama]'></a>
                      </div>
                      <div class='product-info'>
                        <a class='text-black' href='".user_url($value['id'],$value['username'])."'><h5>".potong_nama($value['nama'])."</h5></a>
                      </div>
                    </li><!-- /.item -->
                    ";} ?>
                      
                      </ul><!-- /.users-list -->
                    </div><!-- /.box-body -->
                    <div class="box-footer text-center">
                    </div><!-- /.box-footer -->
                  </div><!--/.box -->

                </div><!-- /.col -->
                

            </div><!-- /.row -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
