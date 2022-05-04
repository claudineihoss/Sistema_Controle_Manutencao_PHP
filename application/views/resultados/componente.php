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


  ?>
  <div id="default-col-interna">
    <div class='content-dashboard'>
      <div class="wrapper wrapper-content">
        <div class="row">
          <div class="new-col col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                <h4>
                  <center>Componentes Cadastrados no Sistema <a href='../dados/criacomponente'> <input type='button' class='default-blue-btn small-btn-table' value='Novo Componente'> </a>
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

                $sql_componente = $conn->query("select * from componente");
                while ($busca_componente = $sql_componente->fetch_array()) {
                  $idcomponente = $busca_componente['0'];
                  $maquina = $busca_componente['1'];
                  $descricao = $busca_componente['2'];
                  $frequencia = $busca_componente['3'];
                  $dataultima = $busca_componente['4'];
                  $dataproxima = $busca_componente['5'];
                  $atividade = $busca_componente['6'];

                  $dataultima = date('d-m-Y', strtotime($dataultima));
                  $dataproxima = date('d-m-Y', strtotime($dataproxima));


                  $sql_query = $conn->query("SELECT descricao FROM  maquina WHERE idmaquina='$maquina'");
                  $busca_query = $sql_query->fetch_array();

                  $descricaomaquina = $busca_query['0'];

                  if($descricaomaquina=='')
                  $descricaomaquina='Maquina Não Vinculada';


                  echo "
      
      <tr>
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