<?php


$bd_servidor = "localhost";
$bd_usuario  = "root";
$bd_senha    = "111213";
$bd_banco    = "manutencao";



date_default_timezone_set('America/Sao_Paulo');
$conn= new mysqli($bd_servidor, $bd_usuario, $bd_senha, $bd_banco); 
$conn->set_charset("utf8");
if (mysqli_connect_errno()) trigger_error(mysqli_connect_error());

