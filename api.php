<?php
require_once 'session_start.php';
require_once 'top.php';

$possible_url = array(
"index",
"logout",
"school",
"adminisration",
"add_course",
"add_student",
"add_administrator"
);

if (isset($_GET["action"]) && in_array($_GET["action"], $possible_url)){

    switch ($_GET["action"]) 
    {
      case "index":{
        require_once 'controller/login_controller.php';
        require_once 'view/login_view.php';
        $controller = new Login_controller();
        $view = $controller->controller();
        $view->print_login();
      break;
      }

      case "school":{
        require_once 'controller/main_school_controller.php';
        require_once 'view/side_view.php';  
        require_once 'view/main_container_view.php';
        $controller = new Main_school_controller();
        $side_view = $controller->side();
        $side_view->school();
        $main_view = $controller->main();
        $main_view->main_school();
      break;
      }

      case "logout":{
        require_once 'controller/log_out_controller.php';
        $controller = new Log_out_controller();
        $controller->controller();
      break;
      }

      case "adminisration":{
        require_once 'controller/main_administraition_controller.php';
        require_once 'view/side_view.php';  
        require_once 'view/main_container_view.php';
        $controller = new Main_administraition_controller();
        $side_view = $controller->side();
        $side_view->administrator();
        $main_view = $controller->main();
        $main_view->main_administrator();
      break;
       }

      case "add_course":{
        require_once 'view/side_view.php'; 
        require_once 'view/main_container_view.php';
        require_once 'controller/main_school_controller.php';  
        require_once 'controller/add_course_controler.php';
        $controller = new Main_school_controller();
        $side_view = $controller->side();
        $side_view->school();
        $controller = new Add_course_controller();
        $main_view = $controller->add_course_form();
        $main_view->add_course();
      break;
      }

      case "add_student":{
        require_once 'controller/main_school_controller.php';
        require_once 'view/side_view.php';  
        $controller = new Main_school_controller();
        $side_view = $controller->side();
        $side_view->school();
        require_once 'controller/add_student_controller.php';
        require_once 'view/main_container_view.php';
        $controller = new Add_student_controller();
        $main_view = $controller->add_student_form();
        $main_view->add_student();
      break;
      }
      case "add_administrator":{
        require_once 'controller/main_administraition_controller.php';
        require_once 'controller/add_administrator_controller.php';
        require_once 'view/side_view.php';  
        require_once 'view/main_container_view.php';
        $controller = new Main_administraition_controller();
        $side_view = $controller->side();
        $side_view->administrator();
        $controller = new Add_administrator_controller();
        $main_view = $controller->add_administrator_form();
        $main_view->add_administrator();
        break;
      }
    }  
}
//////////////////////   POST   //////////////////

if(isset($_POST['submit_login']) && count($_POST['submit_login']) > 0){
    require_once 'controller/login_controller.php';
    require_once 'view/login_view.php';
    $controller = new Login_controller();
    $view = $controller->controller();
    $view->print_login();
}
if(isset($_POST['student_id']) && count($_POST['student_id']) > 0){
    require_once 'controller/main_school_controller.php';
    require_once 'view/side_view.php';  
    require_once 'view/main_container_view.php';
    $id_to_display = htmlspecialchars($_POST['student_id']);
    $controller = new Main_school_controller($id_to_display);
    $side_view = $controller->side();
    $side_view->school();
    $all_courses = $side_view->All_courses;
    $main_view = $controller->display_student();
    $main_view->student_detailes($all_courses);
    $main_view->edit_student();
}
if(isset($_POST['course_id']) && count($_POST['course_id']) > 0){
    require_once 'controller/main_school_controller.php';
    require_once 'view/side_view.php';  
    require_once 'view/main_container_view.php';
    $id_to_display = htmlspecialchars($_POST['course_id']);
    $controller = new Main_school_controller($id_to_display);
    $side_view = $controller->side();
    $side_view->school();
    $main_view = $controller->display_course();
    $main_view->course_detailes();
    if($_SESSION['role']!=="sales"){
      $main_view->edit_course();
    }
}
if(isset($_POST['admin_id']) && count($_POST['admin_id']) > 0){
    require_once 'controller/main_administraition_controller.php';
    require_once 'view/side_view.php';  
    require_once 'view/main_container_view.php';
    $id_to_display = htmlspecialchars($_POST['admin_id']);
    $controller = new Main_administraition_controller($id_to_display);
    $side_view = $controller->side();
    $side_view->administrator();
    $main_view = $controller->display_admin();
    $main_view->administrator_detailes();
    $main_view->edit_administrator();
}

