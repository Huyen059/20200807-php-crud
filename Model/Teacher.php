<?php
declare(strict_types=1);
namespace Model;
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class Teacher extends Person
{
    private string $className = '';
    private int $classId = 0;

    public function getClassName(): string
    {
        return $this->className;
    }

    public function getClassId(): int
    {
        return $this->classId;
    }

    public function setClassName(string $className): void
    {
        $this->className = $className;
    }

    public function setClassId(int $classId): void
    {
        $this->classId = $classId;
    }

    public function insert(\PDO $pdo): void
    {
        $handle = $pdo->prepare('INSERT INTO teacher (firstName, lastName, email, address) VALUES (:firstName, :lastName, :email, :address)');
        $handle->bindValue('firstName', $this->getFirstName());
        $handle->bindValue('lastName', $this->getLastName());
        $handle->bindValue('email', $this->getEmail());
        $handle->bindValue('address', $this->getAddress());
        $handle->execute();
        $this->id = (int)$pdo->lastInsertId();
    }

    public function update(\PDO $pdo)
    {
        $handle = $pdo->prepare('UPDATE teacher SET firstName = :firstName, lastName = :lastName, email = :email, address = :address WHERE id = :id');
        $handle->bindValue('firstName', $this->getFirstName());
        $handle->bindValue('lastName', $this->getLastName());
        $handle->bindValue('email', $this->getEmail());
        $handle->bindValue('address', $this->getAddress());
        $handle->bindValue('id', $this->getId());
        $handle->execute();
    }

    public static function delete(\PDO $pdo, int $id)
    {
        $handle = $pdo->prepare('DELETE FROM teacher WHERE id = :id');
        $handle->bindValue('id', $id);
        $handle->execute();
    }

    public function save(\PDO $pdo)
    {
        if(empty($this->getId())){
            $this->insert($pdo);
            return;
        }

        $this->update($pdo);
    }
}