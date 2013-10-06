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

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="bootstrap-3.0.0/assets/js/html5shiv.js"></script>
      <script src="bootstrap-3.0.0/assets/js/respond.min.js"></script>
    <![endif]-->

    <!-- Fancy opening little dialogs -->
    <script type="text/javascript" language="javascript" src="lytebox_v5.5/lytebox.js"></script>
    <link rel="stylesheet" href="lytebox_v5.5/lytebox.css" type="text/css" media="screen" />
    <!--SoundCloud API-->
    <script src="//connect.soundcloud.com/sdk.js"></script>
    <!--Youtube API Script is here-->
    <script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      
      function onYouTubeIframeAPIReady() {
        //New data entry needs to be created here
        //ACCESSES ALL PAST YOUTUBE URLS AND EMBEDS THEM
        //ACCESSES ALL PAST SOUNDCLOUD URLS AND EMBEDS THEM
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        //event.target.playVideo();
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {
      }
      function stopVideo() {
        player.stopVideo();
      }
    </script>

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
		  <a class="btn" href="compose.php?userid=<?php echo $user['id']; ?>"><button type="button" class="btn btn-default" style="padding: 4px; ">Send E-mail</button></a>
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
          <div class="col-lg-4" style="width: 20%; position: relative;"> <!-- #eddadf -->
            <h2 style="color: #F0650E;">Talents</h2>
            <ul class="talentList" id="talentList">
  <?php if (count($talents) == 0) { ?>
              <li>You have no talents. :(</li>
              
  <?php } else foreach ($talents as $talent) {
        $newGet = $_GET;
        $newGet['talent'] = $talent['id'];
        $href = http_build_query($newGet);
  ?>
    <?php if ($talent['id'] === $selectedTalentId) { ?>
              <li><b><?php echo $talent['title']; ?></b></li>
    <?php } else { ?>
              <li><a href="?<?php echo $href; ?>"><?php echo $talent['title']; ?></a></li>
    <?php } ?>
  <?php } ?>
            </ul>
  <?php if ($isMe) { ?>
            <p><a href="AddNewTalent.html" class="lytebox" data-title="Add a new talent" data-lyte-options="width:50% scrollbars:no"><strong>+ New Talent . . .</strong></a></p>
  <?php } ?>
          </div>
          <div class="col-lg-4" style="width: 3%; background-color: transparent"></div>

          <!-- This does not work currently. -->
          <?php
            if ($selectedTalentId === NULL)
                include "profile_parts/profile_bio.php";
            else
                include "profile_parts/profile_talent.php";
          ?>


<!--           <div class="col-lg-4" style="width: 54%;" id="midCol">
            <h2 style="color: #9E2342;" id="midColHead">Who Am I?<h2>
          </div> -->
          
          
          <div class="col-lg-4" style="width: 3%; background-color: transparent"></div>
          <!-- Tag div -->
          <div class="col-lg-4" style="width: 20%;">
            <h2 style="color: #F0650E;">Associated Tags</h2>
            <!-- List of tags -->
            <ul class="list-inline" id="tagList">
<?php if (count($tags) == 0) { ?>
                <li>
                    <?php echo $isMe ? "You have no tags. Add tags to help people discover and collaborate with you."
                                     : "This person has no tags."; ?>
                    
                </li>
<?php } else foreach ($tags as $tag) { ?>
              <li><a href="#"><?php echo $tag['title']; ?></a></li>
<?php } ?>
            </ul>
  <?php if ($isMe) { ?>
            <p><a href="AddNewTag.html" class="lytebox" data-title="Add a new tag" data-lyte-options="width:50% scrollbars:no"><strong>+ New Tag . . .</strong></a></p>
  <?php } ?>
          </div>
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