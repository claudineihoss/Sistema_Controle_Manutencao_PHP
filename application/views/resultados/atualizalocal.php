<?php

include "conecta.php";
$codigo=$_POST["codigo"];

$local= strtoupper($_POST['local']);



$update="update local set descricao='$local' where idlocal='$codigo'";

$conn->query($update);

redirect('dados/local');


?>
