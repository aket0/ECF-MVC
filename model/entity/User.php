<?php

namespace Model\entity;

class User
{
    private $id;
    private $username;
    private $email;
    private $password;
    
    public function __construct($id, $username, $email, $password)
    {
        $this->setId($id);
        $this->setUsername($username);
        $this->setEmail($email);
        $this->setPassword($password);
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getId()
    {
     return $this->id;   
    }

    public function getUsername()
    {
     return $this->username;   
    }

    public function getEmail()
    {
     return $this->email;   
    }

    public function getPassword()
    {
     return $this->password;   
    }
}