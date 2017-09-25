<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$path_adm=base_url()."an-theme/admin";

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Rilisitas | Daftar</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo $path_adm; ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- Font Awesome Icons -->
    <link href="<?php echo $path_adm; ?>/plugins/font-awesome-4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo $path_adm; ?>/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="register-page">
    <div class="register-box">
      <div class="register-logo">
        <a href="<?php echo base_url() ?>" target='_top'><span style="color:#a80000"><div style="color">RILISITAS</div></span></a>
      </div>

      <div class="register-box-body">
        <p class="login-box-msg">Daftar Sebagai Riliser Baru</p>
        <div class="row">
            <div class="col-xs-12">
              <?php echo $this->session->flashdata('verify_msg'); ?>
             <?php echo form_close(); ?>
        <?php echo $this->session->flashdata('msg'); ?>
        <?php $tgl=date("Y:m:d H:i:s",now());?>
            </div>
      </div>
        <?php $attributes = array("name" => "registrationform");
        echo form_open("author/register", $attributes);?>
          <div class="form-group has-feedback">
            <input type="text" placeholder="Username" class="form-control" name="name_user" value="<?php echo set_value('name_user'); ?>">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="tex-danger"><?php echo form_error('name_user'); ?></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" placeholder="Nama Lengkap" class="form-control" required='required' name="nama_lengkap" value="<?php echo set_value('nama_lengkap'); ?>">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
            <span class="tex-danger"><?php echo form_error('nama_lengkap'); ?></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" placeholder="Email" class="form-control" name="email" value="<?php echo set_value('email'); ?>">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <span class="tex-danger"><?php echo form_error('email'); ?></span>
          </div>
          <div class="form-group has-feedback">
            <input placeholder="Password" class="form-control" type="password" name="password_user">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <span class="tex-danger"><?php echo form_error('password_user'); ?></span>
          </div>
          <div class="form-group has-feedback">
            <input placeholder="Konfirmasi password" class="form-control" name="cpassword" type="password">
            <input type="hidden" name="avatar_user" value="user_pic.png">
            <input type="hidden" name="status_user" value="N">
            <input type="hidden" name="terdaftar" value="<?php echo date('Y-m-d'); ?>">
            <input type="hidden" name="terhapus" value="N">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            <span class="tex-danger"><?php echo form_error('cpassword'); ?></span>
          </div>
          <div class="row">
            <div class="col-xs-4 col-xs-offset-8">
              <button class="btn btn-danger btn-block btn-flat" type="submit">Daftar</button>
            </div><!-- /.col -->
          </div>
        </form>


        <div class="social-auth-links text-center">
          <p>- Atau -</p>
        </div>

        <a class="text-center text-red" href="<?php base_url() ?>login">Sudah Memiliki Akun? Silahkan Login! </a>
      </div><!-- /.form-box -->
    </div>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo $path_adm; ?>/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo $path_adm; ?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

  </body>
</html>