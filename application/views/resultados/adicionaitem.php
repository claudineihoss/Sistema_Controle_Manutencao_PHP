<?php
include 'conecta.php';
include 'sessao.php';
$descricao = $_POST['descricao'];

$encoding = 'UTF-8'; // ou ISO-8859-1...
$descricao=mb_convert_case($descricao, MB_CASE_UPPER, $encoding);

$sql = "insert into itens(descricao) 
values('$descricao')";
$conn->query($sql);

echo "<script>window.location='../dados/itenschecklist';alert('Cadatro Efetuado com Sucesso!!');</script>";
