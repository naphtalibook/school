<?php
require_once 'session_start.php';
require_once 'handlers/db_handler.php';
require_once 'logger/logger.php';
require_once 'logger/logger_msg.php';
require_once 'view/eror_view.php';
require_once 'handlers/upload_img_handler.php';
class Add_administrator_controller{

    public function add_administrator_form(){
          return new Main_container_view();
     } 
    public function add_administrator(){
        $name = htmlspecialchars($_POST['name']);
        $family_name = htmlspecialchars($_POST['family_name']);
        $phone = htmlspecialchars($_POST['phone']);
        $email = htmlspecialchars($_POST['email']);
        $user_name = htmlspecialchars($_POST['user_name']);
        $password = htmlspecialchars($_POST['password']);
        $submit_password = htmlspecialchars($_POST['submit_password']);
        if($password === $submit_password){
            if($name !== "" && $family_name !== "" && $phone !== "" && $email !== "" && $user_name !=="" && $password !=="" && $submit_password !==""){
                if(isset($_POST['role'])){
                    $role = htmlspecialchars($_POST['role']);
                    if($role === "manager"){
                        $role = 2;
                    }else{
                        $role = 3;
                    }
                }else{
                    $role = "3";
                }
                $image_path = Upload_Img::upload();
                if($image_path === "uploads/"){
                    $image_path = "uploads/defalt.png";   
                }
                    $inserted_id = Db_handler::add_administrator($name,$family_name,$user_name,$role,$phone,$email,$password,$image_path);     
                    if(!$inserted_id){
                        $view = new Eror_view("try diferent phone number or user name");
                        $view->eror();
                        die();
                    }
                Logger::WriteToLogFile(Logger_msg::new($name." ".$family_name,"administrator"));
                return $inserted_id; 
                 
            }else{
                $view = new Eror_view("you need to fill all the form");
                $view->eror();
               die();
            }
        }else{
            $view = new Eror_view("password dnot match");
            $view->eror();
            die(); 
        }
    }

    public function edit_administrator(){
        $administrator_id = $_POST['submit_edit_administrator'];
        $name = $_POST['edited_name'];
        $family_name = $_POST['edited_family_name'];
        $user_name = $_POST['edited_user_name'];
        $phone = $_POST['edited_phone'];
        $email = $_POST['edited_email'];
        if($name !== "" && $family_name !== "" && $phone !== "" && $email !== "" && $user_name !== ""){
            $image_path = Upload_Img::upload();
            if($image_path === "uploads/"){
                $image_path = null;   
            }
            if(isset($_POST['role'])){
                if($_POST['role'] === 'manager'){
                    $role = 2;
                }else if($_POST['role'] === 'sales'){
                    $role = 3;
                }
            }else if($_SESSION['role'] === 'owner'){
                $role = 1;
            }else $role = null;
        $resalt = Db_handler::edit_administrator($administrator_id,$name,$family_name,$user_name,$phone,$email,$image_path,$role);
            if($resalt){
                Logger::WriteToLogFile(Logger_msg::edit($name." ".$family_name,"administrator")); 
            }
        }else{
            $view = new Eror_view("you need to fill all the form");
            $view->eror();
            die();
        }
    }
    public function delete_administrator(){
        $resalt = Db_handler::delete_from_db("administrator",$_POST['delete_administrator']); 
        if($resalt){
            Logger::WriteToLogFile(Logger_msg::delete("id = ".$_POST['delete_administrator'],"administrator")); 
        }    
    }
}