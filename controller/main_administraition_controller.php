<?php
require_once 'session_start.php';
require_once "handlers/db_handler.php";
class Main_administraition_controller{
  
  public $Id_to_display;

  public function __construct($id_to_display=''){
      $this->Id_to_display = $id_to_display;
  }

   public function main(){
         $resalt = Db_handler::get_administrator_detailes();
        return new Main_container_view(null,null,null,null,null,$resalt);
    }
    public function side(){
        if($_SESSION['role'] === "owner"){
            $q = "SELECT administrator.Id, `Name`,Family_name, Phone,Email,Image_path,`Value` as Role FROM school.administrator join `values` on administrator.Role = `values`.Id";
        }else if($_SESSION['role'] === "manager"){
             $q = "SELECT administrator.Id, `Name`,Family_name, Phone,Email,Image_path,`Value` as Role FROM school.administrator join `values` on administrator.Role = `values`.Id where `Value` = 'manager' || `Value` = 'sales'";
        }
         $resalt = Db_handler:: get_all_administratores($q);
        return new Side_view(null,null,$resalt);
    }
     public function display_admin(){
         $admin = Db_handler::get_one_by_id("administrator",$this->Id_to_display);
         return new Main_container_view(null,null,null,null,null,null,null,null,$admin);
     }
}