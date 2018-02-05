<?php
require_once 'session_start.php';
class Print_out{

    public static function login($msg){
         ?>
         
        <div class="form" id="login">
            <h1>Log in</h1>
            <form name="login" action="api.php" method="post">
            <p>User Name <input type="text" name="user_name" placeholder="user name"  required></p>
            <p>Password <input type="password" name="passwoerd"  placeholder="password" required></p>
            <p><input type="submit" name="submit_login" value="Ener" class= "btn btn-primary"></p>
            <p style="color:red"><?=$msg?></p>
        </div>
         <?php
     }
    ///////////////////////////    ALL OF X (SIDE)   ////////////////////////////////////
    public static function all_courses($all_courses){
    ?>
        <div id="side_courses">
            <a href="api.php?action=add_course"><button class="btn btn-success">course +</button></a>
                <form name="courst_pik" action="api.php" method="POST">
                    <?php
                
                    foreach($all_courses as $row){                       
                    ?> <button class="student_panel" value="<?=$row->Id?>" type="submit" name="course_id">
                        <img class="small_img" src="<?=$row->Image_path?>">
                        <span><?=$row->Name ?><br>
                        Price: <?=$row->Price?></span>
                        </button> <?php
                    }
                
            ?>
                </form>
        </div>
    <?php }
     public static function all_students($all_students){
        ?>
            <div id="side_students">
                <a href="api.php?action=add_student"><button class="btn btn-success">student +</button></a>
                <form name="student_pik" action="api.php" method="POST">
                <?php
                
                    foreach($all_students as $row){
                        
                    ?> <button class="student_panel" value="<?=$row->Id?>" type="submit" name="student_id">
                        <img class="small_img" src="<?=$row->Image_path?>">
                        <span><?=$row->Name . ' ' . $row->Family_name?><br>
                        <?=$row->Phone?></span>
                        </button> <?php
                    }
                
            ?>
            </div>
            </form>
            <?php
    }
    public static function all_administrator($all_admins){
    ?>  <div id="side">
            <div>
                <a href="api.php?action=add_administrator"><button class="btn btn-success">administrator +</button></a>
            </div>
            <div class="admin_btn">
                <form name="admin_pik" action="api.php" method="POST">
                <?php
                
                    foreach($all_admins as $row){
                        
                    ?> <button class="student_panel admin" value="<?=$row->Id?>" type="submit" name="admin_id">
                        <img class="small_img" src="<?=$row->Image_path?>">
                        <span><?=$row->Name . ' ' . $row->Family_name . ' - ' . "<b>" . $row->Role . "</b>"?><br>
                        <?=$row->Phone?> <br>
                        <?=$row->Email?></span>
                        </button> <?php
                    }
             ?>
                </form>
            </div>
        </div><?php
    }
        ///////////////////////////    MAIN COINTANER  ////////////////////////////////////
    public static function main_school_container($num_of_student, $num_of_courses){
        ?><div id="main_container">
            <h2>Number of students in the school: <?=$num_of_student?></h2>
            <h2>Number of courses in the school: <?=$num_of_courses?></h2>
            </div><?php
    }
    public static function main_administrator_container($administrator_details){
        ?><div id="main_container">
        <h2>admins in school:</h2>
        <h2>Owner: <?=$administrator_details->Owner?></h2>
        <h2>Manager: <?=$administrator_details->Manager?></h2>
        <h2>Saels: <?=$administrator_details->Saels?></h2>
        </div>
        <?php
    }
        ///////////////////////////   DETAILES ////////////////////////////////////
    public static function student_detailes($student,$students_courses){
        ?>
            <button type="button" class="btn btn-default" onclick="allow_edit('edit_student_detailes','student_course_detailes')">edit</button>
            <p class="edit_header">Student</p><br>

            <div id="student_course_detailes">
                <a target="_blank" href="<?=$student->Image_path?>"><img src="<?=$student->Image_path?>" class="medium_img"><br></a>
                <p>Name: <?=$student->Name?></p>
                <p>Family name: <?=$student->Family_name?></p>
                <p>Phone: <?=$student->Phone?></p>
                <p>Email: <?=$student->Email?></p>
                <h4>courses:</h4>
                <?php
                if($students_courses !== []){
                    foreach($students_courses as $row){
                    ?>
                    <p><img src="<?=$row->Image_path?>" class="small_img"> <?=$row->Name?></p>
                        <?php
                    }
                }else{
                    ?> <p>student is not takeing any courses</p><?php
                }  ?>
            </div> <?php
        }
         public static function course_detailes($cours_detailes,$students_in_cours){
        if($students_in_cours == []){
            $num_of_students = '0';
        }else{
            $num_of_students = count($students_in_cours);
        }
        ?>
        <div id="main_container">
        <?php
        if($_SESSION['role']!=="sales"){ ?>
            <button onclick="allow_edit('edit_course_detailes','course_detailes')" class="btn btn-default">edit</button><!--send both id`s to js-->
            <p class="edit_header">Cuorse</p><br>
        <?php } ?>
            <div id="course_detailes">
                <a target="_blank" href="<?=$cours_detailes->Image_path?>"><img src="<?=$cours_detailes->Image_path?>" class="medium_img"><br></a>
                <p> <h4><?=$cours_detailes->Name?>,</h4> <?=$num_of_students?> students</p>
                <p>Description: <?=$cours_detailes->Description?></p>
                <h4>students:</h4>
                <?php
                if($students_in_cours !== []){
                    foreach($students_in_cours as $row){
                    ?>
                    <p><img src="<?=$row->Image_path?>" class="small_img"> <?=$row->Name?> <?=$row->Family_name?></p>
                        <?php
                    }
                }  
            
          ?> </div> 
    <?php 
    }
          public static function admin_detailes($admin){
        if($admin->Role == 1){
            $role = "Owner";
        }else if($admin->Role == 2){
                $role = "Manager";
        }else{
            $role = "Sales";
        }
        ?>
            <div id="main_container">
            <button type="button" class="btn btn-default" onclick="allow_edit('edit_administrator_detailes','student_course_detailes')">edit</button>
            <p class="edit_header">Administrator</p><br>
            <div id="student_course_detailes">
                <a target="_blank" href="<?=$admin->Image_path?>"><img src="<?=$admin->Image_path?>" class="medium_img"><br></a>
                <p>Name: <?=$admin->Name?></p>
                <p>Family name: <?=$admin->Family_name?></p>
                <p>Role: <?=$role?></p>
                <p>Phone: <?=$admin->Phone?></p>
                <p>Email: <?=$admin->Email?></p>
            </div>
        <?php
      
    }
       ///////////////////////////    EDIT FORM ////////////////////////////////////
    public static function edit_student_detailes($student,$students_courses){ 
    ?>
        <div id="edit_student_detailes"> 
            <form name="edit_student" id="edit_student" action="api.php" method="POST" enctype="multipart/form-data">
                <a target="_blank" href="<?=$student->Image_path?>"><img src="<?=$student->Image_path?>" class="medium_img"></a><br>
                <p>edit image<input type="file" name="fileToUpload" id="fileToUpload"><img id="image"></p>
                <p>Name: <input type="text" name="edited_name" value="<?=$student->Name?>"></p>
                <p>Family name: <input type="text" name="edited_family_name" value="<?=$student->Family_name?>"></p>
                <p>Phone: <input type="text" name="edited_phone" value="<?=$student->Phone?>"></p>
                <p>Email:<input type="text" name="edited_email" value="<?=$student->Email?>"></p>
                <p><button type="submit" name="submit_edit_student" value="<?=$student->Id?>" class="btn btn-success">save edit</button></p>
                
                <h4>courses: </h4>
                <?php
                    if($students_courses !== []){ ?>
                    <p><button type="submit" name="remove_courses_from_student" value="<?=$student->Id?>" class="btn btn-danger">leave course</button></p>
                    <?php
                        foreach($students_courses as $row){?>
                            <p><img src="<?=$row->Image_path?>" class="small_img" ><?=$row->Name?> <input type="checkbox" name="remove_cours[]" value="<?=$row->Id?>"></p>
                                <?php
                        }
                    }else{
                        ?> <p><button type="submit" onclick="return areYouSure('edit_student')" class="btn btn-danger" name="delete_student" value="<?=$student->Id?>">delete student</button></p><?php
                    }
            ?>
            </form>
        </div>
    <?php
    }
    public static function edit_course_detailes($cours_detailes,$students_in_cours){ 
        ?>
        <div id="edit_course_detailes">
            <form name="edit_course" id="edit_course" action="api.php" method="POST" enctype="multipart/form-data">
                <a target="_blank" href="<?=$cours_detailes->Image_path?>"><img src="<?=$cours_detailes->Image_path?>" class="medium_img"></a><br>
                <p>edit image<input type="file" name="fileToUpload" id="fileToUpload"><img id="image" ></p>
                <p>Name: <input type="text" name="edited_name" value="<?=$cours_detailes->Name?>"></p>
                <p>Description: <input type="text" name="edited_description" value="<?=$cours_detailes->Description?>"></p>
                <p>Price:<input type="text" name="edited_rice" value="<?=$cours_detailes->Price?>"</textarea></p>
                <p><button type="submit" name="submit_edit_course" value="<?=$cours_detailes->Id?>" class="btn btn-success">save</button></p>
                <h4>students</h4>
                <?php
                if($students_in_cours !== []){ ?>
                <p><button type="submit" name="remove_students_from_course" class="btn btn-danger" value="<?=$cours_detailes->Id?>">remove students</button></p>
                <?php
                    foreach($students_in_cours as $row){ 
                    ?>
                    <p><img src="<?=$row->Image_path?>" class="small_img"> <?=$row->Name?> <?=$row->Family_name?> <input type="checkbox" name="delete_student_from_course[]" value="<?=$row->Id?>"></p>
                        <?php
                    }
                }?>
                <?php if($students_in_cours == [] && ($_SESSION['role'] === 'owner' || $_SESSION['role'] === 'manager')){ 
                   ?> <p><button onclick="return areYouSure('edit_course')" type="submit" name="delete_course" class="btn btn-danger" value="<?=$cours_detailes->Id?>">delete course</button></p>
                <?php } ?>
                </form>
            </div>
        </div><!--main_container-->
        <?php
    }
    public static function edit_administrator_detailes($administrator,$to_delete){
        ?>
            <div id="edit_administrator_detailes"> 
            <form name="edit_administrator" id="edit_administrator" action="api.php" method="POST" enctype="multipart/form-data">
            <a target="_blank" href="<?=$administrator->Image_path?>"><img src="<?=$administrator->Image_path?>" class="medium_img"></a><br>
            <p>edit image<input type="file" name="fileToUpload" id="fileToUpload"></p><img id="image">
            <p>Name: <input type="text" name="edited_name" value="<?=$administrator->Name?>"></p>
            <p>Family name: <input type="text" name="edited_family_name" value="<?=$administrator->Family_name?>"></p>
            <p>User name: <input type="text" name="edited_user_name" value="<?=$administrator->User_name?>"></p>
            <p>Phone: <input type="text" name="edited_phone" value="<?=$administrator->Phone?>"></p>
            <p>Email:<input type="text" name="edited_email" value="<?=$administrator->Email?>"></p>
    <?php   if($_SESSION['role'] === 'owner' && $administrator->Role !== '1'){ 
                $manager_checked = '';
                $sales_checked = '';
                if($administrator->Role === '2'){
                    $manager_checked = 'checked';
                }else  if($administrator->Role === '3'){
                    $sales_checked = 'checked';
                }   ?>
                    <p>Edit Role: <br>
                    <input type="radio" name="role" value="manager" <?=$manager_checked?>> manager<br>
                    <input type="radio" name="role" value="sales" <?=$sales_checked?>> sales</p>
                    <?php
            }?>
            <p><button type="submit" name="submit_edit_administrator" class="btn btn-success" value="<?=$administrator->Id?>">save</button></p>
            <?php  
            if(($_SESSION['role'] === 'owner' || $_SESSION['role'] === 'manager') && $administrator->Role !== '1'){?>
                <p><button type="submit" onclick="return areYouSure('edit_administrator')" class="btn btn-danger" name="delete_administrator" value="<?=$administrator->Id?>"> delete administeator  </button></p><?php
            } ?>
            </form>
        </div>
    </div> <!--main_container-->
    <?php
    }
    ///////////////////////////  ADD FORM ////////////////////////////////////
    public static function add_student_form($all_courses){
        ?>
        <div id="main_container">
             <div id="add_form">
                <form name="add_student" action="api.php" method="POST" enctype="multipart/form-data">
                <h2>new student</h2>
                    <p>Name: <input type="text" name="name" required></p>
                    <p>Family name: <input type="text" name="family_name" required></p>
                    <p>Phone: <input type="text" name="phone" required></p>
                    <p>Email: <input type="email" name="email" required></p>
                    <p>add image<input type="file" name="fileToUpload" id="fileToUpload"><img id="image"></p>
                    <h4>select course/s</h4>  <?php
                    foreach($all_courses as $row){?>
                            <p><input type="checkbox" name="selected_courses[]" value="<?=$row->Id?>"><img src="<?=$row->Image_path?>" class="small_img"> <?=$row->Name?></p>
                <?php    
                    } ?>
                    <p><input type="submit"  name="submit_add_student" value="save" class="btn btn-success"></p>
                </form>
            </div>
        </div>
        <?php
    }
    public static function add_course_form(){
        ?>
        <div id="main_container">
            <div id="add_form">
                <form name="add_course" action="api.php" method="POST" enctype="multipart/form-data">
                    <h2>new course</h2>
                    <p>Course name: <input type="text" name="name" required></p>
                    <p>Description: <input type="text" name="description" required></p>
                    <p>Price <input type="number" name="price" required></p>
                    <p>add image<input type="file" name="fileToUpload" id="fileToUpload"><img id="image"></p>
                    <p><input type="submit" name="submit_add_course" value="save" class="btn btn-success"></p>
                </form>
            </div>
        </div>
        <?php
    }
    public static function add_administrator_form(){
          ?>
        <div id="main_container">
            <div id="add_form">
                <form name="add_admin" action="api.php" onsubmit="return addAdmin()" method="POST" enctype="multipart/form-data">
                    <h2>new administrator</h2>
                    <p>Name: <input type="text" name="name" required></p>
                    <p>Family name: <input type="text" name="family_name" required></p>
                    <p>Phone: <input type="text" name="phone" required></p>
                    <p>Email: <input type="text" name="email" required></p>
                    <p>User name: <input type="text" name="user_name" required></p>
                    <p>Password: <input type="password" id="password" name="password" onkeyup="validatePassword(this)" placeholder="At least 4 digits" required></p>
                    <p>Submit Password: <input type="password" id="submitPassword" onkeyup="validateSubmitPassword(this)" name="submit_password" required></p>   
                    <p>Role: <br>
                    <input type="radio" name="role" value="manager"> manager<br>
                    <input type="radio" name="role" value="sales"> sales</p>
                    <p class="addImg"><input type="file" name="fileToUpload" id="fileToUpload"><img id="image"></p> 
                    <p><input type="submit" name="submit_add_administrator" value="add administrator" class="btn btn-success"></p>
                </form>
            </div>
        </div>
        <?php
    }
  public static function all_courses_to_pick($all_courses,$student_obj,$student_courses){
            ?><div id="take_course">
                <h3>take course:</h3>
                <form name="student_pick_course" action="api.php" method="POST"> <?php
                    if($student_courses === []){
                        foreach($all_courses as $row) { ?>
                        <p><img src="<?=$row->Image_path?>" class="small_img"> <?=$row->Name?> <input type="checkbox" name="student_wants_to_learn[]" value="<?=$row->Id?>"></p>
                        <?php }
                    }else{
                        foreach($all_courses as $row) {
                            $flag = 0;
                            foreach($student_courses as $dont_display){
                                if($row->Id === $dont_display->Id){
                                    $flag++;  
                                }
                            }
                            if($flag === 0){?>
                                <p><img src="<?=$row->Image_path?>" class="small_img"> <?=$row->Name?> <input type="checkbox" name="student_wants_to_learn[]" value="<?=$row->Id?>"></p>
        <?php               }      
                        }
                    }?>
                <button type="submit" class="btn btn-info" name="submit_student_picked_course" value="<?=$student_obj->Id?>">take course</button>
                </form>
            </div>
            <?php 
       }

     

}


?>