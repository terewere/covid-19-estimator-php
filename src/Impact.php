<?php

require_once __DIR__ . '/util.php';

class Impact
{
    protected $currentlyInfected = '';
    protected $infectionsByRequestedTime = '';
    protected $severeCasesByRequestedTime = '';
    protected $hospitalBedsByRequestedTime = '';
    protected $casesForICUByRequestedTime = '';
    protected $casesForVentilatorsByRequestedTime = '';
    protected $dollarsInFlight = '';
    protected $input;
    public function __construct($input)
    {
        $this->input = $input;
        $this->init();
    }

    public function init()
    {
        $this->currentlyInfected = $this->getCurrentlyInfected();
        $this->infectionsByRequestedTime = $this->getInfectionsByRequestedTime();
        $this->severeCasesByRequestedTime = $this->getSevereCasesByRequestedTime();
        $this->hospitalBedsByRequestedTime = $this->getHospitalBedsByRequestedTime();
        $this->casesForICUByRequestedTime = $this->getCasesForICUByRequestedTime();
        $this->casesForVentilatorsByRequestedTime = $this->getCasesForVentilatorsByRequestedTime();
        $this->dollarsInFlight = $this->getDollarsInFlight();
    }

    // challenge 1
    public function getCurrentlyInfected()
    {
        return $this->input['reportedCases'] * 10;
    }

    // challenge 1
    public function getInfectionsByRequestedTime()
    {
        $timeInDays = convertElapseTimeTodays($this->input['timeToElapse'], $this->input['periodType']);

        $factor = getFactor($timeInDays);
        $projectedTime = getProjectedTime($factor);
        return (int)($this->currentlyInfected * $projectedTime);
    }

    // challenge 2 of 1
    public function getSevereCasesByRequestedTime()
    {
        return (int) ((15 / 100) * $this->infectionsByRequestedTime);
    }
 
    // challenge 2 of 2
    // not sure of this computation: the question wasn't clear
    public function getHospitalBedsByRequestedTime()
    {
        $availableBeds = 35 / 100 * $this->input['totalHospitalBeds'];
        return (int) ($availableBeds - $this->severeCasesByRequestedTime);
    }

    // challenge 3 of 1
    public function getCasesForICUByRequestedTime()
    {
        return (int) ((5 / 100) * $this->infectionsByRequestedTime);
    }

    // challenge 3 of 2
    public function getCasesForVentilatorsByRequestedTime()
    {
        return (int) ((2 / 100) * $this->infectionsByRequestedTime);
    }

    // challenge 3 of 3
    public function getDollarsInFlight()
    {
        $timeInDays = convertElapseTimeTodays($this->input['timeToElapse'], $this->input['periodType']);
        $amount = ($this->infectionsByRequestedTime
             * $this->input['region']['avgDailyIncomePopulation']
             * $this->input['region']['avgDailyIncomeInUSD']) / $timeInDays;

        return (int) ($amount);
    } 

    public function getData()
    {
        return [
            'currentlyInfected' => $this->currentlyInfected,
            'infectionsByRequestedTime' => $this->infectionsByRequestedTime,
            'severeCasesByRequestedTime' => $this->severeCasesByRequestedTime,
            'hospitalBedsByRequestedTime' => $this->hospitalBedsByRequestedTime,
            'casesForICUByRequestedTime' => $this->casesForICUByRequestedTime,
            'casesForVentilatorsByRequestedTime' => $this->casesForVentilatorsByRequestedTime,
            'dollarsInFlight' => $this->dollarsInFlight,
        ];
    }
}
