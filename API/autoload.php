<?php

/**
 * A função registra junto ao PHP qual será a função (no código abaixo
 * uma função anônima) responsável por procurar e incluir as classes
 * requisitadas durante a execução dos scripts. No que a função anônima
 * tem um parâmetro que é o nome da classe procurada (junto com o devido
 * namespace)
 * Links abaixo para estudo:
 * Função sql_autoload_register => https://www.php.net/manual/pt_BR/function.spl-autoload-register.php
 * Funções Anônimas => https://www.php.net/manual/pt_BR/functions.anonymous.php
 */
spl_autoload_register(function($nome_classe)
{

    /**
     * Defidindo o caminho absoluto até o arquivo que será incluído pelo PHP.
     * A constante BASEDIR está definida no arquivo config.php. Também é
     * importante observar que na variável $nome_da_classe temos, além do nome
     * da classe buscada, o namespace que também deve ser o caminho de diretórios
     * até o arquivo que contém a classe.
     */
    $arquivo = BASEDIR . "/" . $nome_classe . ".php";

    if(file_exists($arquivo))
    {

        include $arquivo;

    }

    else
    {

        exit("Arquivo" . $arquivo. "não encontrado.");

    }

});

?>