<html>
<head>
<style type="text/css" media="print">
	table {border: solid 1px #000; border-collapse: collapse; width: 100%}
	tr { border: solid 1px #000; page-break-inside: avoid;}
	td { padding: 7px 5px; font-size: 10px}
	th {
		font-family:Arial;
		color:black;
		font-size: 11px;
		background-color:lightgrey;
	}
	thead {
		display:table-header-group;
	}
	tbody {
		display:table-row-group;
	}
	h3 { margin-bottom: -17px }
	h2 { margin-bottom: 0px }
</style>
<style type="text/css" media="screen">
	table {border: solid 1px #000; border-collapse: collapse; width: 100%}
	tr { border: solid 1px #000}
	th {
		font-family:Arial;
		color:black;
		font-size: 11px;
		background-color: #999;
		padding: 8px 0;
	}
	td { padding: 7px 5px;font-size: 10px}
	h3 { margin-bottom: -17px }
	h2 { margin-bottom: 0px }
</style>
<title>Cetak Rekap Pembayaran</title>
</head>

<body onLoad="window.print()">
<center><b style="font-size: 20px">Rekap Laporan Pembayaran</b><br>
<table class="table table-hover table-bordered table-striped">
	<thead>
	    <tr class="info">
	      <th>#</th>
	      <th>No Invoice</th>
	      <th>Nama User</th>
	      <th>Tgl Bayar</th>
	      <th>Tgl Validasi</th>
	      <th>Total</th>
	      <th>Status</th>     
	    </tr>
  	</thead>
	<tbody align="center">
		<?php
		require_once('../inc/config.php');
		include "../inc/function.php";
		$dari = $_POST['dari'];
		$sampai = $_POST['sampai']; //get the nama value from form
		$id = $_POST['id'];
		$level = $_POST['level'];
		if ($level == 'admin') {
			$q = "select a.id_transaksi, b.nama, a.nominal, a.bukti, a.tgl_bayar, a.tgl_validasi, a.status from t_transaksi a join t_users b on a.id_user=b.id WHERE tgl_bayar >= '$dari' AND tgl_bayar <= '$sampai' ORDER BY id_transaksi DESC";
		} else {
			$q = "select a.id_transaksi, b.nama, a.nominal, a.bukti, a.tgl_bayar, a.tgl_validasi, a.status from t_transaksi a join t_users b on a.id_user=b.id WHERE tgl_bayar >= '$dari' AND tgl_bayar <= '$sampai' AND id_user = '$id' ORDER BY id_transaksi DESC";
		}
		$result = mysqli_query($koneksi, $q) or die(mysqli_error($koneksi));
		$no = 1;
		$subtotal = 0; // initialize subtotal variable
		while ($data = mysqli_fetch_array($result)) { //fetch the result from query into an array
			$subtotal += $data['nominal']; // add the nominal value to subtotal
		?>
			<tr>
				<td><?php echo $no++; ?></td> <!--menampilkan nomor dari variabel no-->
				<td>INVOICE-00<?php echo $data['id_transaksi'] ?></td> <!--menampilkan data id transaksi dari tabel pelanggan-->
				<td><?php echo ucfirst($data['nama']) ?></td>
				<td><?php echo TanggalIndo($data['tgl_bayar']); ?></td> <!--menampilkan data tanggal bayar dari tabel pelanggan-->
				<td><?php
					if ($data['tgl_validasi'] == '0000-00-00') {
						echo "belum validasi";
					} else {
						echo TanggalIndo($data['tgl_validasi']);
					} ?></td> <!--menampilkan data tanggal validasi dari tabel pellangan-->
				<td><?php echo "Rp." . number_format($data['nominal'], 0, ',', '.'); ?></td> <!--menampilkan data nominal dari tabel pellangan-->
				<td><?php echo ucfirst($data['status']) ?></td> <!--menampilkan data status dari tabel pellangan-->
			</tr>
		<?php
		}
		?>
		<tr>
			<td colspan="5" align="right"><b>Subtotal:</b></td>
			<td><b><?php echo "Rp." . number_format($subtotal, 0, ',', '.'); ?></b></td>
			<td></td>
		</tr>
	</tbody>

</body>
</html>
