<?php
defined('BASEPATH') OR exit('Please Cari Yang Lain!!!!');
?>
<?php
class menu_rilis {

  public $CI;

  public $menu;

  function __construct(){
    $this->CI =& get_instance();
  }

  // fungsi untuk mengambil menu
  function ambil_menu($type_menu,$parent=0){

    $kondisi=array(

      "menu_id"=>$type_menu,
      "menu_child_parent" => $parent,
      "aktif" => "Y"

      );
    //query ke database
    $this->CI->db->order_by("posisi","ASC");
    $query= $this->CI->db->get_where("menu_child",$kondisi);

    //cek apakah memiliki hasil
    if($query->num_rows()>0){
      $class=$parent==0?"nav navbar-nav":"dropdown-menu bg-red";
      $this->menu.="<ul class='$class'>";
      
      foreach ($query->result_array() as $menu) {
        //cek apakah menu sekarang mempunyai submenu atau tidak
        $cek=$this->CI->db->get_where('menu_child',array('menu_child_parent'=>$menu['menu_child_id'],'aktif'=>'Y','menu_id'=>$type_menu));

        //jika terdapat sub menu
        if($cek->num_rows()>0){

          $this->menu.= "<li class='dropdown'><a href='$menu[menu_child_url]' target='$menu[menu_child_target]' style='color:#fff;'  class='dropdown-toggle' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'>$menu[menu_child_nama] <span class='caret'></span></a>";
          //panggil ambil_menu() secara reqursive untuk mengambil sub-menu nya
          $this->ambil_menu($type_menu,$menu['menu_child_id']);
          $this->menu.= "</li>";

        }
        //jika tidak memiliki sub menu
         else {
          $this->menu.= "<li><a href='$menu[menu_child_url]' target='$menu[menu_child_target]'>$menu[menu_child_nama]</a>";
          $this->menu.= "</li>";
        }

      }

      $this->menu.="</ul>";

    } else {
      //jika tidak ada hasil.
      return;

    }

  }


function take_menu($type_menu,$parent=0){

    $kondisi=array(
      "menu_id"=>$type_menu,
      "menu_child_parent" => $parent,
      "aktif" => "Y"

      );
    $this->CI->db->order_by("posisi","ASC");
    $query= $this->CI->db->get_where("menu_child",$kondisi);
    if($query->num_rows()>0){
      $class=$parent==0?"sidebar-menu":"treeview-menu";
      $this->menu.="<ul class='$class'>";
      foreach ($query->result_array() as $menu) {
        $cek=$this->CI->db->get_where('menu_child',array('menu_child_parent'=>$menu['menu_child_id'],'aktif'=>'Y','menu_id'=>$type_menu));
        if($cek->num_rows()>0){
          $this->menu.= "<li class='active'><a href='$menu[menu_child_url]' style='color:#fff;' target='$menu[menu_child_target]'>$menu[menu_child_nama]<i class='fa fa-angle-left pull-right'></i></a>";
          $this->take_menu($type_menu,$menu['menu_child_id']);
          $this->menu.= "</li>";
        }
         else {
          $this->menu.= "<li class='active'><a href='$menu[menu_child_url]' style='color:#fff;' target='$menu[menu_child_target]'>$menu[menu_child_nama]</a>";
          $this->menu.= "</li>";
        }
      }
      $this->menu.="</ul>";
    } else {
      return;
    }
  }
}

$menuPertama = new menu_rilis;
$menuPertama->ambil_menu(1); //angka 1 adalah ID menu horizontal 
$menukecil = new menu_rilis;
$menukecil->take_menu(1); //angka 1 adalah ID menu horizontal 

?>

<!DOCTYPE html>
<html lang="id-ID" prefix="og: http://ogp.me/ns#">
<head>
	<title><?php echo $informasi["title"] ?></title>

     <meta name="viewport" content="width=device-width, initial-scale=1" />

     <meta name="description" content="<?php echo $informasi['meta_deskripsi']; ?>" />
     <meta name="keywords" content="<?php echo $informasi['meta_keyword']; ?>" />
     <meta name="author" content="<?php echo $informasi['author']; ?>" />

     <meta property="og:url" content="<?php echo $informasi['og-url'];  ?>" />
     <meta property="og:title" content="<?php echo $informasi['og-title']; ?>" />
     <meta property="og:description" content="<?php echo $informasi["og-description"]; ?>" />
     <meta property="og:site_name" content="<?php echo $informasi['og-site_name']; ?>" />
     <meta property="og:image" content="<?php echo $informasi['og-image']; ?>" />
     <meta property="og:image:type" content="image/jpeg" />
     <meta property="og:type" content="<?php echo $informasi['og-type']; ?>" />
