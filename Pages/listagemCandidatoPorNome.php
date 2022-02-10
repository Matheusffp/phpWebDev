
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



        

    </head>
    <body>


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
  
<?php

use Desenv\Aula11\Candidatos;

$procuraPeloNome= filter_input(INPUT_POST, 'procurarPorNome', FILTER_SANITIZE_STRING);

    $con = new Candidatos;
    $listagem = $con->searchCandidatosByName($procuraPeloNome);
  


?>
<!DOCTYPE html>
  
  
  
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
 
<script>
           
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

  
                     
        </script>


    </body>