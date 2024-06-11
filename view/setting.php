<?php
  if($_SESSION['level']=="pelanggan"){
  header("location:index.php");
}else{
?>
<ul class="breadcrumb">
  <li><a href="./">Home</a></li>
  <li class="active"><?php echo ucfirst($page) ; ?></li>
</ul>
<?php
	$data = mysqli_query($koneksi, "SELECT * FROM t_setting where id='1' LIMIT 1 ") or die (mysqli_error($koneksi));
	$r = mysqli_fetch_array($data);

?>
<fieldset>
	<legend>Data Profil Toko</legend>
	<form class="form-horizontal"  method="post" enctype="multipart/form-data">	  
		<input type="hidden" name="gambarLama" value="<?= $r['logo'] ?>">
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Nama Toko</label>
	    <div class="col-sm-4">
	      <input type="text" name="nama" value="<?php echo $r['nama']; ?>" class="form-control" placeholder="Nama Toko">
	    </div>
	  </div>	  
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Alamat</label>
	    <div class="col-sm-5">
	      <textarea class="form-control" name="alamat" rows="3"><?php echo $r['alamat']; ?></textarea>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Nama Pemilik</label>
	    <div class="col-sm-3">
	      <input type="text" class="form-control" value="<?php echo $r['pemilik']; ?>" name="pemilik" placeholder="Nama Pemilik">
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Logo</label>
	    <div class="col-sm-4">
		<img src="img/<?= $setting['logo'] ?>" class="thumbnail span3" style="display: inline; float: left; margin-right: 20px; width: 130px; height: 130px">
	      <input type="file" class="form-control" name="gambar">
	    </div>
	  </div>	  
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	    <button type="submit" name="simpan" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Simpan</button>
        <a href="./" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Kembali </a>
	    </div>
	  </div>
	  <?php  

  // buatkan edit data nya untuk semua form, kondisikan jika gambar tidak diisi maka gunakan gambar lama jika tidak maka gunakan gambar yang baru
if(isset($_POST['simpan'])){

	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$pemilik = $_POST['pemilik'];
	$gambar = $_FILES['gambar']['name'];
	$gambarLama = $_POST['gambarLama'];
	$tmp = $_FILES['gambar']['tmp_name'];
	$path = "img/".$gambar;

	if($gambar == ""){
	  $query = "UPDATE t_setting SET nama='$nama', alamat='$alamat', pemilik='$pemilik' WHERE id='1'";
	  $sql = mysqli_query($koneksi, $query);
	  if($sql){
		echo "<script>alert('Data berhasil diupdate!');document.location.href='?page=setting'</script>";
	  }else{
		echo "<script>alert('Data gagal diupdate!');document.location.href='?page=setting'</script>";
	  }
	}else{
	  if(move_uploaded_file($tmp, $path)){
		$query = "UPDATE t_setting SET nama='$nama', alamat='$alamat', pemilik='$pemilik', logo='$gambar' WHERE id='1'";
		$sql = mysqli_query($koneksi, $query);
		if($sql){
		  echo "<script>alert('Data berhasil diupdate!');document.location.href='?page=setting'</script>";
		}else{
		  echo "<script>alert('Data gagal diupdate!');document.location.href='?page=setting'</script>";
		}
	  }else{
		echo "<script>alert('Data gagal diupdate!');document.location.href='?page=setting'</script>";
	  }
	}	
}


	  ?>
	</form>
</fieldset>
<?php
}
?>