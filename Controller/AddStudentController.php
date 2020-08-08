<?php
declare(strict_types=1);
namespace Controller;
use Model\Student;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class AddStudentController
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
            if($classId !== 0) {
                $student->setClass($classId);
            }
            $student->save();
        }

        $title = "Add a new student";
        $action = 'add';
        require 'View/add_student.php';
    }
}