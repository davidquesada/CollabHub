<?php include "profile_private.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="bootstrap-3.0.0/assets/ico/favicon.png">

    <title>User Profile</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap-3.0.0/dist/css/CollabHub.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="navbar.css" rel="stylesheet">

    <?php include "background.html"; ?>
    
  </head>

  <body>

   <?php include "common-navbar.php"; ?>

   <!-- Profile row -->
   <div class="container">
      <div class="jumbotron" style="position: relative; padding: 16px;">
  <?php $img = "img/profileImage.php?id=".$user['id']; ?>
        <image src="<?php echo $img; ?>" class="img-thumbnail" width="200px"/>
  <?php
        $get = $_GET;
        unset($get['talent']);
        $href = http_build_query($get);
  ?>
        <span><a style="color: white; vertical-align: bottom" id="userName" href="?<?php echo $href; ?>"><?php echo $profileName; ?></a></span>
        <!-- About stuff -->
        <div style="position: absolute; bottom: 0; right: 0; margin: 16px 24px">
          <span style="font-size: 16px;">Current Location: </span>
          <span style="font-size: 16px;" id="userLoc"><?php echo $currentLocation; ?></span>
          <button style="margin-top: -8px; padding: 2px;" type="submit" class="btn btn-sm btn-default">About</button>
        </div>
        <!-- Change settings and send e-mail -->
        <div style="position: absolute; top: 0; right: 0; padding: 0px 24px">
  <?php if (!$isMe) { ?>            
          <button type="button" class="btn btn-default" style="padding: 4px; ">Send E-mail</button>
  <?php } else { ?>
          <a href="/settings.php">
            <image src="settings_white.png" width="24px" />
          </a>
  <?php } ?>
        </div>
      </div>

      <!-- Main content div -->
      <div class="container">
      <!-- Example row of columns -->
        <div class="row">

          <div class="col-lg-4" style="width: 14%; background-color: transparent"></div>



           <div class="col-lg-4" style="width: 74%;" id="midCol">
            <h2 style="color: #9E2342;" id="midColHead">Compose Message<h2>
			<table>
			<tr>
				<td>To:</td>
				<td><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></td>
			</tr>
			<tr>
				<td>From: &nbsp;</td>
				<td>David Quesada (<?php echo 0; ?>) </td>
			</tr>
			</table>
			<form method="post" action="scripts/actions/sendMessage.php">
				<input style="align:center; margin:6px 12px 0px 6px" type="text" name="subject" placeholder="Subject" class="form-control"/>
				<input style="align:center; margin:6px 12px 0px 6px; height:100px; text-align:top" type="textarea" name="content" placeholder="Content" class="form-control"/>
				<input style="float:center; margin:6px 12px 0px 6px; width:50%" type="submit" value="Send" class="form-control"/><br>
			</form>
          </div> 
          
          
          <div class="col-lg-4" style="width: 13%; background-color: transparent"></div>
          <!-- Tag div -->
        </div>
      </div>
    </div>

      <hr>

<!--       <footer>
        <p>© Company 2013</p>
      </footer> -->
      
      
      
      
      
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap-3.0.0/assets/js/jquery.js"></script>
    <script src="bootstrap-3.0.0/dist/js/bootstrap.js"></script>
    <script src="profile.js"></script>
    <script src="embed.js"></script>
    
	<script type="text/javascript" src="jquery.githubRepoWidget.js"></script>
    
  </body>
</html>