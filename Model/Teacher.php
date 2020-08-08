<?php
declare(strict_types=1);
namespace Model;
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class Teacher extends Person
{
    use Connection;
    private ?LearningClass $class = null;

    public function getClass(): ?LearningClass
    {
        return $this->class;
    }

    public function setClass(LearningClass $class): void
    {
        // Todo: link class here
        $this->class = $class;
    }

    public function save()
    {
        $pdo = $this->openConnection();
        $handle = $pdo->prepare('INSERT INTO teacher (firstName, lastName, email, address) VALUES (:firstName, :lastName, :email, :address)');
        $handle->bindValue('firstName', $this->getFirstName());
        $handle->bindValue('lastName', $this->getLastName());
        $handle->bindValue('email', $this->getEmail());
        $handle->bindValue('address', $this->getAddress());
        $handle->execute();
        $this->id = (int)$pdo->lastInsertId();
    }
}