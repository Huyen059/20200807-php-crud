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
    private string $teacherFullName = '';
    private int $teacherId = 0;
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

    public function getTeacherFullName(): string
    {
        return $this->teacherFullName;
    }

    public function setTeacherFullName(string $teacherFullName): void
    {
        $this->teacherFullName = $teacherFullName;
    }

    public function getTeacherId(): int
    {
        return $this->teacherId;
    }

    public function setTeacherId(int $teacherId): void
    {
        $this->teacherId = $teacherId;
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
            if ($student['studentId']) {
                $this->students[$student['studentId']] = $student['studentFirstName'] . " " . $student['studentLastName'];
            }
        }
    }

    public function insert(\PDO $pdo)
    {
        $handle = $pdo->prepare('INSERT INTO class (name, address, teacher_id) VALUES (:name, :address, :teacher)');
        $handle->bindValue('name', $this->getName());
        $handle->bindValue('address', $this->getAddress());
        $teacherId = $this->getTeacherId() ?: null;
        $handle->bindValue('teacher', $teacherId);
        $handle->execute();
        $this->id = (int)$pdo->lastInsertId();
    }

    public function update(\PDO $pdo)
    {
        $handle = $pdo->prepare('UPDATE class SET name = :name, address = :address, teacher_id = :teacher WHERE id = :id');
        $handle->bindValue('name', $this->getName());
        $handle->bindValue('address', $this->getAddress());
        $handle->bindValue('id', $this->getId());
        $teacherId = $this->getTeacherId() ?: null;
        $handle->bindValue('teacher', $teacherId);
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