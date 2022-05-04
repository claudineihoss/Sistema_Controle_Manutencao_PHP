<!DOCTYPE html>
<html>

<head>
</head>



<script>
  function troca() {

    if (document.getElementById("botao").value == 'Editar') {
      document.getElementById("descricao").disabled = false; // Habilitar
      document.getElementById("verificacao").disabled = false; // Habilitar
      document.getElementById("frequencia").disabled = false; // Habilitar
      document.getElementById("ultima").disabled = false; // Habilitar
      document.getElementById("obs").disabled = false; // Habilitar
      document.getElementById("botao").value = 'Salvar';
      document.getElementById("excluir").disabled = true; // Habilitar
    } else {
      document.formulario.submit();
    }
  }
</script>

<?php
require_once "botoes.php";
require_once "funcao.php";

$codigo = $_GET["codigo"];

$sql_query = $conn->query("SELECT * FROM  componente WHERE idcomponente='$codigo'");
$busca_query = $sql_query->fetch_array();

$id = $busca_query['idcomponente'];
$maquina = $busca_query['maquina'];
$descricao = $busca_query['descricao'];
$frequencia = $busca_query['frequencia'];
$dataultima = $busca_query['dataultima'];
$verificacao = $busca_query['verificacao'];



?>
<section class="content">
  <!-- #END# Inline Layout | With Floating Label -->
  <!-- Multi Column -->
  <div class="row clearfix">
    <form name="formulario" action="<?php echo site_url("dados/atualizacomponente") ?>" method="POST">
      <div>
        <div class="default-header-blue">
          <center>
            <h4 class="default-size-header">Cadastro de Maquinas</h4>
          </center>
          </a>
        </div>
      </div>
      <div class="default-padding-inputs">
        <div class="col-md-4">
          <div class="form-group">
            <div class="form-line">
              <label>Maquina</label>
              <select class="form-control show-tick" data-live-search="true" name="maquina" id="maquina" ;>
                <?php
                $sqlmaquina = $conn->query("SELECT idmaquina,descricao  FROM maquina  order by descricao");
                while ($busca_maquina = $sqlmaquina->fetch_array()) {
                  $codigomaquina = $busca_maquina[0];
                  $descricaomaquina = $busca_maquina[1];
                  $selecionado = '';
                  if ($codigomaquina == $maquina) {
                    $selecionado = 'selected';
                  }
                  echo "<option value='$codigomaquina' $selecionado>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$descricaomaquina</option>";
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
                <center> Componente </center>
              </label>
              <input type="text" class="form-control" name="descricao" id="descricao" value="<?php echo $descricao ?>" disabled>

            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <div class="form-line">
              <label>
                <center>Frequência</center>
              </label>
              <input type="number" class="form-control" name="frequencia" id="frequencia" value="<?php echo $frequencia ?>" disabled>

            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <div class="form-line">
              <label>
                <center>Verificação</center>
              </label>
              <input type="text" class="form-control" name="verificacao" id="verificacao" value="<?php echo $verificacao ?>" disabled>

            </div>
          </div>
        </div>

        <div class="col-md-4">
              <div class="form-group">
                <div class="form-line">
                  <label><center>Data Ultima Verificação</center> </label>
                  <input type="date" class="form-control" name="ultima" id="ultima" value="<?php echo $dataultima ?>" disabled>

                </div>
              </div>
            </div>

            <div class="col-md-4">
          <div class="form-group">
            <div class="form-line">
              <label>
                <center>Observação</center>
              </label>
              <input type="text" class="form-control" name="obs" id="obs" disabled>

            </div>
          </div>
        </div>

      </div>

      <input type="hidden" class="form-control" name="codigo" value="<?php echo $id ?>">
      <center class="eng-buttons-modal">

        <input type="button" id="botao" class="default-blue-btn" value="Editar" onclick="troca()">
        &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php echo site_url("dados/deletacomponente?codigo=$id") ?>">
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