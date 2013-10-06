<?php
$name = @$_GET['person'];
$tag = @$_GET['tag'];
$location = @$_GET['location'];

if (!$name) $name = "";
if (!$tag) $tag = "";
if (!$location) $location = "";
?>
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
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->

    <!-- Fancy opening little dialogs -->
    <script type="text/javascript" language="javascript" src="lytebox_v5.5/lytebox.js"></script>
    <link rel="stylesheet" href="lytebox_v5.5/lytebox.css" type="text/css" media="screen" />


    <script>
      var htmlsent = "";

      function constructURL(person,tag,location)
      {
        var url = "http://158.130.157.168/scripts/actions/partnersearch.php?";
        url = url + "person="+person+"&tag="+tag+"&location=" + location;
        url = encodeURI(url);
        return url;
      }
      //alert(6);
      function get_request()
      {
        
        if(htmlsent!="")
          window.location.reload();
        htmlsent = "";
        
        
        person = document.getElementById('person-box').value;
        tag = document.getElementById('tag-box').value;
        location = document.getElementById('location-box').value;
        cleanURL = constructURL(person,tag,location);
        
        
        
        var xmlHttp = null;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.open( "GET", cleanURL, false );
        xmlHttp.send( null );
        text = "";
        text = xmlHttp.responseText;
        
        alert(text);
        
        document.getElementById("resultsContent").innerHtml = text;
        text = '<p id= "search_bar" class = "text-muted" style = "font-size: 150%">Here are the people you know!</p>' + text;
        htmlsent = text;
      }
    </script>
    <?php include "background.html"; ?>
  </head>

  <body >

    <?php include "common-navbar.php"; ?> 

      <div>
        <h2 style="margin-top:10px; color:white" align = center>Find Someone to Collaborate with...<h2>
      </div>

      <!-- Search Area -->
      <div class="container" style="background-color:#E6E6E6; border-radius:6px">
        <div class="row">
		  <form action="search.php" method="get">
          <div class="col-lg-4" style="width: 30%; padding:16px; background-color:transparent">
            <p>Looking for someone specific?</p>
            <input type="text" class="form-control" placeholder="Search by name" id="person-box" name="person" value="<?php echo $name; ?>"></input></li>
          </div>
          <div class="col-lg-4" style="width: 30%; padding:16px; background-color:transparent">
            <p>Looking for anything special?</p>
            <input type="text" class="form-control" placeholder="Search by tags, comma separated" id="tag-box" name="tag" value="<?php echo $tag; ?>"></input></li>
          </div>
          <div class="col-lg-4" style="width: 30%; padding:16px; background-color:transparent">
            <p>Looking within an area?</p>
            <input type="text" class="form-control" placeholder="Search by city" id="location-box" name="location" value="<?php echo $location; ?>"></input></li>
          </div>
          <div class="col-lg-4" style="width: 10%; padding:16px; background-color:transparent">
            <div style="margin-bottom:30px"></div>
            <!--<button type="button" class="btn btn-success" onclick="get_request();">Update</button>-->
			<input type="submit" class="btn" value="NO"/>
          </div>
		  </form>
        </div>
      </div>

		<div class="container" style="background-color:#E6E6E6; border-radius:6px; margin-top:32px; padding:16px">
		
		<?php
		if(array_key_exists('tag', get_defined_vars()) && array_key_exists('name', get_defined_vars()) && array_key_exists('location', get_defined_vars())){
    $users = database_fetch_all("SELECT * FROM users");
		/// Step 1. Get the user objects matching the search parameters.
		function Comparator($user1, $user2)
    {
	global $tag;
	global $location;
      $url1 = "SELECT * FROM user_tags WHERE `user_id` = '{$user1['id']}' AND `title`= '$tag'";
      $url2 = "SELECT * FROM user_tags WHERE `user_id` = '{$user2['id']}' AND `title`= '$tag'";
      $result1 = database_fetch_all($url1);
      $result2 = database_fetch_all($url2);
      $result1 = count($result1);
      $result2 = count($result2);
      if($location == $user1['location'])
        $result1 = $result1 + 1;
      if($location == $user2['location'])
        $result2 = $result2 + 1;
      return $result1 <= $result2;
    }
		// For now, return all users.
	

		//print_r($users);
		
		/// Step 2. Print a row for each result user.
    usort($users,"Comparator");
		foreach ($users as $user)
		{
			$href = "profile.php?userid=" . $user['id'];
			$img = "img/profileImage.php?id=" . $user['id'];
			$name = $user['first_name'] . ' ' . $user['last_name'];
      echo '<div style="margin-bottom:16px;">
      <a href="' .$href. '" style="text-decoration:none">
      <image height="50px" src="'.$img.'" id=""></image>
      <span style="vertical-align:bottom; padding-left:8px;" id="name" >'.$name.'</span>
      </a><hr>
      </div> ';
    }
  }
		?>
		

		

		
		</div>
	  
        <!-- Search Results -->
		<!-- 
        <div class="container" style="background-color:#E6E6E6; border-radius:6px; margin-top:32px; padding:16px">
          <!-- Redirect to user profile -->
          <div style="margin-bottom:16px;">
            <a href="profile.php" style="text-decoration:none">
              <image width="50px" src="settings.png" id=""></image>
              <span style="vertical-align:bottom; padding-left:8px;" id="name" >User Name</span>
            </a>
			
          </div>
		  <hr />
          <div>
            <a href="profile.php" style="text-decoration:none">
              <image width="50px" src="settings.png" id=""></image>
              <span style="vertical-align:bottom; padding-left:8px;" id="name" >User Name</span>
            </a>
          </div>
        </div> -->

        <div id="resultsContent">
            
        </div>
      </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="bootstrap-3.0.0/assets/js/jquery.js"></script>
    <script src="bootstrap-3.0.0/dist/js/bootstrap.min.js"></script>
  </body>
</html>