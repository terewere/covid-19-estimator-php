<?php
require_once __DIR__.'/Impact.php';
class SevereImpact extends Impact {
  // eslint-disable-next-line no-useless-constructor
  public function __construct($input) {
    parent::__construct($input);
  }

  // challenge 1
  public function getCurrentlyInfected() {
    return $this->input['reportedCases'] * 50;
  }
}
