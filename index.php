<?php
// require_once __DIR__.'/vendor/autoload.php';
require_once __DIR__.'/src/estimator.php';


$input = array(
    'region' => [
      'name' => 'Africa',
      'avgAge' => 19.7,
      'avgDailyIncomeInUSD' => 5,
      'avgDailyIncomePopulation' => 0.71
    ],
    'periodType' => "days",
    'timeToElapse' => 30,
    'reportedCases' =>50,
    'population' => 50000,
    'totalHospitalBeds' =>45545
);
$output = covid19ImpactEstimator($input);

echo json_encode($output);
