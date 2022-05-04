<?php
include 'conecta.php';
include 'sessao.php';
$maquina= $_POST["maquina"];
$componente= $_POST["componente"];
$obs = strtoupper($_POST["obs"]);
$obs = $_POST['obs'];
$encoding = 'UTF-8'; // ou ISO-8859-1...
$obs=mb_convert_case($obs, MB_CASE_UPPER, $encoding);
$datainicio =$_POST["datainicio"];
$datafim=$_POST["datafim"];



$sql = "insert into corretiva(maquina,componente,datainicio,obs,datafim)values('$maquina','$componente','$datainicio','$obs','$datafim')";
$conn->query($sql);

echo "<script>window.location='../dados/corretiva';alert('Cadatro Efetuado com Sucesso!!');</script>";
