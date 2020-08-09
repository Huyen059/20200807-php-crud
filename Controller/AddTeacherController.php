<?php
declare(strict_types=1);
namespace Controller;
use Model\Connection;
use Model\Teacher;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class AddTeacherController
{
    public function render()
    {
        $pdo = Connection::openConnection();
        if(isset($_POST['id'])){
            $firstName = htmlspecialchars(trim($_POST['firstName']));
            $lastName = htmlspecialchars(trim($_POST['lastName']));
            $email = htmlspecialchars(trim($_POST['email']));
            $address = htmlspecialchars(trim($_POST['address']));
            $teacher = new Teacher($firstName, $lastName, $email, $address);
            $teacher->save($pdo);
        }

        $title = "Add a new teacher";
        $action = 'add';
        require __DIR__ . '/../View/add_teacher.php';
    }
}