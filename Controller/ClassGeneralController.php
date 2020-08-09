<?php
declare(strict_types=1);
namespace Controller;
use Model\ClassLoader;
use Model\ClassLoaderException;
use Model\Connection;
use Model\LearningClass;
use Model\TeacherLoader;
use Model\TeacherLoaderException;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class ClassGeneralController
{
    public function render()
    {
        $pdo = Connection::openConnection();
        // If the delete button is clicked, remove the row in database before re-fetching the classes
        if(isset($_POST['delete'])){
            $id = (int)$_POST['delete'];
            LearningClass::delete($pdo, $id);
        }
        // Get the teacherLoader because constructor of ClassLoader needs it
        // Todo: need to separate them somehow
        try {
//            $teacherLoader = new TeacherLoader($pdo);
//            $teachers = $teacherLoader->getTeachers();
            $loader = new ClassLoader($pdo);
        }
        catch (ClassLoaderException $e) {
            $errorMessage = $e->getMessage();
        }
//        catch (TeacherLoaderException $e) {
//            $teachers = [];
//            $errorMessage = $e->getMessage();
//        }

        $count = 1;

        require __DIR__ . '/../View/class_general.php';
    }
}