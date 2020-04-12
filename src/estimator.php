<?php

require_once __DIR__.'/Impact.php';
require_once __DIR__.'/SevereImpact.php';

function covid19ImpactEstimator($data)
{
   $impact = new Impact($data);
   $severeImpact = new SevereImpact($data);
  
   return [
    'data' => $data,
    'impact' => $impact->getData(),
    'severeImpact' => $severeImpact->getData()
   ];
}
