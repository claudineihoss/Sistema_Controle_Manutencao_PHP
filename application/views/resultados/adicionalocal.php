<?php
include 'conecta.php';
include 'sessao.php';
$local = strtoupper($_POST['local']);

$sql = "insert into local(descricao) 
values('$local')";
$conn->query($sql);

echo "<script>window.location='../dados/local';alert('Cadatro Efetuado com Sucesso!!');</script>";
