<?php
declare(strict_types=1);
namespace Model;
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class LearningClass
{
    use Connection;

    private int $id;
    private string $name, $address;
    private ?Teacher $teacher = null;
    /**
     * @var Student[]
     */
    private array $students;

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

    /**
     * @return Student[]
     */
    public function getStudents(): array
    {
        return $this->students;
    }

    /**
     * @param Student[] $students
     */
    public function setStudents(array $students): void
    {
        $this->students = $students;
    }


    public function setTeacher(int $teacherId): void
    {
        // Todo: link Teacher here
        $this->teacher = new Teacher('', '', '', '');
    }

    public function save(): void
    {
        $pdo = $this->openConnection();
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
}