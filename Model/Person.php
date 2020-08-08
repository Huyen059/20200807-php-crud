<?php
declare(strict_types=1);
namespace Model;
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class Person
{
    protected int $id = 0;
    protected string $firstName, $lastName, $email, $address;

    public function __construct(string $firstName, string $lastName, string $email, string $address)
    {
        $this->firstName = ucwords($firstName);
        $this->lastName = ucwords($lastName);
        $this->email = strtolower($email);
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

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getFullName(): string
    {
        return $this->getFirstName() . " " . $this->getLastName();
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAddress(): string
    {
        return $this->address;
    }
}