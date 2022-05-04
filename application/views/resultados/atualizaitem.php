<?php

include "conecta.php";
$codigo=$_POST["codigo"];

$item= strtoupper($_POST['item']);



$update="update itens set descricao='$item' where id='$codigo'";

$conn->query($update);

redirect('dados/itenschecklist');


?>
