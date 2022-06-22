<?php
function check_email($email) {
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    } else {
        return false;
    }
}

function check_phone_number($phone_num){
    $phone_num = preg_replace("/\s/","",$phone_num);
    if(preg_match("/^[0-9]{9}$/", $phone_num)) {
        return true;
    } else {
        return false;
    }
}


?>