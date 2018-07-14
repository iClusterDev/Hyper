<?php
  /**
   * Home Controller
   * 
   * PHP Version 7.2.5
   */


  namespace App\Controllers\User;


  use \Core\Controller;


  class Admin extends Controller {

    protected function before() {
      echo 'before() ';
      return true;
    }

    protected function after() {
      echo ' after()';
    }

    public function indexAction() {
      echo 'Hello from Admin Index';
    }

  }