<?php
declare(strict_types=1);
namespace Model;
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class ClassLoader
{
    /**
     * @var LearningClass[]
     */
    private array $classes = [];

    public function __construct(\PDO $pdo)
    {
        if(!empty($this->classes)){
            return;
        }
        $handle = $pdo->prepare('SELECT class.id, class.name, class.address, class.teacher_id, teacher.firstName, teacher.lastName FROM class 
            LEFT JOIN teacher ON teacher.id = class.teacher_id');
        $handle->execute();
        $classes = $handle->fetchAll();

        if (empty($classes)) {
            throw new ClassLoaderException('No record found.');
        }

        foreach ($classes as $class) {
            $newClass = new LearningClass($class['name'], $class['address']);
            $newClass->setId((int)$class['id']);
            $newClass->setStudents($pdo);
            $newClass->setTeacherId((int)$class['teacher_id']);
            if($class['teacher_id']) {
                $newClass->setTeacherFullName($class['firstName'] . " " . $class['lastName']);
            }
            $newClass->setTeacherId((int)$class['teacher_id']);
            $this->classes[$class['id']] = $newClass;
        }
    }

    public function getClasses(): array
    {
        return $this->classes;
    }
}