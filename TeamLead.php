<?php


class TeamLead
{
    private $state;
    public  $junior;
    public  $manager;
    public  $hr;

    const possibleStates = [
        'good'     => [0 => 'normal',    1 => 'good'],
        'normal'   => [0 => 'bad',       1 => 'good'],
        'bad'      => [0 => 'fuck off',  1 => 'normal'],
        'fuck off' => [0 => 'fuck off',  1 => 'bad'],
    ];

    public function __construct($state)
    {
        $this->setState($state);
        $this->manager = new Manager();
        $this->hr = new HR();
    }

    public function setState($state)
    {
        $array_keys_list = array_keys(self::possibleStates);
        if (in_array($state, $array_keys_list)) {
            $this->state = $state;
            echo 'Current State is - ' . $this->getTeamLeadState() . PHP_EOL;
        } else {
            echo 'Enter Correct State' . PHP_EOL;
        }
    }

    public function getStateBySignal($key)
    {
        $state = $this->state;
        $nextStateBySignal = self::possibleStates[$state][$key];

        return $nextStateBySignal;
    }

    public function input0signal($signal)
    {
        echo 'Signal 0 received' . PHP_EOL;
        $nextState = $this->getStateBySignal($signal);

        $this->state === $nextState ? $this->hr->addCounter() : $this->setState($nextState);
    }

    public function input1signal($signal)
    {
        echo 'Signal 1 received' . PHP_EOL;
        $nextState = $this->getStateBySignal($signal);

        $this->state === $nextState ? $this->manager->addCounter() : $this->setState($nextState);
    }

    public function getJuniorWork()
    {
        return $this->junior->signal;
    }

    public function getTeamLeadState()
    {
        return $this->state;
    }

    public function checkJuniorWork()
    {
        $this->getJuniorWork() === 1 ? $this->input1signal($signal = 1) : $this->input0signal($signal = 0);
    }
}