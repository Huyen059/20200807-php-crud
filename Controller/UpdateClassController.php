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

class UpdateClassController
{
    public function render()
    {
        $pdo = Connection::openConnection();

        // When the form is not submitted, we need to displayed the info currently stored in database
        if(!isset($_POST['id'])){
            try {
                // Get the list of all teachers, so that they can be displayed in the dropdown of the form
                $teacherLoader = new TeacherLoader($pdo);
                $teachers = $teacherLoader->getTeachers();
                // Load the class
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
            catch (TeacherLoaderException $e) {
                $teachers = [];
                $errorMessage = $e->getMessage();
            }
        } else {
            // After the form is submitted, we won't display the form anymore, just update info in database
            $className = htmlspecialchars(trim($_POST['className']));
            $address = htmlspecialchars(trim($_POST['address']));
            $teacherId = (int)$_POST['teacherId'];
            $class = new LearningClass($className, $address);
            $class->setId((int)$_POST['id']);
            $class->setTeacher($pdo, $teacherId);
            $class->save($pdo);
        }

        $title = "Update data";
        $action = 'update';
        $firstOption = (empty($teachers)) ? 'No teacher available' : 'Choose a teacher';
        require __DIR__ . '/../View/add_class.php';
    }
}