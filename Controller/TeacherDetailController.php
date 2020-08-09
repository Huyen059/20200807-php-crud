<?php
declare(strict_types=1);
namespace Controller;
use Model\ClassLoader;
use Model\ClassLoaderException;
use Model\Connection;
use Model\LearningClass;
use Model\Teacher;
use Model\TeacherLoader;
use Model\TeacherLoaderException;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class TeacherDetailController
{
    public function render()
    {
        $pdo = Connection::openConnection();
        // If the delete button is clicked, remove the row in database before re-fetching the classes
        if(isset($_POST['delete'])){
            $id = (int)$_POST['delete'];
            Teacher::delete($pdo, $id);
        } else {
            try {
                $loader = new TeacherLoader($pdo);
                $teacher = $loader->getTeachers()[(int)$_GET['id']];
                $students = [];
                if($teacher->getClassId()){
                    $classLoader = new ClassLoader($pdo);
                    $class = $classLoader->getClasses()[$teacher->getClassId()];
                    $students = $class->getStudents();
                }

            }
            catch (TeacherLoaderException $e) {
                $errorMessage = $e->getMessage();
            }
            catch (ClassLoaderException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        require __DIR__ . '/../View/teacher_detail.php';
    }
}