<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
        <script src="./js/script.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    </head>
   
    <body>
    <a href="index.php?page=form"><img src="./img/voltar.png" style="width: 100px;"></a>
        <h1>
            Bem vindo à documentaçaõ do sistema de rh da empresa "X".
        </h1>
        <h4>Instruções para uso:</h4>
        <h5>1)</h5><p>Na página inicial (index.php?page=form) você verá um formulário e mais abaixo um grid 
            com vagas para serem escolhidas. Esta parte é auto-explicativa, basta você preencher o form com os 
            dados de um candidato que está interessado em uma de nossas vagas e clicar em enviar. NÃO SE ESQUEÇA 
            DE ESCOLHER UMA DAS VAGAS, precisaremos dessa informação para criarmos nossa tabela de cadidaturas.
        </p>
        <h5>2)</h5><p>Você deve ter percebido que no fim da página inicial (index.php?page=form), abaixo do grid de vagas,
            há um botão que diz para acrescentar uma vaga. Se clicarmos nele, um formulário mais abaixo irá aparecer, permitindo
        que adicionemos alguma vaga que porventura não esteja no sistema. Se necessário, CRIE! </p>
       
        <h5>3)</h5><p>Nesse momento, já descobrimos como criar uma nova candidatura no nosso sistema (afinal, não faz
            sentido cadastrarmos um candidato sem ligá-lo a uma vaga para formar uma candidatura). Tudo isso pode
ser feito na pagina inicial apenas preenchendo o form e enviando. Nesse momento voce será redirecionado para a página de 
confirmação de informação da candidatura, e três Opções surgirão na sua tela: -Voltar a tela de inicio, -verificar o arquivo XML ou 
-Verificar a listagem com Todos os Candidatos (ativos e inativos).
        <h5>4)</h5>
        <P>Se você escolher a opção "Verificar todos os candidatos", você cairá em uma página de listagem com todos 
            os condidatos já cadastrados nessa empresa, sejam eles ativos ou inativos.
            Sempre que você precisar, pode alterar algum dado de qualquer candidato, basta clicar no ícone de lápis ao lado 
            e alterar a informação no formulário abaixo do grid. (ESSA METODOLOGIA DE ALTERAÇÃO DE INFORMAÇÃO FOI UTILIZADA
             EM TODAS AS PÁGINAS DE LISTAGEM - CANDIDATOS, VAGAS E CANDIDATURAS.) Todas as informações que não podem ser alteradas
              com risco que comprometimento do sistema foram desabilitadas. 
        </P>
        <h5>5)</h5>
        <p>O resto do sistema é bem intuitivo, ao mexer algumas vezes você já estará bem ambientado ao sistema de rh
            da empresa "X". Lembre-se que todas as nossas deleções são feitas com ajax de maneira lógica. portanto, 
            se por acidente você excluir alguem que não queria, Basta alterar, no ícone do lápis, o status de "F" para "V".
            Por enquanto é isso. Se houver dúvida, entre em contato! 
        </p>


    </body>
</html>