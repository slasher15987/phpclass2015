<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        
            require './functions/until.php';
        
            $email = filter_input(INPUT_POST, 'email');
            
            $isValid = true;
            
            if ( filter_var($email, FILTER_VALIDATE_EMAIL) === false && isPostRequest() ) {
                $isValid = false;
            }
            
                       
        
        ?>
        
        <?php if( !$isValid ) : ?>
            <h1>Email is invalid</h1>
        <?php endif; ?>
         <form method="post" action="#">
            Email<input type="text" name="email" value="" />
            <input type="submit" value="Submit" />
            </form>
    </body>
</html>