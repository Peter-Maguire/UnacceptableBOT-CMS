<?php

/* 
 * Copyright UnacceptableUse 2014
 * http://github.com/unacceptableuse
 */

    include('_template.php');


  
    $sqlcon = mysqli_connect("hp.matrixdevuk.pw",,"teknogeek_settings");
    if(mysqli_connect_errno($sqlcon))
    {
        echo '<div class="alert alert-danger" role="alert">Unable to connect to MySQL Database:'.mysqli_connect_error().'</div>';
    }
    
    
    $result = mysqli_query($sqlcon, "SELECT * FROM `Global_Settings` WHERE 1;");
     while ($row = mysqli_fetch_array($result)) { 
        $conf[$row['Setting']] = $row['Value'];
     }


?>


<div class="alert alert-info alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Note:</strong> Settings will not save unless you press the save button!
</div>



<div class="panel panel-default">
  <div class="panel-heading">
       <h3 class="panel-title">General Configuration</h3>
  </div>
  <div class="panel-body">
      <div class="input-group input-group-sm">
          <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span> Bot Name: </span>
          <input type="text" class="form-control" placeholder="<?php echo $conf['botName']; ?>"></input>
      </div>
      <br>
      <div class="input-group input-group-sm">
          <span class="input-group-addon"><span class="glyphicon glyphicon-exclamation-sign"></span> Wowzers: </span>
         <input type="text" class="form-control" placeholder="There are literally no other settings to go here"></input>
      </div>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
       <h3 class="panel-title"><span class="glyphicon glyphicon-list"></span> Startup channels</h3>
  </div>
  <div class="panel-body">
    <ul class="list-group">
        <?php
            $chans = explode(":", $conf['channels']);
            foreach($chans as $chan)
            {
                echo '<li class="list-group-item"><div class="input-group"> <input type="text" class="form-control" placeholder="'.$chan.'"></input><span class="input-group-addon"><a href="#" alt="Remove Channel" style="color: #990000 !important; onclick="remove""><span class="glyphicon glyphicon-remove"></span></a></span></div></li>';
            } 
        ?>
        
        <li class="list-group-item"><a href="#"><span class="glyphicon glyphicon-plus"></span>Add new channel</a>...  NOTE: Channels will only be joined upon restart</li>
        
    </ul>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Dogecoin tips</h3>
  </div>
  <div class="panel-body">
      <div class="page-header">
        <h1 class="centered"><?php echo $conf['profitReserve']; ?>Ð<small> Profit reserve</small></h1>
      </div>
      <br>
      <div class="input-group input-group-sm">
          <span class="input-group-addon"><span class="glyphicon glyphicon-qrcode"></span> Profit Deposit Address: </span>
          <input type="text" class="form-control" placeholder="asdjinasdjkl"></input>
      </div>
  </div>
</div>

</body>
</html>

<?php mysqli_close($sqlcon); ?>
