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
    $parametro="SELECT maquina,componente,data,obs  FROM corretiva";
    $datainicio=date('2022-01-01');
    $datafim=date('Y-m-d');
  } else {
    $datainicio=$_POST['datainicio'];
    $datafim=$_POST['datafim'];
    $maquina=$_POST['maquina'];
    $parametro="SELECT maquina,componente,data,obs  FROM corretiva where maquina=$maquina and cast( data as date )BETWEEN '$datainicio' and '$datafim'";
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
                  <center>Relatório Manutenção Corretiva 
                </h4>
              </div>
            </div>
          </div>
        </div>
        <form name="dados" action="<?php echo site_url("dados/imprimecorretiva") ?>" method="POST">
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
                  <th>Maquina</th>
                  <th>Componente</th>
                  <th>Data</th>
                  <th>Observação</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $sql_corretiva = $conn->query($parametro);
                while ($busca_corretiva = $sql_corretiva->fetch_array()) {
                  $maquina = $busca_corretiva['maquina'];
                  $componente = $busca_corretiva['componente'];
                  $data = $busca_corretiva['data'];
                  $obs = $busca_corretiva['obs'];


                  $data= date('d-m-Y', strtotime($data));


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
      <td> $data</td>
      <td> $obs</td>
                           
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