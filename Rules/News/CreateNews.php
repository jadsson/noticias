<?php

class CreateNews {
    private $id, $category, $id_user, $id_upd, $title, $text, $day, $upd;

    function Create($id, $category, $id_user, $id_upd, $title, $text, $day, $upd) {
        $this->id = $id;
        $this->category = $category;
        $this->id_user = $id_user;
        $this->id_upd = $id_upd;
        $this->title = $title;
        $this->text = $text;
        $this->day = $day;
        $this->upd = $upd;
    }

    function getId() {return $this->id;}
    function getCategory() {return $this->category;}
    function getIdUser() {return $this->id_user;}
    function getIdUpd() {return $this->id_upd;}
    function getTitle() {return $this->title;}
    function getText() {return $this->text;}
    function getDay() { return $this->day; }
    function getUpd() { return $this->upd; }
    function setId($id) {$this->id = $id;}
    function setCategory($cat) {$this->category = $cat;}
    function setIdUser($id_u) {$this->id_user = $id_u;}
    function setIdUpd($id_upd) {$this->id_upd = $id_upd;}
    function setTitle($t) {$this->title = $t;}
    function setText($text) {$this->text = $text;}
    function setDay($day) {$this->day = $day; }
    function setUpd($upd) {$this->upd = $upd; }
}