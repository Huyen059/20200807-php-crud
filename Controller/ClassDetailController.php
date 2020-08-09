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

class ClassDetailController
{
    public function render()
    {
        $pdo = Connection::openConnection();
        // If the delete button is clicked, remove the row in database, nothing is displayed anymore
        if(isset($_POST['delete'])){
            $id = (int)$_POST['delete'];
            LearningClass::delete($pdo, $id);
        } else {
            try {
                $teacherLoader = new TeacherLoader($pdo);
                $loader = new ClassLoader($pdo);
                $class = $loader->getClasses()[(int)$_GET['id']];
            }
            catch (ClassLoaderException $e) {
                $errorMessage = $e->getMessage();
            }
            catch (TeacherLoaderException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        require __DIR__ . '/../View/class_detail.php';
    }
}