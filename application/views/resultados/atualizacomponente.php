<?php

include "conecta.php";

$codigo =$_POST["codigo"];
$maquina= $_POST["maquina"];
$descricao = strtoupper($_POST["descricao"]);
$descricao=preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $descricao ) );
$descricao = strtoupper($descricao);
$frequencia =$_POST["frequencia"];
$ultima =$_POST["ultima"];
$verificacao =$_POST["verificacao"];

$obs = strtoupper($_POST["obs"]);
$obs=preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $obs) );
$obs = strtoupper($obs);


   $proxima=date('d/m/Y', strtotime("+$frequencia days",strtotime($ultima)));

  $proxima = str_replace('/', '-', $proxima);

 $proxima=date('Y-m-d', strtotime($proxima));



$update="update componente set 	idcomponente='$codigo',maquina='$maquina',descricao='$descricao',dataultima='$ultima',frequencia='$frequencia',dataproxima='$proxima',verificacao='$verificacao' where idcomponente='$codigo'";


$sql1 = "insert into preventiva(maquina,componente,data,obs)values('$maquina','$codigo','$ultima','$obs')";
$conn->query($sql1);


$conn->query($update);

redirect('dados/componente');


?>
