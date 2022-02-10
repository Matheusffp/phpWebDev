<?php

use Desenv\Aula11\Candidatos;
use Desenv\Aula11\Candidaturas;
use Desenv\Aula11\Vagas;

var_dump($_POST);

$idVaga= filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

$exclui = new Vagas;
$resultado = $exclui->exclusaoLogicaVaga($idVaga);

$idCandidato = filter_input(INPUT_POST, 'id_candidato', FILTER_SANITIZE_STRING);

$excluiCandidato = new Candidatos;
$excluido = $excluiCandidato->exclusaoLogicaCandidato($idCandidato);

$idCandidatura = filter_input(INPUT_POST, 'id_candidatura', FILTER_SANITIZE_STRING);

$excluiCandidatura = new Candidaturas;
$ex = $excluiCandidatura->exclusaoLogicaCandidatura($idCandidatura);

var_dump($ex);
