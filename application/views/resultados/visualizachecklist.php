
<!DOCTYPE html>
<html>

<head>
</head>


<?php
  require_once "botoes.php";
  require_once "funcao.php";

$codigo=$_GET["codigo"];

$sql_query = $conn->query("SELECT * FROM  checklist WHERE id='$codigo'");
			$busca_query = $sql_query->fetch_array();

			$idchecklist = $busca_query['id'];
			$maquina = $busca_query['maquina'];
      $data = $busca_query['data'];
      $obs= $busca_query['obs'];
      
      $sql_maquina=$conn->query("SELECT numero,descricao from maquina where idmaquina='$maquina'");
      $busca_maquina = $sql_maquina->fetch_array();
      $numero=$busca_maquina['numero'];
			$descricao = $busca_maquina['descricao'];



?>
<div id="default-col-interna">
    <div class='content-dashboard'>
      <div class="wrapper wrapper-content">
        <div class="row">
          <div class="new-col col-lg-12">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                <h4>
                  <center>Check List da Maquina <? echo"$descricao ($numero)" ?>
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
                <?php

                $sql_itens =$conn->query("select id,descricao,item from checklistitens where idchecklist=$idchecklist");
                while ($busca_itens= $sql_itens->fetch_array()) {
                  $id= $busca_itens['0'];
                  $descricao=$busca_itens['1'];
                  $item=$busca_itens['2'];

                  $sql_item=$conn->query("SELECT descricao from itens where id='$item'");
                  $busca_item = $sql_item->fetch_array();
                  $descricaoitem=$busca_item['descricao'];
                


                  echo "
      
      <tr>
      <td>$descricaoitem</td>
      <td><input type=text name=$id value='$descricao'></td>
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
                  <input type="date" class="form-control" name="data" value="<?php echo $data ?>" required>

                </div>
              </div>
            </div>

            <div class="col-md-9">
              <div class="form-group">
                <div class="form-line">
                  <label><center>Não Conformidades Apresentadas</center> </label>
                  <input type="text" class="form-control" name="descricao" value="<? echo $obs ?>">

                </div>
              </div>
            </div>
    

 </div>
</div>
</div>
</div>
<!-- #END# Multi Column -->
</div>
</body>

</html>