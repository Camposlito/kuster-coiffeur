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

      <tr>
        <td class="text-left">Larry</td>
        <td>the Bird</td>
        <td>@twitter</td>
        <td>Otto</td>
        <td> <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="1" onclick="getUser()"><i class="fas fa-bars"></i></button> </td>
      </tr>
    </tbody>
  </table>


<?php //usar função que pega o iduser passado pelo jQuery para introduzir dados sql no modal ?>

<!-- modal teste -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
            <input type="text" class="form-control" name="recipient-name" id="recipient-name">
          </div>
          <div class="form-group" id="detalhes">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text"></textarea>
            <?php

            echo getNome(0); ?>
            <p>akdjaskldjasldaskd</p>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>
</div>
<script>
$('#exampleModal').on('show.bs.modal', function (event) {
var button = $(event.relatedTarget) // Button that triggered the modal
var recipient = button.data('whatever') // Extract info from data-* attributes
// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
var modal = $(this)
modal.find('.modal-title').text('New message to ' + recipient)
modal.find('.modal-body input').val(recipient)
})

//AJAX Pesquisar
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
 //Função para enviar os dados
 function getDados() {
     // Declaração de Variáveis
     var nome   = document.getElementById("pesquisa").value;
     var result = document.getElementById("Resultado");
     var xmlreq = CriaRequest();
     // Iniciar uma requisição
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
 function getUser(){
   // Declaração de Variáveis
   var id   = document.getElementById("recipient-name").value;
   var result = document.getElementById("detalhes");
   var xmlreq = CriaRequest();
   // Iniciar uma requisição
   xmlreq.open("GET", "detalhes.php?det=" + id, true);
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
</script>
