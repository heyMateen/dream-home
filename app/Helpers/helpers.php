<?php

use App\Models\Staff;
use App\Models\User;
if (!function_exists('format_name')) {
    function format_name($fname, $lname)
    {
        if (empty($fname) && empty($lname)) {
            return '<span style="color:red">N/A</span>';
        }
        $fname = ucfirst(trim($fname));
        $lname = ucfirst(trim($lname));
        return $fname . ' ' . $lname;
    }
}
if (!function_exists('format_address')) {
    function format_address($address, $city, $state)
    {
        return $address . ', ' . $city . ', ' . $state;
    }
}
if (!function_exists('get_cities')) {
    function get_cities()
    {
        $cities = [
            'Karachi',
            'Lahore',
            'Islamabad',
            'Rawalpindi',
            'Faisalabad',
            'Multan',
            'Gujranwala',
            'Peshawar',
            'Quetta',
            'Sialkot',
            'Bahawalpur',
            'Sargodha',
            'Sukkur',
            'Larkana',
            'Sheikhupura',
            'Jhang',
            'Rahim Yar Khan',
            'Gujrat',
            'Mardan',
            'Kasur',
            'Dera Ghazi Khan',
            'Sahiwal',
            'Okara',
            'Wah Cantt',
            'Mingora',
            'Nawabshah',
            'Mirpur Khas',
            'Chiniot',
            'Khanewal',
            'Turbat',
            'Bannu',
            'Jhelum',
            'Khuzdar',
            'Abbottabad',
            'Mansehra'
        ];
        return $cities;
    }
    if (!function_exists('get_states')) {
        function get_states()
        {
            $states = [
                'Punjab',
                'Sindh',
                'Khyber Pakhtunkhwa',
                'Balochistan',
                'Islamabad Capital Territory',
                'Azad Jammu and Kashmir',
                'Gilgit-Baltistan'
            ];

            return $states;
        }
    }
    if (!function_exists('get_available_managers')) {
        function get_available_managers()
        {
            // Fetch all 'staff' users with their associated 'staff' records
            $available_managers = Staff::where('role', 'employee')->with('user')->latest()->get();
            return $available_managers;
        }
    }

}
?>