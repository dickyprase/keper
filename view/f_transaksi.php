<?php

$id = $_SESSION['id'];
?>
<ul class="breadcrumb">
  <li><a href="./">Home</a></li>
  <li><a href="?page=<?php echo $page ;?>"><?php echo ucfirst($page) ; ?></a></li>
  <li class="active"><?php echo ucfirst($action) ; ?> Data</li>
</ul>

<form class="form-horizontal" method="POST" enctype="multipart/form-data">
  <fieldset>
    <legend>Tambah Data Transaksi</legend>
    <div class="form-group">
      <label class="col-sm-2 control-label">Nama Pelanggan</label>
      <div class="col-sm-3">
        <select class="form-control" name="nama" required>
          <option selected disabled>- PILIH -</option>
          <?php
          $sql = "SELECT * FROM t_users WHERE level !='admin'";
          $result = $koneksi->query($sql);

          if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo "<option value='" . $row["id"]. "'>" . $row["nama"]. "</option>";
            }
          } else {
            echo "0 results";
          }
          ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Tanggal Bayar</label>
      <div class="col-sm-3">
        <input type="text" id="datepicker" class="form-control" name="tgl_bayar" placeholder="Tanggal Bayar">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Jumlah Bayar</label>
      <div class="col-sm-3">        
        <input type="text" class="form-control" id="inputku" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" name="nominal" placeholder="Jumlah Bayar">
      </div>
    </div>    
    <div class="form-group">
      <label class="col-sm-2 control-label">Bukti Pembayaran</label>
      <div class="col-sm-3">
        <input type="file" id="exampleInputFile" name="file">
      </div>
    </div>
    
   <input type="hidden" name="info" value="1">
   <input type="hidden" name="id_pelanggan" value="<?php echo $_SESSION['id'] ;?>">
    <div class="form-group">
      <div class="col-sm-10 col-sm-offset-2">
        <button type="reset" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Reset</button>
        <button type="submit" name="simpan" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Tambah</button>
        <a href="?page=transaksi" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Batal </a>
      </div>
    </div>
  </fieldset>

  <?php  
  ?>
</form>

  <?php 

  if(isset($_POST['info'])) {
    $id_user = $_POST['nama'];
    $nominal = $_POST['nominal'];
    $tgl_bayar = $_POST['tgl_bayar'];
    $tgl_validasi = date('Y-m-d');
    $status = '0';
    $bukti = $_FILES['file']['name'];
    $tmp = $_FILES['file']['tmp_name'];
    $path = "img/".$bukti;
    if(move_uploaded_file($tmp, $path)) {
      $sql = "INSERT INTO t_transaksi (id_user, nominal, bukti, tgl_bayar, tgl_validasi, status) VALUES ('$id_user', '$nominal', '$bukti', '$tgl_bayar', '$tgl_validasi', '$status')";
      if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil disimpan!');</script>";
        echo "<script>document.location.href='?page=transaksi';</script>";
      } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
      }
    } else {
      echo "Gagal Upload";
    }
  }


  ?>
