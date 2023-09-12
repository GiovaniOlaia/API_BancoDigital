<?php

namespace App\Model;

use App\DAO\ContaDAO;

class ContaModel extends Model
{

    public $id_conta, $numero, $tipo, $senha_conta, $ativa, $fk_correntista;

    public function Salvar()
    {
        $dao = new ContaDAO();

        if(empty($this->id_conta))
        {
            $dao->insert($this);
        }

        else
        {
            return $dao->update($this);
        }
    }

    public function getAllRows(int $id_cidadao)
    {
        $dao = new ContaDAO();

        $this->rows = $dao->select($id_cidadao);
    }

    public function Erase(int $id)
    {
        (new ContaDAO())->Delete($id);
    }
    
}

?>