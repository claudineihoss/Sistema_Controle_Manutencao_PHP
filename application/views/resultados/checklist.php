<!DOCTYPE html>
<html>

<head>
  <link rel="icon" href="<?php echo base_url('img/logo.png'); ?>" type="image/x-icon">

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

  $hoje = date('Y-m-d');

  $semana = date('d/m/Y', strtotime("+7 days", strtotime($hoje)));

  $semana = str_replace('/', '-', $semana);

  $semana = date('Y-m-d', strtotime($semana));

  if (empty($_GET['situacao'])) {
    $parametro = "order by dataproxima ASC";
  } else {
    $situacao = $_GET['situacao'];
    if ($situacao == '1')
      $parametro = "where cast( dataproxima as date )<='$hoje'";

    if ($situacao == '2')
      $parametro = "where cast( dataproxima as date )>'$hoje' and cast( dataproxima as date )<='$semana' ";
  }
  ?>
  <div id="default-col-interna">
    <div class='content-dashboard'>
      <div class="wrapper wrapper-content">
        <div class="row">
          <div class="new-col col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                <h4>
                  <center>Check List de Maquinas
                    <a href="<?php echo site_url("dados/checklist?situacao=0") ?>"><input type='button' class='default-blue-btn small-btn-table' value='Todos'> </a>
                    <a href="<?php echo site_url("dados/checklist?situacao=1") ?>"><input type='button' class='default-blue-btn small-btn-table' value='Vencidos'> </a>
                    <a href="<?php echo site_url("dados/checklist?situacao=2") ?>"><input type='button' class='default-blue-btn small-btn-table' value='Vencidos Primeira Semana'> </a>

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
                <th>Numero</th>
                  <th>Maquina</th>
                  <th>Frequencia(Dias)</th>
                  <th>Ultima</th>
                  <th>Próxima</th>
                  <td align="right">Opção</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $sql_maquina = $conn->query("select * from maquina $parametro");
                while ($busca_maquina = $sql_maquina->fetch_array()) {
                  $idmaquina = $busca_maquina['0'];
                  $numero = $busca_maquina['1'];
                  $descricao = $busca_maquina['2'];
                  $frequencia = $busca_maquina['4'];
                  $dataultima = $busca_maquina['5'];
                  $dataproxima = $busca_maquina['6'];


                  if ((strtotime($dataproxima)) <= (strtotime($hoje)))
                    $cor = "bg-red";

                  if ((strtotime($dataproxima)) > (strtotime($hoje)) && (strtotime($dataproxima)) <= (strtotime($semana)))
                    $cor = "bg-orange";

                    if ((strtotime($dataproxima)) > (strtotime($hoje)) && (strtotime($dataproxima)) >= (strtotime($semana)))
                    $cor = "bg-teal";

                
                    if($dataultima==''){
                      $dataultima='00.00.0000';
                      $dataproxima='00.00.0000';
                    }
                    else{
                    $dataultima = date('d-m-Y', strtotime($dataultima));
                    $dataproxima = date('d-m-Y', strtotime($dataproxima));
                    }


                  echo "
      
                  <tr class=$cor>
      <td> $numero</td>
      <td> $descricao</td>
      <td> $frequencia</td>
      <td> $dataultima</td>
      <td> $dataproxima</td>
      <center>  
      <td align=right> <a href=../dados/verificar?codigo=$idmaquina>
      <button type='button' class='default-blue-btn small-btn-table'>Informar Check-List</button> </td>  
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