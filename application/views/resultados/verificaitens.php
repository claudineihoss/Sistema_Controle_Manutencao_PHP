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
include "conecta.php";
  $maquina=$_GET['codigo'];

  $sql_query=$conn->query("SELECT idmaquina,numero, descricao FROM MAQUINA where idmaquina='$maquina'");
  $busca_query=$sql_query->fetch_array();
  $idmaquina = $busca_query['idmaquina'];
			$codigo = $busca_query['numero'];
			$descricao = $busca_query['descricao'];


  ?>
  <div id="default-col-interna">
    <div class='content-dashboard'>
      <div class="wrapper wrapper-content">
        <div class="row">
          <div class="new-col col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                <h4>
                  <center>Check List da Maquina <? echo"$descricao ($codigo)" ?>
                </h4>
              </div>
            </div>
          </div>
        </div>

        <body class="theme-green">
          <div class="dataTable_wrapper">
            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
              <thead>
               
              <tbody>
                <form action="<?php echo site_url("dados/addverificacao")?>" method="POST"
                <?php

                $sql_itens =$conn->query("select id,descricao from itens");
                while ($busca_itens= $sql_itens->fetch_array()) {
                  $id= $busca_itens['0'];
                  $descricao=$busca_itens['1'];
                


                  echo "
      
      <tr>
      <td>$descricao</td>
      <td><input type=text name=$id required></td>
      </tr>
      ";
                }
                ?>
              </tbody>
            </table>

            <div class="col-md-3">
              <div class="form-group">
                <div class="form-line">
                  <label><center>Data</center> </label>
                  <input type="date" class="form-control" name="data" required>

                </div>
              </div>
            </div>

            <div class="col-md-9">
              <div class="form-group">
                <div class="form-line">
                  <label><center>Não Conformidades Apresentadas</center> </label>
                  <input type="text" class="form-control" name="descricao">

                </div>
              </div>
            </div>

            <input type="hidden" name="maquina" value="<? echo $idmaquina ?>">

            <center>
          <button type="submit" class="default-red-btn">Finalizar</button>
        </center>  
              </form>
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