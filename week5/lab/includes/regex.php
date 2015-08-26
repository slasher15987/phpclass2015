<?php
//REGEX TIME!
    $siteRegex = '/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/';
    preg_match_all($siteRegex, $output, $links);
   
    $removeDuplicates = array_unique($links[0]);