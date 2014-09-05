<!DOCTYPE html>
<!--
Copyright UnacceptableUse 2014
http://github.com/unacceptableuse
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>UnacceptableBOT Login</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css"  href="css/style.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div id="login-container">
            <h2 class="text-center">Login</h2>
            <?php
                 if(isset($_GET['error']))
                 {
                    $errorcode = filter_input(INPUT_GET, 'error', FILTER_SANITIZE_SPECIAL_CHARS);
                    echo '<div class="alert alert-danger" role="alert">';
                    switch($errorcode)
                    {
                        case 1: echo 'Please enter a username.'; break;
                        case 2: echo 'Please enter a password.'; break;
                        case 3: echo 'You have logged out.'; break;
                        case 4: echo 'The session returned was invalid.'; break;
                        case 5: echo 'Session expired'; break;
                        case 6: echo 'Please login first'; break;
                        case 7: echo 'You are not logged in.'; break;

                        case 10: echo 'Too many login attempts.'; break;
                        case 11: echo 'Username or password is invalid.'; break;
                        case 12: echo 'Username or password is incorrect.'; break;
                        case 13: echo 'Your account is not activated.'; break;
                        default: echo $errorcode; break;       
                    }
                    echo '</div>';
                    
                 }
            ?>
            <form name="input" action="proccess_login.php" method="post">
                <div class="input-group">
                    <input type="text" name="username" class="form-control" placeholder="Username">
                    <input type="password" name="password" class="form-control" placeholder="Password">         
                </div>
                <div class="btn-group" id="login-button">
                    <button type="submit" class="btn">Submit</button>
                </div>
            </form>
        </div>
    </body>
</html>
