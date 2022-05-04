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

  include "funcao/mes.php";
  require_once "botoes.php";
  require_once "funcao.php";


  ?>
  <div id="default-col-interna">
    <div class='content-dashboard' style="">
      <div class="wrapper wrapper-content">
        <div class="row">
          <div class="new-col col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                <h4>
                  <center>Cadastro de Componentes
                </h4>
              </div>
            </div>
          </div>
        </div>
        <br>
        <br>
        <br>
        <form action="<?php echo site_url("dados/addcomponente")?>" method="POST">

        <div class="default-padding-inputs">

        <div class="col-md-4">
              <div class="form-group">
                <div>
                  <label>Maquina</label>
                  <select class="form-control show-tick" data-live-search="true" name="maquina";>
                    <?php
                    $sqlmaquina = $conn->query("SELECT idmaquina,descricao FROM maquina  order by descricao");
                    while ($busca_maquina = $sqlmaquina->fetch_array()) {
                      $codigo = $busca_maquina[0];
                      $descricao = $busca_maquina[1];
                      echo "<option value='$codigo' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$descricao</option>";
                    }
                    ?>

                  </select>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <div class="form-line">
                  <label><center> Componente </center> </label>
                  <input type="text" class="form-control" name="descricao" required>

                </div>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <div class="form-line">
                  <label><center> Frequência (Dias) </center> </label>
                  <input type="number" class="form-control" name="frequencia" required>

                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div class="form-line">
                  <label><center>Verificação</center> </label>
                  <input type="text" class="form-control" name="verificacao" required>

                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <div class="form-line">
                  <label><center>Data Ultima Verificação</center> </label>
                  <input type="date" class="form-control" name="ultima" required>

                </div>
              </div>
            </div>
            

            <center>
          <button type="submit" class="default-red-btn">Cadastrar</button>
        </center>  
            
          </div>
        </div>

</body>

</html>