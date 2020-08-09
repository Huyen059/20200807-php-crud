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

class TeacherGeneralController
{
    public function render()
    {
        $pdo = Connection::openConnection();
        if(isset($_POST['delete'])){
            $id = (int)$_POST['delete'];
            Teacher::delete($pdo, $id);
        }

        try {
            $loader = new TeacherLoader($pdo);
        }
        catch (TeacherLoaderException $e) {
            $errorMessage = $e->getMessage();
        }

        $count = 1;

        require __DIR__ . '/../View/teacher_general.php';
    }
}