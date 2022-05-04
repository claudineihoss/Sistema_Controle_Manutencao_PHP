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
                  <center>Manutenção Preventiva de Maquinas e Equipamentos
                    <a href="<?php echo site_url("dados/preventiva?situacao=0") ?>"><input type='button' class='default-blue-btn small-btn-table' value='Todos'> </a>
                    <a href="<?php echo site_url("dados/preventiva?situacao=1") ?>"><input type='button' class='default-blue-btn small-btn-table' value='Vencidos'> </a>
                    <a href="<?php echo site_url("dados/preventiva?situacao=2") ?>"><input type='button' class='default-blue-btn small-btn-table' value='Vencidos Primeira Semana'> </a>

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
                  <th>Maquina</th>
                  <th>Componente</th>
                  <th>Frequencia(Dias)</th>
                  <th>Ultima</th>
                  <th>Próxima</th>
                  <th>Atividade</th>
                  <td align="right">Opção</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $sql_componente = $conn->query("select * from componente $parametro ");
                while ($busca_componente = $sql_componente->fetch_array()) {
                  $idcomponente = $busca_componente['0'];
                  $maquina = $busca_componente['1'];
                  $descricao = $busca_componente['2'];
                  $frequencia = $busca_componente['3'];
                  $dataultima = $busca_componente['4'];
                  $dataproxima = $busca_componente['5'];
                  $atividade = $busca_componente['6'];


                  $sql_query = $conn->query("SELECT descricao FROM  maquina WHERE idmaquina='$maquina'");
                  $busca_query = $sql_query->fetch_array();

                  $descricaomaquina = $busca_query['0'];

                  if ($descricaomaquina == '')
                    $descricaomaquina = 'Maquina Não Vinculada';

                  if ((strtotime($dataproxima)) <= (strtotime($hoje)))
                    $cor = "bg-red";

                  if ((strtotime($dataproxima)) > (strtotime($hoje)) && (strtotime($dataproxima)) <= (strtotime($semana)))
                    $cor = "bg-orange";

                    if ((strtotime($dataproxima)) > (strtotime($hoje)) && (strtotime($dataproxima)) >= (strtotime($semana)))
                    $cor = "bg-teal";

                
                


                  $dataultima = date('d-m-Y', strtotime($dataultima));
                  $dataproxima = date('d-m-Y', strtotime($dataproxima));


                  echo "
      
                  <tr class=$cor>
      <td> $descricaomaquina</td>
      <td> $descricao</td>
      <td> $frequencia</td>
      <td> $dataultima</td>
      <td> $dataproxima</td>
      <td> $atividade</td>
      <center>  
      <td align=right> <a href=../dados/editacomponente?codigo=$idcomponente>
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