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
        if(!isset($_POST['id'])) {
            // Get the list of all teachers, so that they can be displayed in the dropdown of the form
            try {
                $teacherLoader = new TeacherLoader($pdo);
                $teachers = $teacherLoader->getTeachers();
            }
            catch (TeacherLoaderException $e) {
                $teachers = [];
                $errorMessage = $e->getMessage();
            }
        } else {
            // When the form is submitted
            $className = htmlspecialchars(trim($_POST['className']));
            $address = htmlspecialchars(trim($_POST['address']));
            $teacherId = (int)$_POST['teacherId'];
            $class = new LearningClass($className, $address);
            $class->setTeacherId($teacherId);
            $class->save($pdo);
        }

        $title = "Add a new class";
        $action = 'add';
        $firstOption = (empty($teachers)) ? 'No teacher available' : 'Choose a teacher';
        require __DIR__ . '/../View/add_class.php';
    }
}