<?php

use Api\Controller\CorrentistaController;
use Api\Controller\ContaController;
use Api\Controller\ChavePixController;
use Api\Controller\TransacaoController;

$url = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);

switch($url)
{

    /*
    * Correntista:
    */

    case "/correntista/salvar":
        CorrentistaController::Save();
    break;

    case "/correntista/entrar":
        CorrentistaController::Enter();
    break;

    /*
    * Conta:
    */ 

    case "/conta/pix/transferir":
        ContaController::Transferir();
    break;

    case "/conta/pix/cobrar":
        ContaController::Cobrar();
    break;

    case "/conta/extrato":
        ContaController::Gerar_Extrato();
    break;

    /*
    * Chave Pix:
    */

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

    /*
    * Transação:
    */

    default:
        http_response_code(404);
    
}

?>