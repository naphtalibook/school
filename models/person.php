<?php


 abstract class Person{

    public $Id;
    public $Name;
    public $Family_name;
    public $Phone;
    public $Email;
    public $Image_path;
  
    public function __construct($id,$name,$family_name,$phone,$email,$image_path){
        $this->Id = $id;
        $this->Name = $name;
        $this->Family_name = $family_name; 
        $this->Phone = $phone;
        $this->Email = $email; 
        $this->Image_path = $image_path; 
    }
   

}