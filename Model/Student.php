<?php
declare(strict_types=1);
namespace Model;
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class Student extends Person
{
    private ?LearningClass $class = null;

    public function getClass(): ?LearningClass
    {
        return $this->class;
    }

    public function setClass(\PDO $pdo, int $classId): void
    {
        $classLoader = new ClassLoader($pdo);
        $classes = $classLoader->getClasses();
        $this->class = $classes[$classId];
    }

    public function insert(\PDO $pdo)
    {
        if($this->getClass() !== null) {
            $handle = $pdo->prepare('INSERT INTO student (firstName, lastName, email, address, class_id) VALUES (:firstName, :lastName, :email, :address, :class_id)');
        } else {
            $handle = $pdo->prepare('INSERT INTO student (firstName, lastName, email, address) VALUES (:firstName, :lastName, :email, :address)');
        }
        $handle->bindValue('firstName', $this->getFirstName());
        $handle->bindValue('lastName', $this->getLastName());
        $handle->bindValue('email', $this->getEmail());
        $handle->bindValue('address', $this->getAddress());
        if($this->getClass() !== null) {
            $handle->bindValue('class_id', $this->getClass()->getId());
        }
        $handle->execute();
        $this->id = (int)$pdo->lastInsertId();
    }

    public function update(\PDO $pdo)
    {
        if($this->getClass() !== null) {
            $handle = $pdo->prepare('UPDATE student SET firstName = :firstName, lastName = :lastName, email = :email, address = :address, class_id = :class_id WHERE id = :id');
        } else {
            $handle = $pdo->prepare('UPDATE student SET firstName = :firstName, lastName = :lastName, email = :email, address = :address WHERE id = :id');
        }
        $handle->bindValue('firstName', $this->getFirstName());
        $handle->bindValue('lastName', $this->getLastName());
        $handle->bindValue('email', $this->getEmail());
        $handle->bindValue('address', $this->getAddress());
        $handle->bindValue('id', $this->getId());
        if($this->getClass() !== null) {
            $handle->bindValue('class_id', $this->getClass()->getId());
        }
        $handle->execute();
    }

    public static function delete(\PDO $pdo, int $id)
    {
        $handle = $pdo->prepare('DELETE FROM student WHERE id = :id');
        $handle->bindValue('id', $id);
        $handle->execute();
    }


    public function save(\PDO $pdo)
    {
        if(empty($this->getId())) {
            $this->insert($pdo);
            return;
        }

        $this->update($pdo);
    }
}