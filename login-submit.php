<?php
	session_start(); 		
	include 'inc/config.php'; 		
	$username=$_POST['username']; 
	$password=$_POST['password']; 	
	
	if(isset($_POST['btnSubmit'])){
		
	
		$query = "SELECT * FROM t_user WHERE username='$username' AND password=MD5('$password')";
		$result = mysqli_query($koneksi, $query);
	
		if (!$result) {
			die("Error: " . mysqli_error($conn));
		}
	
		$data = mysqli_num_rows($result);
		$r = mysqli_fetch_assoc($result);
	
		if ($data == 1) {
			session_start();
			$_SESSION['username'] = $username;
			$_SESSION['level'] = $r['level'];
			$_SESSION['id'] = $r['id'];
			header("location:index.php");
		} else {
			header("location:login.php");
		}
	
	}
	

	

?>