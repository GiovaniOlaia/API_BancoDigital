<?php

use App\Controller\CorrentistaController;
use App\Controller\ContaController;
use App\Controller\ChavePixController;
use App\Controller\TransacaoController;

$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

switch($url)
{

     // Correntista:

    case "/correntista":
       CorrentistaController::Listagem();
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

    case "/conta/salvar":
        ContaController::Registro();
    break;

    case "/conta/pix/apagar":
        ContaController::Remover();
    break;

    case "/conta/gerar_extrato":
        ContaController::Gerar_Extrato();
    break;

    /* Chave Pix:
    

    case "/chave_pix/criar":
        ChavePixController::Criar();
    break;

    case "/chave_pix/editar":
        ChavePixController::Editar();
    break;

    case "/chave_pix/excluir":
        ChavePixController::Excluir();
    break;

    case "/chave_pix/atualizar_portador":
        ChavePixController::Atualizar_Portador();
    break;
    */

    /* Transação:
    

    case "/transacao/transferir":
        TransacaoController::Transferir();
    break;

    case "/transacao/cobrar":
        TransacaoController::Cobrar();
    break;

    default:
        http_response_code(404);
    */
}

?>