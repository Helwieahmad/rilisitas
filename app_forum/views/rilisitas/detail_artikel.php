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

                      <div itemscope itemtype="http://schema.org/NewsArticle" class='artikel' style="margin-bottom: 10px;">
                        <meta itemscope itemprop="mainEntityOfPage" itemid="<?php echo current_url(); ?>" >
                          <?php 

                            echo "<h1 itemprop='headline'>$artikel[judul]</h1>";

                          ?>

                        <div class='info'>
                          <meta itemprop="dateModified" content="<?php if($artikel['tanggal_edit']=='0000-00-00 00:00:00'){
                            echo cuma_tanggal($artikel['tanggal']);
                            } else {
                            echo cuma_tanggal($artikel['tanggal_edit']);
                            }
                            ?>"/><hr>
                            <?php 
                            echo "<span class='margin'  itemprop='datePublished' content='".cuma_tanggal($artikel['tanggal'])."'> 
                                    <i class='fa fa-user'></i>
                                    <span itemprop='author' itemscope itemtype='http://schema.org/Person' itemprop='name' class='margin'><a class='text-black' href='".user_url($artikel['id_admin'],$artikel['username'])."'><strong>".($artikel['nama_admin'])."</strong></a></span> 
                                    
                                    &nbsp<i class='fa fa-calendar'></i>&nbsp ".format_tanggal($artikel['tanggal'])."</span>
                                    </span>
                                    &nbsp<span class='margin'> <i class='fa fa-eye'></i>&nbsp Dibaca $artikel[dibaca] kali </span>";
                                    foreach (ambil_tag($artikel['tags']) as  $tag) {
                                    echo "&nbsp<span><small class='label bg-red'><a href='".tag_url($tag['id_tag'],$tag['slug_tag'])."' style='color:#fff;'><i class='fa fa-tags'></i> $tag[nama_tag]</a></small></span>";
                                    }
                            ?>
                            <hr>
                        </div>
                      </div><br>

                      <span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                      <center><img  class="img-responsive pad" src="<?php echo img_artikel_url($artikel['foto']); ?>" alt='$artikel[judul]' /></center>
                        <meta itemprop="url" content="<?php echo img_artikel_url($artikel['foto']); ?>">
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
                        echo set_tag($artikel['isi']);
                         ?>
                      </div>

                      <div class="related_artikel" style="width: 100%; height: auto">
                        <h3>Jangan Lewatkan Juga</h3>
                          <ul itemscope itemtype="http://schema.org/WebPage">
                        <?php 

                        foreach ($artikel_related_per_kategori as $related) {
                          echo "<li><a style='color: #a80000;font-size: 1.5em;line-height: 1.9em;'  itemprop='relatedLink' title='$related[judul]' href='".artikel_url($related['id'],$related['slug'])."' >$related[judul]</a></li>";
                        }

                         ?>
                          </ul>
                      </div>
                    </div>
                    </div>
                    <div class="box box-solid" style="padding:30px">
                        <div class="box-body">
                            <div id="disqus_thread"></div>
                            <script>
                            /**
                            * RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                            * LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
                            */

                            var disqus_config = function () {
                            this.page.url = "<?php echo current_url() ?>"; // Replace PAGE_URL with your page's canonical URL variable
                            this.page.identifier = "<?php echo $informasi['uniqueid'] ?>"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                            };

                            (function() { // DON'T EDIT BELOW THIS LINE
                            var d = document, s = d.createElement('script');

                            s.src = '//<?php echo $disqus["unique_name"] ?>.disqus.com/embed.js';

                            s.setAttribute('data-timestamp', +new Date());
                            (d.head || d.body).appendChild(s);
                            })();
                            </script>
                            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
                        </div>
                    </div>

                  
                  </div><!-- /.col -->

                  <div class="col-md-3">

                      <h3>TERPOPULER</h3>
                      <?php
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
                  </div><!-- /.col -->
                    

            </div><!-- /.row -->
          </section><!-- /.content -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
     
  