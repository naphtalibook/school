<?php
require_once 'session_start.php';
 class Log_out_controller{

     public function controller(){
        $_SESSION['name'] = null;
        $_SESSION['image'] = null;
        $_SESSION['role'] = null;
        header("Location: api.php?action=index");
     }
 }