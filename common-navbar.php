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
      <div class="navbar navbar-default" >
      <div class="container" style="position:relative">
        <div>
          <!-- Hides things when the window is too small-->
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">CollabHub</a>
          <!-- Search button -->
          <a class="btn btn-primary" style="margin:8px 0px" href="search.php">Search</a>
        </div>
        <div class="navbar-collapse collapse" style="padding:0; position:absolute; right:0; top:0">
          <ul class="list-inline">
<?php if (user_isLoggedIn()) { ?>
            <!-- If Logged in -->
            <li style="color:#8CC0ED; margin:16px 0px; vertical-align:top">Logged in as: <span id="name"><?php echo $userFullName; ?></span></li>
            <li style="vertical-align:top; margin:16px 0px"><a style="color:white;" href="/profile.php" onMouseOver="this.style.color='#47a447'" onMouseOut="this.style.color='white'">Your Profile</a></li>
            <li style="vertical-align:top; margin:8px 0px"><a href="scripts/actions/signout.php" class="btn btn-danger" style="color:white;">Log Out</a></li>
<?php } else { ?>
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
<?php } ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>