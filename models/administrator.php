<?php
require_once 'person.php';
class Administrator extends Person{

    public $User_name;
    public $Role;
    public $Password;
    
     public function __construct(){

            if(func_num_args() > 0 ){
                  $id = func_get_arg(0);
                  $name = func_get_arg(1);
                  $family_name = func_get_arg(2);
                  $phone = func_get_arg(5);
                  $email = func_get_arg(6);
                  $image_path = func_get_arg(8);
                  
                  parent::__construct($id,$name,$family_name,$phone,$email, $image_path);

                $this->User_name = func_get_arg(3);
                $this->Role = func_get_arg(4);
                $this->Password = func_get_arg(7);
            }
      }
      
    
}