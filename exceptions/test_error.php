<?php
class throw_error {
  public $number;

  function __construct($low_number) {
    $this->number = $low_number;
  }

  function throw_exception() {
    $message = "divided by " . $this->number;
    throw new Exception($message);
  }
}
?>