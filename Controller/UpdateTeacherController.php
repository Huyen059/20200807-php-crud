<?php
declare(strict_types=1);
namespace Controller;
use Model\Teacher;
use Model\TeacherLoader;
use Model\TeacherLoaderException;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class UpdateTeacherController
{
    public function render()
    {
        if(isset($_POST['id'])){
            $firstName = htmlspecialchars(trim($_POST['firstName']));
            $lastName = htmlspecialchars(trim($_POST['lastName']));
            $email = htmlspecialchars(trim($_POST['email']));
            $address = htmlspecialchars(trim($_POST['address']));
            $teacher = new Teacher($firstName, $lastName, $email, $address);
            $teacher->setId((int)$_POST['id']);
            $teacher->save();
        } else {
            try {
                $loader = new TeacherLoader();
                $teachers = $loader->getTeachers();
                $teacherId = (int)$_POST['update'];
                $teacher = $teachers[$teacherId];
                $id = $teacher->getId();
                $firstName = $teacher->getFirstName();
                $lastName = $teacher->getLastName();
                $email = $teacher->getEmail();
                $address = $teacher->getAddress();
            }
            catch (TeacherLoaderException $e)
            {
                $errorMessage = $e->getMessage();
            }
        }

        $title = "Update data";
        $action = 'update';
        require 'View/add_teacher.php';
    }
}