<?php
  error_reporting(0);
  session_start();
  if($_SESSION['level']=="pelanggan"){
  header("location:index.php");
}else{
?>
<ul class="breadcrumb">
  <li><a href="./">Home</a></li>
  <li class="active"><?php echo ucfirst($page) ; ?></li>
</ul>
<div class="btn-group" >
  <a href="?page=user&aksi=tambah" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Data</a>
</div>

<br/><br/>
<?php 
  if ($action == ""){
?>
<table class="table table-hover table-bordered table-striped">
  <thead>
      <tr class="info">
        <th>#</th>
        <th>ID User</th>
        <th>Username</th>
        <th>Password</th>
        <th>Level</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $query = "SELECT * FROM t_user WHERE level != 'admin'";
        $result = mysqli_query($koneksi, $query);
        $no=1;
        while ($lihat = mysqli_fetch_array($result)) {
        ?>    
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $lihat['id'] ?></td>
        <td><?php echo $lihat['username'] ?></td>
        <td><?php echo "*******" ?></td>
        <td><?php echo $lihat['level'] ?></td>
        
        <td align="center">
          <a href="?page=user&aksi=edit&id=<?php echo $lihat['id_pelanggan'] ;?>" class="btn btn-info btn-sm" title="Edit Data"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> 
          <a href="?page=user&aksi=delete&id=<?php echo $lihat['id_pelanggan'] ;?>" onclick="javascript: return confirm('Anda yakin akan menghapus data ini ?')" class="btn btn-danger btn-sm" title="Hapus Data"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
      </td>
      </tr>
      <?php
        }
      ?>
    </tbody>

</table>
  <ul class="pagination">
    <li class="disabled"><a href="#">«</a></li>
    <li class="active"><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li><a href="#">»</a></li>
  </ul>
<?php
}else if($action == "delete"){
  $id = $_GET['id'];

  $query = "DELETE FROM t_user WHERE id='$id'";
  if (mysqli_query($koneksi, $query)) {
      echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=user">';
  } else {
      die("Gagal menghapus data karena : " . mysqli_error($koneksi));
  }

}else{
  echo "maaf aksi tidak ditemukan";
}
}
  ?>