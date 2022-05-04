<?php
include 'conecta.php';
include 'sessao.php';
$codigo = $_POST['codigo'];
$descricao = strtoupper($_POST['descricao']);
$local = $_POST['local'];
$frequencia= $_POST['frequencia'];
$dataultima= $_POST['dataultima'];

$proxima=date('d/m/Y', strtotime("+$frequencia days",strtotime($dataultima)));

$proxima = str_replace('/', '-', $proxima);

$proxima=date('Y-m-d', strtotime($proxima));


$sql = "insert into maquina(numero,descricao,local,frequencia,dataultima,dataproxima) 
values('$codigo','$descricao','$local','$frequencia','$dataultima','$proxima')";
$conn->query($sql);

echo "<script>window.location='../dados/maquina';alert('Cadatro Efetuado com Sucesso!!');</script>";
