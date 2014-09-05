<?php

/* 
 * Copyright UnacceptableUse 2014
 * http://github.com/unacceptableuse
 */


$config = array();
$config['db']['host'] = "hp.matrixdevuk.pw";
$config['db']['user'] = "unacceptablebot";
$config['db']['pass'] = "paqe7u2yd";
$config['db']['name'] = "teknogeek_cmsauth";


include ("php/Auth.php");


try {
    $dbh = new PDO('mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'],
        $config['db']['user'], $config['db']['pass']);
}
catch (exception $e) {
    header('Location: http://unacceptableuse.com/bot/cms/login.php?error='.$e->getMessage());
    exit();
}


$auth = new cuonic\PHPAuth2\Auth($dbh);


if($auth->logout($_COOKIE['auth_session']))
{
    header('Location: http://unacceptableuse.com/bot/cms/login.php?error=3');
    exit();
}
header('Location: http://unacceptableuse.com/bot/cms/login.php?error=7');
exit();

?>