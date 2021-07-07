<?php

class CreateComment {
    private $id, $id_user, $id_img, $id_news, $text;

    function Create($id, $id_user, $id_img, $id_news, $text) {
        $this->id = $id;
        $this->id_user = $id_user;
        $this->id_img = $id_img;
        $this->id_news = $id_news;
        $this->text = $text;
    }

    function getId() {return $this->id;}
    function getIdUser() {return $this->id_user;}
    function getIdImg() {return $this->id_img;}
    function getIdNews() {return $this->id_news;}
    function getText() {return $this->text;}
    function setId($id) {$this->id = $id;}
    function setIdUser($id_u) {$this->id_user = $id_u;}
    function setIdImg($id_img) { $this->id_img = $id_img; }
    function setIdNews($id_news) { $this->id_news = $id_news; }
    function setText($text){ $this->text = $text; }
}