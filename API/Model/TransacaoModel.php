<?php

namespace App\Model;

use App\DAO\TransacaoDAO;

class TransacaoModel extends Model
{
    public $id, $id_categoria, $id_cidadao, $id_bairro, $descricao, $titulo, $endereco, $latitude, $longitude, $foto;

    public function save()
    {

        $dao = new TransacaoDAO();

        if(empty($this->id))
        {
            $dao->Insert($this);
        }
        else
        {
            $dao->Update($this);
        }
    }

    public function getAllRows(int $id_cidadao)
    {
        $dao = new TransacaoDAO();

        $this->rows = $dao->select($id_cidadao);
    }
}

?>