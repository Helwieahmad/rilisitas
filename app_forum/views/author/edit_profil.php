<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

?>
 <div class="content-wrapper" >

 	     <section class="content-header">
          <h1>
            Edit Profil
            <small> Halaman Edit Profil </small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $burl; ?>/"><i class="fa fa-dashboard"></i> Halaman Utama</a></li><li class="active">Edit Profil</li>
           
          </ol>
        </section>

        <section class="content">
        	<div class="box box-danger">
        		<div class="box-body">
        		
        			<div class="col-sm-12">
        				<table id="daftar-user" class="table table-condensed" >
        					<thead>
        						<tr>
        							<th class="text-center">Username</th>
        							<th class="text-center">Nama</th>
        							<th class="text-center">Email</th>
        							<th class="text-center">Ganti Password & Ganti Foto</th>

        						</tr>
        					</thead>
        					<tbody>
        						<?php echo $data ?>
        					</tbody>

        				</table>
        			</div>
        		
        	</div>
        	</div>
        </section>



 </div>


 <div class="modal fade" id="modal-password" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4>Ubah Password</h4>
                <p >username: <span class="username"></span></p>
            </div>

            <div class="modal-body">
                        <input type="hidden" class="id" value="0">
                        <div class='form-group'>
                                <label for='editpassword'>Password</label> <span class='label label-danger'></span>
                                <div class='input-group has-feedback'><span class="input-group-addon" id="editpassword"><i class='fa fa-lock'></i></span>
                                  <input type='password' class='form-control' id='editpassword' placeholder='password' placeholder='username' data-toggle='tooltip' data-placement='top' title='Minimal 8 karakter' ><span class='form-control-feedback'></span>
                                </div>
                        </div>

                        <div class='form-group'>
                                <label for='editrepassword'>Konfirmasi Password</label> <span class='label label-danger'></span>
                                <div class='input-group has-feedback'><span class="input-group-addon" id="editrepassword"><i class='fa fa-lock'></i></span>
                                 <input type='password' class='form-control' id='editrepassword' placeholder='Masukan kembali password' placeholder='username' data-toggle='tooltip' data-placement='top' title='Password harus sama'  ><span class='form-control-feedback'></span>
                                </div>
            </div>
        </div>

            <div class="modal-footer">
                <span class="ajax-notif">Masih ada proses lain yang sedang berlangsung, harap tunggu sebentar..</span>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning save" >Save</button>
            </div>

        </div>
   </div>
 </div>


 <div class="modal fade" id="modal-foto" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header"> 
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4>Ganti Foto</h4>
                <p >username: <span class="username"></span></p>  
            </div>
            <div class="modal-body">
                <input type="hidden" class="id" value="" >
                <div class="area-foto dropzone well dz-clickable"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-warning ok">Ok</button>
                <button class="btn btn-warning fakeOk disabled ">Ok</button>
            </div>
        </div>
    </div>
 </div>