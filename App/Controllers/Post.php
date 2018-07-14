<?php
  /**
   * Posts Controller
   * 
   * PHP Version 7.2.5
   */


  namespace App\Controllers;


  use \Core\Controller;
  use \Core\View;
  use App\Models\Posts;


  class Post extends Controller {

    protected function before() {
      // do something before
      return true;
    }

    protected function after() {
      // do something before
    }

    public function indexAction() {
      $posts = Posts::getAll();
      View::render('Post/index.html', [
        'posts' => $posts
      ]);
    }

  }