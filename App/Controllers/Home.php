<?php
  /**
   * Home Controller
   * 
   * PHP Version 7.2.5
   */


  namespace App\Controllers;


  use \Core\Controller;


  class Home extends Controller {

    protected function before() {
      echo 'before() ';
      return true;
    }

    protected function after() {
      echo ' after()';
    }

    public function indexAction() {
      echo 'Hello from Home Index';
    }

    public function aboutAction() {
      echo 'This is all about MVC';
    }

  }