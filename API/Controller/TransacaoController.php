<?php

namespace App\Controller;

/**
 * Definimos aqui que nossa classe precisa incluir uma classe de outro subnamespace
 * do projeto, no caso a classe PessoaModel do subnamespace Model
 */

use App\Model\TransacaoModel;

/**
 * Classes Controller são responsáveis por processar as requisições do usuário.
 * Isso significa que toda vez que um usuário chama uma rota, um método (função)
 * de uma classe Controller é chamado.
 * O método poderá devolver uma View (fazendo um include), acessar uma Model (para
 * buscar algo no banco de dados), redirecionar o usuário de rota, ou mesmo,
 * chamar outra Controller.
 */

class TransacaoController extends Controller
{
    public static function ReceberPix()
    {
        $objeto_json = json_decode(file_get_contents('php://input'));
    }

    public static function EnviarPix()
    {
        $objeto_json = json_decode(file_get_contents('php://input'));
    }
}