<?php
include "../inc/config.php";
$owner = mysqli_query($koneksi, "SELECT * FROM t_setting limit 1") or die (mysqli_error($koneksi));
$seting = mysqli_fetch_array($owner);
$id_transaksi=$_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Cetak Invoice | Keper POS Net</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="../css/default/bootstrap.css" />
    <link href="../css/custom-style.css" rel="stylesheet" />
    <script type="text/javascript" src="../js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript">
        window.onload = function() {
            window.print();
        }
    </script>
</head>
<body >
<div class="container">
<?php
include "../inc/config.php";
include "../inc/function.php";
$query = "SELECT t_users.*, t_paket.id,t_paket.nama as nama_paket,t_paket.harga, t_transaksi.* from t_users, t_paket, t_transaksi WHERE t_users.id=t_transaksi.id_user AND t_users.id_paket=t_paket.id AND t_transaksi.id_transaksi='$id_transaksi'";
$result = mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));
while ($data = mysqli_fetch_array($result)){
    ?>
    <div  class="row contact-info">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <hr />
            <img src="../img/logo.png" class="thumbnail span3" style="display: inline; float: left; margin-right: 20px; width: 100px; height: 100px">
            <h2 style="margin: 15px 0 10px 0; color: #000;"><?php echo $seting['nama'] ?></h2>
            <div style="color: #000; font-size: 16px; font-family: Tahoma" class="clearfix"><b>Alamat : <?php echo $seting['alamat'] ?></b></div>
             
            <hr />
        </div>
    </div>
    <div  class="row text-center contact-info">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <hr />
             <span>
                 <strong>#INVOICE-00<?php echo $data['id_transaksi'] ?> </strong>
             </span>
             
            <hr />
        </div>
    </div>
    <div  class="row pad-top-botm client-info">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <h4>  <strong>Data Pelanggan </strong></h4>
            <b>Nama :</b> <?php echo $data['nama'] ?>.
            <br />
            <b>Alamat :</b> <?php echo $data['alamat'] ?>.
            <br />
            <b>No HP :</b> <?php echo $data['no_hp'] ?>
            <br />
            <b>E-mail :</b> <?php echo $data['email'] ?>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">

            <h4>  <strong>Data Pembayaran </strong></h4>
            Tanggal Bayar :  <?php echo TanggalIndo($data['tgl_bayar']); ?>
            <br />
            Tanggal Validasi :  <?php echo TanggalIndo($data['tgl_bayar']); ?>
            <br />            
            <b>Status :  <?php echo ucfirst($data['status']) ?> </b>
            
            
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Description</th>
                        <th>Speed.</th>
                        <th>Sub Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?php echo $data['id_paket'] ?></td>
                        <td>Paket Internet </td>
                        <td><?php echo $data['nama_paket'] ?></td>
                        <td><?php echo number_format( $data['nominal'] , 0 , ',' , '.' ); ?></td>
                    </tr>
                    

                    </tbody>
                </table>
            </div>
            <hr />
            <div class="ttl-amts">
                <h4> <strong>Total : <?php echo number_format( $data['nominal'] , 0 , ',' , '.' ); ?></strong> </h4>
            </div>
        </div>
    </div>
</div>
<?php 
};
?>
</body>
</html>