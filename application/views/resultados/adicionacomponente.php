<?php
include 'conecta.php';
include 'sessao.php';
$maquina= $_POST["maquina"];
$descricao = strtoupper($_POST["descricao"]);
$descricao=preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $descricao ) );
$descricao = strtoupper($descricao);
$frequencia =$_POST["frequencia"];
$ultima =$_POST["ultima"];
$verificacao =$_POST["verificacao"];


   $proxima=date('d/m/Y', strtotime("+$frequencia days",strtotime($ultima)));

  $proxima = str_replace('/', '-', $proxima);

 $proxima=date('Y-m-d', strtotime($proxima));





$sql = "insert into componente(maquina,descricao,frequencia,dataultima,dataproxima,verificacao)values('$maquina','$descricao','$frequencia','$ultima','$proxima','$verificacao')";
$conn->query($sql);
$componente=mysql_insert_id();

$sql1 = "insert into preventiva(maquina,componente,data,obs)values('$maquina','$componente','$ultima','$verificacao')";
$conn->query($sql1);

echo "<script>window.location='../dados/componente';alert('Cadatro Efetuado com Sucesso!!');</script>";
