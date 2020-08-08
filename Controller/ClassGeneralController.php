<?php
declare(strict_types=1);
namespace Controller;
use Model\ClassLoader;
use Model\ClassLoaderException;
use Model\Connection;
use Model\LearningClass;
use Model\TeacherLoader;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class ClassGeneralController
{
    public function render()
    {
        $pdo = Connection::openConnection();
        if(isset($_POST['delete'])){
            $id = (int)$_POST['delete'];
            LearningClass::delete($pdo, $id);
        }
        try {
            $loader = new ClassLoader($pdo);
            $teacherLoader = new TeacherLoader($pdo);
        }
        catch (ClassLoaderException $e) {
            $errorMessage = $e->getMessage();
        }

        $count = 1;

        require 'View/class_general.php';
    }
}