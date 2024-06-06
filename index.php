<?php
  //error_reporting(0);
  session_start();  
  include "inc/config.php";

  $query = "SELECT * FROM t_setting LIMIT 1";
  $result = mysqli_query($koneksi, $query);  
  $setting = mysqli_fetch_assoc($result);

  if(empty($_SESSION['username'])){
    header("location:login.php");
  }else{

?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="keywords" content="admin, dashboard, bootstrap, template, flat, modern, theme, responsive, fluid, retina, backend, html5, css, css3">
  <meta name="description" content="">
  <meta name="author" content="Muhammad Shihab">
  <link rel="shortcut icon" href="image/favicon.ico">
  <link href="css/bootstrap.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="js/jquery/jquery-ui.css"> 
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/angka.js"></script>
    <script src="js/jquery/jquery-ui.js"></script>
    <script src="js/jquery/jquery-ui.min.js"></script>
    
  <title>Aplikasi Tagihan Internet - Keper PostNet</title>
  
  <script type="text/javascript" charset="utf-8">
     function fnHitung() {
        var inputNilai = document.getElementById('inputku').value;
        var angka = bersihPemisah(inputNilai);

        if (inputNilai.trim() === "") {
            alert("Jangan Dikosongi");
            document.getElementById('inputku').focus();
            return false;
        } else if (isNaN(angka)) {
            alert("Masukkan angka yang valid");
            document.getElementById('inputku').focus();
            return false;
        } else {
            alert("Angka aslinya: " + angka);
            document.getElementById('inputku').focus();
            document.getElementById('inputku').value = tandaPemisahTitik(angka);
            return false;
        }
    }

  </script>

  <script>
  $(function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
    
  });
  $(function() {
    $( "#tgl_validasi" ).datepicker({ dateFormat: 'yy-mm-dd' });
    
  });
  $(function() {
    $( "#dari" ).datepicker({ dateFormat: 'yy-mm-dd' });
    
  });
  $(function() {
    $( "#sampai" ).datepicker({ dateFormat: 'yy-mm-dd' });
    
  });
  </script>
  
</head>
<body>
 
<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="./" class="navbar-brand">Home</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <?php if($_SESSION['level'] == 'admin'){ ;?>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Master Data <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a href="?page=pelanggan">Data Pelanggan</a></li>                
                <li><a href="?page=paket">Data Paket</a></li>
              </ul>
            </li>
            <?php }?>
            <li><a href="?page=transaksi">Pembayaran</a></li>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Laporan <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <li><a href="?page=rekapbayar">Rekap Pembayaran</a></li>  
              </ul>
            </li>
            <?php if($_SESSION['level'] == 'admin'){ ;?>
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="themes">Pengaturan <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="themes">
                <!-- <li><a href="?page=user">Manajemen User</a></li>                 -->
                <li><a href="?page=profile">Profile</a></li>
              </ul>
            </li>
            <?php }?>
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" title="<?php echo ucfirst($_SESSION['username'])  ;?>" id="download"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo ucfirst($_SESSION['username'])  ;?> <span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="download">
                <li><a href="?page=logout">Logout</a></li>
              </ul>
            </li>
          </ul>

        </div>
      </div>
    </div>

<div id="wadah">
          
  <div id="kepala">
        <img src="img/logo.png" class="thumbnail span3" style="display: inline; float: left; margin-right: 20px; width: 130px; height: 130px">
        <h2 style="margin: 15px 0 10px 0; color: #000;"><?php echo $setting['nama'] ?></h2>
        <div style="color: #000; font-size: 16px; font-family: Tahoma" class="clearfix"><b>Alamat : <?php echo $setting['alamat'] ?></b></div>
      </div>
  
  <div id="isi">

  <?php 
    $page = @$_GET['page'];
    $action = @$_GET['aksi'];
    
    if($page == "pelanggan"){
      if ($action == ""){
        include "view/l_pelanggan.php" ;
      }else if ($action == "tambah"){
        include "view/f_pelanggan.php" ;
      }else if ($action == "detail"){
        include "view/detail_pelanggan.php" ;
      }else if ($action == "edit"){
        include "view/u_pelanggan.php" ;
      }else if ($action == "delete"){
        include "view/l_pelanggan.php" ;
      }
    }else if ($page == "paket"){
      if ($action == ""){
        include "view/l_paket.php" ;
      }else if ($action == "tambah"){
        include "view/f_paket.php" ;
      }else if ($action == "edit"){
        include "view/u_paket.php" ;
      } else if ($action == "delete"){
        include "view/l_paket.php" ;
      }   
    }else if ($page == "transaksi"){
      if($action == ""){
        include "view/l_transaksi.php";
      }else if($action=="tambah"){
        include "view/f_transaksi.php";
      }else if($action=="edit"){
        include "view/u_transaksi.php";
      }else if($action=="delete"){
        include "view/l_transaksi.php";
      }
      
    }else if ($page == "profile"){
      include "view/setting.php";
    }else if ($page == "user"){
      if($action == ""){
      include "view/l_user.php";
      }elseif ($action == "tambah") {
        include "view/f_user.php";
      }elseif ($action == "edit") {
        include "view/u_user.php";
      }elseif ($action == "delete") {
        include "view/l_user.php";
      }

    }else if ($page == "rekapbayar"){
      include "view/rekap_laporan.php";
    }else if ($page == "logout"){
      include "logout.php";
    }else if ($page == ""){
      include "view/xyz.php" ;
    }else {
      include "view/404.php";
    }
  
  ?>
  </div>

  <div id="ekor">
  Copyright &copy; 2020 by <a href="https://www.instagram.com/mrhabs_/" target="_blank" title="Muhammad Shihab"> Muhammad Shihab </a>
  </div>
</div>
  
</body>
  
</html>
<?php
}
?>