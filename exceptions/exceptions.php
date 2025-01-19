<?php
/*   function printThings($things) {
    return print $things;
  }

  $print = 'printThings';

  call_user_func('printThings', 'hello momma'); */
  require_once('./test_error.php');
  function error_handler($errno, $errstr, $errfile, $errline) {
    print $errno."<br/>";
    print $errstr."<br/>";
    print $errfile."<br/>";
    print $errline."<br/>";
/*     throw new errorException($errstr, 0, (int)$errno, $errfile, $errline); */
    throw new Error;
  }

  set_error_handler('error_handler');
  try {
    $tester = new test_error;
    $tester->produce_error();
  } /* catch (errorException $ex) {
    echo "ERROR"."<br/>";
    echo $ex->getMessage();
  }  */catch (Error $er) {
    $message = $er->getMessage();
    print 'Error catch';
    echo $message;
  } catch (Throwable $t) {
    print 'hello world throwable';
    $message = $t->getMessage();
    echo $message;
  }
?>