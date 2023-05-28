<?php
class Article{
    private $id;
    private $title;
    private $summary;
    private $content;

    public function __construct($id, $title, $summary, $content){
        $this->id       =$id;
        $this->title    =$title;
        $this->summary  =$summary;
        $this->content  =$content;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id=$id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
    }
}
?>