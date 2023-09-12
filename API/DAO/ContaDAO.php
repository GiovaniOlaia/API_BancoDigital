<?php

namespace App\DAO;

use App\Model\ContaModel;

/**
 * As classes DAO (Data Access Object) são responsáveis por executar os
 * SQL junto ao banco de dados.
 */
class ContaDAO extends DAO
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

    /**
     * Método que recebe um model e extrai os dados do model para realizar o insert
     * na tabela correspondente ao model. Note o tipo do parâmetro declarado.
     */
    public function Insert(ContaModel $model) : ?ContaModel
    {
        // Trecho de código SQL com marcadores ? para substituição posterior, no prepare
        $sql = "INSERT INTO Conta(numero, tipo, senha_conta, ativa, " +
                "fk_correntista) VALUES (?, ?, ?, ?, ?)";
        
        /**
         * Declaração da variável stmt que conterá a montagem da consulta. Observe que
         * estamos acessando o método prepare dentro da propriedade que garda a conexão
         * com o MySQL, via operador seta "->". Isso significa que o prepare "está dentro"
         * da propriedade $conexao e recebe nossa string sql com os devidos marcadores.
         */
        $stmt = $this->conexao->prepare($sql);

        /**
         * Nesta etapa, os bindValue são responsáveis por receber um valor e trocar em uma
         * determinada posição, ou seja, o valor que está em 3, será trocado pelo terceiro ?
         * No que o bindValue está recebendo o model que veio via parâmetro e acessamos 
         * via seta qual dado do model queremos pegar para a posição em quetsão.
         */
        $stmt->bindValue(1, $model->numero);

        $stmt->bindValue(2, $model->tipo);

        $stmt->bindValue(3, $model->senha_conta);

        $stmt->bindValue(4, $model->ativa);

        $stmt->bindValue(5, $model->fk_correntista);

        $stmt->execute();

        $model->id_conta = $this->conexao->lastInsertId();

        return $model;

    }

    // Método que recebe o Model preenchido e atualiza no banco de dados.
    public function Update(ContaModel $model) : bool
    {
        $sql = "UPDATE Conta SET numero = ?, tipo = ?, senha_conta = ?, " +
                "ativa = ?, fk_correntista = ? WHERE id_conta = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $model->numero);

        $stmt->bindValue(2, $model->ativa);

        $stmt->bindValue(3, $model->senha_conta);

        $stmt->bindValue(4, $model->ativa);

        $stmt->bindValue(5, $model->fk_correntista);

        $stmt->bindValue(6, $model->id_conta);

        return $stmt->execute();
    }

    // Remove um registro da tabela pessoa do banco de dados.
    public function Delete(int $id) : bool
    {

        $sql = "DELETE FROM Conta WHERE id_conta = ?";

        $stmt = $this->conexao->prepare($sql);

        $stmt->bindValue(1, $id);

        return $stmt->execute();

    }

    // Método que retorna todas os registros da tabela pessoa no banco de dados.
    public function Select()
    {

        $sql = "SELECT * FROM Conta ORDER BY id_conta ASC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "App\Model\ContaModel");

    }

    /**
     * Retorna um registro específico da tabela pessoa do banco de dados.
     * Neste caso, retorna o Id da Conta.
     */
    public function SelectByIDConta() : array
    {

        $parametro = [":filtro" => "%"];

        $sql = "SELECT * FROM Conta WHERE numero LIKE :filtro ORDER BY id_conta ASC";

        $stmt = $this->conexao->prepare($sql);

        $stmt->execute($parametro);

        return $stmt->fetchAll(DAO::FETCH_CLASS, "App\Model\ContaModel");

    }
}

?>