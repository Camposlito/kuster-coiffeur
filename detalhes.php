<?php
include "lib/fw.php";

$id = $_GET["det"];
$dado = array (
  "id" => $id
);
$row = sqlSelectFirst("info_cliente", $dado);

echo <<<EOT
<div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-user-circle"></i> &nbsp; Informações do Cliente</h5>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<div class="modal-body">
  <div class="container-fluid">
    <form>
      <div class="form-group row">
        <div class="col">
          <label for="nome" class="col-form-label">Nome</label>
          <input type="text" class="form-control" name="nome" placeholder="Não informado" value="{$row["nome"]}">
        </div>
      </div>
      <hr>
      <div class="form-group row">
        <div class="col">
          <label for="email" class="col-form-label">E-mail</label>
          <input type="text" class="form-control" name="email" placeholder="Não informado" value="{$row["email"]}">
        </div>
      </div>
      <hr>
      <div class="form-group row">
        <div class="col">
          <label for="cell1">Celular (1)</label>
          <input class="form-control" type="tell" name="cell1" placeholder="Não informado" value="{$row["cell1"]}">
        </div>
        <div class="col">
          <label for="cell2">Celular (2)</label>
          <input class="form-control" type="text" name="cell2" placeholder="Não informado" value="{$row["cell2"]}">
        </div>
        <div class="col">
          <label for="tell">Telefone Fixo</label>
          <input class="form-control" type="text" name="tell" placeholder="Não informado" value="{$row["tell_fixo"]}">
        </div>
      </div>
      <hr>
      <div class="form-group row">
        <div class="col">
          <label for="niver"><i class="fas fa-birthday-cake"></i> Aniversário</label>
          <input class="form-control" type="text" name="niver" value="{$row["niver_dia"]}/{$row["niver_mes"]}" placeholder="Não informado">
        </div>
      </div>
      <hr>
      <div class="form-group row">
        <div class="col">
          <label for="servico"><i class="fas fa-cut"></i> Ultimo Serviço</label>
          <input class="form-control" type="text" name="servico" value="" placeholder="Não informado">
        </div>
      </div>

    </form>
  </div>
</div>
<div class="modal-footer">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
  <button type="button" class="btn btn-primary">Editar <i class="fas fa-user-cog"></i></button>
</div>

EOT;

 ?>
