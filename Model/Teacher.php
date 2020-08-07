<?php
declare(strict_types=1);
namespace Model;
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class Teacher
{
    private int $id;
    private string $firstName, $lastName, $email, $address;

    public function __construct(string $firstName, string $lastName, string $email, string $address)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->address = $address;
    }
}