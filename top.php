<?php
require_once 'session_start.php';
if(!isset($_SESSION['role']) && $_GET['action'] !== 'index'){
    header('Location: api.php?action=index');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <div id="main">
            <nav class="clearfix">
                <div id="left">
                    <img src="img/images.png" id="logo" /><?php
                    if(isset($_SESSION['name']) && count($_SESSION['name']) > 0){
                        ?><a href="api.php?action=school"><button class="btn btn-defalt">School</button></a>
                    <?php if($_SESSION['role'] != "sales"){
                            ?><a href="api.php?action=adminisration"><button class="btn btn-defalt">Adminisration</button></a>
                    <?php   }  
                ?></div>
                 <div id="right">
                    <p class="nav"><?= $_SESSION['name'] ." ,"."<b>".  $_SESSION['role'] . "</b>" ?></p> 
                    <p class="nav"><a href="api.php?action=logout"><b>logout</b></a></p>
                    <img src="<?= $_SESSION['image'] ?>" alt="pic" id="img_nav" class="small_img" >
                </div>
                <?php } ?>
            </nav>

              