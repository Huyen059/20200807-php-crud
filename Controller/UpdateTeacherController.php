<?php
declare(strict_types=1);
namespace Controller;
use Model\Connection;
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
        $pdo = Connection::openConnection();
        if(!isset($_POST['id'])){
            // When the form is not submitted
            try {
                $loader = new TeacherLoader($pdo);
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
        } else {
            // When the form is submitted
            $firstName = htmlspecialchars(trim($_POST['firstName']));
            $lastName = htmlspecialchars(trim($_POST['lastName']));
            $email = htmlspecialchars(trim($_POST['email']));
            $address = htmlspecialchars(trim($_POST['address']));
            $teacher = new Teacher($firstName, $lastName, $email, $address);
            $teacher->setId((int)$_POST['id']);
            $teacher->save($pdo);
        }

        $title = "Update data";
        $action = 'update';
        require __DIR__ . '/../View/add_teacher.php';
    }
}