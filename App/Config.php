<?php
  /**
   * App Configuration file
   * 
   * PHP Version 7.2.5
   */


   namespace App;


  /**
   * Config class
   * contains all the configuration settings
   * these are stored in constant variables
   * this file has to be "gitignored" 
   */
   class Config {

    /**
     * Database
     * @var string DB_NAME: database name
     * @var string DB_USER: database user
     * @var string DB_HOST: database host
     * @var string DB_PSWD: database password
     */
     const DB_NAME = 'your_db_name';
     const DB_HOST = 'your_db_host';
     const DB_USER = 'your_db_user';
     const DB_PSWD = 'your_db_password';

    /**
     * Errors
     * @var boolean SHOW_ERROR: true for development, false for production
     */
    const SHOW_ERROR = true;

   }