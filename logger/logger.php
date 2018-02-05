
<?php


class Logger{

  private function __construct(){}

   public static function WriteToLogFile($data,$error = false){

        $role = $_SESSION['role']; 
        $name = $_SESSION['name'];  

        $logFile = fopen("logger/logger.txt","a+");

        $date = new DateTime('now');
        $stringDate = date_format( $date ,'Y-m-D H:i:s');

        if($error) { $prefixData = "[$stringDate][Error]=>[$role][$name]=> ";}
        else { $prefixData = "[$stringDate]=>[$role][$name]=> ";}
        
        fwrite($logFile,$prefixData.$data); //[1-10-2017 20:31:15] => [owner][naphtali]

        fclose($logFile);

   }  

 } 

   




?>