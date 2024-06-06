<?php

  if($_SESSION['level']=="pelanggan"){
  header("location:index.php");
}else{
?>
<ul class="breadcrumb">
  <li><a href="./">Home</a></li>
  <li><a href="?page=<?php echo $page ;?>"><?php echo ucfirst($page) ; ?></a></li>
  <li class="active"><?php echo ucfirst($action) ; ?> Data</li>
</ul>
<fieldset>
	<legend>Tambah Data Pelanggan</legend>
	<form class="form-horizontal"  method="post">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Nama</label>
	    <div class="col-sm-4">
	      <input type="text" name="nama" class="form-control" placeholder="Nama">
	    </div>
	  </div>	  
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Alamat</label>
	    <div class="col-sm-5">
	      <textarea class="form-control" name="alamat" rows="3"></textarea>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">No. Telp</label>
	    <div class="col-sm-3">
	      <input type="text" class="form-control" name="telpon" placeholder="No. Telp">
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Email</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="email" placeholder="Email">
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">username</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="username" placeholder="username">
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">password</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" name="password" placeholder="password">
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Paket</label>
	    <div class="col-sm-2">
	      	<select name="paket" onchange="showUser(this.value)" class="form-control">
				<option value="">--Pilih Paket--</option>
				<?php
					$query = "SELECT * FROM t_paket ORDER BY id";
					$result = mysqli_query($koneksi, $query);
					while ($r_pos = mysqli_fetch_array($result)) {
						
						echo "<option value=".$r_pos['id'].">".$r_pos['nama']."</option>";
						
					}
                ?>
			</select>
	    </div>
	    <a href="?page=paket&aksi=tambah" class="btn btn-primary "><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></a>
	  </div>  
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	    <button type="reset" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Reset</button>
        <button type="submit" name="simpan" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Tambah</button>
        <a href="?page=pelanggan" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Batal </a>
	    </div>
	  </div>
	</form>
</fieldset>

  <?php 
 
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $telpon = $_POST['telpon'];
    $email = $_POST['email'];
    $paket = $_POST['paket'];
	$username = $_POST['username'];
	$password = $_POST['password'];

    $cekdata = "SELECT nama FROM t_users WHERE nama='$nama'";
    $ada = mysqli_query($koneksi, $cekdata);

    if (mysqli_num_rows($ada) > 0) {
        echo '<b>Pelanggan sudah ada</b>';
    } else {
        $query = "INSERT INTO t_users VALUES (null, $paket, '$nama', '$alamat', '$telpon', '$email', '$username', md5('$password'), 'pelanggan')";
        if (mysqli_query($koneksi, $query)) {
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=pelanggan">';
        } else {
            echo "Gagal menyimpan data karena : " . mysqli_error($koneksi);
        }
    }
}

  ?>

<?php
}
?>