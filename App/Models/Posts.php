<?php
  /**
   * Home Controller
   * 
   * PHP Version 7.2.5
   */


  namespace App\Models;


  use PDO;
  use \Core\Model;


  /**
   * Posts class
   * test class to check the database functionality
   */
  class Posts extends Model {

    /**
     * Gets all the posts from the database
     * @return array the posts 
     */
    public static function getAll() {
      $sql = 'SELECT id, title, content FROM posts ORDER BY created_at DESC';

      try {
        $connection = static::getConnection();
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
      }
      catch(PDOException $e) {
        throw new \Exception('Error from: ' . get_class($this) . ' method getAll() - Unable to get all posts');
      }

    }

  }