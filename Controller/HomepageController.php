<?php
declare(strict_types=1);
namespace Controller;
use Model\Connection;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class HomepageController {
    public function render()
    {
        $pdo = Connection::openConnection();
        require __DIR__ . '/../View/homepage.php';
    }
}
