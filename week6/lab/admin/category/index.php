<?php
//db connection and post/get functions
include '../../functions/dbConn.php';
include '../../functions/category-functions.php';
include '../../functions/product-functions.php';
include '../../functions/util.php';
include '../../includes/access-required.html.php';
require '../../includes/session-start.rec.inc.php';
//hold db connection
$db = getDB();
/*
 * create a variable to hold the database
 * SQL statement
 */
//prepare sql statement
$stmt = $db->prepare("SELECT * FROM corps WHERE id = :id");
//filter input for id
$id = filter_input(INPUT_GET, 'id');
//bind id to variable
$binds = array(
    ":id" => $id
);

$results = array();
//make sure we get back results
if ($stmt->execute($binds) && $stmt->rowCount() > 0) {
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>EncorpDatabase</title>
        <link href="css/bootstrap.css" rel="stylesheet">
        <script src="cd.js" language="JavaScript" type="text/javascript"></script> <!-- confirm delete row -->
    </head>
    <body>
        <div class="container">
            <h1>EncorpDatabase <a href="add.php" class="btn btn-primary btn-index">Create</a> <a href="search-index.php" class="btn btn-success btn-index">Search</a></h1>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Corporation</th>
                        <th>Incorporation Date</th>
                        <th>Email</th>
                        <th>Zipcode</th>
                        <th>Owner</th>
                        <th>Phone Number</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <?php foreach ($results as $row): ?>
                    <tr>
                        <td><?php echo $row['corp']; ?></td>
                        <td><?php echo date("F j, Y, g:i a", strtotime($row['incorp_dt'])); ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['zipcode']; ?></td>
                        <td><?php echo $row['owner']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Update</a>           
                            <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onClick="return checkDelete()">Delete</a></td>            
                    </tr>
                <?php endforeach; ?>
            </table>
            <p> <a href="index.php" class="btn btn-primary">Back To Index</a></p>
        </div>
    </body>
</html>
