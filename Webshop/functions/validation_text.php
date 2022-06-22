<?php

    function get_rid_of_bad_char($string){
        $string = preg_replace('/[<>"()-]/', '', $string);
        return $string;
    }


?>
