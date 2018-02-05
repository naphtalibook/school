<?php
require_once 'person.php';

class Student extends Person{

      public $Courses;

     public function __construct(){

            if(func_num_args() > 0 ){
                  $id = func_get_arg(0);
                  $name = func_get_arg(1);
                  $family_name = func_get_arg(2);
                  $phone = func_get_arg(3);
                  $email = func_get_arg(4);
                  $image_path = func_get_arg(5);
                  
                  parent::__construct($id,$name,$family_name,$phone,$email, $image_path);

                  $this->Courses = null;
            }
      }
      
}