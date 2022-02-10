<?php

use Desenv\Aula11\EmailSend;
use Desenv\Aula11\Vagas;



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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">



  <div id="superior" style="background-color: #50c8c6; display:block; text-align:center;font-family:Verdana; padding:0; margin-right:0; ">


    <h1> <img src="./img/logoex.png" style="width: 250px;"> </h1>
    <i>
      <h4>Bem vindo ao sistema de rh da empresa "X". Clique no menu abaixo em "COMO FUNCIONA" e leia atentamente a
        documentação do sistema!
      </h4>
    </i>
  </div>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Alterna navegação">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link" style="margin-left: 50px;" href="index.php?page=form">Criar Candidatura<span class="sr-only">(Página atual)</span></a>
        <a class="nav-item nav-link" style="margin-left: 50px;" href="index.php?page=listagem-candidatos">Lista de Candidatos</a>
        <a class="nav-item nav-link" style="margin-left: 50px;" href="index.php?page=listagem-vagas">Lista De Vagas</a>
        <a class="nav-item nav-link" style="margin-left: 50px;" href="index.php?page=listagem-candidaturas">Lista de Candidaturas</a>
        <a class="nav-item nav-link" style="margin-left: 50px;" href="index.php?page=documentacao">COMO FUNCIONA?</a>
      </div>
    </div>
  </nav>

</head>

