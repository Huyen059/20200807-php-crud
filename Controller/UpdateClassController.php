<?php
declare(strict_types=1);
namespace Controller;
use Model\ClassLoader;
use Model\ClassLoaderException;
use Model\Connection;
use Model\LearningClass;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class UpdateClassController
{
    public function render()
    {
        $pdo = Connection::openConnection();
        if(isset($_POST['id'])){
            $className = htmlspecialchars(trim($_POST['className']));
            $address = htmlspecialchars(trim($_POST['address']));
            $teacherId = (int)$_POST['teacherId'];
            $class = new LearningClass($className, $address);
            if($teacherId !== 0) {
                $class->setTeacher($teacherId);
            }
            $class->setId((int)$_POST['id']);
            $class->save($pdo);
        } else {
            try {
                $loader = new ClassLoader($pdo);
                $classes = $loader->getClasses();
                $classId = (int)$_POST['update'];
                $class = $classes[$classId];
                $id = $class->getId();
                $className = $class->getName();
                $address = $class->getAddress();
            }
            catch (ClassLoaderException $e)
            {
                $errorMessage = $e->getMessage();
            }
        }

        $title = "Update data";
        $action = 'update';
        require 'View/add_class.php';
    }
}