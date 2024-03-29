<?php

namespace App\Model;

use App\DAO\ContaDAO;
use App\DAO\CorrentistaDAO;

class CorrentistaModel extends Model
{

    public $id_correntista, $nome, $cpf, $email, $data_nascimento, $senha_correntista, $ativo, $saldo, $limite, $data_cadastro;
    public $dados_contas;

    public function Salvar()
    {
        $dao_correntista = new CorrentistaDAO();

        $model_preenchido = $dao_correntista->Salvar($this);

        if(empty($this->id_correntista))
        {
            $correntista_model = $dao_correntista->Insert($this);

            if(empty($this->id_correntista))
            {
                $conta_dao = new ContaDAO();

                for($i = 0; $i < 2; $i++)
                {
                    switch($i)
                    {
                        case 0:

                            $conta_corrente_model = new ContaModel();

                            $conta_corrente_model->saldo = 0;

                            $conta_corrente_model->limite = 100;

                            $conta_corrente_model->tipo = "Corrente";

                            $conta_corrente_model->ativo = 1;

                            $conta_corrente_model->fk_correntista = $correntista_model->id_correntista;

                            $conta_dao->Insert($conta_corrente_model);

                            $correntista_model->dados_contas[] = $conta_corrente_model;

                        break;

                        case 1:

                            $conta_poupanca_model = new ContaModel();

                            $conta_poupanca_model->saldo = 0;

                            $conta_poupanca_model->limite = 0;

                            $conta_poupanca_model->tipo = "Poupança";

                            $conta_poupanca_model->ativa = 1;

                            $conta_poupanca_model->fk_correntista = $correntista_model->id_correntista;

                            $conta_dao->Insert($conta_poupanca_model);

                            $correntista_model->dados_contas[] = $conta_poupanca_model;

                        break;
                    }
                }

                return $correntista_model;

            }
        }

        else
        {
            return $correntista_dao->Update($this);
        }
    }


    public function Disable(int $id, bool $ativamento)
    {

        (new CorrentistaDAO())->Disable($id, $ativamento);

    }

    public function GetRows(string $filtro = null)
    {
        $dao = new CorrentistaDAO();

        $this->rows = ($filtro == null) ? $dao->Select() : $dao->Search($filtro);
    }
    
    public function LoginValidation(string $usuario, string $senha)
    {
        $this->rows = (new CorrentistaDAO())->Login($usuario, $senha);
    }
}

?>