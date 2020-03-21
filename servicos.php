<?php
include "lib/fw.php";

$id = $_GET["serv"];
$dado = array (
  "id_cliente" => $id
);
$row = sqlSelectFirst("servico", $dado);
$clienteNome = getNomeById($row["id_cliente"]);

echo <<<EOT
<div class="modal-header">
  <h5 class="modal-title" id="servicosModalLabel"><i class="fas fa-cut"></i> Mostrando Todos os Serviços de {$clienteNome}</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  ...
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
  <button type="button" class="btn btn-primary">Save changes</button>
</div>

EOT;
 ?>
