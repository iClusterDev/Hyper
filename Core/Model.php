<?php
  /**
   * Model
   * 
   * PHP Version 7.2.5
   */


   namespace Core;


   use PDO;
   use App\Config;


   /**
    * Model (base) class
    * every model inherits from base Model
    */
   abstract class Model {

    /**
     * uses PDO to connect to a database
     * the connection happens on the first call only
     * @return PDO $connection: the PDO connection object
     */
    protected static function getConnection() {

      static $connection = null;

      if ($connection === null) {
        try {
          $dsn = 'mysql:host=' . Config::DB_HOST . ';dbname=' . Config::DB_NAME;
          $connection = new PDO($dsn, Config::DB_USER, Config::DB_PSWD);
          $connection->setAttribute(PDO::ATTR_ERRORMODE, PDO::ERRORMODE_EXCEPTION);
        }
        catch(PDOException $e) {
          throw new \Exception('Error from: ' . get_class($this) . ' - Unable to connect to database ' . Config::DB_NAME  );
        }
      }

      return $connection;

    }

   }