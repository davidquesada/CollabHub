<?php include "scripts/actions/createAccount.php"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="bootstrap-3.0.0/assets/ico/favicon.png">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap-3.0.0/dist/css/CollabHub.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="bootstrap-3.0.0/assets/js/html5shiv.js"></script>
      <script src="bootstrap-3.0.0/assets/js/respond.min.js"></script>
    <![endif]-->
    <?php include "background.html" ?>
  </head>

  <body style="padding:0">

    <div class="navbar navbar-default" >
      <div class="container" style="position:relative">
        <div>
          <a class="navbar-brand" href="index.php">CollabHub</a>
          <!-- Search button -->
          <a class="btn btn-primary" style="margin:8px 0px" href="search.php">Search</a>
        </div>
      </div>
    </div>

    <div class="container">
      <form class="form-signin" method="POST" action="MakeAnAccount.php">
        <h2 class="form-signin-heading" style="color:white">Create An Account</h2>
        <input type="text" class="form-control" placeholder="First Name"                name="first_name" />
        <input type="text" class="form-control" placeholder="Last Name"                 name="last_name" />
        <input type="text" class="form-control" placeholder="Email address" autofocus   name="email" />
        <input type="password" class="form-control" placeholder="Password"                  name="password" />
        <input type="password" class="form-control" placeholder="Confirm Password" />
        <input type="hidden" name="isCreatingAccount" />

        <button class="btn btn-lg btn-primary btn-block" type="submit" style = "margin-top: 7%">Submit</button>
        <!-- <p>
          <center>or...</center>
        </p>
        Insert join with facebook button here
        <p>
          <center>Insert Join With Facebook Button Here</center>
        </p> -->
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
