<?php
declare(strict_types=1);
namespace Controller;
use Model\Connection;
use Model\TeacherLoader;
use Model\TeacherLoaderException;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class TeacherDetailController
{
    public function render()
    {
        $pdo = Connection::openConnection();
        try {
            $loader = new TeacherLoader($pdo);
            $teacher = $loader->getTeachers()[(int)$_GET['id']];
        }
        catch (TeacherLoaderException $e) {
            $errorMessage = $e->getMessage();
        }

        require __DIR__ . '/../View/teacher_detail.php';
    }
}