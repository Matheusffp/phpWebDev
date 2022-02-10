<?php

namespace Desenv\Aula11;
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
    
        <script>
            $(document).ready(function(){
                $("#btn-aparecer-form").click(function(){
                     $("#formEditVaga").slideToggle();
            });
            $("html, body").animate({
                   scrollTop: $("#btn-aparecer-form").offset().top
              }, 50);
        });
        </script>

<?php

$vagas = new Vagas;
$resultadoVagas = $vagas->getVagas();
?>

<a href="index.php?page=form"><img src="./img/voltar.png" style="width: 100px;"></a>

<table class="table table-bordered">
<thead>

  <tr>
    <th scope="col">Id da vaga</th>
    <th scope="col">Nome da Vaga</th>
    <th scope="col">Descrição da Vaga</th>
    <th scope="col">Salário</th>
    <th scope="col">Status</th>
    <th scope="col">Editar</th>
    
  </tr>
</thead>
<tbody>
<?php foreach($resultadoVagas as $vaga): ?>
  <tr>
    <td><?= $vaga['id_vaga'] ?></td>
    <td><?= $vaga['nome_vaga'] ?></td>
    <td><?= $vaga['descricao_vaga'] ?></td>
    <td><?= $vaga['salario_vaga'] ?></td>
    <td><?=$vaga['status_vaga']?></td>
    <td><a href="index.php?page=listagem-vagas&&id_vaga=<?=$vaga['id_vaga']?>&&nome_vaga=<?=$vaga['nome_vaga']?>
    &&descricao_vaga=<?=$vaga['descricao_vaga']?>&&salario_vaga=<?=$vaga['salario_vaga']?>
    &&status_vaga=<?=$vaga['status_vaga']?>" id="btn-aparecer-form"><img src="./img/iconeEditar.png" style="width: 30px;"></a></td>
  </tr>
  <?php endforeach;?>
</tbody>
</table> 

<div style="color: #207178">
<br><h4><i>Clique no lápis para editar a vaga e altere o preenchimento no formulário abaixo:</i></h4>
<strong><i>Usamos aqui exclusão lógica, ou seja, se alterar o status da vaga de 'V' para 'F', ela não 
    mais estará disponível para cadastro de candidato</i></strong>
</div>    

<?php
$nomeDaVaga="";
$descricaoVaga="";
$salarioVaga="";
$statusVaga="";
$idVaga="";

if(count($_GET)>1){
$idVaga = $_GET['id_vaga'];    
$nomeDaVaga = $_GET['nome_vaga'];
$descricaoVaga = $_GET['descricao_vaga'];
$salarioVaga = $_GET['salario_vaga'];
$statusVaga = $_GET['status_vaga'];
}

?>




<form method="POST" class="row g-3" action="index.php?page=listagem-vagas" id="formEditVaga" style="padding: 100px;">
<div class="col-md-1">
    <label for="inputState" class="form-label">Id da vaga:</label>
    <select id="inputState" class="form-select" name = "idVaga" >
      <option value="<?=$idVaga?>" ><?=$idVaga?></option>
    </select>
  </div>  
<div class="col-md-6">
    <label for="inputEmail4" class="form-label">Nome da vaga:</label>
    <input type="text" class="form-control" id="inputEmail4" name = "nomeVaga" value="<?=$nomeDaVaga?>" placeholder="Coloque o nome da vaga" required>
  </div>
  <div class="col-md-3">
    <label for="inputCity" class="form-label">Salario:</label>
    <input type="text" class="form-control" id="inputCity" name = "salarioVaga" placeholder="Coloque o salario" value="<?= $salarioVaga ?>" required>
  </div>
  <div class="col-md-2">
    <label for="inputState" class="form-label">Status da vaga:</label>
    <select id="inputState" class="form-select" name = "statusVaga" value="">
      <option value="V">V</option>
      <option value="F">F</option>
    </select>
  </div>
  <div class="col-md-3">
    <label class="form-label">Descrição da Vaga:</label>
    <textarea  name="descricaoVaga" placeholder="Escreva aqui..." style="width:600px; height:100px;" value="<?= $descricaoVaga?>" required><?= $descricaoVaga?></textarea>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Enviar</button> 
  </div>

</form>
<?php

$nomeVagaPost="";
$idVagaPost="";
$descricaoVagaPost="";
$statusVagaPost="";
$salarioVagaPost="";

if(count($_POST)>0){

    $nomeVagaPost = filter_input(INPUT_POST, 'nomeVaga', FILTER_SANITIZE_STRING);
    $salarioVagaPost = filter_input(INPUT_POST, 'salarioVaga', FILTER_SANITIZE_NUMBER_FLOAT);
    $descricaoVagaPost = filter_input(INPUT_POST, 'descricaoVaga', FILTER_SANITIZE_STRING);
    $statusVagaPost = filter_input(INPUT_POST, 'statusVaga', FILTER_SANITIZE_STRING);
    $idVagaPost = filter_input(INPUT_POST, 'idVaga', FILTER_SANITIZE_NUMBER_INT);
    
    $editVaga = new Vagas;
    $resultado = $editVaga->updateVagas($idVagaPost ,$nomeVagaPost, $descricaoVagaPost, $salarioVagaPost, $statusVagaPost);
    echo("<meta http-equiv='refresh' content='1'>");
}



?>

