<?php
//
//db connection and post/get functions
include 'functions/dbConn.php';
include 'functions/util.php';
//get and hold the db connection in a variable
$db = getDB();

$results = '';
$isValid = true;
$textbox = '';
$sitelist = 0;

if (isPostRequest()) {
$site = filter_input(INPUT_POST, 'site');
if (filter_var($site, FILTER_VALIDATE_URL) === false) {
$isValid = false;
$textbox = filter_input(INPUT_POST, 'site');
$results = 'Enter a valid website.';
}
if ($isValid) {

$site = filter_input(INPUT_POST, 'site');
$stmt = $db->prepare("INSERT INTO sites SET site = :site, date = now()");

// bind variables to sql statement
$binds = array(
":site" => $site,
);
//execute and make sure results are returned
if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
//$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$results = 'Data Added';
} else {
$results = 'done broke something';
}
$lastID = $db->lastInsertId();
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $site);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$http = '/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/';
preg_match_all($http, curl_exec($curl), $sitelist);
curl_close($curl);
print_r($sitelist[0]);

$row = array();
$stmt2 = $db->prepare("INSERT INTO sitelinks SET site_id = :id, link = :site");
foreach($sitelist as $row) {
$binds = array(
":site" => $row,
 ":id" => $lastID
);
//execute and make sure results are returned
if ($stmt2->execute($binds) && $stmt2->rowCount() > 0) {
//$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$results = 'Data Added';
} else {
$results = 'done broke something';
}

}

}
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Link Scraper</title>
        <link href="css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <div class="jumbotron vertical-center">
                <h3><?php echo $results; ?></h3> 
                <center><h1>URL Scraper</h1><br /><br/>
                    <form method="post" action="#">
                        <input type="text" value="" name="site" autofocus="autofocus" placeholder="Enter a URL here.." class="form-control"/><br/>
                        <input type="submit" value="Submit" class="btn btn-primary"/>
                        <br/><br/>

                        <!-- <a href="index.php" class="btn btn-default">Back To Index</a> -->
                </center>
            </div>
        </div>
        
    </body>
</html>
