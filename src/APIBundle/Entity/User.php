<?php

namespace APIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="APIBundle\Repository\UserRepository")
 */
class User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string
     *
     * @ORM\Column(name="randnum", type="string", length=255, nullable=true)
     */
    private $randnum;
    
    /**
     * @var array
     *
     * @ORM\Column(name="token", type="array", length=255, nullable=true)
     */
    private $token;
    
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;
    
    public function __construct() {
        $this->token = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * Set randnum
     *
     * @param string $randnum
     *
     * @return User
     */
    public function setRandnum($randnum)
    {
        $this->randnum = $randnum;

        return $this;
    }

    /**
     * Get randnum
     *
     * @return string
     */
    public function getRandnum()
    {
        return $this->randnum;
    }
    
    /**
     * Set token
     *
     * @param string $token
     *
     * @return User
     */
    public function setToken($token)
    {
        $this->token[] = $token;

        return $this;
    }
    
    public function removeToken($token)
    {
        $this->token->removeElement($token);

        return $this;
    }
    
    public function checkToken($token)
    {
        return in_array($token, this->token); 
    }

    /**
     * Get token
     *
     * @return array
     */
    public function getToken()
    {
        return $this->token;
    }
    
    public function getToken(int i)
    {
        return $this->token[i];
    }
    
}

