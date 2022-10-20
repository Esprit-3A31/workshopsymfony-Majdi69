<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StudentRepository::class)]
class Student
{
    #[ORM\Id]
    #[ORM\Column(length: 255)]
    private ?string $ref = null;

    #[ORM\Column(length: 255)]
    private ?string $username = null;

    #[ORM\ManyToOne(inversedBy: 'student')]
    #[ORM\JoinColumn(onDelete: "CASCADE")]
    private ?ClassRooM $classRooM = null;

    public function getRef(): ?String
    {
        return $this->ref;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }
    public function setRef(string $ref): self
    {
        $this->ref = $ref;

        return $this;
    }

    public function getClassRooM(): ?ClassRooM
    {
        return $this->classRooM;
    }

    public function setClassRooM(?ClassRooM $classRooM): self
    {
        $this->classRooM = $classRooM;

        return $this;
    }

   /* public function toString(){

        return(string)$this->getUsername();
    }*/
}
