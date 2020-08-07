<?php
declare(strict_types=1);

namespace Model;
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class StudentLoader extends Loader
{
    /**
     * @var Student[]
     */
    private array $students = [];

    public function __construct()
    {
        /**
         * @var \PDO $pdo
         */
        $pdo = $this->openConnection();
        $handle = $pdo->prepare('SELECT * FROM student');
        $handle->execute();
        $students = $handle->fetchAll();

        if (empty($students)) {
            throw new StudentLoaderException('No record found.');
        }

        foreach ($students as $student) {
            $this->students[$student['id']] = new Student($student['firstName'], $student['lastName'], $student['email'], $student['address']);
        }
    }

    public function getStudents(): array
    {
        return $this->students;
    }
}