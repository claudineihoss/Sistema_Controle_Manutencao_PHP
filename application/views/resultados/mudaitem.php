
<!DOCTYPE html>
<html>

<head>
</head>



<script>

  function troca(){

   if(document.getElementById("botao").value=='Editar'){
      document.getElementById("item").disabled = false; // Habilitar
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

$sql_query = $conn->query("SELECT * FROM  itens WHERE id='$codigo'");
			$busca_query = $sql_query->fetch_array();

			$id = $busca_query['id'];
			$item = $busca_query['descricao'];



?>
<section class="content">
  <!-- #END# Inline Layout | With Floating Label -->
  <!-- Multi Column -->
  <div class="row clearfix">
          <form name="formulario" action="<?php echo site_url("dados/atualizaitem")?>" method="POST">
            <div >
               <div class="default-header-blue">
                <center><h4 class="default-size-header">Itens do Check-List</h4></center>
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
                      <input type="text" class="form-control" name="item" id="item" value="<?php echo $item?>" disabled>

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
         <a href="<?php echo site_url("dados/deletaitem?codigo=$id")?>">
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