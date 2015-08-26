<?php
/*
 * Establish a connection to the database
 */
function getDB() {
    $config = array(
            'DB_DNS' => 'mysql:host=localhost;port=3306;dbname=phpclasssummer2015', 
            'DB_USER' => 'php', 
            'DB_PASSWORD' => 'summer15'
            );
   try {//create the database connection and store in a variable 
        //attempt to establish a db connection, close it if it fails
        $db = new PDO($config['DB_DNS'], $config['DB_USER'], $config['DB_PASSWORD']);
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (Exception $ex) {
        $db = null;
        $message = $ex->getMessage();
        include './includes/error.php';
        exit();
    }
    return $db;
}