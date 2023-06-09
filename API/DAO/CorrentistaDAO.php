<?php

namespace App\DAO;

use App\Model\CorrentistaModel;

class CorrentistaDAO extends DAO
{

    public function __construct()
    {

        parent::__construct();
        
    }

    public function Insert(CorrentistaModel $model) : CorrentistaModel
    {

        $sql = "INSERT INTO Correntista(nome, cpf, data_nascimento, " +
                "senha_correntista, ativo) VALUES(?, ?, ?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->nome);

        $stmt->bindValue(2, $model->cpf);

        $stmt->bindValue(3, $model->data_nascimento);

        $stmt->bindValue(4, $model->senha_correntista);

        $stmt->bindValue(5, $model->ativo);

        $stmt->execute();

        $model->id_correntista = $this->conexao->lastInsertId();

        return $model;

    }

    public function Update(CorrentistaMOdel $model) : bool
    {

        $sql = "UPDATE Correntista SET nome = ?, cpf = ?, data_nascimento = ?, " +
               "senha_correntista = ?, ativo = ? WHERE id_correntista = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->nome);

        $stmt->bindValue(2, $model->cpf);

        $stmt->bindValue(3, $model->data_nascimento);

        $stmt->bindValue(4, $model->senha_correntista);

        $stmt->bindValue(5, $model->ativo);

        $stmt->bindValue(6, $model->id_correntista);

        return $stmt->execute();

    }

    public function Disable(int $id) : bool
    {

        $sql = "DELETE FROM Correntista WHERE id_correntista = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $id);

        return $stmt->execute();

    }

    public function Select() : array
    {

        $sql = "SELECT * FROM Correntista ORDER BY id_correntista ASC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "App\Model\CorrentistaModel");

    }

    public function SelectByNomeCorrentista(string $query) : array
    {

        $parametro = [":filtro" => "%" . $query. "%"];

        $sql = "SELECT * FROM Correntista WHERE nome LIKE :filtro ORDER BY id_correntista ASC";

        $stmt = $this->conexao->prepare($sql);

        return $stmt->fetchAll(DAO::FETCH_CLASS, "App\Model\CorrentistaModel");

    }

}

?>