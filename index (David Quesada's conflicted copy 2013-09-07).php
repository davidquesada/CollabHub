<?php
    $emailValue = "";
    $passwordAttr = "";
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
    
  </head>

  <body>
<body>
<div id="fb-root"></div>
<script>
loginCheckUser = function(){
  FB.getLoginStatus(function(response) {
  if (response.status === 'connected') {
    // the user is logged in and has authenticated your
    // app, and response.authResponse supplies
    // the user's ID, a valid access token, a signed
    // request, and the time the access token 
    // and signed request each expire
    var uid = response.authResponse.userID;
    var accessToken = response.authResponse.accessToken;
    FB.api('/me', function(response){
    Profile = {FBID: uid , firstname : response.first_name , lastname : response.last_name, education : response.education , location : response.location , picture : response.picture , website : response. website, work : response.work, email : response.email ,bio : response.bio}
    str_Profile = JSON.stringify(Profile);

    var xmlHttp = null;
    xmlHttp.open('POST',"./scripts/user.php",true);
    xmlHttp.setRequestHeader("Content-type", "application/json", true);
    xmlHttp.send(str_Profile);      
});
  } else if (response.status === 'not_authorized') {
    // the user is logged in to Facebook, 
    // but has not authenticated your app
  } else {
    // the user isn't logged in to Facebook.
  }
 });
}
  // Additional JS functions here
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
      // The response object is returned with a status field that lets the app know the current
      // login status of the person. In this case, we're handling the situation where they 
      // have logged in to the app.
      testAPI();     
    }
    else if (response.status === 'not_authorized') 
    {
      // In this case, the person is logged into Facebook, but not into the app, so we call
      // FB.login() to prompt them to do so. 
      // In real-life usage, you wouldn't want to immediately prompt someone to login 
      // like this, for two reasons:
      // (1) JavaScript created popup windows are blocked by most browsers unless they 
      // result from direct interaction from people using the app (such as a mouse click)
      // (2) it is a bad experience to be continually prompted to login upon page load.
    }
    else
    {
      // In this case, the person is not logged into Facebook, so we call the login() 
      // function to prompt them to do so. Note that at this stage there is no indication
      // of whether they are logged into the app. If they aren't then they'll see the Login
      // dialog right after they log in to Facebook. 
      // The same caveats as above apply to the FB.login() call here.
      FB.login();
    }
  });
  };
  // Load the SDK asynchronously
  (function(d, s, id)
  {
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/all.js";
     fjs.parentNode.insertBefore(js, fjs);

   }(document, 'script', 'facebook-jssdk'));
</script>    
    <!-- Fixed navbar -->
    <div class="navbar navbar-default" >
      <div class="container" style="position:relative">
        <div>
          <!-- Hides things when the window is too small-->
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">CollabHub</a>
          <!-- Search button -->
          <a class="btn btn-primary" style="margin:8px 0px" href="search.php">Search</a>
        </div>
        <div class="navbar-collapse collapse" style="padding:0; position:absolute; right:0; top:0">
          <ul class="list-inline">
            <li style="color:#8CC0ED; margin:16px 0px; vertical-align:top">Logged in as: <span id="name">User Name</span></li>
            <li style="vertical-align:top; margin:16px 0px"><a style="color:white;" href="http://158.130.157.168/" onMouseOver="this.style.color='#8CC0ED'" onMouseOut="this.style.color='white'">Home</a></li>
            <!-- If Logged in -->
            <li style="vertical-align:top; margin:16px 0px"><a style="color:white;" href="/profile.php" onMouseOver="this.style.color='#8CC0ED'" onMouseOut="this.style.color='white'">Your Profile</a></li>
            <li style="vertical-align:top; margin:8px 0px"><a href="scripts/actions/signout.php" class="btn btn-danger" style="color:white;">Log Out</a></li>
          </ul>
          <ul>
            <li>
              <form class="navbar-form navbar-right" style="padding:0" method="POST" action="scripts/actions/signin.php">
                <div class="form-group">
                  <input type="text" placeholder="Email" class="form-control" name="email" value="<?php echo $emailValue; ?>" />
                </div>
                <div class="form-group">
                  <input type="password" placeholder="Password" class="form-control" name="password" <?php echo $passwordAttr; ?>>
                </div>
                <button type="submit" class="btn btn-success">Sign in</button>
                <!-- <a class="btn btn-default" href="MakeAnAccount.html">Create Account</a> -->
                <!--  <button type="submit" class="btn btn-default" href="MakeAnAccount.html">Create an Account</a> -->
              </form>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        
        <h1>Collaboration made easy!</h1>
        <p>Looking for a bassist near your home town to play in a metal band? How about a 3d-Modeler to help with your game? Use CollabHub to find people with similar interests and work on jaw-dropping projects! Creating an account takes less than 30 seconds!</p>
        <div id="player"></div>
        <script>
        <!-- This code below is the youtube embed code -->
        //Make above into a real form where after/while youtube video is generated a new data entry form is created that can then create another video.
        // player = new YT.Player('player', {
        //   height: '292',
        //   width: '480',

        //   //videoId: 'M7lc1UVf-VE',
        //   videoId: daURL,
        //   events: {
        //     'onReady': onPlayerReady,
        //     'onStateChange': onPlayerStateChange
        //   }
        // });
        </script>
        <p>
          <a class="btn btn-lg btn-primary" href="MakeAnAccount.php">Create an Account! &raquo;</a>
          <fb:login-button show-faces="true" width="400" max-rows="1" autologoutlink = true onlogin ="loginCheckUser" size="xlarge"></fb:login-button>
        </p>

        <div id="widget"></div>
      </div>
      
      <footer>
        <p>&copy; CollabHub 2013</p>
        <a href="contact.html">Contact Us</a>
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
