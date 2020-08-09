<?php
declare(strict_types=1);
namespace Controller;
use Model\ClassLoader;
use Model\ClassLoaderException;
use Model\Connection;
use Model\Student;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class AddStudentController
{
    public function render()
    {
        $pdo = Connection::openConnection();

        // Get all classes to display in dropdown
        try {
            $classLoader = new ClassLoader($pdo);
            $classes = $classLoader->getClasses();
        }
        catch (ClassLoaderException $e) {
            $classes = [];
            $errorMessage = $e->getMessage();
        }
        // When the form is submitted
        if(isset($_POST['id'])){
            $firstName = htmlspecialchars(trim($_POST['firstName']));
            $lastName = htmlspecialchars(trim($_POST['lastName']));
            $email = htmlspecialchars(trim($_POST['email']));
            $address = htmlspecialchars(trim($_POST['address']));
            $classId = (int)$_POST['classId'];
            $student = new Student($firstName, $lastName, $email, $address);
            if($classId !== 0) {
                $student->setClassId($classId);
            }
            $student->save($pdo);
        }

        $title = "Add a new student";
        $action = 'add';
        $firstOption = (empty($classes)) ? 'No class available' : 'Choose a class';
        require __DIR__ . '/../View/add_student.php';
    }
}