<?php

namespace App\DAO;

use \PDO;

use Exception;

use PDOException;

abstract class DAO extends PDO
{

    protected $conexao;

    protected function __construct()
    {

        try
        {

            $dsn = "mysql:host=" . $_ENV["database"]["host"] . ";dbname=" . $_ENV["database"]["db_name"];

            $options = [

                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"

            ];

            $this->conexao = new PDO($dsn, $_ENV["database"]["user"], $_ENV['database']['password'], $options);

        }

        catch(PDOException $ex)
        {

            throw new Exception("Ocorreu um erro!", 0, $ex);

        }
        
    }

}

?>