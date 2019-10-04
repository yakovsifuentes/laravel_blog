<?php


namespace App;


class PostTO
{
    private $id;
    private $image;
    private $comment;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getComment()
    {
        return $this->comment;
    }


}