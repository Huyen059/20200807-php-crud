<?php
declare(strict_types=1);
namespace Model;
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class LearningClass extends Loader
{
    private int $id;
    private string $name, $address;
    private ?Teacher $teacher = null;

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

    public function setTeacher(int $teacherId): void
    {
        // Todo: link Teacher here
        $this->teacher = new Teacher('', '', '', '');
    }

    public function save(): void
    {
        //Todo: get the values from $_POST, save to database
        $pdo = $this->openConnection();
        $handle = $pdo->prepare('INSERT INTO class (name, address) VALUES (:name, :address)');
        $handle->bindValue('name', $this->getName());
        $handle->bindValue('address', $this->getAddress());
        $handle->execute();
        $this->id = (int)$pdo->lastInsertId();
    }
}