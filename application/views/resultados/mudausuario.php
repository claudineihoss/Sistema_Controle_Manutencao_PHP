
<!DOCTYPE html>
<html>

<head>
</head>



<script>

  function troca(){

   if(document.getElementById("botao").value=='Editar'){
      document.getElementById("senha").disabled = false; // Habilitar
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

$sql_query = $conn->query("SELECT * FROM  users_bi WHERE id='$codigo'");
			$busca_query = $sql_query->fetch_array();

			$id = $busca_query['id'];
			$nome = $busca_query['nome'];
      $login = $busca_query['login'];
      $senha = $busca_query['senha'];



?>
<section class="content">
  <!-- #END# Inline Layout | With Floating Label -->
  <!-- Multi Column -->
  <div class="row clearfix">
          <form name="formulario" action="<?php echo site_url("dados/atualizausuario")?>" method="POST">
            <div >
               <div class="default-header-blue">
                <center><h4 class="default-size-header">Cadastro de Usuários</h4></center>
                 </a>
               </div>
              </div>
              <div class="default-padding-inputs">
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="form-line">
                      <label><center> Nome </center> </label>
                      <input type="text" class="form-control" name="nome" id="nome" value="<?php echo $nome ?>" disabled>

                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="form-line">
                      <label><center>login</center> </label>
                      <input type="text" class="form-control" name="login" id="login" value="<?php echo $login ?>" disabled>

                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="form-line">
                      <label><center>Senha</center> </label>
                      <input type="password" class="form-control" name="senha" id="senha" value="<?php echo $senha?>" disabled>

                    </div>
                  </div>
                </div>
                

           </div>

           <input type="hidden" class="form-control" name="codigo" value="<?php echo $id?>"  >

        </div> 
       <center class="eng-buttons-modal">

         <input type="button"  id="botao"  class="default-blue-btn" value="Editar" onclick="troca()"> 
         &nbsp;&nbsp;&nbsp;&nbsp;
         <a href="<?php echo site_url("dados/deletausuario?codigo=$id")?>">
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