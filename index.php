<?php
declare(strict_types=1);

use Controller\AddClassController;
use Controller\AddStudentController;
use Controller\AddTeacherController;
use Controller\ClassDetailController;
use Controller\ClassGeneralController;
use Controller\HomepageController;
use Controller\StudentDetailController;
use Controller\StudentGeneralController;
use Controller\TeacherDetailController;
use Controller\TeacherGeneralController;

ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

require_once 'vendor/autoload.php';
require 'credentials/database.php';

$controller = new HomepageController();

if(isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'student':
            $controller = new StudentGeneralController();
            if(isset($_GET['id'])) {
                $controller = new StudentDetailController();
            }
            if(isset($_POST['action'])) {
                switch ($_POST['action']){
                    case 'add':
                        $controller = new AddStudentController();
                        break;
                    case 'update':
                        $controller = 'update';
                        break;
                    case 'delete':
                        $controller = 'delete';
                        break;
                }
            }
            break;
        case 'teacher':
            $controller = new TeacherGeneralController();
            if(isset($_GET['id'])) {
                $controller = new TeacherDetailController();
            }
            if(isset($_POST['action'])) {
                switch ($_POST['action']){
                    case 'add':
                        $controller = new AddTeacherController();
                        break;
                    case 'update':
                        $controller = 'update';
                        break;
                    case 'delete':
                        $controller = 'delete';
                        break;
                }
            }
            break;
        case 'class':
            $controller = new ClassGeneralController();
            if(isset($_GET['id'])) {
                $controller = new ClassDetailController();
            }
            if(isset($_POST['action'])) {
                switch ($_POST['action']){
                    case 'add':
                        $controller = new AddClassController();
                        break;
                    case 'update':
                        $controller = 'update';
                        break;
                    case 'delete':
                        $controller = 'delete';
                        break;
                }
            }
            break;
    }
}

$controller->render();
