<?php
        include '../../functions/dbConn.php';
        include '../../functions/category-functions.php';
        include '../../functions/product-functions.php';
        include '../../functions/util.php';
        include '../../includes/access-required.html.php';
        require '../../includes/session-start.rec.inc.php';
        $categories = getAllCategories();

        if (isPostRequest()) {

            $category_id = filter_input(INPUT_POST, 'category_id');
            $product = filter_input(INPUT_POST, 'product');
            $price = filter_input(INPUT_POST, 'price');
            $image = filter_input(INPUT_POST, 'image');

            $errors = array();
            if (!isValidPrice($price)) {

                $errors[] = 'Price is not valid';
            }
            if (!isValidProduct($product)) {

                $errors[] = 'Product is not valid';
            }

            if (count($errors) == 0) {

                if (createProduct($category_id, $product, $price, $image)) {
                    $results = 'Product Added';
                } else {
                    $results = 'Product not added.';
                }
            }
        }
        ?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        

        <h1>Add Product</h1>

        <?php if (isset($errors) && count($errors) > 0) : ?>
            <ul>
    <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
            <?php endforeach; ?>
            </ul>
            <?php endif; ?>


            <?php include '../../includes/results.html.php'; ?>


        <form method="post" action="#">
            Category:
            <select name="category_id" class="form-control-small">
<?php foreach ($categories as $row): ?>
                    <option value="<?php echo $row['category_id']; ?>">
    <?php echo $row['category']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br />
            
            Product Name : <input type="text" name="product" value="" /> 
            <br />
            Price : <input type="text" name="price" value="" /> 
            <br />
            <input type="submit" value="Submit" />
        </form>



    </body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Shop-A-Holic</title>
        <link href="css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h1>Shop-A-Holic <a href="add.php" class="btn btn-primary btn-index">Create</a></h1>
            <!-- print confirmation that data was added or not -->

            <form method="post" action="#">
                <div class="form-group">
                    <label for="corp_input">Corporation Name</label>
                    <input type="text" value="" class="form-control" id="corp_input" name="corp" />
                </div>
                <div class="form-group">
                    <label for="email_input">Email</label>
                    <input type="text" value="" class="form-control" id="email_input" name="email" />
                </div>
                <div class="form-group">
                    <label for="zip_input">Zipcode</label>        
                    <input type="text" value="" class="form-control" id="zip_input" name="zipcode" />
                </div>
                <div class="form-group">
                    <label for="owner_input">Owner</label>
                    <input type="text" value="" class="form-control" id="owner_input" name="owner" />
                </div>
                <div class="form-group">
                    <label for="phone_input">Phone Number</label>
                    <input type="text" value="" class="form-control" id="phone_input" name="phone" />
                </div>            
                <input type="submit" class="btn btn-primary" value="Submit" />
                <a href="index.php" class="btn btn-default">Back To Index</a>
            </form>
        </div>
    </body>
</html>
