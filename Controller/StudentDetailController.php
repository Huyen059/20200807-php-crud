<?php
declare(strict_types=1);
namespace Controller;
use Model\StudentLoader;
use Model\StudentLoaderException;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class StudentDetailController
{
    public function render()
    {
        try {
            $loader = new StudentLoader();
            $student = $loader->getStudents()[(int)$_GET['id']];
        }
        catch (StudentLoaderException $e) {
            $errorMessage = $e->getMessage();
        }

        require 'View/student_detail.php';
    }
}