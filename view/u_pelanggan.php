<?php
$id = $_SESSION['id'];

?>
<ul class="breadcrumb">
  <li><a href="./">Home</a></li>
  <li><a href="?page=<?php echo $page ;?>"><?php echo ucfirst($page) ; ?></a></li>
  <li class="active"><?php echo ucfirst($action) ; ?> Data</li>
</ul>
      <?php

          $query = "SELECT * FROM t_users WHERE id='" . $_GET['id'] . "'";
          $result = mysqli_query($koneksi, $query);

          $no = 1;
          while ($lihat = mysqli_fetch_array($result)) {

      ?> 
<form class="form-horizontal" method="POST">
  <fieldset>
    <legend>Update Data Pelanggan</legend>
    <input type="hidden" name="id" value="<?= $lihat['id'] ?>">
    <div class="form-group">
      <label class="col-sm-2 control-label">ID Pelanggan</label>
      <div class="col-sm-3">
        <input disabled type="text" class="form-control" name="id_pel" required value="<?= $lihat['id'] ;?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Nama</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="nama" value="<?= $lihat['nama'] ;?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Alamat</label>
      <div class="col-sm-3">
        <textarea class="form-control" name="alamat" rows="3"><?= $lihat['alamat'] ;?></textarea>
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">No HP</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="telpon" value="<?= $lihat['no_hp'] ;?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Email</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="email" value="<?= $lihat['email'] ;?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">username</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="username" value="<?= $lihat['username'] ;?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">password</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="password" value="" placeholder="encrypted">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Paket</label>
      <div class="col-sm-3">
        <select name="paket" class="form-control">
          <?php
            $query = "SELECT * FROM t_paket ORDER BY id";
            $result = mysqli_query($koneksi, $query);

            while ($r_pos = mysqli_fetch_array($result)) {
              ?>
              <option <?php if ($lihat['id'] == $r_pos['id']) {echo "selected"; } ?> value='<?php echo $r_pos['id']; ?>'><?php echo $r_pos['nama']; ?></option>
              <?php
            }
          ?>
        </select>
      </div>
    </div>  
   
   <input type="hidden" name="id_pelanggan" value="<?php echo "$_SESSION[id]" ;?>">
    <div class="form-group">
      <div class="col-sm-10 col-sm-offset-2">
        <button type="reset" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Reset</button>
        <button type="submit" name="simpan" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Simpan</button>
        <a href="?page=pelanggan" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Batal </a>
      </div>
    </div>
  </fieldset>


</form>
<?php


    if (isset($_POST['simpan'])) {
      $nama = $_POST['nama'];
      $alamat = $_POST['alamat'];
      $telpon = $_POST['telpon'];
      $email = $_POST['email'];
      $paket = $_POST['paket'];
      $id = $_POST['id'];
      $username = $_POST['username'];
      
      // lakukan update data, beri kondisi jika user mengisi passwordnya maka update, jika tidak maka tidak usah diupdate
      if ($_POST['password'] != '') {
        $password = md5($_POST['password']);
      } else {
        $password = $lihat['password'];
      }

      $query = "UPDATE t_users SET nama='$nama', alamat='$alamat', no_hp='$telpon', email='$email', id_paket='$paket', username='$username', password='$password' WHERE id='$id'";

      if (mysqli_query($koneksi, $query)) {
          echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=pelanggan">';
      } else {
          die("Gagal menyimpan data karena : " . mysqli_error($conn));
      }
    }
  };
  ?>