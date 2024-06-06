<ul class="breadcrumb">
  <li><a href="./">Home</a></li>
  <li><a href="?page=<?php echo $page ;?>"><?php echo ucfirst($page) ; ?></a></li>
  <li class="active"><?php echo ucfirst($action) ; ?> Pelanggan</li>
</ul>
 <?php

	$query = "SELECT t_users.*, t_paket.nama AS nama_paket, t_paket.harga FROM t_users LEFT JOIN t_paket ON t_users.id_paket = t_paket.id WHERE t_users.id='" . $_GET['id'] . "'";
	$result = mysqli_query($koneksi, $query);

	$data = mysqli_fetch_array($result);


 ?>
<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">Detail Pelanggan</h3>
  </div>
  <div class="panel-body">
  					<div class="form-horizontal" role="form">
                				  
					  <div class="form-group">
						<label class="col-sm-2 control-label">ID Pelanggan</label>
						<div class="col-sm-10">
							<label class="col-sm-0 control-label">:</label>
							<label class="col-sm-0 control-label"><?php echo $data['id']; ?></label>
						</div>
					  </div>					  
					  <div class="form-group">
						<label class="col-sm-2 control-label">Nama </label>
						<div class="col-sm-10">
							<label class="col-sm-0 control-label">:</label>
							<label class="col-sm-0 control-label"><?php echo $data['nama']; ?></label>
						</div>
					  </div>					  
					  <div class="form-group">
						<label class="col-sm-2 control-label">Alamat</label>
						<div class="col-sm-10">
							<label class="col-sm-0 control-label">:</label>
							<label class="col-sm-0 control-label"><?php echo $data['alamat']; ?></label>
						</div>
					  </div>
					  <div class="form-group">
						<label class="col-sm-2 control-label">No. Telp</label>
						<div class="col-sm-10">
							<label class="col-sm-0 control-label">:</label>
							<label class="col-sm-0 control-label"><?php echo $data['no_hp']; ?></label>
						</div>
					  </div>
					  <div class="form-group">
						<label class="col-sm-2 control-label">Email</label>
						<div class="col-sm-10">
							<label class="col-sm-0 control-label">:</label>
							<label class="col-sm-0 control-label"><?php echo $data['email']; ?></label>
						</div>
					  </div>
					  <div class="form-group">
						<label class="col-sm-2 control-label">Paket</label>
						<div class="col-sm-10">
							<label class="col-sm-0 control-label">:</label>
							<label class="col-sm-0 control-label"><?php echo $data['nama_paket']; ?></label>
						</div>
					  </div>
					  <div class="form-group">
						<label class="col-sm-2 control-label">username</label>
						<div class="col-sm-10">
							<label class="col-sm-0 control-label">:</label>
							<label class="col-sm-0 control-label"><?php echo $data['username']; ?></label>
						</div>
					  </div>
					  <div class="form-group">
						<label class="col-sm-2 control-label">password</label>
						<div class="col-sm-10">
							<label class="col-sm-0 control-label">:</label>
							<label class="col-sm-0 control-label"><?php echo $data['password'] ?> => [encrypted]</label>
						</div>
					  </div>
					  <div class="form-group">
						<label class="col-sm-2 control-label">Harga</label>
						<div class="col-sm-10">
							<label class="col-sm-0 control-label">:</label>
							<label class="col-sm-0 control-label"><?php echo "Rp.".number_format($data['harga'], 0, ',', '.'); ?></label>
						</div>
					  </div>
					  <div class="btn-group">
						<?php 
							echo "<a href=\"?page=pelanggan\" class=\"btn btn-primary\"><span class=\"glyphicon glyphicon-arrow-left\"></span> Kembali</a>"; 
						?> 
					  </div>
					</div>
  </div>
</div>


					