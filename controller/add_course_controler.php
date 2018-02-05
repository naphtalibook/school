<?php
require_once 'handlers/db_handler.php';
require_once 'logger/logger.php';
require_once 'logger/logger_msg.php';
require_once 'view/eror_view.php';
require_once 'handlers/upload_img_handler.php';
class Add_course_controller{
    public function add_course_form(){
        return new Main_container_view();
    }
    public function add_course(){
        $name = htmlspecialchars($_POST['name']);
        $description = htmlspecialchars($_POST['description']);
        $price = htmlspecialchars($_POST['price']);
        if($name !== "" && $description !== "" && $price !== ""){
            $image_path = Upload_Img::upload();
            if($image_path === "uploads/"){
                $image_path = "uploads/cours.jpg";   
            }
            $inserted_id = Db_handler::add_course($name,$description,$price,$image_path);     
            
            Logger::WriteToLogFile(Logger_msg::new($name,"course"));
            return $inserted_id; 
         }else{
            $view = new Eror_view("you need to fill all the form");
            $view->eror();
            die();
        }    
    }
      public static function edit_course(){  //was written static
        $course_id = $_POST['submit_edit_course'];
        $name = $_POST['edited_name'];
        $description = $_POST['edited_description'];
        $price = $_POST['edited_rice'];
        if($name !== "" && $description !== "" && $price !== ""){
            $image_path = Upload_Img::upload();
            if($image_path === "uploads/"){
                $image_path = null;   
            }
            $resalt = Db_handler::edit_course($course_id,$name,$description,$price,$image_path);
            if($resalt){
                Logger::WriteToLogFile(Logger_msg::edit($name,"course")); 
            }  
        }else{
            $view = new Eror_view("you need to fill all the form");
            $view->eror();
            die();
        }    
    }
    public function remove_course(){
        $course_id = $_POST['remove_students_from_course'];
        $student_id_arr = $_POST['delete_student_from_course'];
        foreach($student_id_arr as$student_id){
            $resalt = Db_handler::remove_student_from_cours($student_id,$course_id);
        }
    }
    public function delete_course(){
        $resalt = Db_handler::delete_from_db("course",$_POST['delete_course']);
         if($resalt){
           Logger::WriteToLogFile(Logger_msg::delete("id = ".$_POST['delete_course'],"course")); 
        }
    }
}