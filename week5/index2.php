<?php//
//db connection and post/get functions
include 'functions/dbConn.php';
include 'functions/util.php';
//get and hold the db connection in a variable
$db = getDB();


$stmt = $db->prepare("SELECT * FROM sites ORDER BY site DESC");
$sitelinks = array();
if ($stmt->execute() && $stmt->rowCount() > 0) {
    $sitelinks = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$results = '';
if (isPostRequest()) {


    $stmt = $db->prepare("SELECT * FROM sites JOIN sitelinks ON sites.site_id = sitelinks.site_id");
    $site_id = filter_input(INPUT_POST, 'site_id');
    $binds = array(
        ":site_id" => $site_id
    );

    if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>URL Scraper</title>
        <link href="css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">

            <form method="post" action="#">

                <select name="site_id" class="form-control">
                    <?php foreach ($sitelinks as $row): ?>
                        <option value="<?php echo $row['site_id']; ?>"><?php echo $row['site']; ?></option>
                    <?php endforeach; ?>
                </select>

                <input type="submit" value="Submit" />
            </form>
            <?php if (isset($results)): ?>
                <table class="table table-striped table-hover">
                    <h2>Results found <?php echo count($results); ?></h2>
                    <table border="1">        
                        <tbody>
                            <?php foreach ($sitelinks as $row): ?>
                                <tr>
                                    <td><?php echo $row['sitelinks']; ?></td> 
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php endif; ?>
            </table>
        </div>
    </body>
</html>
