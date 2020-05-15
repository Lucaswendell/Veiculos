<?php

namespace Source\Controller;

use Exception;
use PDO;

class Connection
{
    private static $instance;
    public static function getConnection(): ?PDO
    {
        try {
            if (!isset(self::$instance)) {
                self::$instance = new PDO("mysql:host=localhost;dbname=veiculo", "root", "root");
            }
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo "Erro ao se conectar com o banco.";
        }
        return self::$instance;
    }

    public static function close(PDO &$con = null)
    {
        $con = null;
    }
}
