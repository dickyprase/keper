<?php
$id = $_SESSION['id'];
?>
<ul class="breadcrumb">
  <li><a href="./">Home</a></li>
  <li><a href="?page=<?php echo $page ;?>"><?php echo ucfirst($page) ; ?></a></li>
  <li class="active"><?php echo ucfirst($action) ; ?> Data</li>
</ul>
      <?php
        $query = mysqli_query($koneksi, "SELECT * FROM t_users WHERE id='{$_GET['id']}'") or die(mysqli_error($koneksi));
        $no = 1;
        while($lihat = mysqli_fetch_array($query)){  //mengeluarkan isi data dengan mysql_fetch_array dengan perulangan
      ?> 
<form class="form-horizontal" method="POST">
  <fieldset>
    <legend>Update Data User</legend>
    <div class="form-group">
      <label class="col-sm-2 control-label">Nama</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="nama" value="<?php echo $lihat['nama']; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Alamat</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="alamat" value="<?php echo $lihat['alamat']; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">No HP</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="no_hp" value="<?php echo $lihat['no_hp']; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="col-sm-2 control-label">Email</label>
      <div class="col-sm-3">
        <input type="email" class="form-control" name="email" value="<?php echo $lihat['email']; ?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Username</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="username" value="<?php echo $lihat['username'] ;?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Password</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="password" value="" placeholder="encrypted">
      </div>
    </div>
   
   <input type="hidden" name="id_pelanggan" value="<?php echo "$_SESSION[id]" ;?>">
    <div class="form-group">
      <div class="col-sm-10 col-sm-offset-2">
        <button type="reset" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Reset</button>
        <button type="submit" name="simpan" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Simpan</button>
        <a href="?page=user" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Batal </a>
      </div>
    </div>
  </fieldset>

</form>
<?php
};
?>
  <?php 
  if (isset($_POST['simpan'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $level = $_POST['level'];
      $id = $_POST['id'];
  
      $query = "UPDATE t_user SET username='$username', password=MD5('$password'), level='$level' WHERE id=$id";
      if (mysqli_query($koneksi, $query)) {
          echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=user">';
      } else {
          die("Gagal menyimpan data karena : " . mysqli_error($koneksi));
      }
    }
  ?>