<?php
  require_once('./exception_log.php');
  require_once('./test_error.php');
  use exception_log\class\Exception_log;

/*   function error_handler($errno, $errstr, $errfile, $errline) {
    print "exception thrown";
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
  }

  set_error_handler('error_handler'); */

  try {
  if (isset($_POST['high-number']) && isset($_POST['low-number'])) {
    $high_number = filter_var($_POST['high-number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $low_number = filter_var($_POST['low-number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $response = array();

    if ($low_number != 0) {
      $result = $high_number / $low_number;
      
      $response['status'] = 'completed';
      $response['result'] = $result;

      header('Content-Type: application/json');
      echo json_encode($response);
    } else {
      $low_number = $_POST['low-number'];
      $throw_error = new throw_error($low_number);
      $throw_error->throw_exception();
    }

  } else if (isset($_GET)) {
    $send_log_file = new Exception_log('log_requested');
    $send_log_file->send_errorlogfile();
  } else {
    print 'not received';
    print_r($_POST);
  }
} catch (ErrorException $ex) {
  $error_message = $ex->getMessage();
  $response = array();
  $response['status'] = 'failed';
  $response['message'] = $error_message;
  http_response_code(500);
  header('Content-Type: application/json');
  echo json_encode($response);
} catch (Exception $e) {
  $error_message = $e->getMessage();
  $log_error = new Exception_log($error_message);
  $log_error->log_exception();
  $response = array();
  $response['status'] = 401;
  $response['message'] = $error_message;
  http_response_code(401);
  header('Content-Type: application/json');
  echo json_encode($response);
}
?>