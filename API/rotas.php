<?php

use BancoDigital_API\Controller\Controller;

$url = parse_url($_SERVER['REQUEST_URl'], PHP_URL_PATH);

switch ($url) 
{
  case '/correntista/save':
    Controller::getSaveByCorrentista();
  break;

/**
 * [OK] Exemplo de Acesso:
 */

  case '/conta/extrato':
    Controller::getExtratoByConta();
  break;

/**
 * [OK] Exemplo de Acesso:
 */

 case '/conta/pix/enviar':
    Controller::getEnviarPixByConta();
 break;

/**
 * [OK] Exemplo de Acesso:
 */

  case '/conta/pix/receber':
    Controller::getReceberPixByConta();
 break;

/**
 * [OK] Exemplo de Acesso:
 */

 case '/correntista/entrar':
    Controller::getEntrarByCorrentista();
 break;

 default:
    http_response_code(403);
 break;

}