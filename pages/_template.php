<?php

/* 
 * Copyright UnacceptableUse 2014
 * http://github.com/unacceptableuse
 */

    include("../php/Auth.php");
        
    $config = array();
    $config['db']['host'] = "hp.matrixdevuk.pw";
    $config['db']['user'] = 
    $config['db']['pass'] = 
    $config['db']['name'] = "teknogeek_cmsauth";
     
   try {
        $dbh = new PDO('mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'],
            $config['db']['user'], $config['db']['pass']);
    }
    catch (exception $e) {
        echo 'Error establishing database connection';
        exit();
    }
 
    $auth = new cuonic\PHPAuth2\Auth($dbh);
   
    if(isset($_COOKIE['auth_session']))
    {
        if (!$auth->checkSession($_COOKIE['auth_session'])) {
            header('Location: http://unacceptableuse.com/bot/cms/login.php?error=5');
            exit();
        }
    }else
    {
          header('Location: http://unacceptableuse.com/bot/cms/login.php?error=6');
          exit();
    }
   
    
    //END AUTH
    

    
    echo 
        '<html><head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css"  href="css/style.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        
        </head>
        <body>';

?>

