<?php
  /**
   * Front Controller
   * 
   * PHP Version 7.2.5
   */


   use App\Controllers;


   /**
    * Autoloader
    */
    $root = str_replace('\\', '/', dirname(__DIR__)); 
    require_once $root . '/Vendor/autoload.php';


   /**
    * Error and Exception handling 
    */
    error_reporting(E_ALL);
    set_error_handler('Core\Error::errorHandler');
    set_exception_handler('Core\Error::exceptionHandler');
    



   /**
    * Routing
    */
    $router = new \Core\Router();
    $router->use('{controller}/{action}');
    $router->use('{controller}/{action}/{id:\d+}');
    // Display the routing table
    // echo '<pre>';
    // echo htmlspecialchars(print_r($router->getRoutes(), true));
    // echo '</pre>';
    // echo '<hr>';


   /**
    * Dispatcher
    */
    $url = $_SERVER['QUERY_STRING'];
    $router->dispatch($url);


