
<!DOCTYPE html>
<html>

<head>
</head>



<script>

  function troca(){

   if(document.getElementById("botao").value=='Editar'){
      document.getElementById("local").disabled = false; // Habilitar
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

$sql_query = $conn->query("SELECT * FROM  local WHERE idlocal='$codigo'");
			$busca_query = $sql_query->fetch_array();

			$id = $busca_query['idlocal'];
			$local = $busca_query['descricao'];



?>
<section class="content">
  <!-- #END# Inline Layout | With Floating Label -->
  <!-- Multi Column -->
  <div class="row clearfix">
          <form name="formulario" action="<?php echo site_url("dados/atualizalocal")?>" method="POST">
            <div >
               <div class="default-header-blue">
                <center><h4 class="default-size-header">Locais de Fabrica</h4></center>
                 </a>
               </div>
              </div>
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
                      <label><center> Descricão </center> </label>
                      <input type="text" class="form-control" name="local" id="local" value="<?php echo $local ?>" disabled>

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

           <input type="hidden" class="form-control" name="codigo" value="<?php echo $id?>"  >

        </div> 
       <center class="eng-buttons-modal">

         <input type="button"  id="botao"  class="default-blue-btn" value="Editar" onclick="troca()"> 
         &nbsp;&nbsp;&nbsp;&nbsp;
         <a href="<?php echo site_url("dados/deletalocal?codigo=$id")?>">
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