<?php
require_once "handlers/print.php";
class Main_container_view{

    public $Num_of_students;
    public $Num_of_courses;
    public $Student_obj;
    public $Students_courses;
    public $All_courses;
    public $Administrator_details;
    public $Cours_detailes;
    public $Students_in_cours;
    public $Admin;

    public function __construct($num_of_students='',$num_of_courses='',$student_obj='',$students_courses='',$all_courses='',$administrator_details='',$cours_detailes='',$students_in_cours='',$admin=''){

        $this->Num_of_students = $num_of_students;
        $this->Num_of_courses = $num_of_courses;
        $this->Student_obj = $student_obj;
        $this->Students_courses = $students_courses;
        $this->All_courses = $all_courses;
        $this->Administrator_details = $administrator_details;
        $this->Cours_detailes = $cours_detailes;
        $this->Students_in_cours = $students_in_cours;
        $this->Admin = $admin;
    }

    public function main_school(){
        Print_out::main_school_container($this->Num_of_students, $this->Num_of_courses);
    }
    public function main_administrator(){
         Print_out::main_administrator_container($this->Administrator_details);
    }
    
    public function student_detailes($all_courses){
        ?><div id="main_container"><?php
        Print_out::student_detailes($this->Student_obj,$this->Students_courses);
        Print_out::edit_student_detailes($this->Student_obj,$this->Students_courses);
        print_out::all_courses_to_pick($all_courses,$this->Student_obj,$this->Students_courses);//
        ?></div><?php
    }
    public function course_detailes(){
        Print_out::course_detailes($this->Cours_detailes,$this->Students_in_cours);
        Print_out::edit_course_detailes($this->Cours_detailes,$this->Students_in_cours);
    }
    public function administrator_detailes(){
        Print_out::admin_detailes($this->Admin);
    }

    public function edit_student(){
        Print_out::edit_student_detailes($this->Student_obj,$this->Students_courses);
    }
     public function edit_course(){
        Print_out::edit_course_detailes($this->Cours_detailes,$this->Students_in_cours);
    }
    public function edit_administrator(){
        $to_delete = false;
        if(self::can_i_delete($this->Admin)){
            $to_delete = true;
        }
        Print_out::edit_administrator_detailes($this->Admin,$to_delete);
    }

    public function add_student(){
         Print_out::add_student_form($this->All_courses);
    } 
    public function add_course(){
         Print_out::add_course_form();
    }
    public function add_administrator(){
        Print_out::add_administrator_form();
    }
   
   
    public function can_i_delete($admin){
         if($_SESSION['role'] === "owner" && ($admin->Role === "2" || $admin->Role === "3") || ($_SESSION['role'] === "manager" && $admin->Role === "3")){
          return true;
        }else{
            return false;
        }
    }

    
}