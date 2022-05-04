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
                  <center>Check List de Maquinas Finalizados

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
                <th>Numero Maquina</th>
                  <th>Maquina</th>
                  <th>Data</th>
                  <th>Não Conformidades</th>
                  <td align="right">Visualizar</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $sql = $conn->query("select checklist.id,maquina.descricao,checklist.obs,maquina.numero,checklist.data from checklist inner join maquina on(checklist.maquina=maquina.idmaquina)");
                while ($busca = $sql->fetch_array()) {
                  $id = $busca['0'];
                  $maquina = $busca['1'];
                  $obs = $busca['2'];
                  $numeromaquina = $busca['3'];
                  $data=$busca['4'];

                  $data = date('d-m-Y', strtotime($data));



                  echo "
      
                  <tr>
      <td> $numeromaquina</td>
      <td> $maquina</td>
      <td> $data</td>
      <td> $obs</td>
      <center>  
      <td align=right> <a href=../dados/mudachecklist?codigo=$id>
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