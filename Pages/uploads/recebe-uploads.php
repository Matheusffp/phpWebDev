<?php 

$_UP ['Arquivos'] = 'Pages/uploads/recebe-upload.php';

$_UP['tamanho'] = 1024 * 1024 * 2;

$_UP['extensoes'] = array('pdf', 'doc', 'docx');

$_UP['renomeia'] = 'false';

$_UP['erros'][0] = 'Não houve erro';
$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado de 2MB';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'Não foi feito o upload do arquivo';

if($_FILES['arquivo']['error'] != 0){
    die("Não foi possível fazer o upload, erro:<br />" . $_UP['erros'][$_FILES['arquivo']['error']]);
    exit;
}
@$extensao = strtolower(end(explode('.', $_FILES['arquivo']['name'])));
if(array_search($extensao, $_UP['extensoes']) === false) {
    echo "Por favor, envie arquivos com as seguintes extensões: pdf, doc, docx";
}
else if($_UP['tamanho'] < $_FILES['arquivo']['size']) {
    echo "O arquivo enviado enviado é muito grande, envie arquivos de até 2Mb.";
}
else {
    if($_UP['renomeia'] == true) {
        $nome_final = time().'.pdf';
    }else{
        $nome_final = $_FILES['arquivo']['name'];
    }
}
if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['Arquivos'] . $nome_final)){
    echo "Upload efetuado com sucesso!";
    echo "<br /><a href='" . $_UP['Arquivos'] . $nome_final . "'>Clique aqui para acessar o arquivo</a>"; 
}else{
    echo "Não foi possível enviar o arquivo, tente novamente";
}