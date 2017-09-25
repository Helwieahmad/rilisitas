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
              
                <section class="content">

          <div class="row">
            <div class="col-md-4">
            </div>

            <div class="col-md-8">
            		
            		<div class="box box-solid" style="padding:30px;">
            			<div class="box-body">
							<div itemscope itemtype="http://schema.org/NewsArticle" style="margin-bottom: 10px;">
                        <meta itemscope itemprop="mainEntityOfPage" itemid="<?php echo current_url(); ?>" >
                          <?php 

                            echo "<h1 itemprop='headline'>$page[judul]</h1><hr><br>";

                          ?>

                        <div class='info'>
                          
                      	</div>
                      	<br>

                      <span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                      <center><?php if($page["foto"]!=""){
				echo "<img class='img-responsive' alt='$page[judul]' src='$page[foto]' />";
			} 
			?></center>
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

                      <div style="color: #555;font-size: 1.5em;line-height: 1.9em;">
                        <?php 
                        echo set_tag($page['isi']);
                         ?>
                      </div>

            </div><!-- /.col -->
          

          </div><!-- /.row -->

        </section>

          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
     
  