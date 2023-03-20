<?php


class TeamLead
{
    private $currentState;
    public $junior;
    public $manager;
    public $hr;

    const possibleStates = [
        'good'     => [0 => 'normal', 1 => 'good'],
        'normal'   => [0 => 'bad', 1 => 'good'],
        'bad'      => [0 => 'fuck off', 1 => 'normal'],
        'fuck off' => [0 => 'fuck off', 1 => 'bad'],
    ];

    public function __construct($currentState)
    {
        $this->setState($currentState);
        $this->manager = new Manager();
        $this->hr = new HR();
    }

    public function getMinMaxPossibleState()
    {
        $array_keys_list = array_keys(self::possibleStates);
        $stateMin = end($array_keys_list);
        $stateMax = reset($array_keys_list);

        return [
            'min' => $stateMin,
            'max' => $stateMax,
        ];
    }

    public function setState($currentState)
    {
        $array_keys_list = array_keys(self::possibleStates);
        if (in_array($currentState, $array_keys_list)) {
            $this->currentState = $currentState;
            echo 'Current State is - ' . $this->getTeamLeadState() . PHP_EOL;
        } else {
            echo 'Enter Correct State' . PHP_EOL;
        }
    }

    public function getNextState($signal)
    {
        $currentState = $this->currentState;
        $nextState = self::possibleStates[$currentState][$signal];

        return $nextState;
    }

    public function checkGoodOrBadWork($signal)
    {
        $nextState = $this->getNextState($signal);
        $minState = $this->getMinMaxPossibleState()['min'];
        $maxState = $this->getMinMaxPossibleState()['max'];

        if ($minState === $nextState && $signal === 0) {
            $this->hr->addCounter();
        }

        if ($maxState === $nextState && $signal === 1) {
            $this->manager->addCounter();
        }
    }

    public function fromGoodToBadState($signal)
    {
        $currentState = $this->currentState;

        if ($signal === 0 && $currentState == 'good')
        {
            $this->setState('bad');
        }
    }

    public function inputSignal($signal)
    {
        echo "Signal $signal received" . PHP_EOL;
        $currentState = $this->currentState;
        $nextState = $this->getNextState($signal);

        if ($signal === 0 && $currentState == 'good')
        {
            $nextState = 'bad';
        }

        $this->getTeamLeadState() === $nextState ? $this->checkGoodOrBadWork($signal) : $this->setState($nextState);
    }

    public function getJuniorWork()
    {
        return $this->junior->signal;
    }

    public function getTeamLeadState()
    {
        return $this->currentState;
    }

    public function checkJuniorWork()
    {
        $signal = $this->getJuniorWork();
        $this->inputSignal($signal);
    }
}