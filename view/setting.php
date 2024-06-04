<?php
  //error_reporting(0);
  session_start();
  if($_SESSION['level']=="pelanggan"){
  header("location:index.php");
}else{
?>
<ul class="breadcrumb">
  <li><a href="./">Home</a></li>
  <li class="active"><?php echo ucfirst($page) ; ?></li>
</ul>
<?php

	
	$query = "SELECT * FROM t_setting WHERE id=1 LIMIT 1";
	$result = mysqli_query($koneksi, $query);

    //$row = mysqli_fetch_assoc($result);
    while ($row = mysqli_fetch_array($result)) {

?>
<fieldset>
	<legend>Data Profil Toko</legend>
	<form class="form-horizontal"  method="post" enctype="multipart/form-data">	
	<input type="hidden" name="gambarLama" value="<?= $row['logo'] ?>"/>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Nama Toko</label>
	    <div class="col-sm-4">
	      <input type="text" name="nama" value="<?php echo $row['nama']; ?>" class="form-control" placeholder="Nama Toko">
	    </div>
	  </div>	  
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Alamat</label>
	    <div class="col-sm-5">
	      <textarea class="form-control" name="alamat" rows="3"><?php echo $row['alamat']; ?></textarea>
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Nama Pemilik</label>
	    <div class="col-sm-3">
	      <input type="text" class="form-control" value="<?php echo $row['pemilik']; ?>" name="pemilik" placeholder="Nama Pemilik">
	    </div>
	  </div>
	  <div class="form-group">
	    <label class="col-sm-2 control-label">Logo</label>
	    <div class="col-sm-4">
    	  <img src="img/<?= $setting['logo'] ?>" alt="Preview" width="100px">	
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
    }
    



function upload() {

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek apakah tidak ada gambar yang diupload
	if( $error === 4 ) {
		echo "<script>
				alert('pilih gambar terlebih dahulu!');
			  </script>";
		return false;
	}

	// cek apakah yang diupload adalah gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		echo "<script>
				alert('yang anda upload bukan gambar!');
			  </script>";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if( $ukuranFile > 1000000 ) {
		echo "<script>
				alert('ukuran gambar terlalu besar!');
			  </script>";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

	return $namaFileBaru;
}
	  
  
	  if(isset($_POST['simpan']))
	  {
	      
	    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
		$alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
		$pemilik = mysqli_real_escape_string($koneksi, $_POST['pemilik']);
		$gambarLama = mysqli_real_escape_string($koneksi, $_POST['gambarLama']);
		
		if( $_FILES['gambar']['error'] === 4 ) {
			$gambar = $gambarLama;
		} else {
			$gambar = upload();
		}
		

		$query = "UPDATE t_setting SET nama = '$nama', alamat = '$alamat', pemilik = '$pemilik', logo= '$gambar' WHERE id = 1";
		
		if (mysqli_query($koneksi, $query)) {
		    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=index.php">';
		} else {
		    echo "Error dalam eksekusi query: " . mysqli_error($conn);
		}
	  }
	  ?>
	</form>
</fieldset>
<?php
}
?>