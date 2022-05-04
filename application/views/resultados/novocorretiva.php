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
      var maquina = document.getElementById("maquina").value;
      window.location.href = '../dados/criacorretiva?codigomaquina=' + maquina;
    }
  </script>

</head>

<body>
  <?php

  include "funcao/mes.php";
  require_once "botoes.php";
  require_once "funcao.php";

  if (empty($_GET['codigomaquina'])) {
    $parametro = "";
  } else {
    $codigomaquina = $_GET['codigomaquina'];
    $parametro = "where maquina=$codigomaquina";
  }



  ?>
  <div id="default-col-interna">
    <div class='content-dashboard' style="">
      <div class="wrapper wrapper-content">
        <div class="row">
          <div class="new-col col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                <h4>
                  <center>Lançamento de Manutenções Corretivas
                </h4>
              </div>
            </div>
          </div>
        </div>
        <br>
        <br>
        <br>
        <form action="<?php echo site_url("dados/addcorretiva") ?>" method="POST">

          <div class="default-padding-inputs">

            <div class="col-md-4">
              <div class="form-group">
                <div>
                  <label>Maquina</label>
                  <select class="form-control show-tick" data-live-search="true" required title="Nenhum Valor Selecionado" name="maquina" id="maquina" onChange="atualiza()" ;>
                    <option value=''></option>
                    <?php
                    $sqlmaquina = $conn->query("SELECT idmaquina,descricao  FROM maquina  order by descricao");
                    while ($busca_maquina = $sqlmaquina->fetch_array()) {
                      $codigo = $busca_maquina[0];
                      $descricaomaquina = $busca_maquina[1];
                      $selecionado = '';
                      if ($codigo == $codigomaquina) {
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
                <div>
                  <label>Componente</label>
                  <select class="form-control show-tick" data-live-search="true" name="componente" ;>
                    <?php
                    $sqlcomponente = $conn->query("SELECT idcomponente,descricao FROM componente $parametro  order by descricao");
                    while ($busca_componente = $sqlcomponente->fetch_array()) {
                      $codigo = $busca_componente[0];
                      $descricao = $busca_componente[1];
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
                  <label>
                    <center>Data Inicio</center>
                  </label>
                  <input type="date" class="form-control" name="datainicio" required>

                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <div class="form-line">
                  <label>
                    <center>Data Fim</center>
                  </label>
                  <input type="date" class="form-control" name="datafim" required>

                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <div class="form-line">
                  <label>
                    <center> Observação </center>
                  </label>
                  <input type="text" class="form-control" name="obs">

                </div>
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