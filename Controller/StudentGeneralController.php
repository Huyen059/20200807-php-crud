<?php
declare(strict_types=1);
namespace Controller;
use Model\StudentLoader;
use Model\StudentLoaderException;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class StudentGeneralController
{
    public function render()
    {
        //Todo: fetch all students from database and display in the view
        try {
            $loader = new StudentLoader();
        }
        catch (StudentLoaderException $e) {
            $errorMessage = $e->getMessage();
        }
        require 'View/student_general.php';
    }
}