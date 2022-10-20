<?php

namespace App\Entity;

use App\Repository\ClassRooMRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassRooMRepository::class)]
class ClassRooM
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbrStudent = null;

    #[ORM\OneToMany(mappedBy: 'classRooM', targetEntity: Student::class)]
    private Collection $student;

    public function __construct()
    {
        $this->student = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNbrStudent(): ?int
    {
        return $this->nbrStudent;
    }

    public function setNbrStudent(?int $nbrStudent): self
    {
        $this->nbrStudent = $nbrStudent;

        return $this;
    }

    /**
     * @return Collection<int, Student>
     */
    public function getStudent(): Collection
    {
        return $this->student;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->student->contains($student)) {
            $this->student->add($student);
            $student->setClassRooM($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->student->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getClassRooM() === $this) {
                $student->setClassRooM(null);
            }
        }

        return $this;
    }
    public function __toString(){

        return(string)$this->getName();
    }
}
