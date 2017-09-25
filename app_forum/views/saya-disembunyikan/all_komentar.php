<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

?>

 <div class="content-wrapper" >

 	     <section class="content-header">
          <h1>
            Managemen Komentar
            <small> Seluruh Komentar </small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo $burl; ?>/"><i class="fa fa-dashboard"></i> Halaman Utama</a></li><li class="active">Managemen Komentar</li>
           
          </ol>
        </section>

        <section class="content">
        	<div class="box box-danger">
        		<div class="box-body">
        		<div class="row">
        			<div class="col-sm-12">
        				<table id="daftar-user" class="table table-bordered table-striped table-hover" >
        					<thead>
        						<tr>
                                    <th>Nama</th>
                                    <th>Email</th>
        							<th>Komentar</th>
        							<th>Tanggal</th>
        							<th>IP</th>
        							<th>Edit</th>

        						</tr>
        					</thead>
        					<tbody>
        						<?php echo $table ?>
        					</tbody>

        				</table>
        			</div>
        		</div>
        	</div>
        	</div>
        </section>



 </div>
