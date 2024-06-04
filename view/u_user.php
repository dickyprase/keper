<?php
include "./inc/config.php";
include "./inc/function.php";
$id = $_SESSION['id'];
?>
<ul class="breadcrumb">
  <li><a href="./">Home</a></li>
  <li><a href="?page=<?php echo $page ;?>"><?php echo ucfirst($page) ; ?></a></li>
  <li class="active"><?php echo ucfirst($action) ; ?> Data</li>
</ul>
      <?php
        $query = "SELECT * FROM t_user WHERE id='" . $_GET['id'] . "'";
          $result = mysqli_query($koneksi, $query);

          $no = 1;
          while ($lihat = mysqli_fetch_array($result)) {
      ?> 
<form class="form-horizontal" method="POST">
  <fieldset>
    <legend>Update Data User</legend>
    <div class="form-group">
      <label class="col-sm-2 control-label">ID User</label>
      <div class="col-sm-3">
        <input disabled type="text" class="form-control" name="id" required value="<?= $lihat['id'] ;?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Username</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="username" value="<?php echo $lihat['username'] ;?>">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Password</label>
      <div class="col-sm-3">
        <input type="text" class="form-control" name="password" value="*****">
      </div>
    </div>
    <div class="form-group">
      <label class="col-sm-2 control-label">Level</label>
      <div class="col-sm-3">
        <select name="level" class="form-control">
          <option <?php if( $lihat['level']=='admin'){echo "selected"; } ?> value='admin'>Admin</option>
          <option <?php if( $lihat['level']=='pelanggan'){echo "selected"; } ?> value='pelanggan'>Pelanggan</option>          
        </select>
      </div>
    </div>  
   
   <input type="hidden" name="id_pelanggan" value="<?php echo "$_SESSION[id]" ;?>">
    <div class="form-group">
      <div class="col-sm-10 col-sm-offset-2">
        <button type="reset" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Reset</button>
        <button type="submit" name="simpan" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Simpan</button>
        <a href="?page=user" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Batal </a>
      </div>
    </div>
  </fieldset>

</form>
<?php
};
?>
  <?php 
  if (isset($_POST['simpan'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $level = $_POST['level'];
      $id = $_POST['id'];
  
      $query = "UPDATE t_user SET username='$username', password=MD5('$password'), level='$level' WHERE id=$id";
      if (mysqli_query($koneksi, $query)) {
          echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=user">';
      } else {
          die("Gagal menyimpan data karena : " . mysqli_error($koneksi));
      }
    }
  ?>