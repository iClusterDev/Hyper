<?php
  /**
   * Base Controller
   * 
   * PHP Version 7.2.5
   */


  namespace Core;


  /**
   * Base controller class
   * Every controller inherits from base controller
   * The base controller is for storing the route parameters into $this->getParams
   * The route parameters are passed in when a new controller is created
   * @param Controller
   */
  abstract class Controller {
  

    protected $params = array();


    protected abstract function before();    


    protected abstract function after();


    public function __construct($routeParams) {
      $this->params = $routeParams;
    }


    public function __call($name, $args) {
      if ($this->before()) {
        $action = $name . 'Action';
        if (is_callable([$this, $action])) {
          call_user_func_array([$this, $action], $args);
          $this->after();
        }
      }
    }


    public function getParams() {
      return $this->params;
    }

  }