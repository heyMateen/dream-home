<?php
    if(!function_exists('format_name')){
        function format_name($fname, $lname){
            if(empty($fname) && empty($lname)){
                return '<span style="color:red">N/A</span>';
            }
            $fname = ucfirst(trim($fname));
            $lname = ucfirst(trim($lname));
            return $fname.' '.$lname;
        }
    }
    if(!function_exists('format_address')){
        function format_address($address, $city, $state){
            return $address.', '.$city.', '.$state;
        }
    }
?>