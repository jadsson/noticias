<?php

class CreateUser {
    private $id, $type, $user_name, $email, $password;

    function Create($id, $type, $user_name, $email, $password) {
        $this->id = $id;
        $this->type = $type;
        $this->user_name = $user_name;
        $this->email = $email;
        $this->password = $password;
    }

    function getId() {return $this->id;}
    function getType() {return $this->type;}
    function getUserName() {return $this->user_name;}
    function getEmail() {return $this->email;}
    function getPassword() {return $this->password;}
    function setId($id) {$this->id = $id;}
    function setType($type) {$this->type = $type;}
    function setUserName($un) {$this->user_name = $un;}
    function setEmail($em) {$this->email = $em;}
    function setPassword($pass) {$this->password = $pass;}
}