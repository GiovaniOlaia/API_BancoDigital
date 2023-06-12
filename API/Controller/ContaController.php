<?php

namespace App\Controller;

use exception;

use App\Model\ContaModel;

class ContaController extends Controller
{
    public static function Registro() : void
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

            parent::GetResponseAsJSON($model->Save());
            
        }
        catch(Exception $ex)
        {

            parent::GetExceptionAsJSON($ex);

        }
    }

    public static function Remover() : void
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

    public static function Gerar_Extrato()
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