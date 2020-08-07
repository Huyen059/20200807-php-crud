<?php
declare(strict_types=1);
namespace Model;
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class Student
{
    private int $id;
    private string $firstName, $lastName, $email, $address;
    private ?LearningClass $class = null;

    public function __construct(string $firstName, string $lastName, string $email, string $address)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->address = $address;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getClass(): LearningClass
    {
        return $this->class;
    }

    public function setClass(int $classId): void
    {
        // Todo: link class here
        $this->class = new LearningClass('', '', 1);
    }

}