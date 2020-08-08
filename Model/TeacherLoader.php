<?php
declare(strict_types=1);
namespace Model;
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class TeacherLoader
{
    use Connection;

    /**
     * @var Teacher[]
     */
    private array $teachers = [];

    public function __construct()
    {
        /**
         * @var \PDO $pdo
         */
        $pdo = $this->openConnection();
        $handle = $pdo->prepare('SELECT * FROM teacher');
        $handle->execute();
        $teachers = $handle->fetchAll();

        if (empty($teachers)) {
            throw new TeacherLoaderException('No record found.');
        }

        foreach ($teachers as $teacher) {
            $newTeacher = new Teacher($teacher['firstName'], $teacher['lastName'], $teacher['email'], $teacher['address']);
            $newTeacher->setId((int)$teacher['id']);
            $this->teachers[$teacher['id']] = $newTeacher;
        }
    }

    public function getTeachers(): array
    {
        return $this->teachers;
    }
}