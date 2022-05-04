<?php
include 'conecta.php';
include 'sessao.php';
$maquina = $_POST['maquina'];
$descricao = strtoupper($_POST['descricao']);
$data = $_POST['data'];


$sql = "insert into checklist(maquina,data,obs) 
values('$maquina','$data','$descricao')";
$conn->query($sql);

$idchecklist= mysqli_insert_id($conn);

$sql_frequencia=$conn->query("select frequencia from maquina where idmaquina='$maquina'");
$busca_frequencia=$sql_frequencia->fetch_array();
$frequencia=$busca_frequencia['0'];

$proxima=date('d/m/Y', strtotime("+$frequencia days",strtotime($data)));

$proxima = str_replace('/', '-', $proxima);

$proxima=date('Y-m-d', strtotime($proxima));


$update="update maquina set dataultima='$data',dataproxima='$proxima' where idmaquina='$maquina'";
$conn->query($update);


$sql_itens =$conn->query("select id from itens");
                while ($busca_itens= $sql_itens->fetch_array()) {
                  $id= $busca_itens['0'];
                $descricao=$_POST[$id];

                $sql="insert into checklistitens(idchecklist,item,descricao) values ('$idchecklist','$id','$descricao')";
                $conn->query($sql);

                }

               // echo "<script>window.location='../dados/checklist';alert('Check List Efetuado com Sucesso!!');</script>";