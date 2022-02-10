<?php

namespace Desenv\Aula11;

?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
        <script src="./js/script.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">



        <script>
            $(document).ready(function(){
                $("#btn-aparecer-form").click(function(){
                     $("#formEditVaga").slideToggle();
            });
            $("html, body").animate({
                   scrollTop: $("#btn-aparecer-form").offset().top
              }, 50);

              $(".exc-cand").click(function(e) {
                  e.preventDefault();
                  console.log("..");
                  var id = $(this).data("target");
                  Swal.fire({
                      title: 'Tem certeza que você quer deletar?',
                      text: "Este candidato ficará inativo no sistema mas ainda se encontrará no Banco de dados!",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Sim, Exclua!'
                  })
                  .then((result) => {
                      if (result.isConfirmed) {              
                          $.ajax({
                              url: "index.php?page=deleteVaga",
                              type: 'post',
                              data: {id_candidato : id},
                          success: function(html) {
                                location.reload();
                       }
                      });
             
                        } else {
                      Swal.fire("Sua candidatura não foi excluída!");
                     }
          });
      });

    });
              
           
        </script>

    </head>
    <body>

    <?php

use Desenv\Aula11\Candidatos;

$listar = new Candidatos;
    $listagem = $listar->getCandidatos();
    
    ?>

<a href="index.php?page=form"><img src="./img/voltar.png" style="width: 100px;"></a>


<form method = "POST" action="index.php?page=listagemCandidatoPorNome">
<div class="row">
<div class="col-sm-8">
      <label for="inputProcurarPorNome" class="form-label">Pesquisar Nome:</label>
      <input type="text" class="form-control" id="inputProcurarPorNome" name="procurarPorNome" placeholder="Coloque o nome do candidato" required>
  </div>
  <div class="col-sm-4">
      <button type="submit" class="btn btn-primary">Pesquisar</button>
    </div>
</form>    
  
    
  
  
  
  <table class="table table-bordered">
    <thead>

  <tr>
    <th scope="col">Id </th>
    <th scope="col">Nome</th>
    <th scope="col">Email </th>
    <th scope="col">Telefone </th>
    <th scope="col">Cidade</th>
    <th scope="col">Estado</th>
    <th scope="col">Idiomas Falados</th>
    <th scope="col">Resumo Profissional</th>
    <th scope="col">Disponível para Presencial?</th>
    <th scope="col">Status Candidato</th>
    <th scope="col">Editar</th>
    <th scope="col">Excluir</th>
    
  </tr>
</thead>
<tbody>
<?php foreach($listagem as $candidato): ?>
  <tr>
    <td><?= $candidato['id_candidato'] ?></td>
    <td><?= $candidato['nome_candidato'] ?></td>
    <td><?= $candidato['email_candidato'] ?></td>
    <td><?= $candidato['telefone_candidato'] ?></td>
    <td><?= $candidato['cidade_candidato'] ?></td>
    <td><?= $candidato['estado_candidato'] ?></td>
    <td><?= $candidato['idioma_candidato'] ?></td>
    <td><?= $candidato['resumo_candidato'] ?></td>
    <td><?= $candidato['presencial'] ?></td>
    <td><?= $candidato['status_candidato'] ?></td>
    <td><a href="index.php?page=listagem-candidatos&&id_candidato=<?=$candidato['id_candidato']?>&&nome_candidato=<?=$candidato['nome_candidato']?>
    &&email_candidato=<?=$candidato['email_candidato']?>&&telefone_candidato=<?=$candidato['telefone_candidato']?>
    &&cidade_candidato=<?=$candidato['cidade_candidato']?>&&estado_candidato=<?=$candidato['estado_candidato']?>
    &&idioma_candidato=<?=$candidato['idioma_candidato']?>&&resumo_candidato=<?=$candidato['resumo_candidato']?>
    &&presencial=<?=$candidato['presencial']?>&&status_candidato=<?=$candidato['status_candidato']?>" id="btn-aparecer-form"><img src="./img/iconeEditar.png" style="width: 30px;"></a></td>
    <td><a href="#" data-target="<?=$candidato['id_candidato']?>" class="exc-cand">
      <img src="./img/iconeExcluir.png" style="width: 30px;"></a></td>  
  </tr>
  <?php endforeach;?>
</tbody>
</table> 

<div style="color: #207178">
<br><h4><i>Clique no lápis para editar o candidato e altere o preenchimento no formulário abaixo:</i></h4>
<strong><i>Usamos aqui exclusão lógica, ou seja, se alterar o status do candidato de 'V' para 'F', ele não 
    mais estará disponível para cadastro de candidaturas</i></strong>
</div>    

<?php
$idCandidato="";
$nomeCandidato="";
$emailCandidato="";
$telefoneCandidato="";
$cidadeCandidato="";
$estadoCandidato="";
$idiomaCandidato="";
$resumoCandidato="";
$presencialCandidato = "";
$statusCandidato="";

if(count($_GET)>1){
$idCandidato = $_GET['id_candidato'];    
$nomeCandidato = $_GET['nome_candidato'];
$emailCandidato = $_GET['email_candidato'];
$telefoneCandidato = $_GET['telefone_candidato'];
$cidadeCandidato = $_GET['cidade_candidato'];
$estadoCandidato=$_GET['estado_candidato'];
$idiomaCandidato=$_GET['idioma_candidato'];
$resumoCandidato=$_GET['resumo_candidato'];
$presencialCandidato = $_GET['presencial'];
$statusCandidato=$_GET['status_candidato'];
}

