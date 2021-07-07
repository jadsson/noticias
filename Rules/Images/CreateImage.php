<?php

class CreateImage {
    private $id, $id_user, $id_news, $title, $category, $nome;

    function Create($id, $id_user, $id_news, $title, $category, $nome) {
        $this->id = $id;
        $this->id_user = $id_user;
        $this->id_news = $id_news;
        $this->title = $title;
        $this->category = $category;
        $this->nome = $nome;
    }

    function getId()            {return $this->id;}
    function getIdUser()        {return $this->id_user;}
    function getIdNews()        {return $this->id_news;}
    function getTitle()         {return $this->title;}
    function getCategory()      {return $this->category;}
    function getNome()          {return $this->nome;}
    function setId($id)         {$this->id = $id;}
    function setIdUser($id_u)   {$this->id_user = $id_u;}
    function setIdNews($id_n)   {$this->id_news = $id_n;}
    function setTitle($t)       {$this->title = $t;}
    function setCategory($c)    {$this->category = $c;}
    function setNome($n)        {$this->nome = $n;}
}