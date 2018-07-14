<?php
  /**
   * View
   * 
   * PHP Version 7.2.5
   */


   namespace Core;


  /**
   * View class
   * uses the twig template engine 
   */
   class View {

    /**
     * renders the template view
     * initializes (static) $twig on the first call only
     * @param string $template: the template file name
     * @param array $args: additional arguments passed to the template (defaults to empty array)
     */
    public static function render($template, $args = []) {

      static $twig = null;

      if ($twig === null) {

        $loader = new \Twig_Loader_Filesystem(str_replace('\\', '/', dirname(__DIR__)) . '/App/Views');
        $twig = new \Twig_Environment($loader);
      }

      echo $twig->render($template, $args);

    }

   }