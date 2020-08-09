<?php
declare(strict_types=1);
namespace Model;
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class LearningClass
{
    private int $id = 0;
    private string $name, $address;
    private ?Teacher $teacher = null;
    private array $students = [];

    public function __construct(string $name, string $address)
    {
        $this->name = ucwords($name);
        $this->address = ucwords($address);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getTeacher(): ?Teacher
    {
        return $this->teacher;
    }

    public function getStudents(): array
    {
        return $this->students;
    }

    public function setStudents(\PDO $pdo): void
    {
        $handle = $pdo->prepare('SELECT 
            student.id as studentId, student.firstName as studentFirstName, student.lastName as studentLastName
            FROM class
            LEFT JOIN student ON class.id = student.class_id
            WHERE class.id = :id');
        $handle->bindValue('id', $this->getId());
        $handle->execute();
        $students = $handle->fetchAll();
        foreach ($students as $student) {
            $this->students[$student['studentId']] = $student['studentFirstName'] . " " . $student['studentLastName'];
        }
    }


    public function setTeacher(\PDO $pdo, int $teacherId): void
    {
        if($teacherId === 0) {
            $this->teacher = null;
            $handle = $pdo->prepare('UPDATE class SET teacher_id = null WHERE id = :id');
            $handle->bindValue('id', $this->getId());
            $handle->execute();
            return;
        }

        $teacherLoader = new TeacherLoader($pdo);
        $this->teacher = $teacherLoader->getTeachers()[$teacherId];
    }

    public function insert(\PDO $pdo)
    {
        if($this->getTeacher() !== null) {
            $handle = $pdo->prepare('INSERT INTO class (name, address, teacher_id) VALUES (:name, :address, :teacher)');
        } else {
            $handle = $pdo->prepare('INSERT INTO class (name, address) VALUES (:name, :address)');
        }
        $handle->bindValue('name', $this->getName());
        $handle->bindValue('address', $this->getAddress());
        if($this->getTeacher() !== null) {
            $handle->bindValue('teacher', $this->getTeacher()->getId());
        }
        $handle->execute();
        $this->id = (int)$pdo->lastInsertId();
    }

    public function update(\PDO $pdo)
    {
        if($this->getTeacher() !== null) {
            $handle = $pdo->prepare('UPDATE class SET name = :name, address = :address, teacher_id = :teacher WHERE id = :id');
        } else {
            $handle = $pdo->prepare('UPDATE class SET name = :name, address = :address WHERE id = :id');
        }
        $handle->bindValue('name', $this->getName());
        $handle->bindValue('address', $this->getAddress());
        $handle->bindValue('id', $this->getId());
        if($this->getTeacher() !== null) {
            $handle->bindValue('teacher', $this->getTeacher()->getId());
        }
        $handle->execute();
    }

    public static function delete(\PDO $pdo, int $id)
    {
        $handle = $pdo->prepare('DELETE FROM class WHERE id = :id');
        $handle->bindValue('id', $id);
        $handle->execute();
    }

    public function save(\PDO $pdo): void
    {
        if(empty($this->getId())){
            $this->insert($pdo);
            return;
        }

        $this->update($pdo);
    }
}