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

    public function save()
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
}