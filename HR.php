<?php


class HR
{
    public $countBadWork;

    public function addCounter()
    {
        $this->countBadWork++;
    }

    public function getBadWork()
    {
        return $this->countBadWork;
    }
}