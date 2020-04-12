<?php
 function getFactor($days){
    return (int)($days / 3);
 }

 function getProjectedTime($factor){
  return  2 ** $factor;
 }

function convertElapseTimeTodays($timeToElapse, $periodType) {
  if ($periodType === 'days') {
    return $timeToElapse;
  } if ($periodType === 'weeks') {
    return $timeToElapse * 7;
  } if ($periodType === 'months') {
    return $timeToElapse * 30;
  }
  return 'period types include days,weeks and months';
}


