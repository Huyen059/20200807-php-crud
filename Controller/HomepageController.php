<?php
declare(strict_types=1);
namespace Controller;
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class HomepageController {
    public function render()
    {
        require 'View/homepage.php';
    }
}
