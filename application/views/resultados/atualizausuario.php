<?php

include "conecta.php";
$codigo=$_POST["codigo"];

$senha= mysqli_real_escape_string($conn, $_POST['senha']);
$senha = md5($senha);



$update="update users_bi set senha='$senha' where id='$codigo'";

$conn->query($update);

redirect('dados/usuario');


?>
