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
                     $("#formEditVaga").show();
            });
            $("html, body").animate({
                   scrollTop: $("#btn-aparecer-form").offset().top
              }, 50);
            
              $(".exc-cand-vaga").click(function(e) {
                  e.preventDefault();
                  console.log("..");
                  var id = $(this).data("id");
                  Swal.fire({
                      title: 'Tem certeza que você quer deletar?',
                      text: "Esta candidatura ficará inativa no sistema mas ainda se encontrará no Banco de dados!",
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
                              data: {id_candidatura : id},
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

use Desenv\Aula11\Candidaturas;
use Desenv\Aula11\Vagas;

$candidaturas = new Candidaturas;
$resultadoCandidaturas = $candidaturas->getCandidaturas();

$vagas = new Vagas;
$rsVagas = $vagas->getVagasAtivas();

?>

<a href="index.php?page=form"><img src="./img/voltar.png" style="width: 100px;"></a>

<table class="table table-bordered">
<thead>

  <tr>
    <th scope="col">Id da Candidatura</th>
    <th scope="col">Nome do Candidato</th>
    <th scope="col">Nome da Vaga</th>
    <th scope="col">Data da Candidatura</th>
    <th scope="col">Status da Candidatura</th>
    <th scope="col">Editar</th>
    <th scope="col">Excluir</th>

    
  </tr>
</thead>
<tbody>

<?php foreach($resultadoCandidaturas as $candidatura): ?>
  <tr>
    <td><?= $candidatura['id_candidatura'] ?></td>
    <td><?= $candidatura['nome_candidato'] ?></td>
    <td><?= $candidatura['nome_vaga'] ?></td>
    <td><?= $candidatura['data_candidatura'] ?></td>
    <td><?=$candidatura['status_candidatura']?></td>
    <td><a href="index.php?page=listagem-candidaturas&&id_candidatura=<?=$candidatura['id_candidatura']?>&&nome_candidato=<?=$candidatura['nome_candidato']?>
    &&nome_vaga=<?=$candidatura['nome_vaga']?>&&data_candidatura=<?=$candidatura['data_candidatura']?>
    &&status_candidatura=<?=$candidatura['status_candidatura']?>" id="btn-aparecer-form"><img src="./img/iconeEditar.png" style="width: 30px;"></a></td>
    <td><a href="#" data-id="<?=$candidatura['id_candidatura']?>" class="exc-cand-vaga">
      <img src="./img/iconeExcluir.png" style="width: 30px;"></a></td> 
  </tr>
  <?php endforeach;?>
</tbody>
</table> 


<?php
$idDaCandidatura="";
$nomeDoCandidato="";
$nomeDaVaga="";
$dataDaCandidatura="";
$statusDaCandidatura="";

if(count($_GET)>1){
$idDaCandidatura = $_GET['id_candidatura'];    
$nomeDoCandidato = $_GET['nome_candidato'];
$nomeDaVaga = $_GET['nome_vaga'];
$dataDaCandidatura = $_GET['data_candidatura'];
$statusDaCandidatura = $_GET['status_candidatura'];
}

?>
<div style="color: #207178">
<br><h4><i>Clique no lápis para editar o status da canditadura para torná-la inativa
     e altere o preenchimento no formulário abaixo:</i></h4>
<strong><i>Usamos aqui exclusão lógica, ou seja, se alterar o status da candidatura de 'V' para 'F', ela não 
    mais estará disponível em atividade</i></strong>
</div>  



<?php 


?>
    
<form method="POST" class="row g-3" action="index.php?page=listagem-candidaturas" id="formEditVaga" style=" padding: 100px;">
<div class="col-md-2">
    <label for="inputEmai" class="form-label">Id da Candidatura:</label>
    <input type="text" class="form-control" id="inputEmai" name = "id-candidatura" value="<?=$idDaCandidatura?>" readonly>
  </div>
<div class="col-md-3">
    <label for="inputEmail4" class="form-label">Nome do Candidato:</label>
    <input type="text" class="form-control" id="inputEmail4" name = "nome-candidato" value="<?=$nomeDoCandidato?>" readonly>
  </div>
  <div class="col-md-3">
    <label for="inputEmail" class="form-label">Nome da Vaga:</label>
    <input type="text" class="form-control" id="inputEmail" name = "nome-vaga" value="<?=$nomeDaVaga?>" readonly>
  </div>
  <div class="col-md-2">
    <label class="form-label">Data da Candidatura:</label>
    <input type="text" class="form-control" id="inputDate" placeholder="ANO/MÊS/DIA" name = "data-candidatura" value="<?= $dataDaCandidatura ?>" Readonly>
  </div>
  <div class="col-md-2">
    <label for="inputState" class="form-label">Status Candidatura:</label>
    <select id="inputState" class="form-select" name = "status-candidatura" value="">
      <option value="V">V</option>
      <option value="F">F</option>
    </select>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Enviar</button> 
  </div>

</form>




<?php

$nomeDoCandidatoPost="";
$idCandidaturaPost="";
$nomeDaVagaPostPost="";
$dataDaCandidaturaPost="";
$statusCandidaturaPost="";

if(count($_POST)>0){

    $nomeDoCandidatoPost = filter_input(INPUT_POST, 'nome-candidato', FILTER_SANITIZE_STRING);
    $idCandidaturaPost = filter_input(INPUT_POST, 'id-candidatura', FILTER_SANITIZE_NUMBER_INT);
    $nomeDaVagaPostPost = filter_input(INPUT_POST, 'nome-vaga', FILTER_SANITIZE_STRING);
    $dataDaCandidaturaPost = filter_input(INPUT_POST, 'data-candidatura', FILTER_SANITIZE_STRING);
    $statusCandidaturaPost = filter_input(INPUT_POST, 'status-candidatura', FILTER_SANITIZE_STRING);
    
    $editCandidatura = new Candidaturas;
    $rsEdit = $editCandidatura->updateCandidatura($idCandidaturaPost, $statusCandidaturaPost);
    echo("<meta http-equiv='refresh' content='1'>");
    
}




?>

    </body>
</html>