<body>


  <?php

 $vagas = new Vagas;
 $resultadoVagas = $vagas->getVagasAtivas();


  ?>


  <form method="POST" enctype="multipart/form-data" class="row g-3" action="index.php?page=confirm" id="myCustomForm" style="padding: 30px;">
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Nome:</label>
      <input type="text" class="form-control" id="inputEmail4" name="customerName" placeholder="Coloque seu nome" required>
    </div>
    <div class="col-md-6">
      <label for="inputPassword4" class="form-label">Email:</label>
      <input type="email" class="form-control" id="inputPassword4" name="email" placeholder="Coloque seu email" required>
    </div>
    <div class="col-md-6">
      <label for="inputCity" class="form-label">Cidade:</label>
      <input type="text" class="form-control" id="inputCity" name="cidade" placeholder="Coloque sua cidade" required>
    </div>
    <div class="col-md-2">
      <label for="inputZip" class="form-label">Telefone:</label>
      <input type="tel" class="form-control" id="inputZip" name="phone" placeholder="Coloque seu telefone">
    </div>
    <div class="col-md-4">
      <label for="inputState" class="form-label">Estado:</label>
      <select id="inputState" class="form-select" name="estado">
        <option value="MG">MG</option>
        <option value="SP">SP</option>
        <option value="RJ">RJ</option>
        <option value="ES">ES</option>
      </select>
    </div>
    <div class="form-check">
      <label>Fala Outro idioma?</label><br>
      <label>Inglês</label>
      <input type="checkbox" name="ingles" value="ingles">
      <label>Espanhol</label>
      <input type="checkbox" name="espanhol" value="espanhol">
    </div>
    <br><label>Resumo Profissional:</label>
    <textarea id="resumoProf" name="resumoProf" value="" placeholder="Escreva aqui..." required></textarea><br>

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
      <select id="inputState" class="form-select" name="statusCandidato">
        <option value="V">V</option>
        <option value="F">F</option>
      </select><br><br>
    </div>
    <Label> <strong>Anexe um curriculo para o candidato:</strong><br>
    <input type = "file" name= "arquivo"/>
    </Label>
    
    

  <h4>Escolha abaixo a vaga que o candidato quer se candidatar: <i>(Apenas vagas ativas)</i></h4>

    <table class="table table-bordered" id="resultado">
      <thead>

        <tr>
          <th scope="col">Id da vaga</th>
          <th scope="col">Nome da Vaga</th>
          <th scope="col">Descrição da Vaga</th>
          <th scope="col">Salário</th>
          <th scope="col">Escolha</th>
          <th scope="col">Excluir</th>

        </tr>
      </thead>
      <tbody>
        <?php foreach ($resultadoVagas as $vaga) : ?>
          <tr>
            <td><?= $vaga['id_vaga'] ?></td>
            <td><?= $vaga['nome_vaga'] ?></td>
            <td><?= $vaga['descricao_vaga'] ?></td>
            <td><?= $vaga['salario_vaga'] ?></td>
            <td><input type="radio" name="vagaselecionada" value="<?= $vaga['nome_vaga'] ?>"></td>
            <td><a href="#" id="btnexcluir" data-id="<?= $vaga['id_vaga'] ?>" class="exc-user">
                <img src="./img/iconeExcluir.png" style="width: 30px;"></a></td>

          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="col-6">
      <button type="submit" class="btn btn-primary">Enviar</button>
    </div>
  </form>



  <!-- ADD NOVA VAGA-->
  <div class="col-6">
    <button type="" id="btn-aparecer-form" class="btn btn-primary">Clique para adicionar outra vaga</button> <i>... e preencha o formulário abaixo</i><br><br>
  </div>

  <form method="POST" class="row g-3" action="index.php?page=form" id="formNovaVaga" style="display:none; padding: 100px;">
    <div class="col-md-6">
      <label for="inputEmail4" class="form-label">Nome da vaga:</label>
      <input type="text" class="form-control" id="inputEmail4" name="nomeVaga" placeholder="Coloque seu nome" required>
    </div>
    <div class="col-md-6">
      <label for="inputCity" class="form-label">Salario:</label>
      <input type="text" class="form-control" id="inputCity" name="salarioVaga" placeholder="Coloque sua cidade" required>
    </div>
    <div class="col-md-6">
      <label class="form-label">Descrição da Vaga:</label>
      <textarea name="descricaoVaga" value="" placeholder="Escreva aqui..." style="width:600px; height:100px;" required></textarea>
    </div>
    <div class="col-md-2">
      <label for="inputState" class="form-label">Status da vaga:</label>
      <select id="inputState" class="form-select" name="statusVaga" value="">
        <option value="V">V</option>
        <option value="F">F</option>
      </select>
    </div>
    <div class="col-12">
      <button type="submit" class="btn btn-primary">Enviar</button>
    </div>

  </form>



  <?php
  if (count($_POST) > 0) {
    $nomeVaga = filter_input(INPUT_POST, 'nomeVaga', FILTER_SANITIZE_STRING);
    $salarioVaga = filter_input(INPUT_POST, 'salarioVaga', FILTER_SANITIZE_NUMBER_FLOAT);
    $descricaoVaga = filter_input(INPUT_POST, 'descricaoVaga', FILTER_SANITIZE_STRING);
    $statusVaga = filter_input(INPUT_POST, 'statusVaga', FILTER_SANITIZE_STRING);

    $novaVaga = new Vagas;
    $resultado = $novaVaga->setVagas($nomeVaga, $descricaoVaga, $salarioVaga, $statusVaga);
    echo ("<meta http-equiv='refresh' content='1'>");
  }

  ?>
  <script>
    $(document).ready(function() {

      $("#btn-aparecer-form").click(function() {
        $("#formNovaVaga").slideToggle();

      });

      $(".exc-user").click(function(e) {
        e.preventDefault();
        console.log("..");
        var id = $(this).data("id");
        Swal.fire({
          title: 'Tem certeza que você quer deletar?',
          text: "Você não vai mais poder usar esta vaga para formar uma candidatura!",
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
                data: {
                  id: id
                },
                success: function(html) {
                  location.reload();
                }
              });
             
            } else {
              Swal.fire("Sua vaga não foi excluída!");
            }
          });
      });

    });
  </script>


  <script>
    $(".exc-user").click(function() {


    });
  </script>




</body>

<footer>

</footer>

</html>
