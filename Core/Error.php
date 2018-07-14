<?php
  /**
   * Error
   * 
   * PHP Version 7.2.5
   */


  namespace Core;


  use App\Config;

  /**
   * Error class
   * responsible for error handling
   * @var Error
   */
  class Error {

    /**
     * converts any error into an exception
     * @param int $level: error severity
     * @param string $message: error message
     * @param string $file: lile name where error occurs
     * @param int $line: line number in the file
     * @return void
     */
    public static function errorHandler($level, $message, $file, $line) {
      if (error_reporting() !== 0) {
        throw new \ErrorException($message, 0, $level, $file, $line);
      }
    }


    /**
     * exception handler
     * @param Exception $exception: the exception
     * @return void
     */
    public static function exceptionHandler($exception) {

      $errorCode = ($exception->getCode() === 404) ? 404 : 500;
      http_response_code($errorCode);

      if (Config::SHOW_ERROR) {
        echo "<h1>Fatal Error</h1>";
        echo "<p>Uncaught Exception:" . get_class($exception) . "</p>";
        echo "<p>Message: " . $exception->getMessage() . "</p>";
        echo "<p>Stack Trace: <pre>" . $exception->getTraceAsString() . "</pre></p>";
        echo "<p>Thrown in " . $exception->getFile() . "</p>";
        echo "<p>Line " . $exception->getLine() . "</p>";
      }
      else {
        $message  = "\n";
        $message .= "\nUncaught Exception:" . get_class($exception);
        $message .= "\nMessage: " . $exception->getMessage();
        $message .= "\nStack Trace: " . $exception->getTraceAsString();
        $message .= "\nThrown in " . $exception->getFile();
        $message .= "\nLine " . $exception->getLine();
        $message .= "\n";

        $logFile = str_replace('\\', '/', dirname(__DIR__)) . '/Logs/' . date('Y-m-d') . '.txt';
        ini_set('error_log', $logFile);
        error_log($message);
  
        View::render("$errorCode.html");
      }
    }

  }