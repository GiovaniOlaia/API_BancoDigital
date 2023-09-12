<?php

namespace App\Model;

use App\DAO\ContaDAO;
use App\DAO\CorrentistaDAO;

class CorrentistaModel extends Model
{

    public $id, $id_correntista, $nome, $cpf, $data_nascimento, $senha_correntista, $ativo, $saldo, $limite;
    public $rows_contas;

    public function Salvar() : ?CorrentistaModel
    {
        $dao_correntista = new CorrentistaDAO();

        $model_preenchido = $dao_correntista->Salvar($this);

        if($model_preenchido->id_correntista != null)
        {
            $dao_conta = new ContaDAO();

            $conta_corrente = new ContaModel();
            $conta_corrente->id_correntista = $model_preenchido->id;
            $conta_corrente->saldo = 0;
            $conta_corrente->limite = 100;
            $conta_corrente->tipo = 'C';
            $conta_corrente = $dao_conta->Insert($conta_corrente);

            $model_preenchido->rows_contas[] = $conta_corrente;

            $conta_poupanca = new ContaModel();
            $conta_poupanca->id_correntista = $model_preenchido->id;
            $conta_poupanca->saldo = 0;
            $conta_poupanca->limite = 0;
            $conta_poupanca->tipo = 'P';
            $conta_poupanca = $dao_conta->Insert($conta_poupanca);

            $model_preenchido->rows_contas[] = $conta_poupanca;
        }

        else
        {
            return $model_preenchido;
        }
    }

    public function GetByCpfAndSenha($cpf, $senha_correntista)
    {
        return (new CorrentistaDAO())->SelectByCpfAndSenha($cpf, $senha_correntista);
    }
    
    public function Excluir(int $id)
    {

        (new CorrentistaDAO())->Delete($id);

    }

    public function Consultar(string $filtro = null)

    {
        $dao = new CorrentistaDAO();

        $this->rows = ($filtro == null) ? $dao->Select() : $dao->SelectByNomeCorrentista($filtro);
    }

}

?>