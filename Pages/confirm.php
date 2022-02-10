<?php
namespace Desenv\Aula11;

use Desenv\Aula11\Candidatos;
use Desenv\Aula11\Candidaturas;
use Desenv\Aula11\Vagas;

include "uploads/recebe-uploads.php";

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
        <script src="./js/script.js"></script>
        <link rel="stylesheet" href="./css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    


    </head>
    <body>

<?php



if($_POST){






    $i = "";
    if(isset($_POST['ingles']) && isset($_POST['espanhol'])){
        $i = array($_POST['ingles'], $_POST['espanhol']);
    
    }else if(isset($_POST['ingles'])){
        $i = $_POST['ingles'];
    }else if(isset($_POST['espanhol'])){
        $i = $_POST['espanhol'];
    }else if(!isset($_POST['ingles']) && !isset($_POST['espanhol'])){
        $i = "Nenhum";
    }

    //condição ? codigoUm : codigoDois;

$arrPost= array(
    $nome = filter_input(INPUT_POST, 'customerName', FILTER_SANITIZE_STRING),
    $tel = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT ),
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
    $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING),
    $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING),
    $resumoProf = filter_input(INPUT_POST, 'resumoProf', FILTER_SANITIZE_STRING),
    $idioma = $i,
    $presencial = filter_input(INPUT_POST, 'presencial', FILTER_SANITIZE_STRING),
    $statusCandidato = filter_input(INPUT_POST, 'statusCandidato', FILTER_SANITIZE_STRING),
    $vagaEscolhida = filter_input(INPUT_POST, 'vagaselecionada', FILTER_SANITIZE_STRING)
);

//criando corpo da mensagem do Mailler:
$corpoDaMensagem = "Você recebeu uma nova candidatura:<br>" . "Nome: " . $nome . 
"<br>" . "Telefone: " . $tel . "<br>" . "Email: " . $email . "<br>" . "Cidade: " . 
$cidade . "Estado: " . $estado . "<br>" . "Resumo Profissional: " . $resumoProf . "<br>" . 
"Idiomas Falados: " . $idioma . "<br>" . "Disponível para presencial: " . $presencial . "<br>" . 
"Status do Candidato: " . $statusCandidato . "<br>" . "Vaga Escolhida: " . $vagaEscolhida . "<br><br>";

echo $corpoDaMensagem;

$novaMensagem = new EmailSend;
$msgRecebida = $novaMensagem->send($corpoDaMensagem);

//
$inserirCandidato = new Candidatos;
$inserido = $inserirCandidato->setCandidato($nome, $email, $tel, $cidade, $estado, $idioma, $resumoProf, $presencial, $statusCandidato);

//puxando a chave estrangeira da vaga:
$puxarVaga = new Vagas;
$vagaPuxada = $puxarVaga->getVagasByName($vagaEscolhida);
foreach($vagaPuxada as $vagaParaCandidato){
    $fk_id_vaga = $vagaParaCandidato['id_vaga'];
}

//puxar a chave estrangeira do candidato:
$puxarCandidato = new Candidatos;
$candidatoPuxado = $puxarCandidato->getCandidatosByName($nome);
foreach($candidatoPuxado as $iddecandidato){
    $fk_id_candidato = $iddecandidato['id_candidato'];
}
//criando a data de hoje:
$dataHoje = date('Y/m/d');


//criando candidatura:
$novaCandidatura = new Candidaturas;
$candidtura = $novaCandidatura->setCandidaturas($fk_id_candidato, $fk_id_vaga, $dataHoje, $statusCandidato);
?> 

<h4><i>Candidatura criada com sucesso!</i></h4>

                    <ul class="list-group">
                         <li class="list-group-item"><b>Nome:</b> <?= $nome?></li>
                         <li class="list-group-item"><b>Status Inicial:</b> <?= $statusCandidato?></li>
                          <li class="list-group-item"><b>Email:</b> <?= $email?></li>
                          <li class="list-group-item"><b>Telefone:</b> <?= $tel?></li>
                          <li class="list-group-item"><b>Resumo profissional:</b> <?= $resumoProf?></li>
                          <li class="list-group-item"><b>cidade:</b> <?= $cidade?></li>
                          <li class="list-group-item"><b>Estado:</b> <?= $estado?></li>
                          <li class="list-group-item"><b>idioma:</b>
                          <?php if(gettype($idioma)== 'array'){
                               foreach($idioma as $idi){
                                   echo $idi . "  ";
                                   }
                                   }else{
                                        echo $idioma;
                                        } ?></li>
                          <li class="list-group-item"><b>Disponível para trabalho presencial?:</b> <?= $presencial?></li>
                          <li class="list-group-item"><b>Vaga Selecionada:</b> <?= $vagaEscolhida?></li>
                    </ul>

                   <br><a href="index.php?page=form" class="list-group-item list-group-item-action list-group-item-info">Voltar</a>
                    <a href="Pages/Cadastros.xml" class="list-group-item list-group-item-action list-group-item-info"> Verifique o arquivo XML </a>
                    <a href="index.php?page=listagem-candidatos" class="list-group-item list-group-item-action list-group-item-info"> Verifique a listagem de todos os candidatos </a>



<?php 



}
if(gettype($idioma)=='array'){
    $idioma = "Ambos (Inglês e Espanhol)";
}

//carrega o arquivo
$xml = simplexml_load_file('./Pages/Cadastros.xml');

//cria o elemento
$filho = $xml->addChild('cadastro');

//cria um elemento nome e assim vai...
$filho->addChild('nome', $nome);    
$filho->addChild('email', $email);
$filho->addChild('telefone', $tel);
$filho->addChild('cidade', $cidade);
$filho->addChild('estado', $estado);
$filho->addChild('resumoProfissional', $resumoProf);
$filho->addChild('idioma', $idioma);
$filho->addChild('presencial', $presencial);
$filho->addChild('vagaSelecionada', $vagaEscolhida);


file_put_contents("./Pages/Cadastros.xml", $xml->asXML());




?>
