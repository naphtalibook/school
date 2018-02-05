
<?php

class Logger_msg{

private function __construct(){}

    public static function write_text($text){
        return  $text . "\n";
    }
    public static function new($name,$type){
        return   $name . " " . $type . " was added \n";
    }
    public static function delete($name,$type){
        
        return $type . " ". $name ." was deleted  \n ";
    }
    public static function edit($name,$type){
        
        return $type . "  " . $name . " was edited \n";
    }
}




?>