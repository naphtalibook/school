<?php
require_once "handlers/print.php";
// require_once "view/main_container_view.php";
class Side_view{

    public $All_students;
    public $All_courses;
    public $All_administeators;
    public function __construct($all_students = '', $all_courses='', $all_administeators = ''){
        $this->All_students = $all_students;
        $this->All_courses = $all_courses;
        $this->All_administeators = $all_administeators;
    }

    public function school(){
        ?><div id="side"><?php
        Print_out:: all_courses($this->All_courses);
        Print_out:: all_students($this->All_students);
        ?></div><?php
    }
    public function administrator(){
         Print_out:: all_administrator($this->All_administeators); //All_students = all admin
    }
}