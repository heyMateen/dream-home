<?php
    if(!function_exists('format_name')){
        function format_name($fname, $lname){
            $fname = ucfirst(trim($fname));
            $lname = ucfirst(trim($lname));
            return $fname.' '.$lname;
        }
    }
?>