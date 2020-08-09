<?php
declare(strict_types=1);
namespace Controller;
use Model\Connection;
use Model\LearningClass;
use Model\Student;
use Model\StudentLoader;
use Model\StudentLoaderException;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class StudentDetailController
{
    public function render()
    {
        $pdo = Connection::openConnection();
        // If the delete button is clicked, remove the row in database, nothing is displayed anymore
        if(isset($_POST['delete'])){
            $id = (int)$_POST['delete'];
            Student::delete($pdo, $id);
        } else {
            try {
                $loader = new StudentLoader($pdo);
                $student = $loader->getStudents()[(int)$_GET['id']];
            }
            catch (StudentLoaderException $e) {
                $errorMessage = $e->getMessage();
            }
        }

        require __DIR__ . '/../View/student_detail.php';
    }
}