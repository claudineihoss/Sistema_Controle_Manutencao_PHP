<?php

include "conecta.php";

$codigo =$_POST["codigo"];
$maquina= $_POST["maquina"];
$componente= $_POST["componente"];
$obs = $_POST['obs'];
$encoding = 'UTF-8'; // ou ISO-8859-1...
$obs=mb_convert_case($obs, MB_CASE_UPPER, $encoding);
$datainicio =$_POST["datainicio"];
$datafim =$_POST["datafim"];

$update="update corretiva set 	idcorretiva='$codigo',maquina='$maquina',componente='$componente',datainicio='$datainicio',obs='$obs',datafim='$datafim' where idcorretiva='$codigo'";

$conn->query($update);

redirect('dados/corretiva');


?>
