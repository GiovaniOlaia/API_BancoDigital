<?php

namespace App\DAO;

use App\Model\TransacaoModel;
use \PDO;

class TransacaoDAO extends DAO
{

    public function __construct()
    {

        parent::__construct();
        
    }

    /*public function Insert(TransacaoModel $model)
    {
        $sql = "INSERT INTO Reclamacao
                            (id_categoria, id_cidadao, id_bairro, descricao, titulo, enderenco, latitude, longitude, foto)
                VALUES
                            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->id_categoria);
        $stmt->bindValue(2, $model->id_cidadao);
        $stmt->bindValue(3, $model->id_bairro);
        $stmt->bindValue(4, $model->descricao);
        $stmt->bindValue(5, $model->titulo);
        $stmt->bindValue(6, $model->endereco);
        $stmt->bindValue(7, $model->latitude);
        $stmt->bindValue(8, $model->longitude);
        $stmt->bindValue(9, $model->foto);

        return $stmt->execute();
    }*/

    /*public function update(ReclamacaoModel $model)
    {
        $sql = "UPDATE Reclamacao SET titulo = ? descricao = ? WHERE id=? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $model->nome);
        $stmt->bindValue(2, $model->cpf);
        $stmt->bindValue(3, $model->data_nascimento);
        $stmt->bindValue(4, $model->id);
        return $stmt->execute();
    }*/

    /*public function select(int $id_cidadao)
    {

        $sql = "SELECT * FROM Reclamacao WHERE id_cidadao = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id_cidadao);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);

    }*/
    
    /*public function selectById(int $id)
    {
        $sql = "SELECT * FROM Reclamacao WHERE id = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchObject("App\Model\ReclamacaoModel"); // Retornando um objeto específico PessoaModel
    }*/

    /*public function delete(int $id)
    {
        $sql = "UPDATE Reclamacao SET ativo='N' WHERE id = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }*/

}

?>