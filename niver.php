<?php

$mes_atual = date('m');
$dia_atual = date('d');

?>
<div class="container">
  <div class="text-center">
    <h1><i class="fas fa-calendar-day"></i></h1>
    <h2>Aniversários</h2>
  </div>
  <div class="row">
    <div class="col-md-12 order-md-1">
      <h4 class="mb-3"><i class="fas fa-calendar-week"></i> Mês de <?php converteMes($mes_atual); ?></h4>
    </div>
  </div>
  <table class="table">
    <thead>
      <tr>
        <th>Dia</th>
        <th>Nome</th>
        <th>E-mail</th>
        <th>Celular (1)</th>
        <th>Celular (2)</th>
      </tr>
    </thead>
    <tbody>
      <?php ListarNiverHoje($dia_atual, $mes_atual); ListarNiverAmanha($dia_atual, $mes_atual); ListarNiverMes($dia_atual, $mes_atual);  ?>
    </tbody>
  </table>

</div>
