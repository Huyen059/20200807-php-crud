<?php
declare(strict_types=1);
namespace Controller;
use Model\ClassLoader;
use Model\ClassLoaderException;
use Model\Connection;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class ClassGeneralController
{
    public function render()
    {
        $pdo = Connection::openConnection();
        try {
            $loader = new ClassLoader($pdo);
        }
        catch (ClassLoaderException $e) {
            $errorMessage = $e->getMessage();
        }

        $count = 1;

        require 'View/class_general.php';
    }
}