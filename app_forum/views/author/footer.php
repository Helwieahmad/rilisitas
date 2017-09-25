<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

?>

       <!-- Main Footer -->
      <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
          
        </div>
        <!-- Default to the left -->
        <strong> Rilisitas - Berita Politik Indonesia</strong> 
      </footer>
      


      <div class='modal-error'></div>
      <div class='notif-proses'></div>
      <div class='modal-konfirmasi'></div>


      <div class="modal fade" id="modal-upload-foto" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header"> 
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     <h4>Upload Foto</h4>
                      
                  </div>
                  <div class="modal-body">
                      <div class="area-pop-up-upload dropzone well dz-clickable"></div>
                      <div class="input-group">
                          <div class="input-group-addon">URL</div>
                          <input type='text' class='form-control just-upload-field' />
                      </div>
                  </div>
                  <div class="modal-footer">
                  </div>
              </div>
          </div>
 </div>


 <div class="modal fade" id="modal-direct-upload" role="dialog" aria-hidden="true">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header"> 
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                     <h4>Upload Foto</h4>
                      
                  </div>
                  <div class="modal-body">

<iframe id="iframe-direct-upload" style="width: 100%" height="400" src="" frameborder="0" style="overflow: scroll; overflow-x: hidden; overflow-y: scroll; "></iframe>

                  </div>
                  <div class="modal-footer">
                  </div>
              </div>
          </div>
 </div>



    </div><!-- ./wrapper -->

  </body>
</html>