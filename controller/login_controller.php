<?php
require_once 'session_start.php';
require_once 'logger/logger.php';
require_once 'logger/logger_msg.php';
require_once 'handlers/db_handler.php';

class Login_controller{

    public function __construct(){}
    
    public function controller(){
    
        $msg = "";
        if(empty($_POST['submit_login'])){
                return new Login_view($msg);
        }

        else if(isset($_POST['submit_login']) && count($_POST['submit_login']) >0){
            $user_name = htmlspecialchars($_POST['user_name']);
            $passwoerd = htmlspecialchars($_POST['passwoerd']);
            $resalt = Db_handler::submit_login($user_name,$passwoerd);
            if($resalt){
                $_SESSION['role'] = $resalt->Value;
                $_SESSION['name'] = $resalt->Name . " " . $resalt->Family_name;
                $_SESSION['image'] = $resalt->Image_path;
                Logger::WriteToLogFile(Logger_msg::write_text("enterd"));
                header('Location: api.php?action=school');
            }else{
                $msg = "failed to login";
                return new Login_view($msg);
            }
        }
        
     

    }
}



?>