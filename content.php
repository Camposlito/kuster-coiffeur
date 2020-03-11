<?php
include "lib/fw.php";

function mainContent(){
  $go = $_GET["_location"];
  switch ($go) {
    case 'inicio':
      include "inicio.php";
      break;

    case 'cadastro':
      include "cadastro.php";
      break;

    case 'listar-clientes':
      include "listar-clientes.php";
      break;

    case 'niver':
      include "niver.php";
      break;

    case 'novo-servico':
      include "novo-servico.php";
      break;

    default:
      //
      break;
  }
}

include "lib/main-template.php";
 ?>
