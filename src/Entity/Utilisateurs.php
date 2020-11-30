<?php

namespace App\Entity;

use App\Repository\UtilisateursRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=UtilisateursRepository::class)
 */

class Utilisateurs implements UserInterface
{
    public function __toString()
    {
        return $this->username;
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /*
     * @ORM\Column(type="string")
     * @Assert\File(mimeTypes={ "image/jpeg" })

    private $picture;

     * @return mixed

    public function getPicture()
    {
        return $this->picture;
    }

     * @param mixed $picture

    public function setPicture($picture): void
    {
        $this->picture = $picture;
    }
    */


    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */

    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */

    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */

    private $prenom;

    /**
     * @ORM\Column(type="integer", length=15, nullable=true)
     */

    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */

    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */

    private $password;


    //pas sauvegardé en base
    private $roles;

    /**
     * @param mixed $roles
     */
    public function setRoles($roles): void
    {
        $this->roles = $roles;
    }
    /**
     * @ORM\Column(type="boolean")
     */

    private $admin;

    /**
     * @ORM\Column(type="boolean")
     */

    private $actif;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Campus")
    */
    private $campus;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom): void
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone): void
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */

    public function getRoles()
    {
        if ($this->getAdmin()) {
            return ["ROLE_ADMIN","ROLE_USER"];
        } else {
            return ["ROLE_USER"];
        }
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin): void
    {
        $this->admin = $admin;
    }

    /**
     * @return mixed
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * @param mixed $actif
     */
    public function setActif($actif): void
    {
        $this->actif = $actif;
    }

    /**
     * @return mixed
    */
    public function getCampus()
    {
        return $this->campus;
    }

    /**
     * @param mixed $campus
    */
    public function setCampus($campus): void
    {
        $this->campus = $campus;
    }

    //inutile pour nous....
    public function getSalt(){return null;}
    public function eraseCredentials(){}

}
