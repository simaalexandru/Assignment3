<?php
class Database 
{
	private static $dbName = 'simaalexandru_d' ; 
	private static $dbHost = 'simaalexandru.dk.mysql' ;
	private static $dbUsername = 'simaalexandru_d';
	private static $dbUserPassword = 'iJPAe6Gz';
	
	private static $cont  = null;
	
	public function __construct() {
		exit('Init function is not allowed');
	}
	
	public static function connect()
	{
	   // connection
       if ( null == self::$cont )
       {      
        try 
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);  
        }
        catch(PDOException $e) 
        {
          die($e->getMessage());  
        }
       } 
       return self::$cont;
	}
	
	public static function disconnect()
	{
		self::$cont = null;
	}
}
?>