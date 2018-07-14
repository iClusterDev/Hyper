<?php
  /**
   * Home Controller
   * 
   * PHP Version 7.2.5
   */


  namespace App\Controllers;


  use \Core\Controller;
  use \Core\View;


  class Home extends Controller {

    protected function before() {
      // do something before
      return true;
    }

    protected function after() {
      // do something before
    }

    public function indexAction() {
      View::render('Home/index.html');
    }

    public function aboutAction() {
      View::render('Home/about.html');
    }

  }