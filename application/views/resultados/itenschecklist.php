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
                  <center>Itens Check-List Cadastrados  no Sistema <a href='../dados/criaitem'> <input type='button'  class='default-blue-btn small-btn-table'  value='Novo Check-List' > </a>
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
                  <th>Descrição</th>
                  <td align="right">Opção</th>
                </tr>
              </thead>
              <tbody>
                <?php

                $sql_check = $conn->query("select * from itens");
                while ($busca_check = $sql_check->fetch_array()) {
                  $id= $busca_check['0'];
                  $descricao = $busca_check['1'];
              


                  echo "
      
      <tr>
      <td> $id</td>
      <td> $descricao</td>
      <center>  
      <td align=right> <a href=../dados/editaitem?codigo=$id>
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