<?php if($informasi["current_page"]=="detail-artikel"){ ?>
     <meta property="article:author" content="<?php echo $informasi['article-author']; ?>" />
     <meta property="article:publisher" content="<?php echo $informasi['article-publisher']; ?>" />
     <meta property="article:published_time" content="<?php echo $informasi['article-published_time']; ?>" />
<?php } ?>


	<link rel='shortcut icon' href='<?php echo $informasi['favicon'] ?>' />	
	<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css' />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css' />
    
    <link rel="stylesheet" href="<?php echo assets_url('bootstrap/css/bootstrap.min.css'); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo assets_url('font-awesome-4.3.0/css/font-awesome.min.css');?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo assets_url('ionicons/2.0.1/css/ionicons.min.css');?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo assets_url('dist/css/AdminLTE.min.css');?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo assets_url('dist/css/skins/_all-skins.min.css');?>">
	
    <link rel="stylesheet" href="<?php echo assets_url('dist/css/jquery-ui.css');?>">
    <script src="<?php echo assets_url('dist/js/jquery-1.8.3.js');?>"></script>
    <script src="<?php echo assets_url('dist/js/jquery-ui.js');?>"></script>
    <script src="<?php echo assets_url('dist/js/chosen.jquery.js');?>"></script>
    <link rel="stylesheet" href="<?php echo assets_url('dist/css/chosen.css');?>">
    <script type="text/javascript">
    $(function() {
        $(".chosen-select").chosen();
    });
    </script>
    <script type="text/javascript">
    var drop_down = this;
    var selected_index = drop_down.selectedIndex;
    var selected_value = drop_down.options[ selected_index ].value;
    top.location.href = '<?php echo baseURL();?>riliser/' + selected_value
    </script>

      <style type="text/css">
    		<?php echo $informasi["custom_css"]; ?>
    	</style>

  <script src='https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit' async defer></script>
<script src='<?php echo assets_url('assets/plugins/jQueryUI/jquery-ui.min.js');?>'></script>
<script src='<?php echo assets_url('assets/plugins/jQueryUI/jquery-ui.js');?>'></script>
    <!-- jQuery 2.1.4 -->
    <script src="<?php echo assets_url('plugins/jQuery/jQuery-2.1.4.min.js');?> "></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo assets_url('bootstrap/js/bootstrap.min.js'); ?>" ></script>
    <!-- SlimScroll -->
    <script src="<?php echo assets_url('plugins/slimScroll/jquery.slimscroll.min.js');?>"></script>
    <!-- FastClick -->
    <script src="<?php echo assets_url('plugins/fastclick/fastclick.min.js'); ?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo assets_url('dist/js/app.min.js')?>"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo assets_url('dist/js/demo.js');?>"></script>

<script type="text/javascript">
$(function() {
  var $searchlink = $('#searchlink');
  
  /** hover effect
  $searchlink.on('mouseover', function(){
    $(this).addClass('open');
  }).on('mouseout', function(){
    $(this).removeClass('open');
  });**/
  $searchlink.on('click', function(e){
    var target = e ? e.target : window.event.srcElement;
    
    if($(target).attr('id') == 'searchlink') {
      if($(this).hasClass('open')) {
        $(this).removeClass('open');
      } else {
        $(this).addClass('open');
      }
    }
  });
});
</script>

<script type="text/javascript">
$(function(){

  var contact_us;


  onloadCallback=function(){

  contact_us=grecaptcha.render(document.getElementById('recaptcha1'), {
          'sitekey' : "<?php echo $recaptcha['key'] ?>",
          'theme' : 'white'
        });


  }


  $("#pesan").on("submit",function(evt){
    evt.preventDefault();    
    if(!$(this)[0].mengirim) {
    __this=$(this)      
    __this[0].mengirim=true;
    var val=__this.serialize();
    var action=__this.attr("action");
    __this.find("button").hide();
    __this.find(".cssload").show();
    $.ajax({
      type:"POST",
      url:action,
      data:val,
      cache:false,
      dataType:'json',
      success:function(a){
        if(a.status=='sukses'){
           noty({
            text:"Pesan Anda Telah terkirim. Terima Kasih",
            type: 'success',
            layout: 'center',            
            dismissQueue:true
                        });
         $('form#pesan').find("input[type=text],input[type=password],input[type=checkbox],textarea").val("");
        } else if(a.status=='error') {
          noty({
            text:a.name,
            type: 'error',
            layout: 'center',
            dismissQueue:true

          });
        }

      },
      error:function(){
          noty({
            text:"Cek koneksi internet anda",
            type: 'error',
            layout: 'center',
            dismissQueue:true

          });
      },
      complete:function(){
        grecaptcha.reset(contact_us);  
        __this.find("button").show();
        __this.find(".cssload").hide();
        __this[0].mengirim=false;      
      }
    });
  }
  });


 var $grid = $(".grid").masonry({
    itemSelector: '.grid-item',   
    });

 $grid.imagesLoaded().progress( function() {
    $grid.masonry('layout');
 });

$(".grid a").tosrus({
  caption: {
    add:true
  }
});

});

