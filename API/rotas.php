<?php

use App\Controller\
{
    ChavePixController,
    CorrentistaController,
    ContaController,
    TransacaoController,
};

$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

switch($url)
{
    case '/exportar':
        $return_var = NULL;
        $output = NULL;
        $command = 'C:/Program Files"/MySQL/"MySQL Server 8.0"/bin/mysqldump -uroot -petecjau -P3307 -hlocalhost db_bancodigital > C:/Dev/file.sql';
        exec($command, $output, $exit_code);

        var_dump($exit_code);

        echo "deu certo.";
    break;
    
    // PIX:

    case "/chave_pix/salvar":
        ChavePixController::Salvar();
    break;

    case "/chave_pix/delete":
        ChavePixController::Remover();
    break;
    
     // Correntista:

    case "/correntista/entrar":
       CorrentistaController::Entrar();
    break;

    case "/correntista/salvar":
        CorrentistaController::Registro();
    break;

    case "/correntista/apagar":
        CorrentistaController::Remover();
    break;

    case "/correntista/pesqisar":
        CorrentistaController::Pesquisar();
    break;

    // Conta:

    case "/conta/abrir":
        ContaController::Abrir();
    break;

    case "/conta/fechar":
        ContaController::Fechar();
    break;

    case "/conta/gerar_extrato":
        ContaController::Extrato();
    break;

    // Transação:

    case "/transacao/receber_pix":
        TransacaoController::ReceberPix();
    break;

    case "/transacao/enviar_pix":
        TransacaoController::EnviarPix();
    break;
}

?>