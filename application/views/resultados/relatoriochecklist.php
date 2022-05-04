<!DOCTYPE html>
<html>

<head>
  <link rel="icon" href="<?php echo base_url('img/logo.png'); ?>" type="image/x-icon">

  <style type="text/css">
    table {
      font-size: 11px;
    }
  </style>

<script>
    function atualiza() {

      document.getElementById('botao').click();
    }
  </script>

</head>

<body>
  <?php
  require_once "botoes.php";
  require_once "funcao.php";

  if (empty($_POST['maquina'])) {
    $datainicio=date('2022-01-01');
    $datafim=date('Y-m-d');
    $parametro="";
  } else {
    $datainicio=$_POST['datainicio'];
    $datafim=$_POST['datafim'];
    $maquina=$_POST['maquina'];
    $parametro="and checklist.maquina=$maquina and cast( data as date )BETWEEN '$datainicio' and '$datafim'";
  }



  ?>
 <<div id="default-col-interna">
    <div class='content-dashboard'>
      <div class="wrapper wrapper-content">
        <div class="row">
          <div class="new-col col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                <h4>
                  <center>Relatório Check-List Maquinas
                </h4>
              </div>
            </div>
          </div>
        </div>
        <form name="dados" action="<?php echo site_url("dados/imprimechecklist") ?>" method="POST">
        <div class="col-md-4">
              <div class="form-group">
                <div>
                  <label>Maquina</label>
                  <select class="form-control show-tick" data-live-search="true" required title="Nenhum Valor Selecionado" name="maquina" id="maquina" onChange="atualiza()" ;>
                    <?php
                   $sqlmaquina = $conn->query("SELECT idmaquina,descricao  FROM maquina  order by descricao");
                    while ($busca_maquina = $sqlmaquina->fetch_array()) {
                      $codigo = $busca_maquina[0];
                      $descricaomaquina = $busca_maquina[1];
                      $selecionado = '';
                      if ($codigo == $maquina) {
                        $selecionado = 'selected';
                      }
                      echo "<option value='$codigo' $selecionado>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$descricaomaquina</option>";
                    }
                    ?>

                  </select>
                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <div class="form-line">
                  <label>
                    <center>data</center>
                  </label>
                  <input type="date" class="form-control" name="datainicio" value=<? echo $datainicio ?> required onChange="atualiza()" ;>

                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <div class="form-line">
                  <label>
                    <center>data</center>
                  </label>
                  <input type="date" class="form-control" name="datafim" required value=<? echo $datafim ?> onChange="atualiza()" ;>

                </div>
              </div>
            </div>

            <div class="col-md-2">
         <div>
            <div>
               <label></label>
               <button type='submit' id="botao" class='btn btn-primary btn-xs' style="visibility: hidden;">Visualizar</button> </td>

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

                $sql = $conn->query("select checklist.id,maquina.descricao,checklist.obs,maquina.numero,checklist.data from checklist inner join maquina on(checklist.maquina=maquina.idmaquina) $parametro");
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
      <td align=right> <a href=../dados/visualizachecklist?codigo=$id>
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