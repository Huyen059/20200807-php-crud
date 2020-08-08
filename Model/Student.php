<?php
declare(strict_types=1);
namespace Model;
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class Student extends Person
{
    use Connection;

    private ?LearningClass $class = null;

    public function getClass(): ?LearningClass
    {
        return $this->class;
    }

    public function setClass(int $classId): void
    {
        // Todo: link class here
        $this->class = new LearningClass('', '', 1);
    }

    public function insert()
    {
        $pdo = $this->openConnection();
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

    public function update()
    {
        $pdo = $this->openConnection();
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

    public function save()
    {
        if(empty($this->getId())) {
            $this->insert();
            return;
        }

        $this->update();
    }
}