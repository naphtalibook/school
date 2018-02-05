function allow_edit(block,none){ 
    if(document.getElementById(block).style.display == "block") {
        document.getElementById(none).style.display = "block"; 
        document.getElementById(block).style.display = "none";  
    }else{
        document.getElementById(none).style.display = "none"; 
        document.getElementById(block).style.display = "block";   
    }
}
function areYouSure(formId){
    var toDelet = confirm("are you sure you want to delet this?");
    if(toDelet){
        document.getElementById(formId).submit();
    }else{
        
        return false;
    }
}
function validatePassword(input){
    if(input.value.length < 4){
        input.style.backgroundColor = "rgba(255,0,0,0.3)";
    }else{
         input.style.backgroundColor = "rgba(0,255,0,0.3)";
    }
}
function validateSubmitPassword(submitPassword){
    var password = document.getElementById('password')
    if(submitPassword.value === password.value && submitPassword.value.length > 3){
        submitPassword.style.backgroundColor = "rgba(0,255,0,0.3)";
    }else{
         submitPassword.style.backgroundColor = "rgba(255,0,0,0.3)";
    }
}
function addAdmin(){
    var password = document.getElementById('password');
    var submitPassword = document.getElementById('submitPassword');
    if(password.value === submitPassword.value && password.value.length > 3){
        return true;
    }else{
        submitPassword.style.border = "3px solid red";
        return false;
    }
}
document.getElementById("main_container").className = "clearfix";


document.getElementById("fileToUpload").onchange = function () {
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("image").src = e.target.result;
        document.getElementById("image").className = "small_img";
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};

