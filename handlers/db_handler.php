<?php
require_once 'models/dbconnect.php';
require_once 'session_start.php';
require_once 'logger/logger.php';
require_once 'logger/logger_msg.php';

class Db_handler{

    public static function submit_login($user_name,$passwoerd){
        $resalt = Database::getInstance()->getConnection()->query("SELECT `Name`, Family_name,`Value`,Image_path FROM school.administrator join `values` on administrator.Role = `values`.Id where User_name = '$user_name' && `Password` = '$passwoerd' limit 1");
        if($resalt->num_rows > 0){
            while($row = $resalt->fetch_object()){
                return $row; 
            }
        }else{
            return false;
        }
    }
    public static function get_all($table){
        require_once 'models/student.php';
        require_once 'models/course.php';
        
        $resalt = Database::getInstance()->getConnection()->query("SELECT * FROM school.$table");
        if($resalt){
             if($resalt->num_rows > 0){
                while($row = $resalt->fetch_object($table)){
                    $arr[] = $row;
                }
                return $arr;
             }
            return [];
        }else{
            Logger::WriteToLogFile("problem with getting all students (db_handler)\n",true);
            return false;
        }
    }
     public static function get_all_administratores($q){
         require_once 'models/administrator.php';
        $resalt = Database::getInstance()->getConnection()->query($q);
        if($resalt){
             if($resalt->num_rows > 0){
                while($row = $resalt->fetch_object('Administrator')){
                    $arr[] = $row;
                }
                return $arr;
             }
            return [];
        }else{
            Logger::WriteToLogFile("problem with gettin all students (db_handler)\n",true);
            return false;
        }
     }
     public static function num_of_row($table){
         $resalt = Database::getInstance()->getConnection()->query("SELECT Id FROM school.$table");
         if($resalt->num_rows > 0){
             return $resalt->num_rows;
         }else{
             Logger::WriteToLogFile("problem with gettin num of row (db_handler)\n",true);
             return false;
         }
     }
     public static function get_administrator_detailes(){ //how meny administrators in each role
       $resalt = Database::getInstance()->getConnection()->query("SELECT sum(case Role when 1 then 1 else 0 end ) as `Owner` , sum(case Role when 2 then 1 else 0 end ) as Manager, sum(case Role when 3 then 1 else 0 end ) as Saels FROM school.administrator");  
       if($resalt->num_rows > 0){
            while($row = $resalt->fetch_object()){
                return $row; 
            }
       }else{
            Logger::WriteToLogFile("problem with gettin admin details (db_handler)\n",true);
            return false;
       }
     }
      public static function get_one_by_id($table,$id){ //gets alsow course by id
        require_once 'models/student.php';
        require_once 'models/course.php';
        require_once 'models/administrator.php';
        $resalt = Database::getInstance()->getConnection()->query("SELECT * FROM school.$table where Id = $id limit 1");
        if($resalt->num_rows > 0){
            while($row = $resalt->fetch_object($table)){
                return $row; 
            }
        }else{
            Logger::WriteToLogFile("problem with gettin ".$table." by id=$id (db_handler)\n",true);
            return false;
        }
      }
      public static function get_courses_by_student_id($sudent_id){
          $resalt = Database::getInstance()->getConnection()->query("SELECT course.Id, course.`Name`,course.Image_path FROM school.course_student join course on Course_id = course.Id where Student_id = $sudent_id");
          if($resalt){
            if($resalt->num_rows > 0){
                while($row = $resalt->fetch_object('Student')){
                    $arr[] = $row;
                }
                return $arr;
             }
             return [];    
          }else{
            Logger::WriteToLogFile("problem with getting students course by student id (db_handler)\n",true);
            return false;  
          }
      }
       public static function get_students_in_course($course_id){
          $resalt = Database::getInstance()->getConnection()->query("SELECT student.Id, `Name`, Family_name, Image_path FROM school.course_student join student on course_student.Student_id = student.Id where Course_id = $course_id");
          if($resalt){
            if($resalt->num_rows > 0){
                while($row = $resalt->fetch_object('Student')){
                    $arr[] = $row;
                }
                return $arr;
             }
             return [];    
          }else{
            Logger::WriteToLogFile("problem with getting students of course by course id = ".$course_id." (db_handler)\n",true);
            return false;  
          }
      }
       public static function add_student($name,$family_name,$phone,$email,$image_path){
          $resalt = Database::getInstance()->getConnection()->query("INSERT INTO `school`.`student` (`Name`, `Family_name`, `Phone`, `Email`, `Image_path`) VALUES ('$name','$family_name','$phone','$email','$image_path')");  
          $resalt = Database::getInstance()->getConnection()->insert_id;
          if($resalt){
            return $resalt;
          }else{
            Logger::WriteToLogFile("problem with adding student to db (db_handler)\n",true);
            return false;  
          }
       }
       public static function add_course($name,$description,$price,$image_path){
           $resalt = Database::getInstance()->getConnection()->query("INSERT INTO `school`.`course` (`Name`, `Description`, `Price`, `Image_path`) VALUES ('$name', '$description', '$price', '$image_path')");
           $resalt = Database::getInstance()->getConnection()->insert_id;
            if($resalt){
                return $resalt;
            }else{
                Logger::WriteToLogFile("problem with adding course to db (db_handler)\n",true);
                return false;  
            }
       }
       public static function add_administrator($name,$family_name,$user_name,$role,$phone,$email,$password,$image_path){
           $resalt = Database::getInstance()->getConnection()->query("INSERT INTO `school`.`administrator` (`Name`, `Family_name`, `User_name`, `Role`, `Phone`, `Email`, `Password`, `Image_path`) VALUES ('$name', '$family_name', '$user_name', '$role', '$phone', '$email', '$password', '$image_path')");
           $resalt = Database::getInstance()->getConnection()->insert_id;
            if($resalt){
                return $resalt;
            }else{
                Logger::WriteToLogFile("problem with adding administrator to db (db_handler)\n",true);
                return false;  
            } 
       }
       public static function add_student_to_course($student_id,$course_arr){
            foreach($course_arr as $course_id){
                $resalt = Database::getInstance()->getConnection()->query("INSERT INTO `school`.`course_student` (`Course_id`, `Student_id`) VALUES ('$course_id', '$student_id');");
            }
            if(!$resalt){
                Logger::WriteToLogFile("problem with adding student id= ".$student_id." to course id= ".$course_id." (db_handler)\n",true);
            }
            return $resalt;
       }
       public static function remove_student_from_cours($student_id,$course_id){
               $resalt = Database::getInstance()->getConnection()->query("DELETE FROM `school`.`course_student`where Course_id = $course_id && Student_id = $student_id;");
                if(!$resalt){
                Logger::WriteToLogFile("problem with removing student id=".$student_id." from course id=".$course_id." (db_handler)\n",true);
                }
            return $resalt;
       }
       public static function edit_student($student_id,$name,$family_name,$phone,$email,$image_path){
                if(!$image_path){
                    $resalt = Database::getInstance()->getConnection()->query("UPDATE `school`.`student` SET `Name`='$name', `Family_name`='$family_name', `Phone`='$phone', `Email`='$email' WHERE `Id`='$student_id'");
                }else{
                    $resalt = Database::getInstance()->getConnection()->query("UPDATE `school`.`student` SET `Name`='$name', `Family_name`='$family_name', `Phone`='$phone', `Email`='$email', `Image_path`='$image_path' WHERE `Id`='$student_id'");
                }
                if(!$resalt){
                Logger::WriteToLogFile("problem with editing student id = ".$student_id." (db_handler)\n",true);
                }
            return $resalt;
       }
       public static function edit_course($course_id,$name,$description,$price,$image_path){
           if(!$image_path){
                $resalt = Database::getInstance()->getConnection()->query("UPDATE `school`.`course` SET `Name`='$name', `Description`='$description', `Price`='$price' WHERE `Id`='$course_id'");
           }else{
                $resalt = Database::getInstance()->getConnection()->query("UPDATE `school`.`course` SET `Name`='$name', `Description`='$description', `Price`='$price', `Image_path`='$image_path' WHERE `Id`='$course_id'");
           } 
                if(!$resalt){
                Logger::WriteToLogFile("problem with editing cuorse id = ".$course_id." (db_handler)\n",true);
                }
            return $resalt;
       }
       public static function edit_administrator($administrator_id,$name,$family_name,$user_name,$phone,$email,$image_path,$role){
           if($image_path && $role){
                 $resalt = Database::getInstance()->getConnection()->query("UPDATE `school`.`administrator` SET `Name`='$name', `Family_name`='$family_name', `User_name`='$user_name', `Role`= '$role', `Phone`='$phone', `Email`='$email', `Image_path`='$image_path' WHERE `Id`='$administrator_id'");
           }else if(!$image_path && $role){
                $resalt = Database::getInstance()->getConnection()->query("UPDATE `school`.`administrator` SET `Name`='$name', `Family_name`='$family_name', `User_name`='$user_name', `Role`= '$role', `Phone`='$phone', `Email`='$email' WHERE `Id`='$administrator_id'");
           }else{
                $resalt = Database::getInstance()->getConnection()->query("UPDATE `school`.`administrator` SET `Name`='$name', `Family_name`='$family_name', `User_name`='$user_name', `Phone`='$phone', `Email`='$email' WHERE `Id`='$administrator_id'");
           }
           if(!$resalt){
                Logger::WriteToLogFile("problem with editing administrator id = ".$administrator_id." (db_handler)\n",true);
                }
            return $resalt;
       }
        public static function delete_from_db($table,$id){
            $resalt = Database::getInstance()->getConnection()->query("DELETE FROM `school`.`$table` WHERE `Id`='$id'");
             if(!$resalt){
                Logger::WriteToLogFile("problem with deleting ".$table." whrer id = ".$id." (db_handler)\n",true);
                }
            return $resalt;
        }
       

}


?>