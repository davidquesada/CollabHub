<?php
    require_once("scripts/common.php");
    $emailValue = "";
    $passwordAttr = "";
    $userFullName = @($_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name']);
    if (isset($_GET['failedLogin']) && isset($_GET['email']))
    {
        $emailValue = $_GET['email'];
        $passwordAttr = "autofocus";
    }
    
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="bootstrap-3.0.0/assets/ico/favicon.png">

    <title>CollabHub</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap-3.0.0/dist/css/CollabHub.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <script src="//connect.soundcloud.com/sdk.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
    
    <?php include "background.html"; ?>
    
  </head>

<body>
<div id="fb-root"></div>
<script>
 loginCheckUser = function(){
  FB.getLoginStatus(function(response) {
  if (response.status === 'connected') {

    var uid = response.authResponse.userID;
    var accessToken = response.authResponse.accessToken;
    FB.api('/me', function(response){
    Profile = {FBID: uid , firstname : response.first_name , lastname : response.last_name, education : response.education , location : response.location , email : response.email ,bio : response.bio};
    str_Profile = JSON.stringify(Profile);
    str_Profile = "user="+ str_Profile;
    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open('POST',"./scripts/actions/FBsignin.php",false);
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded",true);
    xmlHttp.send(str_Profile);
    profileUrl = "http://158.130.157.168/profile.php";
    window.location.href = profileUrl
  });} 
  else if (response.status === 'not_authorized')
  {

  } 
  else 
  {

  }

 })};

  window.fbAsyncInit = function() {
    FB.init({
      appId      : '162787530582568', // App ID
      channelUrl : '//158.130.157.168/channel.html', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });
  // Here we subscribe to the auth.authResponseChange JavaScript event. This event is fired
  // for any authentication related change, such as login, logout or session refresh. This means that
  // whenever someone who was previously logged out tries to log in again, the correct case below 
  // will be handled. 
    FB.Event.subscribe('auth.login', function(response) {
    // Here we specify what we do with the response anytime this event occurs. 
    if (response.status === 'connected') 
    {
      testAPI();     
    }
    else if (response.status === 'not_authorized') 
    {

    }
    else
    {
      FB.login(function(response)
      { },{scope: 'email'});

    }
  });
  };
  // Load the SDK asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));

  </script>    
    <!-- navbar -->
    <?php include "common-navbar.php"; ?> 
    
    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        
        <h1>Collaboration made easy!</h1>
        <p>Looking for a drummer near you to play in a metal band? How about a programmer for the next hackathon? Use CollabHub to find people with similar interests and work on jaw-dropping projects! Creating an account takes less than 30 seconds!</p>

        <p>
		<br>
          <a style="margin-top:-16px" class="btn btn-lg btn-primary" href="MakeAnAccount.php">Create an Account! &raquo;</a>
          <fb:login-button show-faces="false" width="400" max-rows="1" autologoutlink="false" onlogin="loginCheckUser()" size="xlarge" scope = "email"></fb:login-button>
        </p>

      </div>

      <footer style="color:white">
        <p align="center">&copy; CollabHub 2013 
          <a href="#"> Contact Us</a>
        </p>
        <br>
        <!-- <iframe width="420" height="315" src="//www.youtube.com/embed/1z3-H-csk8I" frameborder="0" allowfullscreen></iframe> -->
        <script>
          // SC.initialize({
          //   client_id: "ce76e68b3624ea3ded07c851938b5e8b",
          // });
          // var track_url = 'http://soundcloud.com/forss/flickermood';
          // SC.oEmbed(track_url, { auto_play: false}, document.getElementById('widget'));
        </script>
      </footer>
      
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap-3.0.0/assets/js/jquery.js"></script>
    <script src="bootstrap-3.0.0/dist/js/bootstrap.min.js"></script>
    <!-- <script src="../js/SoundCloudapi.js"></script> -->
  </body>
</html>
