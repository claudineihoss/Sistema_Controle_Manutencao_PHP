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
                  <center>Cadastro Novos Locais de Fabrica
                </h4>
              </div>
            </div>
          </div>
        </div>
        <br>
        <br>
        <br>
        <form action="<?php echo site_url("dados/addlocal") ?>" method="POST">

          <div class="default-padding-inputs">
            <div class="col-md-4">
              <div class="form-group">
                <div>

                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <div class="form-line">
                  <label>
                    <center>Descrição</center>
                  </label>
                  <input type="text" class="form-control" name="local" required>

                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <div>

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