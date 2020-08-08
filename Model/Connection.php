<?php
declare(strict_types=1);
namespace Model;
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class Connection
{
    public static function openConnection(): \PDO
    {
        $dbhost = "localhost";
        $dbuser = "becode";
        $dbpass = password;
        $db = "crud_db";

        $driverOptions = [
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        ];

        return new \PDO('mysql:host=' . $dbhost . ';dbname=' . $db, $dbuser, $dbpass, $driverOptions);
    }
}