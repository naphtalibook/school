<?php
require_once 'handlers/db_handler.php';
require_once 'logger/logger.php';
require_once 'logger/logger_msg.php';
require_once 'view/eror_view.php';
require_once 'handlers/upload_img_handler.php';
class Add_student_controller{

    public function add_student_form(){
        $resalt = Db_handler::get_all('course');
        return new Main_container_view(null,null,null,null,$resalt);
    }

    public function add_student(){ 
        $name = htmlspecialchars($_POST['name']) ;
        $family_name = htmlspecialchars($_POST['family_name']);
        $phone = htmlspecialchars($_POST['phone']);
        $email = htmlspecialchars($_POST['email']);
        if($name !== "" && $family_name !== "" && $phone !== "" && $email !== ""){
            if(isset($_POST['selected_courses'])){
                $course_arr = $_POST['selected_courses'];
            }else{
                $course_arr = [];
            }
            $image_path = Upload_Img::upload();
            if($image_path === "uploads/"){
                $image_path = "uploads/defalt.png";   
            }
            $inserted_id = Db_handler::add_student($name,$family_name,$phone,$email,$image_path); 
            if(!$inserted_id){
                $view = new Eror_view("try diferent phone number");
                $view->eror();
                die();
            } 
            //add student to cours
            if($course_arr !== []){
                $resalt = Db_handler::add_student_to_course($inserted_id,$course_arr);
            }
            Logger::WriteToLogFile(Logger_msg::new($name." ".$family_name,"student"));
            return $inserted_id; 
            
        }else{
           $view = new Eror_view("you need to fill all the form");
           $view->eror();
           die();
        }
        
    }
     public function remove_courses(){  ///remove courses from student
        if(isset($_POST['remove_cours'])){
            $student_id = $_POST['remove_courses_from_student'];
            $course_arr_to_remove = $_POST['remove_cours'];
            if(isset($course_arr_to_remove)){
                foreach($course_arr_to_remove as $course_id){
                    $resalt = Db_handler::remove_student_from_cours($student_id,$course_id);
                }
            }
        }   
    }
    public static function edit_student(){
        $student_id = $_POST['submit_edit_student'];
        $name = $_POST['edited_name'];
        $family_name = $_POST['edited_family_name'];
        $phone = $_POST['edited_phone'];
        $email = $_POST['edited_email'];
        if($name !== "" && $family_name !== "" && $phone !== "" && $email !== ""){
            $image_path = Upload_Img::upload();
            if($image_path === "uploads/"){
                $image_path = null;   
            }
            $resalt = Db_handler::edit_student($student_id,$name,$family_name,$phone,$email,$image_path);
            if($resalt){
                Logger::WriteToLogFile(Logger_msg::edit($name." ".$family_name,"student")); 
            } 
        }else{
           $view = new Eror_view("you need to fill all the form");
           $view->eror();
           die();
        }
    }
    public static function add_student_to_course(){
        if(isset($_POST['student_wants_to_learn'])){
            $student_id = $_POST['submit_student_picked_course'];
            $courses_to_learn_arr = $_POST['student_wants_to_learn'];
            if(isset($courses_to_learn_arr)){
                $resalt = Db_handler::add_student_to_course($student_id,$courses_to_learn_arr);
            }
        }
        
    }
    public static function delete_student(){
         $resalt = Db_handler::delete_from_db("student",$_POST['delete_student']);
          if($resalt){
           Logger::WriteToLogFile(Logger_msg::delete("id = ".$_POST['delete_student'],"student")); 
        }
    }
    
    


}