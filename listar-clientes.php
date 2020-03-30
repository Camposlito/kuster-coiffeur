<div class="container">
  <div class="text-center">
    <h1><i class="fas fa-users"></i></h1>
    <h2>Clientes</h2>
  </div>
  <div class="row">
    <div class="col">
      <h6> <i class="fas fa-stream"></i> Mostrando de <span id="min">1</span>  até <span id="max">7</span>  de  <b id="totClientes"><?php echo contClientes(); ?></b>  registros</h6>
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

    </tbody>
  </table>

  <div class="row">
    <div class="col">
    </div>
    <div class="col">
    </div>
    <div class="col">
    </div>
    <div class="col">
      <div class="input-group">
        <div class="input-group-prepend">
          <button type="button" class="btn btn-dark" onclick="antePag()">Anterior</button>
        </div>
        <input type="text" class="text-center form-control" value="1" id="numPag" readonly>
        <div class="input-group-append">
          <button type="button" class="btn btn-dark" onclick="proxPag()">Proximo</button>
        </div>
      </div>
    </div>
  </div>

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

<!-- modal deletar -->
  <div class="modal fade" id="deletarModal" tabindex="-1" role="dialog" aria-labelledby="deletarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deletarModalLabel"><i class="fas fa-user-slash"></i> Deletar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="deletar.php" method="post">
          <div class="modal-body">
            <div class="msg-delete"></div>
            <input type="hidden" name="id_deletar" value="">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal">Manter</button>
            <button type="submit" class="btn btn-danger">Excluir</button>
          </div>
        </form>
      </div>
    </div>
  </div>

</div>

<script>
//
// *ver todos os serviços (G)
// *formulario editar cliente (P)
// *novo serviço (G)

function editar(){
  document.getElementById("btn-salvar").disabled = false;
  document.getElementById("btn-editar").disabled = true;
  //habilitar formulário
  document.getElementById("dnome").readOnly = false;
  document.getElementById("demail").readOnly = false;
  document.getElementById("dcell1").readOnly = false;
  document.getElementById("dcell2").readOnly = false;
  document.getElementById("dtell").readOnly = false;
  document.getElementById("dniver").readOnly = false;
  //document.getElementById("labelNomeEdit").innerHTML = '<i class="fas fa-id-card"></i> Nome *'
}

function proxPag(){
  var pag = document.getElementById("numPag").value;
  var prox = parseInt(pag) + 1;
  listarClientes(prox);
  document.getElementById("numPag").value = prox;
}

function antePag(){
  var pag = document.getElementById("numPag").value;
  var ante = parseInt(pag) - 1;
  if (ante != 0) {
    listarClientes(ante);
    document.getElementById("numPag").value = ante;
  }
}

//pesquisar com a tecla enter
$('#pesquisa').keypress(function(event){
	var keycode = (event.keyCode ? event.keyCode : event.which);
	if(keycode == '13'){
		getDados();
	}
});

//Modal deletar Cliente
$('#deletarModal').on('show.bs.modal', function (event) {
  $('#detalhesModal').modal('hide');
  var button = $(event.relatedTarget);
  var str = button.data('whatever');
  var modal = $(this);
  var idNome = str.split("§");
  modal.find('.msg-delete').text('Deseja excluir todos os dados de "' + idNome[1] + '" do registro?');
  modal.find('.modal-body input').val(idNome[0]);
})

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
});

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

 function listarClientes(pag){
   var min = (pag * 7) - 6;
   var max = pag * 7;
   document.getElementById("max").innerHTML = max;
   document.getElementById("min").innerHTML = min;
   var result = document.getElementById("Resultado");
   var xmlreq = CriaRequest();
   xmlreq.open("GET", "clientes.php?pag=" + pag, true);
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