<?php echo $informasi['custom_javascript']; ?>

<?php echo $google_analytics["script"]; ?>

</script>
<style type="text/css">
  .cssload {
  width: 100%;
  height: 34px;
  text-align: center;
}

.cssload-tube-tunnel {
  width: 34px;
  height: 34px;
  margin: 0 auto;
  border: 3px solid;
  border-radius: 50%;
  border-color: rgb(235,0,0);
  animation: cssload-scale 1035ms infinite linear;
    -o-animation: cssload-scale 1035ms infinite linear;
    -ms-animation: cssload-scale 1035ms infinite linear;
    -webkit-animation: cssload-scale 1035ms infinite linear;
    -moz-animation: cssload-scale 1035ms infinite linear;
}
@keyframes cssload-scale {
  0% { transform: scale(0); transform: scale(0); }
  90% { transform: scale(0.7); transform: scale(0.7); }
  100% { transform: scale(1); transform: scale(1); }
}

@-o-keyframes cssload-scale {
  0% { -o-transform: scale(0); transform: scale(0); }
  90% { -o-transform: scale(0.7); transform: scale(0.7); }
  100% { -o-transform: scale(1); transform: scale(1); }
}

@-ms-keyframes cssload-scale {
  0% { -ms-transform: scale(0); transform: scale(0); }
  90% { -ms-transform: scale(0.7); transform: scale(0.7); }
  100% { -ms-transform: scale(1); transform: scale(1); }
}

@-webkit-keyframes cssload-scale {
  0% { -webkit-transform: scale(0); transform: scale(0); }
  90% { -webkit-transform: scale(0.7); transform: scale(0.7); }
  100% { -webkit-transform: scale(1); transform: scale(1); }
}

@-moz-keyframes cssload-scale {
  0% { -moz-transform: scale(0); transform: scale(0); }
  90% { -moz-transform: scale(0.7); transform: scale(0.7); }
  100% { -moz-transform: scale(1); transform: scale(1); }
}


</style>
  

</head>
  <body class="hold-transition skin-red layout-top-nav">
    <div class="wrapper">
<aside class="control-sidebar control-sidebar-dark">
    <section class="sidebar">
          <!-- Sidebar user panel -->
          <!-- search form -->
          <?php echo"<form action='".baseURL("form_visitors/search_article")."' method='post' class='sidebar-form'>
            <div class='input-group'>
              <input type='text' name='keyword' class='form-control' placeholder='Cari & Enter...'>
              <span class='input-group-btn'>
                <button type='submit' name='search' id='search-btn' class='btn btn-flat'><i class='fa fa-search'></i></button>
              </span>
            </div>
          </form>";?>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <?php echo $menukecil->menu;?>
        </section>
        <!-- /.sidebar -->
      </aside>
      <div class="control-sidebar-bg"></div>
      <header class="main-header">
  <nav class="navbar navbar-fixed-top">
    <div class="container-fluid">
    <div class="col-lg-2 col-md-2 col-sm-1">
      <div class="navbar-header">
        <a href="<?php echo baseURL() ?>" class="navbar-brand"><b>RILISITAS</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="control-sidebar">
                <i class="fa fa-bars"></i>
              </button>

      </div>
    </div>

    <div class="col-md-5 col-sm-5 hidden-xs">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            
                <?php echo $menuPertama->menu;  ?>
          </ul>
          </div>
      </div>
      <div class="col-md-5 col-sm-6 hidden-xs">
            <ul class="nav navbar-nav navbar-right">
              <div class="navbar-right">
                  <ul class="nav navbar-nav">
                      <li><a href="http://facebook.com/rilisonline"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                      <li><a href="http://twitter.com/rilisonline"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                      <li><a href="https://plus.google.com"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                      <?php if ($name=$this->session->userdata('name_user')) {
                                $user_level=$this->session->userdata('level_user');
                                if ($user_level=='1') {
                                    echo"<li><a class='login-link' href='saya-disembunyikan'><i class='fa fa-user'></i>&nbsp$name</a></li>";
                                  
                                }else{
                                  echo"<li><a class='login-link' href='author'><i class='fa fa-user'></i>&nbsp$name</a></li>";
                                }
                          }else{
                      echo "<li><a class='login-link' href='author/login'><i class='fa fa-user'></i>&nbsp Login / Register</a></li>";}?>
                      <li>
                        <div id="searchlink" class="searchlink fa fa-search" aria-hidden="true">
                          <div class="searchform">
                              <?php echo"<form id='search' method='post' action='".baseURL("form_visitors/search_article")."'>
                                <input type='text' name='keyword' class='s' id='s' placeholder='ketik lalu enter...'>
                                <a type='submit' class='btn bg-red btn-flat'>Search</a>
                              </form>"?>
                          </div>
                        </div>
                      </li>
                  </ul>
              </div>
            </ul>
      </div>
    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
</header>

<main class="site-content" role="main">