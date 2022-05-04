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
                  <center>Cadastro de Usuarios no Sistema <a href='../dados/criausuario'> <input type='button' name='$idusuario' class='default-blue-btn small-btn-table'  value='Novo Usuario' >
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
                <th>Codigo</th>
                  <th>Nome</th>
                  <th>login</th>
                  <td align="right">Opção</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $sql_usuario = $conn->query("select * from users_bi");
                while ($busca_usuario = $sql_usuario->fetch_array()) {
                  $idusuario= $busca_usuario['0'];
                  $nome= $busca_usuario['1'];
                  $login = $busca_usuario['2'];


                  echo "
      
      <tr>
      <td> $idusuario</td>
      <td> $nome</td>
      <td> $login</td>
      <center>  
      <td align=right> <a href=../dados/editausuario?codigo=$idusuario>
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