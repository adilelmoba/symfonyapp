<?php

namespace App\Entity;

use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DepartmentRepository::class)
 */
class Department
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  private $id;

  /**
   * @ORM\Column(type="string", length=25)
   */
  private $Name;

  /**
   * @ORM\Column(type="integer")
   */
  private $Capacity;

  /**
   * @ORM\OneToMany(targetEntity=Student::class, mappedBy="id_department")
   */
  private $id_student;

  public function __construct()
  {
    $this->id_student = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getName(): ?string
  {
    return $this->Name;
  }

  public function setName(string $Name): self
  {
    $this->Name = $Name;

    return $this;
  }

  public function getCapacity(): ?int
  {
    return $this->Capacity;
  }

  public function setCapacity(int $Capacity): self
  {
    $this->Capacity = $Capacity;

    return $this;
  }

  /**
   * @return Collection<int, Student>
   */
  public function getIdStudent(): Collection
  {
    return $this->id_student;
  }

  public function addIdStudent(Student $idStudent): self
  {
    if (!$this->id_student->contains($idStudent)) {
      $this->id_student[] = $idStudent;
      $idStudent->setIdDepartment($this);
    }

    return $this;
  }

  public function removeIdStudent(Student $idStudent): self
  {
    if ($this->id_student->removeElement($idStudent)) {
      // set the owning side to null (unless already changed)
      if ($idStudent->getIdDepartment() === $this) {
        $idStudent->setIdDepartment(null);
      }
    }

    return $this;
  }
}
