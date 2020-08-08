<?php
declare(strict_types=1);
namespace Controller;
use Model\ClassLoader;
use Model\ClassLoaderException;
use Model\LearningClass;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class AddClassController
{
    public function render()
    {
        if(isset($_POST['id'])){
            $className = htmlspecialchars(trim($_POST['className']));
            $address = htmlspecialchars(trim($_POST['address']));
            $class = new LearningClass($className, $address);
            $class->save();
        }
        require 'View/add_class.php';
    }
}