if(isset($_POST['submit_add_student']) && count($_POST['submit_add_student']) > 0){
    require_once 'controller/main_school_controller.php';
    require_once 'view/side_view.php';  
    require_once 'controller/add_student_controller.php';
    require_once 'view/main_container_view.php';
    $controller1 = new Add_student_controller();
    $id_of_new_student = $controller1->add_student();
    $controller = new Main_school_controller($id_of_new_student);
    $side_view = $controller->side();
    $side_view->school();

    $main_view = $controller->display_student();
    $main_view->student_detailes($side_view->All_courses);
    $main_view->edit_student();
}

if(isset($_POST['submit_add_course']) && count($_POST['submit_add_course']) > 0){
      require_once 'view/side_view.php'; 
      require_once 'view/main_container_view.php';
      require_once 'controller/main_school_controller.php';  
      require_once 'controller/add_course_controler.php';
      $controller = new Add_course_controller();
      $id_of_new_cours = $controller->add_course();

      $controller = new Main_school_controller($id_of_new_cours);
      $side_view = $controller->side();
      $side_view->school();

      $main_view = $controller->display_course();
      $main_view->course_detailes();
      if($_SESSION['role']!=="sales"){
      $main_view->edit_course();
    }
      
}

if(isset($_POST['submit_add_administrator']) && count($_POST['submit_add_administrator']) > 0){
    require_once 'controller/main_administraition_controller.php';
    require_once 'controller/add_administrator_controller.php';
    require_once 'controller/add_student_controller.php';
    require_once 'view/side_view.php';  
    require_once 'view/main_container_view.php';
    $controller1 = new Add_administrator_controller();
    $id_of_new_administrator = $controller1->add_administrator();
    
    $controller = new Main_administraition_controller($id_of_new_administrator);
    $side_view = $controller->side();
    $side_view->administrator(); 

    $main_view = $controller->display_admin();
    $main_view->administrator_detailes();
    $main_view->edit_administrator();
}
if(isset($_POST['submit_edit_student']) && count($_POST['submit_edit_student']) > 0){
    require_once 'controller/main_school_controller.php';
    require_once 'view/side_view.php';  
    require_once 'controller/add_student_controller.php';
    require_once 'view/main_container_view.php';
    $controller = new Add_student_controller();
    $controller->edit_student();
    $controller = new Main_school_controller($_POST['submit_edit_student']);
    $side_view = $controller->side();
    $side_view->school();
    $all_courses = $side_view->All_courses;
    $main_view = $controller->display_student();
    $main_view->student_detailes($all_courses);
    $main_view->edit_student();
}
if(isset($_POST['submit_edit_course']) && count($_POST['submit_edit_course']) > 0){
    require_once 'controller/main_school_controller.php';
    require_once 'controller/add_course_controler.php';
    require_once 'view/side_view.php';  
    require_once 'view/main_container_view.php';
    $controller = new Add_course_controller();
    $controller->edit_course();
    $controller = new Main_school_controller($_POST['submit_edit_course']);
    $side_view = $controller->side();
    $side_view->school();
    $main_view = $controller->display_course();
    $main_view->course_detailes();
    if($_SESSION['role']!=="sales"){
    $main_view->edit_course();
    }
}
if(isset($_POST['submit_edit_administrator']) && count($_POST['submit_edit_administrator']) > 0){
    require_once 'view/side_view.php'; 
    require_once 'view/main_container_view.php'; 
    require_once 'controller/main_administraition_controller.php';
    require_once 'controller/add_administrator_controller.php';
    $controller = new Add_administrator_controller();
    $controller->edit_administrator();
    $controller = new Main_administraition_controller($_POST['submit_edit_administrator']);
    $side_view = $controller->side();
    $side_view->administrator();
    $main_view = $controller->display_admin();
    $main_view->administrator_detailes();
    $main_view->edit_administrator();
}
if(isset($_POST['delete_student']) && count($_POST['delete_student']) > 0){
    require_once 'controller/add_student_controller.php';
    require_once 'controller/main_school_controller.php';
    require_once 'view/side_view.php';  
    require_once 'view/main_container_view.php';
    $controller = new Add_student_controller();
    $controller->delete_student();
    $controller = new Main_school_controller();
    $side_view = $controller->side();
    $side_view->school();
    $main_view = $controller->main();
    $main_view->main_school();
}
if(isset($_POST['delete_course']) && count($_POST['delete_course']) > 0){
    require_once 'controller/main_school_controller.php';
    require_once 'controller/add_course_controler.php';
    require_once 'view/side_view.php';  
    require_once 'view/main_container_view.php';
    $controller = new Add_course_controller();
    $controller->delete_course();
    $controller = new Main_school_controller();
    $side_view = $controller->side();
    $side_view->school();
    $main_view = $controller->main();
    $main_view->main_school();
}
if(isset($_POST['delete_administrator']) && count($_POST['delete_administrator']) > 0){
      require_once 'controller/main_administraition_controller.php';
      require_once 'controller/add_administrator_controller.php';
      require_once 'view/side_view.php';  
      require_once 'view/main_container_view.php';
      $controller = new Add_administrator_controller();
      $controller->delete_administrator();///
      $controller = new Main_administraition_controller();
      $side_view = $controller->side();
      $side_view->administrator();
      $main_view = $controller->main();
      $main_view->main_administrator();
}
if(isset($_POST['remove_courses_from_student']) && count($_POST['remove_courses_from_student']) > 0){
    require_once 'controller/main_school_controller.php';
    require_once 'view/side_view.php';  
    require_once 'controller/add_student_controller.php';
    require_once 'view/main_container_view.php';
    $controller = new Add_student_controller();
    $controller->remove_courses();
    $controller = new Main_school_controller($_POST['remove_courses_from_student']);
    $side_view = $controller->side();
    $side_view->school();
    $all_courses = $side_view->All_courses;
    $main_view = $controller->display_student();
    $main_view->student_detailes($all_courses);
    $main_view->edit_student();
}

