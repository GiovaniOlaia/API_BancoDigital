<?php

namespace App\Controller;

use Exception;

use App\Model\CorrentistaModel;

class CorrentistaController extends Controller
{
    // Responsável por processar o login do Correntista.

    public static function Registro()
    {
        try
        {
            // Obtendo os dados enviados por json via C#
            $objeto_json = json_decode(file_get_contents("php://input"));

            // Criando o model
            $model = new CorrentistaModel();

            $model->id_correntista = $objeto_json->id;

            $model->nome = $objeto_json->nome;

            $model->cpf = $objeto_json->cpf;

            $model->data_nascimento = $objeto_json->data_nascimento;

            $model->senha_correntista = $objeto_json->senha_correntista;

            $model->ativo = $objeto_json->ativo;

            /**
             * Realizando o login com os dados digitados na interface do App
             * Exemplo de saída que poderá ser vista no Console do Visual Studio 2022:
             * {"rows":null,"id":"6","nome":"Giovani","email":"giovani@teste.com","cpf":"123456789",
             * "data_nascimento":"2005-02-08T00:00:00","senha":"123"}
             */
            parent::GetResponseAsJSON($model->GetByCpfAndSenha($objeto_json->Cpf, $objeto_json->Senha));
            
        }
        catch(Exception $ex)
        {
            parent::LogError($ex);
            parent::GetExceptionAsJSON($ex);
        }
    }

    /**
     * Responsável pela coleta do Cpf e Senha para check com o banco e assim,
     * permitir a entrada do usuário.
     */
    public static function Entrar()
    {
        try
        {
            $data = json_decode(file_get_contents('php://input'));

            $model = new CorrentistaModel();

            parent::GetResponseAsJSON($model->GetByCpfAndSenha($data->Cpf, $data->Senha));

        }
        catch(Exception $ex)
        {
            parent::LogError($ex);
            parent::GetExceptionAsJSON($ex);
        }
    }

    public static function Salvar()
    {
        try
        {
            $data = json_decode(file_get_contents('php://input'));

            $model = new CorrentistaModel();

            foreach (get_object_vars($data) as $key => $value)
            {
                $prop_letra_minuscula = strtolower($key);

                $model->$prop_letra_minuscula = $value;
            }
        }
        catch(Exception $ex)
        {
            parent::LogError($ex);
            parent::GetExceptionAsJSON($ex);
        }
    }

    public static function Remover() : void
    {
        try
        {
            $conteudo = json_decode(file_get_contents('php://input'));

            $model = new CorrentistaModel();

            $model->Excluir($conteudo);

            parent::GetResponseAsJSON($model->$conteudo);

        }
        catch(Exception $ex)
        {
            parent::LogError($ex);
            parent::GetExceptionAsJSON($ex);
        }
    }

    public static function Pesquisar() : void
    {
        try
        {
            $model = new CorrentistaModel();

            $conteudo = json_decode(file_get_contents("php://input"));

            $model->Query($conteudo);

            parent::GetResponseAsJSON($model->rows);
        }
        catch(Exception $ex)
        {
            parent::LogError($ex);
            parent::GetExceptionAsJSON($ex);
        }
    }
}

?>