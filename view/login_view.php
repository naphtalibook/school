<?php
require_once 'handlers/print.php'; 
require_once 'view/login_view.php';
class Login_view{

    public $Msg;

    public function __construct($msg){
        $this->Msg = $msg;
    }
    
    public function print_login(){
        
       Print_out::login($this->Msg); 
    }
}
?>