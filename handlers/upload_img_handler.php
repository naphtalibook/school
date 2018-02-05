<?php

class Upload_Img{

    public static function upload(){
         if(isset($_FILES["fileToUpload"])){
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            $msg = "";
            // Check if image file is a actual image or fake image
            if(isset($_POST["fileToUpload"])) {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    return $target_dir;
                }
            }
        
            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                return $target_dir;
            }
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                return $target_dir;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
            // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                } else {
                }
            }
            
                return $target_file;
            
        }
    }
}
?>