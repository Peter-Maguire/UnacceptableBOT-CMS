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


if(!isset($_POST['reg-email']))
{
    header('Location: http://unacceptableuse.com/bot/cms/pages/cms.php?error=1');
    exit();
}

if(!isset($_POST['reg-username']))
{
    header('Location: http://unacceptableuse.com/bot/cms/pages/cms.php?error=2');
    exit();
}

if(!isset($_POST['reg-password']))
{
    header('Location: http://unacceptableuse.com/bot/cms/pages/cms.php?error=3');
    exit();
}

$email = filter_input(INPUT_POST, 'reg-email', FILTER_UNSAFE_RAW);
$username =  filter_input(INPUT_POST, 'reg-username', FILTER_UNSAFE_RAW);
$password =  filter_input(INPUT_POST, 'reg-password', FILTER_UNSAFE_RAW);
$passwordhash = hash("sha1", hash("sha1", $password));

include('php/Auth.php');

try {
    $dbh = new PDO('mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'],
        $config['db']['user'], $config['db']['pass']);
}
catch (exception $e) {
     header('Location: http://unacceptableuse.com/bot/cms/pages/cms.php?error="'.$e->getMessage().'"');
    exit();
}

$auth = new cuonic\PHPAuth2\Auth($dbh);

$register = $auth->register($email, $username, $passwordhash);
// Verify return code
if ($register['code'] != 4) {
    header('Location: http://unacceptableuse.com/bot/cms/pages/cms.php?error='.(10+$register['code']));
    var_dump($register);
    exit();
}
// Account is now registered. Fetch user id
$user = $auth->getUserData($username);
// Verify return data
if ($user == false) {
    header('Location: http://unacceptableuse.com/bot/cms/pages/cms.php?error=4');
    exit();
}
// Fetch activation key from database to imitate user activation via email link
$query = $dbh->prepare("SELECT activekey FROM activations WHERE uid = ?");
$query->execute(array($user['uid']));
// Verify row count
if ($query->rowCount() == 0) {
    header('Location: http://unacceptableuse.com/bot/cms/pages/cms.php?error=5');
    exit();
}
// Fetch data
$row = $query->fetch(PDO::FETCH_ASSOC);
// Activate the user
$activate = $auth->activate($row['activekey']);
// Verify return code
if ($activate['code'] != 5) {
    header('Location: http://unacceptableuse.com/bot/cms/pages/cms.php?error='.(20+$activate['code']));
    var_dump($activate);
    exit();
}

header('Location: http://unacceptableuse.com/bot/cms/pages/cms.php?success');



?>