<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
/**
 * @ORM\Entity
 * @UniqueEntity("NumEtud")
 */
class Student
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer", name="id")
   * 
   */
  private $id;

  /**
   * @ORM\Column(type="string", length=25, name="first_name")
   */
  private $FirstName;

  /**
   * @ORM\Column(type="string", length=25,  name="last_name")
   */
  private $LastName;

  /**
   * @ORM\Column(type="integer", name="num_etud", length=10)
   */
  private $NumEtud;

  /**
   * @ORM\ManyToOne(targetEntity=Department::class, inversedBy="id_student")
   * @ORM\JoinColumn(nullable=false)
   */
  private $id_department;

  /**
   * Constructor
   */
  public function __construct()
  {
    $this->NumEtud = abs(crc32(uniqid()));
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getFirstName(): ?string
  {
    return $this->FirstName;
  }

  public function setFirstName(string $FirstName): self
  {
    $this->FirstName = $FirstName;

    return $this;
  }

  public function getLastName(): ?string
  {
    return $this->LastName;
  }

  public function setLastName(string $LastName): self
  {
    $this->LastName = $LastName;

    return $this;
  }

  public function getNumEtud(): ?int
  {
    return $this->NumEtud;
  }

  public function setNumEtud(int $NumEtud): self
  {
    $this->NumEtud = $NumEtud;

    return $this;
  }

  public function getIdDepartment(): ?Department
  {
      return $this->id_department;
  }

  public function setIdDepartment(?Department $id_department): self
  {
      $this->id_department = $id_department;

      return $this;
  }
}
