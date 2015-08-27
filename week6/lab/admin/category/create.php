<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        include '../../functions/dbConn.php';
        include '../../functions/category-functions.php';
        include '../../functions/util.php';
        include '../../includes/access-required.html.php';
        require '../../includes/session-start.rec.inc.php';
        $results = '';
        if (isPostRequest()) {

            $category = filter_input(INPUT_POST, 'category');
            if (isValidCategory($category)) {
                if (createCategory($category)) {
                    $results = 'Category Created';
                } else {
                    $results = 'Category not created';
                }
            } else {
                $results = 'Invalid Category';
            }
        }
        ?>

        <h1>Add Category</h1>

        <?php include '../../includes/results.html.php'; ?>

        <form method="post" action="#">
            Category Name : <input type="text" name="category" value="" />
            <input type="submit" value="Submit" />
        </form>



    </body>
</html>