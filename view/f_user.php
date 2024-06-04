<?php
  session_start();
  include "./inc/function.php";
  if($_SESSION['level']=="operator"){
  header("location:index.php");
}else{
?>
<ul class="breadcrumb">
  <li><a href="./">Home</a></li>
  <li><a href="?page=<?php echo $page ;?>"><?php echo ucfirst($page) ; ?></a></li>
  <li class="active"><?php echo ucfirst($action) ; ?> Data</li>
</ul>
<fieldset>
	<legend>Tambah Data User</legend>
	<form class="form-horizontal"  method="post">	  
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Username</label>
	    <div class="col-sm-3">
	      <input type="text" class="form-control" name="username" placeholder="Username">
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Password</label>
	    <div class="col-sm-3">
	      <input type="password" class="form-control" name="password" placeholder="Password">
	    </div>
	  </div> 
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Level</label>
	    <div class="col-sm-3">
	      	<select name="level" class="form-control">
				<option value="">--Pilih Level--</option>
				<option value="admin">Admin</option>
				<option value="pelanggan">Pelanggan</option>
			</select>
	    </div>
	  </div> 
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	    <button type="reset" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Reset</button>
        <button type="submit" name="simpan" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Tambah</button>
        <a href="?page=user" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Batal </a>
	    </div>
	  </div>
	  <?php  
  
	  ?>
	</form>
</fieldset>
<?php

if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    $cekdata = "SELECT username FROM t_user WHERE username='$username'";
    $ada = mysqli_query($koneksi, $cekdata);

    if (mysqli_num_rows($ada) > 0) {
        echo '<b>Username sudah ada</b>';
    } else {
        $query = "INSERT INTO t_user VALUES (null, '$username', md5('$password'), '$level')";
        if (mysqli_query($koneksi, $query)) {
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=user">';
        } else {
            echo "Gagal menyimpan data karena : " . mysqli_error($koneksi);
        }
    }
}

  ?>

<?php
}
?>