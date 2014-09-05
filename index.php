<!DOCTYPE html>
<?php    
    include("php/Auth.php");
        
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

    $sqlcon = mysqli_connect("hp.matrixdevuk.pw","unacceptablebot","paqe7u2yd","teknogeek_settings");
    if(mysqli_connect_errno($sqlcon))
    {
        $error = mysqli_connect_error();
    }
    
    $result = mysqli_query($sqlcon, "SELECT * FROM `Global_Settings` WHERE `Setting` LIKE 'stat:commandsPerformed'");
    
    $row = mysqli_fetch_assoc($result);
    $commandsPerformed = $row['Value'];
    
    $result = mysqli_query($sqlcon, "SELECT * FROM `Global_Settings` WHERE `Setting` LIKE 'stat:startups'");
    
    $row = mysqli_fetch_assoc($result);
    $startups = $row['Value'];
    
    $result = mysqli_query($sqlcon, "SELECT count(*) from information_schema.tables WHERE table_schema = 'teknogeek_unacceptablebot';"); 
    
    $row = mysqli_fetch_assoc($result);
    $logs = $row['count(*)'];
    
    $result = mysqli_query($sqlcon, "SELECT * FROM `Global_Settings` WHERE `Setting` LIKE 'startupTime'");
    
    $row = mysqli_fetch_assoc($result);
    $currentTime = time();
    $startupTime = $row['Value'];
    
    
    mysqli_close($sqlcon);
    
    function timerFormat($start_time, $end_time, $std_format = false)
    {       
        $total_time = $end_time - $start_time;
        $days       = floor($total_time /86400);        
        $hours      = floor($total_time /3600);     
        $minutes    = intval(($total_time/60) % 60);        
        $seconds    = intval($total_time % 60);     
        $results = "";
        if($std_format == false)
        {
          if($days > 0) $results .= $days . (($days > 1)?" days ":" day ");     
          if($hours > 0) $results .= $hours . (($hours > 1)?" hours ":" hour ");        
          if($minutes > 0) $results .= $minutes . (($minutes > 1)?" minutes ":" minute ");
          if($seconds > 0) $results .= $seconds . (($seconds > 1)?" seconds ":" second ");
        }
        else
        {
          if($days > 0) $results = $days . (($days > 1)?" days ":" day ");
          $results = sprintf("%s%02d:%02d:%02d",$results,$hours,$minutes,$seconds);
        }
        return $results;
    }
     
    
?>
<html>
    <head>
        <title>UnacceptableBOT Manager</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css"  href="css/style.css"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="navbar navbar-inverse">
            <div class="navbar-inner">
                         <a class="navbar-brand" href="#">UnacceptableBOT CMS</a>
             
                         <ul class="nav navbar-nav">
                             <li><a href="pages/home.php" target="ifrm">Summary</a></li>
                             <li><a href="pages/vars.php" target="ifrm">Variables</a></li>
                             <li><a href="pages/users.php" target="ifrm">Users</a></li>
                             <li><a href="pages/channels.php" target="ifrm">Channels</a></li>
                             <li><a href="pages/cms.php" target="ifrm">CMS Manager</a></li>
                             <li><a href="logout.php">Logout</a></li>
                         </ul>
                         
            </div>
        </div>
         <?php
            if($error != null)
            {
                echo '<div class="alert alert-danger" role="alert"><strong>Critical Error:</strong> Unable to establish MySQL Connection: '.$error.'</div>';
            }
        ?>
        <div id="pane1">
            <p><h1 class="inline-header">Uptime</h1><p class="statentry inline-header"><?php echo timerFormat($startupTime, $currentTime, false);   ?></p>
            <p><h1 class="inline-header">Commands performed</h1><p class="statentry inline-header"><?php echo $commandsPerformed; ?></p>
            <p><h1 class="inline-header">Logs</h1><p class="statentry inline-header"><?php echo $logs; ?></p>
            <p><h1 class="inline-header">Registered users</h1><p class="statentry inline-header">0</p>
            <p><h1 class="inline-header">Startups</h1><p class="statentry inline-header"><?php echo $startups; ?></p>
            <p><h1 class="inline-header">Dogecoin</h1><p class="statentry inline-header"><?php echo $dogeBalance; ?></p>

            
        </div>
        <div id="pane2">
            <h1>Connected Channels</h1>
            <table border="1" width="95%">
                <thead>
                    <tr>
                        <th>Channel</th>
                        <th>Mode</th>
                        <th>Users</th>
                        <th>Bot status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>##Ocelotworks</td>
                        <td>+</td>
                        <td>4/20</td>
                        <td><span id="chanstatus" class="label label-success">Opped</span> </td>
                    </tr>
                    <tr>
                        <td>#doge-coin</td>
                        <td>-T</td>
                        <td>69</td>
                        <td><span id="chanstatus" class="label label-info">Voiced</span> </td>
                    </tr>
                    <tr>
                        <td>#dogefest</td>
                        <td></td>
                        <td>1337</td>
                        <td><span id="chanstatus" class="label label-default">User</span> </td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div id="content">
            <iframe name="ifrm" src="pages/home.php">
            </iframe>
        </div>
                
    </body>
</html>
