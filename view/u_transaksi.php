<?php
$id = $_SESSION['id'];

?>
<ul class="breadcrumb">
  <li><a href="./">Home</a></li>
  <li><a href="?page=<?php echo $page ;?>"><?php echo ucfirst($page) ; ?></a></li>
  <li class="active"><?php echo ucfirst($action) ; ?> Data</li>
</ul>
      <?php
        $query=mysqli_query($koneksi, "SELECT * from t_transaksi WHERE id_transaksi='$_GET[id]' " ) or die (mysqli_error($koneksi));
        $no=1;
        while($lihat=mysqli_fetch_array($query)){
      ?> 
<form class="form-horizontal" method="POST">
  <fieldset>
    <legend>Update Data Transaksi</legend>
    <div class="form-group">
      <label class="col-sm-2 control-label">Id Transaksi</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" readonly name="idtrx" required value="<?php echo $lihat['id_transaksi'] ;?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Tanggal Bayar</label>
      <div class="col-sm-3">
        <input type="text" id="datepicker" class="form-control" name="tgl_bayar" value="<?php echo $lihat['tgl_bayar'] ;?>">
      </div>
    </div>
    
    <?php if($_SESSION['level'] == 'admin'){ ?>
    <div class="form-group">
      <label class="col-sm-2 control-label">Tanggal Validasi</label>
      <div class="col-sm-3">
        <input type="text" id="tgl_validasi" class="form-control" name="tgl_validasi" value="<?php echo $lihat['tgl_validasi'] ;?>">
      </div>
    </div>
    
    <?php } ?>
    <div class="form-group">
      <label class="col-sm-2 control-label">Jumlah Bayar</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="nominal" value="<?php echo $lihat['nominal'] ;?>">
      </div>
    </div>
    
    <?php if($_SESSION['level'] == 'admin'){ ?>  
    <div class="form-group">
      <label class="col-sm-2 control-label">Status</label>
      <div class="col-sm-3">

      <select name="status" class="form-control">
        <option value="<?= $lihat['status'] ?>" selected>(<?= $lihat['status'] ?>)</option>
        <option value="lunas">Lunas</option>
        <option value="pending">Pending</option>
      </select>
        
      </div>
    </div>  
    
    <?php } ?>
    <div class="form-group">
      <label class="col-sm-2 control-label">Bukti Pembayaran</label>
      <div class="col-sm-3">
        <img src="img/<?= $lihat['bukti'] ?>" class="thumbnail span3" style="display: inline; float: left; margin-right: 20px; width: 130px; height: 130px">
      </div>
    </div> 
   
   <input type="hidden" name="id" value="<?= $_SESSION['id'] ?>">
    <div class="form-group">
      <div class="col-sm-10 col-sm-offset-2">
        
        <button type="submit" name="simpan" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Simpan</button>
        <a href="?page=transaksi" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Batal </a>
      </div>
    </div>
  </fieldset>

</form>
<?php
};
?>
  <?php 
  if(isset($_POST['simpan'])){
      $query=mysqli_query($koneksi, "UPDATE t_transaksi SET tgl_bayar='{$_POST['tgl_bayar']}', tgl_validasi='{$_POST['tgl_validasi']}', nominal='{$_POST['nominal']}', status='{$_POST['status']}' WHERE id_transaksi='{$_GET['id']}'") or die(mysqli_error($koneksi));
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=transaksi">';
  } 
  ?>