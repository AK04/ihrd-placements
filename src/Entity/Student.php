<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 */
class Student implements UserInterface, \Serializable
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
    private $username;

    private $plainPassword;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Institute;

    /**
     * @ORM\Column(type="date")
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
     * @ORM\Column(type="string", length=1)
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
     * @ORM\Column(type="smallint")
     */
    private $PassoutYear;

    /**
     * @ORM\Column(type="smallint")
     */
    private $SemesterMarks;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
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

    public function getDOB(): ?string
    {
        return $this->DOB;
    }

    public function setDOB(string $DOB): self
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

    public function getMobileNo(): ?string
    {
        return $this->MobileNo;
    }

    public function setMobileNo(string $MobileNo): self
    {
        $this->MobileNo = $MobileNo;

        return $this;
    }

    public function getDifferentlyAbled(): ?string
    {
        return $this->DifferentlyAbled;
    }

    public function setDifferentlyAbled(string $DifferentlyAbled): self
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

    public function getPassoutYear(): ?string
    {
        return $this->PassoutYear;
    }

    public function setPassoutYear(string $PassoutYear): self
    {
        $this->PassoutYear = $PassoutYear;

        return $this;
    }

    public function getSemesterMarks(): ?string
    {
        return $this->SemesterMarks;
    }

    public function setSemesterMarks(string $SemesterMarks): self
    {
        $this->SemesterMarks = $SemesterMarks;

        return $this;
    }

    /**
     * String representation of object
     * @link https://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        // TODO: Implement serialize() method.
        return serialize([
            $this->id,
            $this->username,
            $this->password,
        ]);
    }

    /**
     * Constructs the object
     * @link https://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        // TODO: Implement unserialize() method.
        list (
            $this->id,
            $this->username,
            $this->password
            ) = unserialize($serialized);
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        // TODO: Implement getRoles() method.
        return [
            'ROLE_USER'
        ];
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
        return null;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
        $this->plainPassword = null;
    }
}
