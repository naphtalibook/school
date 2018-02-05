<?php
require_once "handlers/db_handler.php";
class Main_school_controller{
    public $Id_to_display;

    public function __construct($id_to_display = ''){
        $this->Id_to_display = $id_to_display;
    }
    public function main(){
        $num_of_students = Db_handler::num_of_row("student");
        $num_of_courses = Db_handler::num_of_row("course");
        return new Main_container_view($num_of_students,$num_of_courses);
    }
    public function side(){
        //get all students and curses
        $studets = Db_handler:: get_all('student');
        $courses = Db_handler:: get_all('course');
        return new Side_view($studets,$courses); 
    }
     public function display_student(){
         $student = Db_handler::get_one_by_id("student",$this->Id_to_display);
         $students_courses = Db_handler::get_courses_by_student_id($this->Id_to_display);
         $student->Courses = $students_courses;
         return new Main_container_view(null,null,$student,$students_courses);
     }
      public function display_course(){
         $cours_detailes = Db_handler::get_one_by_id("course",$this->Id_to_display);
         $students_in_cours = Db_handler::get_students_in_course($this->Id_to_display);
         $cours_detailes->Students = $students_in_cours;
         return new Main_container_view(null,null,null,null,null,null,$cours_detailes,$students_in_cours);
     }
}