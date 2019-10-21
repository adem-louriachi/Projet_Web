<?php
require '../Models/MessagesMod.php';

class Messages
{
    private $msgDate;
    private $authors;
    private $state;
    private $msgText;

    public function __construct()
    {
        $this->state = false;
    }

    public function getMsgDate()
    {
        return $this->msgDate;
    }


    public function getAuthors()
    {
        return $this->authors;
    }

    public function setAuthors(User $authors)
    {
        $this->authors = $authors;
    }

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
    }

    public function getMsgText()
    {
        return $this->msgText;
    }

    public function setMsgText($msgText)
    {
        $this->state = $msgText;
    }


}
