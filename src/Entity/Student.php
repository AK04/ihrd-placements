<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 */
class Student
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Institute;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DOB;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Gender;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $NativeDistrict;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Address;

    /**
     * @ORM\Column(type="integer")
     */
    private $MobileNo;

    /**
     * @ORM\Column(type="boolean")
     */
    private $DifferentlyAbled;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Course;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Branch;

    /**
     * @ORM\Column(type="integer")
     */
    private $PassoutYear;

    /**
     * @ORM\Column(type="integer")
     */
    private $SemesterMarks;

    /**
     * @ORM\Column(type="integer")
     */
    private $Approved;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Placement;

    

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

    public function getInstitute(): ?string
    {
        return $this->Institute;
    }

    public function setInstitute(string $Institute): self
    {
        $this->Institute = $Institute;

        return $this;
    }

    public function getDOB(): ?\DateTimeInterface
    {
        return $this->DOB;
    }

    public function setDOB(\DateTimeInterface $DOB): self
    {
        $this->DOB = $DOB;

        return $this;
    }

    public function getGender(): ?string
    {
        return $this->Gender;
    }

    public function setGender(string $Gender): self
    {
        $this->Gender = $Gender;

        return $this;
    }

    public function getNativeDistrict(): ?string
    {
        return $this->NativeDistrict;
    }

    public function setNativeDistrict(string $NativeDistrict): self
    {
        $this->NativeDistrict = $NativeDistrict;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->Address;
    }

    public function setAddress(string $Address): self
    {
        $this->Address = $Address;

        return $this;
    }

    public function getMobileNo(): ?int
    {
        return $this->MobileNo;
    }

    public function setMobileNo(int $MobileNo): self
    {
        $this->MobileNo = $MobileNo;

        return $this;
    }

    public function getDifferentlyAbled(): ?bool
    {
        return $this->DifferentlyAbled;
    }

    public function setDifferentlyAbled(bool $DifferentlyAbled): self
    {
        $this->DifferentlyAbled = $DifferentlyAbled;

        return $this;
    }

    public function getCourse(): ?string
    {
        return $this->Course;
    }

    public function setCourse(string $Course): self
    {
        $this->Course = $Course;

        return $this;
    }

    public function getBranch(): ?string
    {
        return $this->Branch;
    }

    public function setBranch(string $Branch): self
    {
        $this->Branch = $Branch;

        return $this;
    }

    public function getPassoutYear(): ?int
    {
        return $this->PassoutYear;
    }

    public function setPassoutYear(int $PassoutYear): self
    {
        $this->PassoutYear = $PassoutYear;

        return $this;
    }

    public function getSemesterMarks(): ?int
    {
        return $this->SemesterMarks;
    }

    public function setSemesterMarks(int $SemesterMarks): self
    {
        $this->SemesterMarks = $SemesterMarks;

        return $this;
    }

    public function getApproved(): ?int
    {
        return $this->Approved;
    }

    public function setApproved(int $Approved): self
    {
        $this->Approved = $Approved;

        return $this;
    }

    public function getPlacement(): ?string
    {
        return $this->Placement;
    }

    public function setPlacement(string $Placement): self
    {
        $this->Placement = $Placement;

        return $this;
    }
}
