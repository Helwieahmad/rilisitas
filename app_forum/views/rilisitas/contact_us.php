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
                  <div class="col-md-12">
                    <h2><center>Hubungi Kami</center></h2><hr>
                  </div>
              </div>
              <div class="row">                  
                  <div class="col-md-6">
                  <div class="box box-danger">
                  <div class="box-body">
                            <div class="box-header with-border">
                              <div class="user-block">
                                <h3 class="box-title">Kirim Pesan</h3>
                              </div><!-- /.user-block -->
                              <div class="box-tools">
                                <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                              </div><!-- /.box-tools -->
                            </div>
                            <form method='POST' class='form-horizontal' id='pesan' action='<?php echo baseURL('form_visitors/contact'); ?>' style='margin-top: 10px;' autocomplete='off' >                            
                            <div class='form-group'>
                            <label class="col-sm-2 control-label" for="inputName">Nama</label>
                            <div class='col-sm-10'>
                             <input type='text' class='form-control' required='required' placeholder='Nama' name='nama' />
                             <input type='hidden' class='form-control' name='url' value='<?php echo current_url() ?>' />
                            </div>
                            </div>

                             <div class='form-group'>
                             <label class="col-sm-2 control-label" for="InputEmail1">Email</label>     
                             <div class="col-sm-10">
                             <input type='email' class='form-control' placeholder='Email' required='required' name='email' />
                             </div>
                             </div>

                            <div class='form-group'>
                            <label class="col-sm-2 control-label" for="InputNoTelephone">No Telepon</label>
                            <div class="col-sm-10">
                            <input type="number" min='8' max='13' class='form-control' placeholder='(Optional)' name='phone' />
                            </div>
                            </div>

                            <div class='form-group'>
                            <label class="col-sm-2 control-label" for='inputpesan'>Pesan</label>
                            <div class="col-sm-10">
                            <textarea class='form-control' placeholder='Pesan' required='required' name='pesan' style='height: 100px !important;'></textarea>
                            </div>
                            </div>
                            <div class='form-group'>
                            <label class="col-sm-2 control-label" for="inputcaptcha"></label>
                            <div class="col-sm-10">
                            <div id='recaptcha1'></div>
                            </div>
                            </div>
                            <div class="box-footer">
                              <button class="btn btn-danger pull-right" id="submit" type="submit">Kirim</button>
                              <div class="cssload-container" style="display: none; width: 100px">
                              <div class="cssload-tube-tunnel"></div>
                                </div>
                            </div>
                            </form>
                  </div>
                  </div> 
                  </div><!-- /.col -->

                  <div class="col-md-6">
                      <div class="box box-info">
                      <div class="box-body">
                        <div class="box-header with-border">
                        <div class="user-block">
                        <h3 class="box-title">Tentang Kami</h3>
                        </div><!-- /.user-block -->
                        <div class="box-tools">
                        <button data-widget="collapse" class="btn btn-box-tool"><i class="fa fa-minus"></i></button>
                        </div><!-- /.box-tools -->
                      </div><br>
                    <!-- The timeline -->
                    <ul class="timeline timeline-inverse">
                      <!-- timeline time label -->
                      <li class="time-label">
                        <span class="bg-red">
                          Tentang Kami
                        </span>
                      </li>
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-users bg-red"></i>
                        <div class="timeline-item">
                          <h3 class="timeline-header text-red"><strong>Sekilas Tentang Kami</strong></h3>
                          <div class="timeline-body">
                           <?php echo $informasi["deskripsi"]; ?> 
                          </div>
                          <div class="timeline-footer">
                      <a class="btn btn-social-icon btn-facebook" href="https://www.facebook.com/rilisonline"><i class="fa fa-facebook"></i></a>
                      <a class="btn btn-social-icon btn-twitter" href="https://twitter.com/RilisOnline"><i class="fa fa-twitter"></i></a>
                    </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-home bg-blue"></i>
                        <div class="timeline-item">
                          <h3 class="timeline-header"><span class='text-blue'><strong>Redaksi Kami </strong></span> &nbsp Graha Rilis, Jl. Pejaten Raya No. 33 Jakarta Selatan 12540</h3>
                          
                        </div>
                      </li>
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-phone bg-green"></i>
                        <div class="timeline-item">
                          <h3 class="timeline-header"><span class='text-green'><strong>Telepon Kami </strong></span>&nbsp <i>78837682. Faks. 78837665. Hotline/WA. 081288122284</i></h3>
                        </div>
                      </li>
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-envelope bg-yellow"></i>
                        <div class="timeline-item">
                          <h3 class="timeline-header"><span class='text-yellow'><strong>Email Kami </strong></span>&nbsp redaksi@rilis.id</h3>
                        </div>
                      </li>
                      <li class="time-label">
                        <span class="bg-maroon">
                          Lain-Lain
                        </span>
                      </li>
                      <li>
                        <i class="fa fa-warning bg-aqua"></i>
                        <div class="timeline-item">
                          <h3 class="timeline-header text-aqua"><strong>Disclaimer</strong></h3>
                          <div class="timeline-body">
                           <?php echo $informasi["disclaimer"]; ?> 
                          </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-cogs bg-orange"></i>
                        <div class="timeline-item">
                          <h3 class="timeline-header text-orange"><strong>Syarat & Ketentuan</strong></h3>
                          <div class="timeline-body">
                            <?php echo $informasi["terms_conditions"]; ?> 
                          </div>
                        </div>
                      </li>
                      <!-- END timeline item -->
                      <!-- timeline time label -->
                      <li>
                        <i class="fa fa-lock bg-purple"></i>
                        <div class="timeline-item">
                          <h3 class="timeline-header text-purple"><strong>Kebijakan Privacy</strong></h3>
                          <div class="timeline-body">
                            <?php echo $informasi["privacy"]; ?> 
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                  </div>
                  </div>
                  </div><!-- /.col -->
                    

            </div><!-- /.row -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
     
