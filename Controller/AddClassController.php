<?php
declare(strict_types=1);
namespace Controller;
use Model\Connection;
use Model\LearningClass;
use Model\TeacherLoader;
use Model\TeacherLoaderException;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class AddClassController
{
    public function render()
    {
        $pdo = Connection::openConnection();
        try {
            $teacherLoader = new TeacherLoader($pdo);
        }
        catch (TeacherLoaderException $e) {
            $errorMessage = $e->getMessage();
        }

        if(isset($_POST['id'])){
            $className = htmlspecialchars(trim($_POST['className']));
            $address = htmlspecialchars(trim($_POST['address']));
            $teacherId = (int)$_POST['teacherId'];
            $class = new LearningClass($className, $address);
            if($teacherId !== 0) {
                $class->setTeacher($teacherLoader, $teacherId);
            }
            $class->save($pdo);
        }

        $title = "Add a new class";
        $action = 'add';
        require 'View/add_class.php';
    }
}