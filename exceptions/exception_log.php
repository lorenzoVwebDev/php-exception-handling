<?php
namespace exception_log\class;

class Exception_log {
  private string $error_message;

  function __construct(string $error_message) {
    $this->error_message = $error_message;
  }

  function log_exception() {
    try {    $date = date('m.d.Y h:i:s');
      $error_log = $date."| User Error |". $this->error_message."\n";
      define('USER_ERROR_LOG', __DIR__."\\logs\\".date('mdy').".log");
      error_log($error_log, 3, USER_ERROR_LOG);
    } catch (Exception $e) {
      print $e->getMessage();
    }

  }

  function send_errorlogfile() {
    $log_file = __DIR__ . "\\logs\\".date('mdy').".log";
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($log_file));
    header('Content-Transfer-Encoding: binary');
    //Prevents the browser from caching the file. Setting Expires to 0 tells the browser that the file should not be stored and must be fetched from the server every time
    header('Expires: 0');
    //must-revalidate ensures that the file is not served from cache if the user requests it again. post-check=0, pre-check=0 disables advanced caching techniques used by some browsers.
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Content-Length: '.filesize($log_file));
    ob_clean();
    flush();
    readfile($log_file);
    exit;
  }
}
?>