<!DOCTYPE html>
<?php    
    $sqlcon = mysqli_connect("hp.matrixdevuk.pw","unacceptablebot","paqe7u2yd","teknogeek_settings");
    
    if(mysqli_connect_errno($con))
    {
        $error = mysqli_connect_error();
    }
?>
<html>
    <head>
        <title>UnacceptableBOT Manager</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css"  href="css/bootstrap.css"/>
        <link rel="stylesheet" type="text/css"  href="css/style.css"/>
    </head>
    <body>
        <?php
            if($error != null)
            {
                echo '<div class="alert alert-danger" role="alert"><strong>Critical Error:</strong> Unable to establsih MySQL Connection: '.$error.'</div>';
            }
        ?>
        <div class="navbar navbar-inverse">
            <div class="navbar-inner">
                <div class="container">
                         <a class="brand" href="#">UnacceptableBOT CMS</a>
             
                         <ul class="nav">
                             <li><a href="#">Summary</a></li>
                             <li><a href="#">Variables</a></li>
                             <li><a href="#">Users</a></li>
                             <li><a href="#">Channels</a></li>
                         </ul>
                         
                </div>
            </div>
        </div>
        <div id="pane1">
            <p><h1 class="inline-header">Uptime</h1><p class="statentry inline-header">0h 0m 0s</p>
            <p><h1 class="inline-header">Commands performed</h1><p class="statentry inline-header">0</p>
            <p><h1 class="inline-header">Logs</h1><p class="statentry inline-header">0</p>
            <p><h1 class="inline-header">Registered users</h1><p class="statentry inline-header">0</p>
            <p><h1 class="inline-header">Startups</h1><p class="statentry inline-header">0</p>
            
            
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
                        <td>+PenIs</td>
                        <td>4/20</td>
                        <td><span id="chanstatus" class="label label-success">Opped</span> </td>
                    </tr>
                    <tr>
                        <td>#doge-coin</td>
                        <td>-DiCKBuTT</td>
                        <td>69</td>
                        <td><span id="chanstatus" class="label label-info">Voiced</span> </td>
                    </tr>
                    <tr>
                        <td>#dogefest</td>
                        <td>IdK</td>
                        <td>1337</td>
                        <td><span id="chanstatus" class="label label-default">User</span> </td>
                    </tr>
                </tbody>
            </table>

        </div>
        <div id="content"><h1>Fuck knows what will go here</h1> <br><img src="http://placekitten.com/g/900/800"></img></div>
                
    </body>
</html>
