<?php

include "conecta.php";
$codigo=$_POST["codigo"];
$numero=$_POST["numero"];
$descricao=$_POST["descricao"];
$local= $_POST['local'];
$frequencia= $_POST['frequencia'];
$dataultima= $_POST['dataultima'];

$proxima=date('d/m/Y', strtotime("+$frequencia days",strtotime($dataultima)));

$proxima = str_replace('/', '-', $proxima);

$proxima=date('Y-m-d', strtotime($proxima));




$update="update maquina set numero='$numero',descricao='$descricao',local='$local',frequencia='$frequencia',dataultima='$dataultima',dataproxima='$proxima' where idmaquina='$codigo'";


$conn->query($update);

redirect('dados/maquina');


?>
