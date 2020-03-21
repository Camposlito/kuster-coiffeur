<div class="container">
  <div class="text-center">
    <h1><i class="fas fa-users"></i></h1>
    <h2>Clientes</h2>
  </div>
  <div class="row">
    <div class="col">
      <h6> <i class="fas fa-stream"></i> Mostrando todos os registros (<?php echo contClientes(); ?>)</h4>
    </div>
    <div class="col">

    </div>
    <div class="col text-right">
      <div class="input-group">
        <div class="input-group-prepend">
          <button type="button" name="enviar-pesquisa" class="btn btn-primary" onclick="getDados()"><i class="fas fa-search"></i></button>
        </div>
        <input type="text" name="pesquisa" id="pesquisa" value="" class="form-control" placeholder="Pesquisar">
      </div>
    </div>
  </div>
  <br>

<!-- Tabela de clientes -->
  <table class="table table-striped table-bordered">
    <thead class="text-center">
      <tr>
        <th scope="col" class="text-left">Nome</th>
        <th scope="col">E-mail</th>
        <th scope="col">Celular (1)</th>
        <th scope="col">Celular (2)</th>
        <th scope="col">Detalhes</th>
      </tr>
    </thead>
    <tbody class="text-center" id="Resultado">
      <?php ListarClientes(); ?>
    </tbody>
  </table>

<!-- modal info_cliente -->
  <div class="modal fade" id="detalhesModal" tabindex="-1" role="dialog" aria-labelledby="detalhesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" id="detalhes">

      </div>
    </div>
  </div>

<!-- modal serviços -->
  <div class="modal fade" id="servicosModal" tabindex="-1" role="dialog" aria-labelledby="servicosModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" id="showServicos">

      </div>
    </div>
  </div>

</div>

<script>
//pesquisar com a tecla enter
jQuery('#pesquisa').keypress(function(event){
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if(keycode == '13'){
		getDados();
	}
});

//Modal detalhes do cliente + AJAX de info_cliente
$('#detalhesModal').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget);
var id = button.data('whatever');
var result = document.getElementById("detalhes");
var xmlreq = CriaRequest();
xmlreq.open("GET", "detalhes.php?det=" + id, true);
xmlreq.onreadystatechange = function(){
    if (xmlreq.readyState == 4) {
        if (xmlreq.status == 200) {
            result.innerHTML = xmlreq.responseText;
        }else{
            result.innerHTML = "Erro: " + xmlreq.statusText;
        }
    }
};
xmlreq.send(null);
var modal = $(this);
})

//cria objeto AJAX Request
function CriaRequest() {
     try{
         request = new XMLHttpRequest();
     }catch (IEAtual){
         try{
             request = new ActiveXObject("Msxml2.XMLHTTP");
         }catch(IEAntigo){
             try{
                 request = new ActiveXObject("Microsoft.XMLHTTP");
             }catch(falha){
                 request = false;
             }
         }
     }
     if (!request)
         alert("Seu Navegador não suporta Ajax!");
     else
         return request;
 }
 //Função para enviar os dados AJAX de pesquisa
 function getDados() {
     var nome   = document.getElementById("pesquisa").value;
     var result = document.getElementById("Resultado");
     var xmlreq = CriaRequest();
     xmlreq.open("GET", "pesquisar.php?pesquisa=" + nome, true);
     // Atribui uma função para ser executada sempre que houver uma mudança de estado
     xmlreq.onreadystatechange = function(){
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
 }

//modal + AJAX serviços
$('#servicosModal').on('show.bs.modal', function (event) {
$('#detalhesModal').modal('toggle');
var button = $(event.relatedTarget);
var id = button.data('whatever');
var result = document.getElementById("showServicos");
var xmlreq = CriaRequest();
xmlreq.open("GET", "servicos.php?serv=" + id, true);
xmlreq.onreadystatechange = function(){
   if (xmlreq.readyState == 4) {
       if (xmlreq.status == 200) {
           result.innerHTML = xmlreq.responseText;
       }else{
           result.innerHTML = "Erro: " + xmlreq.statusText;
       }
   }
};
xmlreq.send(null);
var modal = $(this);
})
</script>
