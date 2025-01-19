<?php
class test_error {
  function produce_error() {
    trigger_error("This is the error message", E_USER_WARNING);
/*     exit(); */
/*     echo "This is not going to be printed"; */
  }

  function throw_exception() {
    throw new userException("User Exception");
    echo "This line will not display";
  }
}
?>