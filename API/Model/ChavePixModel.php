<?php

namespace App\Model;

use App\DAO\ChavePixDAO;

class ChavePixModel extends Model
{
    public $id, $id_conta, $tipo, $chave;

    public function Salvar()
    {
        return (new ChavePixDAO())->Salvar($this);
    }

    public function Editar()
    {
        return (new ChavePixDAO())->Delete($this);
    }
}

?>