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
                  <center>Manutenção Corretiva Cadastrados no Sistema <a href='../dados/criacorretiva'> <input type='button' class='default-blue-btn small-btn-table' value='Nova Corretiva'> </a>
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
                  <th>Data Inicio</th>
                  <th>Data Fim</th>
                  <th>Observação</th>
                  <th align="right">Opção</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $sql_corretiva = $conn->query("select * from corretiva");
                while ($busca_corretiva = $sql_corretiva->fetch_array()) {
                  $idcorretiva = $busca_corretiva['0'];
                  $maquina = $busca_corretiva['1'];
                  $componente = $busca_corretiva['2'];
                  $datainicio = $busca_corretiva['3'];
                  $obs = $busca_corretiva['4'];
                  $datafim=$busca_corretiva['5'];


                  $datainicio = date('d-m-Y', strtotime($datainicio));
                  $datafim=date('d-m-y',strtotime($datafim));


                  $sql_query = $conn->query("SELECT descricao FROM  maquina WHERE idmaquina='$maquina'");
                  $busca_query = $sql_query->fetch_array();

                  $descricaomaquina = $busca_query['0'];

                  if($descricaomaquina=='')
                  $descricaomaquina='Maquina Não Vinculada';

                  $sql_componente = $conn->query("SELECT descricao FROM  componente WHERE idcomponente='$componente'");
                  $busca_componente = $sql_componente->fetch_array();

                  $descricaocomponente = $busca_componente['0'];

                  if($descricaocomponente=='')
                  $descricaocomponente='Componente Não Vinculada';


                  echo "
      
      <tr>
      <td> $descricaomaquina</td>
      <td> $descricaocomponente</td>
      <td> $datainicio</td>
      <td> $datafim</td>
      <td> $obs</td>
      <center>  
      <td align=right> <a href=../dados/editacorretiva?codigo=$idcorretiva>
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