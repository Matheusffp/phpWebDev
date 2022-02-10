<?php


require __DIR__ . "./vendor/autoload.php";




require './vendor/autoload.php';

$page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
$filename = 'Pages/' . $page . '.php';
if(file_exists($filename)){
    require $filename;
}

?>

<a href="index.php?page=form" class="btn btn-primary btn-sm">IR PARA A PÁGINA INICIAL</a>