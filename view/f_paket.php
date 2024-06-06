
<ul class="breadcrumb">
  <li><a href="./">Home</a></li>
  <li><a href="?page=<?php echo $page ;?>"><?php echo ucfirst($page) ; ?></a></li>
  <li class="active"><?php echo ucfirst($action) ; ?> Data</li>
</ul>

<form class="form-horizontal" method="POST">
  <fieldset>
    <legend>Tambah Data Paket</legend>
    <div class="form-group">
      <label class="col-sm-2 control-label">Nama Paket</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="nama" placeholder="Nama Paket">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Harga</label>
      <div class="col-sm-3">
        <input type="number" id="inputku" class="form-control" name="harga" placeholder="Harga Paket">
      </div>
    </div>
    
    
   <input type="hidden" name="info" value="1">
    <div class="form-group">
      <div class="col-sm-10 col-sm-offset-2">
        <button type="reset" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Reset</button>
        <button type="submit" name="simpan" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Tambah</button>
        <a href="?page=paket" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Batal </a>
      </div>
    </div>
  </fieldset>


</form>

  <?php 
 if (isset($_POST['simpan'])) {
  $nama = $_POST['nama'];
  $harga = $_POST['harga'];

  $cekdata = "SELECT nama FROM t_paket WHERE nama='$nama'";
  $ada = mysqli_query($koneksi, $cekdata);

  if (mysqli_num_rows($ada) > 0) {
      echo '<b>paket sudah ada</b>';
  } else {
      $query = "INSERT INTO t_paket VALUES (null, '$nama', '$harga')";
      if (mysqli_query($koneksi, $query)) {
          echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=paket">';
      } else {
          echo "Gagal menyimpan data karena : " . mysqli_error($koneksi);
      }
  }
}

  ?>