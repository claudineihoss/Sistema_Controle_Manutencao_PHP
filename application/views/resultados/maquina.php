<!DOCTYPE html>
<html>

<head>
<link rel="icon" href="<?php echo base_url('img/logo.png');?>" type="image/x-icon">

  <style type="text/css">
    table {
      font-size: 11px;
    }
  </style>

</head>

<body>
  <?php
  require_once "botoes.php";
  require_once "funcao.php";


  ?>
  <div id="default-col-interna">
    <div class='content-dashboard'>
      <div class="wrapper wrapper-content">
        <div class="row">
          <div class="new-col col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                <h4>
                  <center>Maquinas e Equipamentos Cadastrados  no Sistema <a href='../dados/criamaquina'> <input type='button'  class='default-blue-btn small-btn-table'  value='Nova Maquina' > </a>
                </h4>
              </div>
            </div>
          </div>
        </div>

        <body class="theme-green">
          <div class="dataTable_wrapper">
            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
              <thead>
                <tr>
                <th>Codigo</th>
                  <th>Descrição</th>
                  <th>Local</th>
                  <th>Frequência</th>
                  <th>Data Ultima</th>
                  <th>Data Próxima</th>
                  <td align="right">Opção</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $sql_maquina = $conn->query("select * from maquina");
                while ($busca_maquina = $sql_maquina->fetch_array()) {
                  $idmaquina= $busca_maquina['0'];
                  $numero= $busca_maquina['1'];
                  $descricao = $busca_maquina['2'];
                  $local = $busca_maquina['3'];
                  $frequencia = $busca_maquina['4'];
                  $dataultima=$busca_maquina['5'];
                  $dataproxima=$busca_maquina['6'];

                  if($dataultima==''){
                    $dataultima='00.00.0000';
                    $dataproxima='00.00.0000';
                  }
                  else{
                  $dataultima = date('d-m-Y', strtotime($dataultima));
                  $dataproxima = date('d-m-Y', strtotime($dataproxima));
                  }

                  $sql_query = $conn->query("SELECT descricao FROM  local WHERE idlocal='$local'");
			$busca_query = $sql_query->fetch_array();

			$descricaolocal = $busca_query['0'];


                  echo "
      
      <tr>
      <td> $numero</td>
      <td> $descricao</td>
      <td> $descricaolocal</td>
      <td> $frequencia</td>
      <td> $dataultima</td>
      <td> $dataproxima</td>
      <center>  
      <td align=right> <a href=../dados/editamaquina?codigo=$idmaquina>
      <button type='button' class='default-blue-btn small-btn-table'>Visualizar</button> </td>  
      </a> 
      
      </tr>
                           
     </tr>
      ";
                }
                ?>
              </tbody>
            </table>

          </div>
      </div>
    </div>
  </div>
  </div>
  <!-- #END# Basic Examples -->
  <!-- Exportable Table -->
  </section>

</body>

</html>