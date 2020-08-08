<?php
declare(strict_types=1);
namespace Model;
ini_set('display_errors', "1");
ini_set('display_startup_errors', "1");
error_reporting(E_ALL);

class Student extends Person
{
    private string $className = '';
    private int $classId = 0;
    private int $teacherId = 0;
    private string $teacherFullName = '';

    public function getClassName(): string
    {
        return $this->className;
    }

    public function setClassName(string $className): void
    {
        $this->className = $className;
    }

    public function getClassId(): int
    {
        return $this->classId;
    }

    public function setClassId(int $classId): void
    {
        $this->classId = $classId;
    }

    public function getTeacherId(): int
    {
        return $this->teacherId;
    }

    public function setTeacherId(int $teacherId): void
    {
        $this->teacherId = $teacherId;
    }

    public function getTeacherFullName(): string
    {
        return $this->teacherFullName;
    }

    public function setTeacherFullName(string $teacherFullName): void
    {
        $this->teacherFullName = $teacherFullName;
    }

    public function insert(\PDO $pdo)
    {
        if($this->getClassId()) {
            $handle = $pdo->prepare('INSERT INTO student (firstName, lastName, email, address, class_id) VALUES (:firstName, :lastName, :email, :address, :class_id)');
        } else {
            $handle = $pdo->prepare('INSERT INTO student (firstName, lastName, email, address) VALUES (:firstName, :lastName, :email, :address)');
        }
        $handle->bindValue('firstName', $this->getFirstName());
        $handle->bindValue('lastName', $this->getLastName());
        $handle->bindValue('email', $this->getEmail());
        $handle->bindValue('address', $this->getAddress());
        if($this->getClassId()) {
            $handle->bindValue('class_id', $this->getClassId());
        }
        $handle->execute();
        $this->id = (int)$pdo->lastInsertId();
    }

    public function update(\PDO $pdo)
    {
        if($this->getClassId()) {
            $handle = $pdo->prepare('UPDATE student SET firstName = :firstName, lastName = :lastName, email = :email, address = :address, class_id = :class_id WHERE id = :id');
        } else {
            $handle = $pdo->prepare('UPDATE student SET firstName = :firstName, lastName = :lastName, email = :email, address = :address WHERE id = :id');
        }
        $handle->bindValue('firstName', $this->getFirstName());
        $handle->bindValue('lastName', $this->getLastName());
        $handle->bindValue('email', $this->getEmail());
        $handle->bindValue('address', $this->getAddress());
        $handle->bindValue('id', $this->getId());
        if($this->getClassId()) {
            $handle->bindValue('class_id', $this->getClassId());
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