<?php
declare(strict_types=1);

namespace Model;
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class StudentLoader
{
    /**
     * @var Student[]
     */
    private array $students = [];

    public function __construct(\PDO $pdo)
    {
        $handle = $pdo->prepare('SELECT student.id, student.firstName, student.lastName, student.email, student.address, student.class_id, 
            class.name as className, class.address as classAddress,
            teacher.id as teacherId, teacher.firstName as teacherFirstName, teacher.lastName as teacherLastName
            FROM student 
            LEFT JOIN class ON student.class_id = class.id
            LEFT JOIN teacher ON teacher.id = class.teacher_id');
        $handle->execute();
        $students = $handle->fetchAll();

        if (empty($students)) {
            throw new StudentLoaderException('No record found.');
        }

        foreach ($students as $student) {
            $newStudent = new Student($student['firstName'], $student['lastName'], $student['email'], $student['address']);
            $newStudent->setId((int)$student['id']);
            if ($student['class_id']) {
                $newStudent->setClassId((int)$student['class_id']);
                $newStudent->setTeacherId((int)$student['teacherId']);
                $newStudent->setClassName($student['className']);
                $newStudent->setTeacherFullName($student['teacherFirstName'] . " " . $student['teacherLastName']);
            }
            $this->students[$student['id']] = $newStudent;
        }
    }

    public function getStudents(): array
    {
        return $this->students;
    }
}