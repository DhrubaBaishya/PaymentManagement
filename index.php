<?php
include 'main/common/setup.php';
include 'main/common/connection.php';
include 'main/common/constant.php';
if (isset($_SESSION['username'])){
  header("Location: ".DASHBOARD);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="material/css/materialize.min.css"  media="screen,projection"/>
    <link href="materialize/css/ghpages-materialize.css" type="text/css" rel="stylesheet" media="screen,projection">

    <link type="text/css" rel="stylesheet" href="css/home.css"  media="screen,projection"/>
  
</head>
<body>

	
    <div class="loginDiv">
    	<h2>PayMan</h2>
	    <input class="loginInput" type="text" id="username" placeholder="Username">
      	<input class="loginInput" type="password" id="password" placeholder="Password">
      	<input class="loginButton" type="button" name="SignIn" value="SignIn" onclick="login()">
    </div>
          
  
  <script type="text/javascript" src="js/jquery-3.js"></script>
  <script type="text/javascript" src="js/home.js"></script>
  <script type="text/javascript" src="material/js/materialize.min.js"></script>
</body>
</html>