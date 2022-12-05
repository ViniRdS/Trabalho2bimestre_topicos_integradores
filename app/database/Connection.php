<?php
namespace app\database;

use PDO;
use PDOException;

class Connection
{
    //Variável de conexão com banco de dados.
    private static $pdo = null;
    //Método de conexão com banco de dados.
    public static function connection()
    {
        //Inicializamos o bloco com tratamento de, onde se 
        //tenta prever possíveis erros de conexão ao banco de dados.
        try {
            //Caso já exista a conexão com banco de dados retornamos a conexão.
            if (static::$pdo) {
                return static::$pdo;
            }
            //Caso a conexão com banco de dados não exista criamos, uma nova conexão.
            static::$pdo = new PDO('pgsql:host=localhost;port=5432;dbname=aula2;'.
                                   'user=postgres;password=root');
            //Caso seja bem-sucedida a conexão retornamos a variável $pdo;
            return static::$pdo;
        } catch (PDOException $e) {
            var_dump($e->getMessage());
        }
    }
}
