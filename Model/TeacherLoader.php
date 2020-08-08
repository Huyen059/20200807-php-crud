<?php
declare(strict_types=1);
namespace Model;
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class TeacherLoader
{
    /**
     * @var Teacher[]
     */
    private array $teachers = [];

    public function __construct(\PDO $pdo)
    {
        $handle = $pdo->prepare('SELECT teacher.id, firstName, lastName, email, teacher.address, class.id as classId, class.name as className, class.address as classAddress FROM teacher LEFT JOIN class ON teacher.id = class.teacher_id');
        $handle->execute();
        $teachers = $handle->fetchAll();

        if (empty($teachers)) {
            throw new TeacherLoaderException('No record found.');
        }

        foreach ($teachers as $teacher) {
            $newTeacher = new Teacher($teacher['firstName'], $teacher['lastName'], $teacher['email'], $teacher['address']);
            $newTeacher->setId((int)$teacher['id']);
            $this->teachers[$teacher['id']] = $newTeacher;
            if($teacher['classId']) {
                $class = new LearningClass($teacher['className'], $teacher['classAddress']);
                $newTeacher->setClass($class);
            }
        }
    }

    public function getTeachers(): array
    {
        return $this->teachers;
    }
}