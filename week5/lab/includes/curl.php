<?php
$curl = curl_init(); 
// set url 
                curl_setopt($curl, CURLOPT_URL, $site); 
//return the transfer as a string 
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
// $output contains the output string 
                $output = curl_exec($curl); 
// close curl resource to free up system resources 
                curl_close($curl);