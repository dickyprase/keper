<?php
$id = $_SESSION['id'];
$level = $_SESSION['level'];
?>
<ul class="breadcrumb">
  <li><a href="./">Home</a></li>
  <li class="active"><?php echo ucfirst($page) ; ?></li>
</ul>

<form class="form-inline" method="post" action="view/cetak_laporan.php" target="_blank">
  <legend>Rekap Data Transaksi</legend
>  <div class="form-group">
    <label for="exampleInputName2">Dari</label>
    <input type="text" class="form-control" id="dari" name="dari" placeholder="Dari">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail2">Sampai</label>
    <input type="text" class="form-control" id="sampai" name="sampai" placeholder="Sampai">
  </div>
  <input type="hidden" name="id" value="<?php echo "$_SESSION[id]" ;?>">
  <input type="hidden" name="level" value="<?php echo "$_SESSION[level]" ;?>">
  <button type="submit" class="btn btn-info">Cetak</button>
</form>
