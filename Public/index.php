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
  * Routing
  */
  $router = new \Core\Router();
  // $router->use('home', ['controller' => 'home', 'action' => 'index']);
  // $router->use('{controller}');
  // $router->use('home');
  $router->use('{controller}');
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

