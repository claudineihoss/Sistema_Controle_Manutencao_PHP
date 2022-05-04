<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=Edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Manutenção Reafrio</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo base_url('img/logo.png');?>" type="image/x-icon">

  <head>

  </head>

<body background="<?php echo base_url('img/bk2.png'); ?>">

  <!-- Modal -->
  <div class="modal fade bs-example-modal-lg" id="myModal" role="dialog" aria-labelledby="myLargeModalLabel" data-backdrop="static">
    <div class="modal-dialog" role="document">
      <div class="modal-content">

      </div>
    </div>
  </div>
  <?php

  include "sessao.php";

  include "extensao.php";

  ?>





  <a class="btn-open-menu" id="btn-open-menu" onclick="openMenu()"><img src="../../img/btn-open-menu.svg" style="width: 30px;"></a>

  <div class="box-left-screen" id="box-left-screen">
    <div class="sidenav">
      <img src="<?php echo base_url('img/logo.png'); ?>" style="width:100%; height: auto; float: left; padding:25px;">
      <a href="<?php echo site_url("dados/usuario") ?>"><img class="material-icons" src="<?php echo base_url('img/new-icons/Branco/cadastros-gerais.svg'); ?>" width="20px">Usuarios </a>
      <a href="<?php echo site_url("dados/local") ?>"><img class="material-icons" src="<?php echo base_url('img/new-icons/Branco/calendario-periodo.svg'); ?>" width="20px');?>" width="20px">Locais</a>
      <a href="<?php echo site_url("dados/maquina") ?>"><img class="material-icons" src="<?php echo base_url('img/new-icons/Branco/home.svg'); ?>" width="20px');?>" width="20px">Maquinas</a>
      <a href="<?php echo site_url("dados/itenschecklist") ?>"><img class="material-icons" src="<?php echo base_url('img/new-icons/Branco/preco-de-venda.svg'); ?>" width="20px');?>" width="20px">Itens Check-List</a>
      <a href="<?php echo site_url("dados/checklist") ?>"><img class="material-icons" src="<?php echo base_url('img/new-icons/Branco/indices-graficos.svg'); ?>" width="20px">Check-List</a>
      <a href="<?php echo site_url("dados/checklistfinalizados") ?>"><img class="material-icons" src="<?php echo base_url('img/new-icons/Branco/gestores-analise-cliente.svg'); ?>" width="20px"> Finalizados</a>
      <a href="<?php echo site_url("dados/componente") ?>"><img class="material-icons" src="<?php echo base_url('img/new-icons/Branco/Site.svg'); ?>" width="20px">Componentes</a>
      <a href="<?php echo site_url("dados/preventiva") ?>"><img class="material-icons" src="<?php echo base_url('img/new-icons/Branco/DRE-Consolidada.svg'); ?>" width="20px">Preventiva</a>
      <a href="<?php echo site_url("dados/corretiva") ?>"><img class="material-icons" src="<?php echo base_url('img/new-icons/Branco/gestores-analise-cliente.svg'); ?>" width="20px">Corretiva</a>
      <a href="<?php echo site_url("dados/imprimechecklist") ?>"><img class="material-icons" src="<?php echo base_url('img/new-icons/Branco/consultas.svg'); ?>" width="20px">Relatório CheckList</a>
      <a href="<?php echo site_url("dados/imprimepreventiva") ?>"><img class="material-icons" src="<?php echo base_url('img/new-icons/Branco/consultas.svg'); ?>" width="20px">Relatório Preventiva</a>
      <a href="<?php echo site_url("dados/imprimecorretiva") ?>"><img class="material-icons" src="<?php echo base_url('img/new-icons/Branco/consultas.svg'); ?>" width="20px">Relatório Corretiva</a>
      <a href="<?php echo site_url("") ?>" slass="dropdown-btn"><img class="material-icons" src="<?php echo base_url('img/new-icons/Branco/cenario-geral.svg'); ?>" width="20px">Sair Sistema</a>

    </div>
  </div>



  <script>
    function openMenu() {
      $('#box-left-screen').css('display', 'block');
      $('.default-col-interna').css('margin-left', '300px');
      $('.btn-open-menu').css('margin-left', '200px');
      $("#btn-open-menu").attr("onclick", "closeMenu()");
    }

    function closeMenu() {
      $('#box-left-screen').css('display', 'none');
      $('.default-col-interna').css('margin-left', '50px');
      $('.btn-open-menu').css('margin-left', '0px');
      $("#btn-open-menu").attr("onclick", "openMenu()");
    }
  </script>





  <script type="text/javascript">
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;
    for (i = 0; i < dropdown.length; i++) {
      dropdown[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var dropdownContent = this.nextElementSibling;
        if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
        } else {
          dropdownContent.style.display = "block";
        }
      });
    }
  </script>