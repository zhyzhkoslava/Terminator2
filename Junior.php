<?php


class Junior
{
    public $signal;

    const possibleSignals = [
        0,
        1
    ];

    public function work($signal)
    {
        if (in_array($signal, self::possibleSignals)) {
            $this->signal = $signal;
        } else {
            echo 'Enter Correct Signal' . PHP_EOL;
        }
    }
}