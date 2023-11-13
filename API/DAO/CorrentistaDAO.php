<?php

namespace App\DAO;

use App\Model\CorrentistaModel;

class CorrentistaDAO extends DAO
{

    /**
     * Método construtor, sempre chamado na classe quando a classe é instanciada.
     * Exemplo de instanciar classe (criar objeto da classe):
     * $dao = new PessoaDAO();
     */
    public function __construct()
    {

        /**
         * Chamando o construtor da classe DAO, isto é, toda vez que chamos o consturo da classe DAO
         * estamos fazendo a conexão com o banco de dados.
         */
        parent::__construct();
        
    }

    public function Salvar(CorrentistaModel $model) : CorrentistaModel
    {
        return ($model->id == null) ? $this->insert($model) : $this->Update($model);
    }

    /**
     * Método que recebe um model e extrai os dados do model para realizar o insert
     * na tabela correspondente ao model.
     */
    public function Insert(CorrentistaModel $model) : CorrentistaModel
    {
        $sql = "INSERT INTO Correntista id_correntista, nome, cpf, data_nascimento, " +
                "senha_correntista, ativo, saldo, limite" + 
                "VALUES (?, ?, ?, ?, sha1(?), ?, ?) ";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->id_correntista);

        $stmt->bindValue(2, $model->nome);

        $stmt->bindValue(3, $model->cpf);

        $stmt->bindValue(4, $model->data_nascimento);

        $stmt->bindValue(5, $model->senha_correntista);

        $stmt->bindValue(6, $model->ativo);

        $stmt->bindValue(7, $model->saldo);

        $stmt->bindValue(8, $model->limite);

        // Ao fim, onde todo SQL está montando, executamos a consulta.
        $stmt->execute();

        $model->id_correntista = $this->conexao->lastInsertId();

        return $model;

    }

    public function Update(CorrentistaModel $model) : bool
    {

        $sql = "UPDATE Correntista SET nome = ?, cpf = ?, data_nascimento = ?, " +
               "senha_correntista = ?, ativo = ?, saldo = ?, limite = ?" + 
               "WHERE id_correntista = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->nome);

        $stmt->bindValue(2, $model->cpf);

        $stmt->bindValue(3, $model->data_nascimento);

        $stmt->bindValue(4, $model->senha_correntista);

        $stmt->bindValue(5, $model->ativo);

        $stmt->bindValue(6, $model->saldo);

        $stmt->bindValue(7, $model->limite);

        $stmt->bindValue(8, $model->id_correntista);

        return $stmt->execute();

    }

    public function Disable(int $id, bool $ativamento)
    {

        $sql = "UPDATE Correntista SET ativo = ? WHERE id_correntista = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $ativamento);

        $stmt->bindValue(2, $id);

        return $stmt->execute();

    }

    // Função a ser excluída
    public function Delete(int $id_correntista) : bool
    {

        $sql = "DELETE FROM Correntista WHERE id_correntista = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $id_correntista);

        return $stmt->execute();

    }

    public function Select() : array
    {

        $sql = "SELECT * FROM Correntista ORDER BY id_correntista ASC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "App\Model\CorrentistaModel");

    }

    public function Search(string $query) : array
    {
        $parametro = [":filtro" => "%" . $query. "%"];

        $sql = "SELECT * FROM Correntista WHERE ativo = 1 AND nome LIKE :filtro ORDER BY id_correntista ASC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute($parametro);

        return $stmt->fetchAll(DAO::FETCH_CLASS, "Api\Model\CorrentistaModel");
    }
    
    public function SelectByNomeCorrentista(string $query) : array
    {

        $parametro = [":filtro" => "%" . $query. "%"];

        $sql = "SELECT * FROM Correntista WHERE nome LIKE :filtro ORDER BY id_correntista ASC";

        $stmt = $this->conexao->prepare($sql);

        return $stmt->fetchAll(DAO::FETCH_CLASS, "App\Model\CorrentistaModel");

    }

    public function SelectByCpfAndSenha($cpf, $senha)
    {

        $sql = "SELECT * FROM correntista WHERE cpf = ? AND senha = sha1(?) ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $cpf);
        $stmt->bindValue(2, $senha);
        $stmt->execute();
    }
}

?>