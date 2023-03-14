<?php


class Manager
{
    public $countGoodWork;

    public function addCounter()
    {
        $this->countGoodWork++;
    }

    public function getGoodWork()
    {
        return $this->countGoodWork;
    }
}