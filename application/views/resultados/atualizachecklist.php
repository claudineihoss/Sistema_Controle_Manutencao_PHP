<?php
include 'conecta.php';
include 'sessao.php';
$checklist = $_POST['checklist'];
$maquina = $_POST['maquina'];
$descricao = strtoupper($_POST['descricao']);
$data = $_POST['data'];

$sql_frequencia=$conn->query("select frequencia from maquina where idmaquina='$maquina'");
$busca_frequencia=$sql_frequencia->fetch_array();
$frequencia=$busca_frequencia['0'];

$proxima=date('d/m/Y', strtotime("+$frequencia days",strtotime($data)));

$proxima = str_replace('/', '-', $proxima);

$proxima=date('Y-m-d', strtotime($proxima));


$update="update maquina set dataultima='$data',dataproxima='$proxima' where idmaquina='$maquina'";
$conn->query($update);

$update="update checklist set maquina='$maquina',data='$data',obs='$descricao' where id='$checklist'";

$conn->query($update);

$sql_itens =$conn->query("select * from checklistitens where idchecklist='$checklist'");

                while ($busca_itens= $sql_itens->fetch_array()) {
                  $id= $busca_itens['0'];
                $descricao=$_POST[$id];

                $update="update checklistitens set descricao='$descricao' where id='$id'";

                $conn->query($update);

                }

               echo "<script>window.location='../dados/checklistfinalizados';alert('Check List Efetuado com Sucesso!!');</script>";