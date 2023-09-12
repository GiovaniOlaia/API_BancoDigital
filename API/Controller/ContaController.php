<?php

namespace App\Controller;

use Exception;

/**
 * Definimos aqui que nossa classe precisa incluir uma classe de outro subnamespace
 * do projeto, no caso a classe PessoaModel do subnamespace Model
 */

use App\Model\ContaModel;

/**
 * Classes Controller são responsáveis por processar as requisições do usuário.
 * Isso significa que toda vez que um usuário chama uma rota, um método (função)
 * de uma classe Controller é chamado.
 * O método poderá devolver uma View (fazendo um include), acessar uma Model (para
 * buscar algo no banco de dados), redirecionar o usuário de rota, ou mesmo,
 * chamar outra Controller.
 */

class ContaController extends Controller
{
    public static function Abrir() : void
    {
        try
        {
            $objeto_json = json_decode(file_get_contents("php://input"));

            $model = new ContaModel();

            $model->id_conta = $objeto_json->id;

            $model->numero = $objeto_json->numero;

            $model->tipo = $objeto_json->tipo;

            $model->senha_conta = $objeto_json->senha_conta;

            $model->ativa = $objeto_json->ativa;

            $model->fk_correntista = $objeto_json->fk_correntista;

            parent::GetResponseAsJSON($model->Salvar());
            
        }
        catch(Exception $e) 
        {

            parent::GetExceptionAsJSON($e);

        }
    }

    public static function Fechar() : void
    {
        try
        {
            $id = json_decode(file_get_contents("php://input"));

            (new ContaModel())->Erase((int) $id);
        }
        catch(Exception $ex)
        {
            parent::GetExceptionAsJSON($ex);
        }
    }

    public static function Extrato()
    {
        try
        {

        }
        catch(Exception $ex)
        {
            parent::GetExceptionAsJSON(($ex));
        }
    }
}

?>