?>




<form method="POST" class="row g-3" action="index.php?page=listagem-candidatos" id="formEditCandidato" style="padding: 100px;">
<div class="col-md-1">
    <label for="inputState" class="form-label">Id do candidato:</label>
    <select id="inputState" class="form-select" name = "idCandidato" >
      <option value="<?=$idCandidato?>"><?=$idCandidato?></option>
    </select>
  </div>  
<div class="col-md-6">
    <label for="inputEmail4" class="form-label">Nome do candidato:</label>
    <input type="text" class="form-control" id="inputEmail4" name = "nomeCandidato" value="<?=$nomeCandidato?>" placeholder="Coloque o nome do candidato" required>
  </div>
  <div class="col-md-3">
    <label for="inputEmail" class="form-label">Email:</label>
    <input type="email" class="form-control" id="inputEmail" name = "emailCandidato" placeholder="Coloque o email" value="<?= $emailCandidato ?>" required>
  </div>
  <div class="col-md-3">
    <label for="inputTel" class="form-label">Telefone:</label>
    <input type="text" class="form-control" id="inputTel" name = "telefoneCandidato" placeholder="Coloque o telefone" value="<?= $telefoneCandidato ?>" required>
  </div>
  <div class="col-md-3">
    <label for="inputCity" class="form-label">Cidade:</label>
    <input type="text" class="form-control" id="inputCity" name = "cidadeCandidato" placeholder="Coloque a cidade" value="<?= $cidadeCandidato ?>" required>
  </div>
  <div class="col-md-4">
    <label for="inputState" class="form-label">Estado:</label>
    <select id="inputState" class="form-select" name = "estadoCandidato">
      <option value="MG">MG</option>
      <option value="SP">SP</option>
      <option value="RJ">RJ</option>
      <option value="ES">ES</option>
    </select>
  </div>
  <div class="col-md-2">
    <label for="inputState" class="form-label">Idiomas Falados:</label>
    <select id="inputState" class="form-select" name = "idiomaCandidato">
      <option value="ingles">Inglês</option>
      <option value="espanhol">Espanhol</option>
      <option value="ambos">Ambos</option>
      <option value="nenhum">Nenhum</option>
    </select>
  </div>
    <br><label>Resumo Profissional:</label>
               <textarea id="resumoProf" name="resumoProf" value="" placeholder="Escreva aqui..." required><?= $resumoCandidato ?></textarea><br>
  <fieldset class="row mb-3">
  <legend class="col-form-label col-sm-2 pt-0">Disponível p/ presencial?</legend>
    <div class="col-sm-10">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="presencial" id="gridRadios1" value="Sim" checked>
        <label class="form-check-label" for="gridRadios1">
          Sim
        </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="presencial" id="gridRadios2" value="Não">
        <label class="form-check-label" for="gridRadios2">
          Não
        </label>
      </div>
    </div>
  </fieldset>
  <div class="col-md-1">
    <label for="inputState" class="form-label">Status Canditado:</label>
    <select id="inputState" class="form-select" name = "statusCandidato">
      <option value="V">V</option>
      <option value="F">F</option>
    </select><br><br>
  </div>   
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Enviar</button> 
  </div>

</form>
<?php

$idCandidatoPost="";
$nomeCandidatoPost="";
$emailCandidatoPost="";
$telefoneCandidatoPost="";
$cidadeCandidatoPost="";
$estadoCandidatoPost="";
$idiomaCandidatoPost="";
$resumoCandidatoPost="";
$presencialCandidatoPost = "";
$statusCandidatoPost="";

if(count($_POST)>0){

    $idCandidatoPost = filter_input(INPUT_POST, 'idCandidato', FILTER_SANITIZE_NUMBER_INT);
    $nomeCandidatoPost = filter_input(INPUT_POST, 'nomeCandidato', FILTER_SANITIZE_STRING);
    $emailCandidatoPost = filter_input(INPUT_POST, 'emailCandidato', FILTER_SANITIZE_STRING);
    $telefoneCandidatoPost = filter_input(INPUT_POST, 'telefoneCandidato', FILTER_SANITIZE_STRING);
    $cidadeCandidatoPost = filter_input(INPUT_POST, 'cidadeCandidato', FILTER_SANITIZE_STRING);
    $estadoCandidatoPost = filter_input(INPUT_POST, 'estadoCandidato', FILTER_SANITIZE_STRING);
    $idiomaCandidatoPost = filter_input(INPUT_POST, 'idiomaCandidato', FILTER_SANITIZE_STRING);
    $resumoCandidatoPost = filter_input(INPUT_POST, 'resumoProf', FILTER_SANITIZE_STRING);
    $presencialCandidatoPost = filter_input(INPUT_POST, 'presencial', FILTER_SANITIZE_STRING);
    $statusCandidatoPost = filter_input(INPUT_POST, 'statusCandidato', FILTER_SANITIZE_STRING);
    
   $editCandidatos = new Candidatos;
    $resultado = $editCandidato->updateCandidatos($idCandidatoPost, 
                                                  $nomeCandidatoPost,
                                                  $emailCandidatoPost,
                                                  $telefoneCandidatoPost, 
                                                  $cidadeCandidatoPost, 
                                                  $estadoCandidatoPost, 
                                                  $idiomaCandidatoPost, 
                                                  $resumoCandidatoPost, 
                                                  $presencialCandidatoPost, 
                                                  $statusCandidatoPost);
    echo("<meta http-equiv='refresh' content='1'>");
}



?>



    </body>

</html>