<?php
declare(strict_types=1);
namespace Controller;
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
        if(isset($_POST['id'])){
            $firstName = htmlspecialchars(trim($_POST['firstName']));
            $lastName = htmlspecialchars(trim($_POST['lastName']));
            $email = htmlspecialchars(trim($_POST['email']));
            $address = htmlspecialchars(trim($_POST['address']));
            $classId = (int)$_POST['classId'];
            $student = new Student($firstName, $lastName, $email, $address);
            $student->setId((int)$_POST['id']);
            if($classId !== 0) {
                $student->setClass($classId);
            }
            $student->save();
        } else {
            try {
                $loader = new StudentLoader();
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
        }

        $title = "Update data";
        $action = 'update';
        require 'View/add_student.php';
    }
}