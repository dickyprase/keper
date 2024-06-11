<?php
function writeMsg($tipe){
	if ($tipe=='save.sukses') {
		$MsgClass = "alert-success";
		$Msg = "<strong>Sukses!</strong> Data berhasil disimpan!";	
	} else 
	if ($tipe == 'save.gagal') {
		$MsgClass = "alert-danger";
		$Msg = "<strong>Oops!</strong> Data gagal disimpan!";
	}
	else 
	if ($tipe == 'update.sukses') {
		$MsgClass = "alert-success";
		$Msg = "<strong>Sukses!</strong> Data berhasil diupdate!";
	}
	else 
	if ($tipe == 'update.gagal') {
		$MsgClass = "alert-danger";
		$Msg = "<strong>Oops!</strong> Data gagal diupdate!";
	}
	else 
	if ($tipe == 'paket.sama') {
		$MsgClass = "alert-danger";
		$Msg = "<strong>Maaf!</strong> Kode paket sudah terpakai!";
	}
	else 
	if ($tipe == 'pelanggan.sama') {
		$MsgClass = "alert-danger";
		$Msg = "<strong>Maaf!</strong> ID Pelanggan sudah terpakai!";
	}
	else 
	if ($tipe == 'data.lebih') {
		$MsgClass = "alert-danger";
		$Msg = "<strong>Maaf!</strong> Anda cuma bisa input 5 data!";
	}
	else 
	if ($tipe == 'invoice.sama') {
		$MsgClass = "alert-danger";
		$Msg = "<strong>Maaf!</strong> No Invoice sudah ada!";
	}


echo "<div class=\"alert alert-dismissible ".$MsgClass."\">
  	  <button type=\"button\" class=\"close\" data-dismiss=\"alert\">×</button>
  	  ".$Msg."
	  </div>";		  
}

function TanggalIndo($date){
	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
 
	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$tgl   = substr($date, 8, 2);
 
	$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;		
	return($result);
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

	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

	return $namaFileBaru;
}

?>