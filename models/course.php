<?php

class Course{
    public $Id;
    public $Name;
    public $Description;
    public $Price;
    public $Image_path;
    public $Students;

    public function __construct(){
         if(func_num_args() > 0 ){
             $this->Id = func_get_arg(1);
             $this->Name = func_get_arg(2);
             $this->Description = func_get_arg(3);
             $this->Price = func_get_arg(4);
             $this->Image_path = func_get_arg(5);
         }
         $this->Students = null;
    }

}


?>
