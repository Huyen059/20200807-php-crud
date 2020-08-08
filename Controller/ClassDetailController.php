<?php
declare(strict_types=1);
namespace Controller;
use Model\ClassLoader;
use Model\ClassLoaderException;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class ClassDetailController
{
    public function render()
    {
        try {
            $loader = new ClassLoader();
            $class = $loader->getClasses()[(int)$_GET['id']];
        }
        catch (ClassLoaderException $e) {
            $errorMessage = $e->getMessage();
        }

        require 'View/class_detail.php';
    }
}