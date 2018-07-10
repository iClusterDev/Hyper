<?php
  /**
   * Router
   * 
   * PHP Version 7.2.5
   */


  namespace Core;


  /**
   * Router
   * supports flexible routing:
   * routes can be explicitly defined providing a controller and an action
   * alternatively routes can be provided using the variables enclosed in {}
   * @var Router
   */
  class Router {

    /**
     * Routing table
     * @var array $routes: associative array containing the framework routes
     */
    private $routes = array();


    /**
     * Route parameters
     * @var array $params: associative array containing the route parameters
     */
    private $params = array(
      'action' => 'index'
    );


    /**
     * Returns all the routes in the routing table
     * @return array $routes: the routing table
     */
    public function getRoutes() {
      return $this->routes;
    }


    /**
     * Returns the current route parameters
     * @return array $params: the route parameters
     */
    public function getParams() {
      return $this->params;
    }


    /**
     * Converts the route into a regular expression
     * Then adds the route in the routing table
     * @param string $route: a new route to add to the routing table
     * @param array $params: optional array the controller, action, namespace (optional), other params (optional)
     * @return void
     */
    public function use($route, $params = []) {
      $route = preg_replace('/\//', '\\/', $route);
      $route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-_]+)', $route);
      $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);
      $route = '/^' . $route . '$/i';
      $this->routes[$route] = $params;
    }


    /**
     * Matches the passed URL to a route in the routing table
     * If a match is found, extract from the route the controller, action
     * and any other parameter. This parameters are then stored in the router params
     * @param string $url: the request URL
     * @return boolean true if there's a match, false otherwise
     */
    private function match($url) {
      $this->params['controller'] = $url;
      foreach($this->routes as $route => $params) {
        if (preg_match($route, $url, $matches)) {
          foreach($matches as $key => $match) {
            if (is_string($key)) {
              // $params[$key] = $match;
              $this->params[$key] = $match;
            }
          }
          // $this->params = $params;
          // echo '<pre>';
          // echo htmlspecialchars(print_r($this->getParams(), true));
          // echo '</pre>';
          return true;
        }
      }
      return false;
    }


    /**
     * Dispatch the current route to the right 
     * controller (class) and action (class method)
     * @param string $url: the request URL
     * @return void
     */
    public function dispatch($url) {
      if ($this->match($url)) {
        $controller = $this->toStudlyCase($this->params['controller']);
        $controller = $this->getNamespace() . $controller;
        if (class_exists($controller)) {
          $controllerObj = new $controller($this->params);
          // echo '<pre>';
          // echo htmlspecialchars(print_r($controllerObj->getParams(), true));
          // echo '</pre>';
          // $controllerObj->run();
          $action = $this->toCamelCase($this->params['action']);
          if (is_callable([$controllerObj, $action])) {
            $controllerObj->$action();
          }
          else {
            // throw non callable method
          }
        }
        else {
          // throw class not found
        }
      }
      else {
        // throw url not found
      }
    }


    /**
     * Utility function to convert a string 
     * to StudlyCase
     * @param string $string: the string to convert
     * @return string $string: the processed string
     */
    private function toStudlyCase($string) {
      return str_replace(' ', '', ucwords(preg_replace('/[-_]/', " ", $string)));
    }


    /**
     * Utility function to convert a string 
     * to camelCase
     * @param string $string: the string to convert
     * @return string $string: the processed string
     */
    private function toCamelCase($string) {
      return lcfirst(str_replace(' ', '', ucwords(preg_replace('/[-_]/', " ", $string))));
    }


    /**
     * Sets the controller namespace passed optionally
     * in the add function. if the namespace is not passed in
     * namespace defaults to App\Controllers
     * @return string $namespace: the namespace
     */
    private function getNamespace() {
      $namespace = 'App\Controllers\\';
      if (array_key_exists('namespace', $this->params)) {
        $namespace = $this->params['namespace'] . '\\';
      }
      return $namespace;
    }

  }