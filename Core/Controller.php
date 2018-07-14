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
  

    /**
     * Controller parameters
     * Holds the route parameters passed to the controller
     * through its constructor
     * @var array $params: the contrller parameters
     */
    protected $params = array();


    /**
     * action filter
     * this executes before the actual action call
     */
    protected abstract function before();

    /**
     * action filter
     * this executes after the actual action call
     */
    protected abstract function after();


    /**
     * Constructor
     * @param array $routeParams: the current route parameters
     * @return void
     */
    public function __construct($routeParams) {
      $this->params = $routeParams;
    }


    /**
     * Magic method __call
     * this allows to execute the action filters for every controller action
     * @param string $name: the action name to cal
     * @param array $args: action parameters
     */
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