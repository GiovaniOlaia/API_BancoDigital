<?php

namespace App\Model;

use App\DAO\CorrentistaDAO;

class CorrentistaModel extends Model
{

    public function Salvar()
    {
        $dao = new CorrentistaDAO();

        if($this->id_correntista == null)
        {
            return $dao->Insert($this);
        }

        else
        {
            return $dao->Update($this);
        }
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