<?php
declare(strict_types=1);
namespace Controller;
use Model\ClassLoader;
use Model\ClassLoaderException;
use Model\Connection;
use Model\Student;
use Model\StudentLoader;
use Model\StudentLoaderException;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class UpdateStudentController
{
    public function render()
    {
        $pdo = Connection::openConnection();

        // When the form is not submitted
        if(!isset($_POST['id'])){
            try {
                // Get all classes to display in dropdown
                $classLoader = new ClassLoader($pdo);
                $classes = $classLoader->getClasses();
                // Get all students
                $loader = new StudentLoader($pdo);
                $students = $loader->getStudents();
                $studentId = (int)$_POST['update'];
                $student = $students[$studentId];
                $id = $student->getId();
                $firstName = $student->getFirstName();
                $lastName = $student->getLastName();
                $email = $student->getEmail();
                $address = $student->getAddress();
            }
            catch (StudentLoaderException $e)
            {
                $errorMessage = $e->getMessage();
            }
            catch (ClassLoaderException $e) {
                $classes = [];
                $errorMessage = $e->getMessage();
            }
        } else {
            // When the form is submitted, we don't display it anymore
            $firstName = htmlspecialchars(trim($_POST['firstName']));
            $lastName = htmlspecialchars(trim($_POST['lastName']));
            $email = htmlspecialchars(trim($_POST['email']));
            $address = htmlspecialchars(trim($_POST['address']));
            $classId = (int)$_POST['classId'];
            $student = new Student($firstName, $lastName, $email, $address);
            $student->setId((int)$_POST['id']);
            $student->setClassId($classId);
            $student->save($pdo);
        }

        $title = "Update data";
        $action = 'update';
        $firstOption = (empty($classes)) ? 'No class available' : 'Choose a class';
        require __DIR__ . '/../View/add_student.php';
    }
}