<?php

/* 
 * Copyright UnacceptableUse 2014
 * http://github.com/unacceptableuse
 */

$config = array();
$config['db']['host'] = "hp.matrixdevuk.pw";
$config['db']['user'] = 
$config['db']['pass'] = 
$config['db']['name'] = "teknogeek_cmsauth";


if(!isset($_POST['username']))
{
    header('Location: http://unacceptableuse.com/bot/cms/login.php?error=1');
    exit();
}

if(!isset($_POST['password']))
{
    header('Location: http://unacceptableuse.com/bot/cms/login.php?error=2');
    exit();
}

$username =  filter_input(INPUT_POST, 'username', FILTER_UNSAFE_RAW);
$password =  filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);
$passwordhash = hash("sha1", hash("sha1", $password));

include('php/Auth.php');

try {
    $dbh = new PDO('mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'],
        $config['db']['user'], $config['db']['pass']);
}
catch (exception $e) {
     header('Location: http://unacceptableuse.com/bot/cms/login.php?error="'.$e->getMessage().'"');
    exit();
}

$auth = new cuonic\PHPAuth2\Auth($dbh);

$login = $auth->login($username, $passwordhash);
if ($login['code'] != 4) {
    header('Location: http://unacceptableuse.com/bot/cms/login.php?error='.(10+$login['code']));
    var_dump($login);
    exit();
}


$getusername = $auth->getUsername($login['session_hash']);
if (!$getusername) {
    header('Location: http://unacceptableuse.com/bot/cms/login.php?error=4');
    exit();
}

setcookie("auth_session", $login['session_hash'], time()+36000);

header('Location: http://unacceptableuse.com/bot/cms/index.php');
exit();

?>

