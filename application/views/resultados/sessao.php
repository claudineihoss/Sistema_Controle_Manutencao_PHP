<?php

include 'conecta.php';
@session_start();

$login=$_SESSION['login'];
$senha=$_SESSION['senha'];

if (empty($login)) {  
  echo "<script>window.location='../primeiro/index';</script>";
}

$result_usuario = "SELECT * FROM users_bi WHERE login = '$login' && senha = '$senha'";
  if ($result=mysqli_query($conn,$result_usuario)) {
    $rowcount=mysqli_num_rows($result);
}

  if ($rowcount == 0) {
	echo "<script>window.location='../primeiro/index';</script>";

    }

 			
?>

      
			
     
			
     
