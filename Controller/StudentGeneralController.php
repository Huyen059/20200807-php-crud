<?php
declare(strict_types=1);
namespace Controller;
use Model\Connection;
use Model\Student;
use Model\StudentLoader;
use Model\StudentLoaderException;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class StudentGeneralController
{
    public function render()
    {
        $pdo = Connection::openConnection();
        if(isset($_POST['delete'])){
            $id = (int)$_POST['delete'];
            Student::delete($pdo, $id);
        }

        try {
            $loader = new StudentLoader($pdo);
        }
        catch (StudentLoaderException $e) {
            $errorMessage = $e->getMessage();
        }



        $count = 1;
        require 'View/student_general.php';
    }
}