if(isset($_POST['remove_students_from_course']) && count($_POST['remove_students_from_course']) > 0){
    require_once 'controller/main_school_controller.php';
    require_once 'controller/add_course_controler.php';
    require_once 'view/side_view.php';  
    require_once 'view/main_container_view.php';
    $controller = new Add_course_controller();
    $controller->remove_course();
    $controller = new Main_school_controller($_POST['remove_students_from_course']);
    $side_view = $controller->side();
    $side_view->school();
    $main_view = $controller->display_course();
    $main_view->course_detailes();
    if($_SESSION['role']!=="sales"){
    $main_view->edit_course();
    }
}

if(isset($_POST['submit_student_picked_course']) && count($_POST['submit_student_picked_course']) > 0){
    require_once 'controller/main_school_controller.php';
    require_once 'view/side_view.php';  
    require_once 'controller/add_student_controller.php';
    require_once 'view/main_container_view.php';
    $controller = new Add_student_controller();
    $controller->add_student_to_course();
    $controller = new Main_school_controller($_POST['submit_student_picked_course']);
    $side_view = $controller->side();
    $side_view->school();
    $all_courses = $side_view->All_courses;
    $main_view = $controller->display_student();
    $main_view->student_detailes($all_courses);
    $main_view->edit_student();
}


require_once 'footer.php';

?>