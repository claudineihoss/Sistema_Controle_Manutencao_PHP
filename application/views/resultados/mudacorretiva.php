<!DOCTYPE html>
<html>

<head>
</head>



<script>
  function troca() {

    if (document.getElementById("botao").value == 'Editar') {
      document.getElementById("datainicio").disabled = false; // Habilitar
      document.getElementById("datafim").disabled = false; // Habilitar
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

$sql_query = $conn->query("SELECT * FROM  corretiva WHERE idcorretiva='$codigo'");
$busca_query = $sql_query->fetch_array();

$id = $busca_query['idcorretiva'];
$maquina = $busca_query['maquina'];
$componente = $busca_query['componente'];
$datainicio = $busca_query['datainicio'];
$datafim=$busca_query['datafim'];
$obs = $busca_query['obs'];



?>
<section class="content">
  <!-- #END# Inline Layout | With Floating Label -->
  <!-- Multi Column -->
  <div class="row clearfix">
    <form name="formulario" action="<?php echo site_url("dados/atualizacorretiva") ?>" method="POST">
      <div>
        <div class="default-header-blue">
          <center>
            <h4 class="default-size-header">Manutenção Corretiva</h4>
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
              <label>Componente</label>
              <select class="form-control show-tick" data-live-search="true"  name="componente" id="componente" ;>
                <?php
                $sqlcomponente = $conn->query("SELECT idcomponente,descricao  FROM componente  order by descricao");
                while ($busca_componente = $sqlcomponente->fetch_array()) {
                  $codigocomponente = $busca_componente[0];
                  $descricaocomponente = $busca_componente[1];
                  $selecionado = '';
                  if ($codigocomponente == $componente) {
                    $selecionado = 'selected';
                  }
                  echo "<option value='$codigocomponente' $selecionado>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$descricaocomponente</option>";
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
                <center>Data Inicio</center>
              </label>
              <input type="date" class="form-control" name="datainicio" id="datainicio" value="<?php echo $datainicio ?>" disabled>

            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <div class="form-line">
              <label>
                <center>Data Fim</center>
              </label>
              <input type="date" class="form-control" name="datafim" id="datafim" value="<?php echo $datafim ?>" disabled>

            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="form-group">
            <div class="form-line">
              <label>
                <center>Observação</center>
              </label>
              <input type="text" class="form-control" name="obs" id="obs" value="<?php echo $obs ?>" disabled>

            </div>
          </div>
        </div>


      </div>

      <input type="hidden" class="form-control" name="codigo" value="<?php echo $id ?>">
      <center class="eng-buttons-modal">

        <input type="button" id="botao" class="default-blue-btn" value="Editar" onclick="troca()">
        &nbsp;&nbsp;&nbsp;&nbsp;
        <a href="<?php echo site_url("dados/deletacorretiva?codigo=$id") ?>">
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