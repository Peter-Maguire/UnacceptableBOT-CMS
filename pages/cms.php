<?php

/* 
 * Copyright UnacceptableUse 2014
 * http://github.com/unacceptableuse
 */

include('_template.php');
?>

<h2>CMS User manager</h2>
<br> 
<?php
             if(isset($_GET['error']))
             {
                $errorcode = filter_input(INPUT_GET, 'error', FILTER_SANITIZE_SPECIAL_CHARS);
                echo '<div class="alert alert-danger" role="alert">';
                switch($errorcode)
                {
                    case 1: echo 'Please enter an E-mail address.'; break;
                    case 2: echo 'Please enter a username.'; break;
                    case 3: echo 'Please enter a password.'; break;
                    case 4: echo 'Unable to register: The registration failed'; break;
                    case 5: echo 'Unable to register: The activation failed.'; break;

                    case 10: echo 'Unable to register: Too many failed attempts.'; break;
                    case 11: echo 'Invalid registration details.'; break;
                    case 12: echo 'The email is already in use.'; break;
                    case 13: echo 'The username is already in use.'; break;
                    
                    case 20: echo 'Unable to activate: Too many failed attempts.'; break;
                    case 21: echo 'Unable to activate: Activation key is invalid.'; break;
                    case 22: echo 'Unable to activate: Activation key is incorrect.'; break;
                    case 23: echo 'Unable to activate: Already activated.'; break;
                    case 24: echo 'Unable to activate: Activation key expired.'; break;
                    default: echo $errorcode; break;       
                }
                echo '</div>';

             }
             
             if(isset($_GET['success']))
             {
                echo '<div class="alert alert-success" role="alert">Account creation successful</div>';
                
             }
        ?>


<br>
<h3>Add user</h3>
<form name="input" action="../proccess_register.php" method="post">
             <div class="input-group">
                 <input type="text" name="reg-email" class="form-control" placeholder="E-Mail"> 
                 <input type="text" name="reg-username" class="form-control" placeholder="Username">
                 <input type="password" name="reg-password" class="form-control" placeholder="Password">
             </div>
             <div class="btn-group" id="login-button">
                 <button type="submit" class="btn" target="_parent">Add</button>
             </div>
  </form>

</body>
</html>