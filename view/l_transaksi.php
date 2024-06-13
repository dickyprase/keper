<?php
$id = $_SESSION['id'];

?>
<ul class="breadcrumb">
  <li><a href="./">Home</a></li>
  <li class="active"><?php echo ucfirst($page) ; ?></li>
</ul>
<div class="btn-group" >
  <a href="?page=transaksi&aksi=tambah" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah Data</a>
</div>

<br/><br/>
<?php 
  if ($action == ""){

?>
<table class="table table-hover table-bordered table-striped">
	<thead>
	    <tr class="info">
	      <th>#</th>
        <th>Id Transaksi</th>
        <th>Nama Pelanggan</th>
	      <th>Tgl Bayar</th>
	      <th>Tgl Validasi</th>
	      <th>Total</th>
	      <th>Status</th>
        <th>File</th>                      
        <th>Aksi</th>       
	    </tr>
  	</thead>
  	<tbody align="center">
  		
      <?php
        if($_SESSION['level'] == 'admin'){
          $query = mysqli_query($koneksi, "select a.id_transaksi, b.nama, a.nominal, a.bukti, a.tgl_bayar, a.tgl_validasi, a.status from t_transaksi a join t_users b on a.id_user=b.id") or die (mysqli_error($koneksi));   
        } else {
          $query = mysqli_query($koneksi, "select a.id_transaksi, b.nama, a.nominal, a.bukti, a.tgl_bayar, a.tgl_validasi, a.status from t_transaksi a join t_users b on a.id_user=b.id WHERE id_user='$_SESSION[id]' order by id_transaksi ASC ") or die (mysqli_error($koneksi));  
        }

        $no = 1;
        while($lihat = mysqli_fetch_array($query)){  
        ?>    
      <tr>
        <td><?php echo $no++; ?></td>     
        <td><?php echo $lihat['id_transaksi'] ?></td>  
        <td><?php echo $lihat['nama'] ?></td>
        <td><?php echo TanggalIndo($lihat['tgl_bayar']); ?></td>     
        <td><?php
        if ($lihat['tgl_validasi'] == '0000-00-00'){
        echo "<span class='label label-warning'>".ucwords("belum validasi")."</span>";
        }else{
        echo TanggalIndo($lihat['tgl_validasi']); 
        }?></td>     
        <td><?php echo "Rp." . number_format( $lihat['nominal'] , 0 , ',' , '.' ); ?></td>    
        <td><?php if ($lihat['status']=='lunas'){ ?>
          <span class="label label-success"><?php echo ucfirst($lihat['status']) ?></span>
          <?php }else{ ?>
          <span class="label label-danger"><?php echo ucfirst($lihat['status']) ?></span>
          <?php }?>
        </td>    
        <td> <img src="img/<?= $lihat['bukti'] ?>" class="thumbnail span3" style="display: inline; float: left; margin-right: 20px; width: 90px; height: 90px"></td>    
        
        <td align="center">          
  				
          <a href="?page=transaksi&aksi=edit&id=<?php echo $lihat['id_transaksi'] ;?>" class="btn btn-info btn-sm" title="Edit Data"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> 
          <a href="?page=transaksi&aksi=delete&id=<?php echo $lihat['id_transaksi'] ;?>" onclick="javascript: return confirm('Anda yakin akan menghapus data ini ?')" class="btn btn-danger btn-sm" title="Hapus Data"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>  		    
          <?php if($lihat['status']=='lunas'){
            ?>
          <a href="view/cetak_invoice.php?&id=<?php echo $lihat['id_transaksi'] ;?>" name="cetak" target="_blank" class="btn btn-info btn-sm" title="Cetak"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></a>
          <?php
          }else{
          ?>
          <a href="#" target="_blank" class="btn btn-info btn-sm disabled" title="Cetak"><span class="glyphicon glyphicon-print" aria-hidden="true"></span></a>
          <?php
          }
          ?>
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
$hapus=mysqli_query($koneksi, "DELETE from t_transaksi WHERE id_transaksi='$_GET[id]'") or die(mysqli_error($koneksi));
echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=transaksi">';

}else{
  echo "maaf aksi tidak ditemukan";
}
?>
