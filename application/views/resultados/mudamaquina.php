
<!DOCTYPE html>
<html>

<head>
</head>



<script>

  function troca(){

   if(document.getElementById("botao").value=='Editar'){
      document.getElementById("numero").disabled = false; // Habilitar
      document.getElementById("descricao").disabled = false; // Habilitar
      document.getElementById("frequencia").disabled = false; // Habilitar
      document.getElementById("dataultima").disabled = false; // Habilitar
      document.getElementById("botao").value = 'Salvar';
      document.getElementById("excluir").disabled = true; // Habilitar
    }
    else{
      document.formulario.submit();
    }
  }


</script>

<?php
  require_once "botoes.php";
  require_once "funcao.php";

$codigo=$_GET["codigo"];

$sql_query = $conn->query("SELECT * FROM  maquina WHERE idmaquina='$codigo'");
			$busca_query = $sql_query->fetch_array();

			$id = $busca_query['idmaquina'];
			$codigo = $busca_query['numero'];
      $descricao = $busca_query['descricao'];
      $local = $busca_query['local'];
      $frequencia = $busca_query['frequencia'];
      $dataultima= $busca_query['dataultima'];



?>
<section class="content">
  <!-- #END# Inline Layout | With Floating Label -->
  <!-- Multi Column -->
  <div class="row clearfix">
          <form name="formulario" action="<?php echo site_url("dados/atualizamaquina")?>" method="POST">
            <div >
               <div class="default-header-blue">
                <center><h4 class="default-size-header">Cadastro de Maquinas</h4></center>
                 </a>
               </div>
              </div>
              <div class="default-padding-inputs">
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="form-line">
                      <label><center> Codigo </center> </label>
                      <input type="text" class="form-control" name="numero" id="numero" value="<?php echo $codigo ?>" disabled>

                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="form-line">
                      <label><center>Descrição</center> </label>
                      <input type="text" class="form-control" name="descricao" id="descricao" value="<?php echo $descricao ?>" disabled>

                    </div>
                  </div>
                </div>

                <div class="col-md-4">
          <div class="form-group">
            <div class="form-line">
              <label>Local</label>
              <select class="form-control show-tick" data-live-search="true" name="local" id="local" ;>
              <?php
              $sqllocal = $conn->query("SELECT idlocal,descricao  FROM local  order by descricao");
              while ($busca_local= $sqllocal->fetch_array()) {
                $codigolocal = $busca_local[0];
                $descricaolocal = $busca_local[1];
                $selecionado = '';
                if ($codigolocal == $local) {
                  $selecionado = 'selected';
                }
                echo "<option value='$codigolocal' $selecionado>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$descricaolocal</option>";
              }
              ?>

              </select>
            </div>
          </div>
            </div>
          <div class="col-md-6">
                  <div class="form-group">
                    <div class="form-line">
                      <label><center>Frequencia(Dias)</center> </label>
                      <input type="number" class="form-control" name="frequencia" id="frequencia" required value="<?php echo $frequencia ?>" disabled>

                    </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <div class="form-line">
                      <label><center>Data Ultima Inspeção</center> </label>
                      <input type="date" class="form-control" name="dataultima" id="dataultima" required value="<?php echo $dataultima ?>" disabled>

                    </div>
                  </div>
                </div>

        </div>
                

           </div>

           <input type="hidden" class="form-control" name="codigo" value="<?php echo $id?>"  >
       <center class="eng-buttons-modal">

         <input type="button"  id="botao"  class="default-blue-btn" value="Editar" onclick="troca()"> 
         &nbsp;&nbsp;&nbsp;&nbsp;
         <a href="<?php echo site_url("dados/deletamaquina?codigo=$id")?>">
          <button type="button" class="default-red-btn">Excluir</button>
        </a>
      </center> 

    </form>
    

 </div>
</div>
</div>
</div>
<!-- #END# Multi Column -->
</div>


</body>

</html>