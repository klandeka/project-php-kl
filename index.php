<?php 
	# Stop Hacking attempt
	define('__APP__', TRUE);
	
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	
	# Start session
    session_start();
	
	
	# Variables MUST BE INTEGERS
    if(isset($_GET['menu'])) { $menu   = (int)$_GET['menu']; }
	if(isset($_GET['action'])) { $action   = (int)$_GET['action']; }
	
	# Variables MUST BE STRINGS A-Z
    if(!isset($_POST['_action_']))  { $_POST['_action_'] = FALSE;  }
	
	if (!isset($menu)) { $menu = 1; }
	
	# Classes & Functions
    include_once("functions.php");
	
	# Database connection
	include ("dbconn.php");
	
print '
<!DOCTYPE html>
<html>
	<head>
		
		<!-- CSS -->
		<link rel="stylesheet" href="style.css">
		<!-- End CSS -->
		<!-- meta elements -->
		<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="description" content="Službena stranica azila Landeka za udomljavanje pasa">
        <meta name="keywords" content="Azil, Landeka, Psi, Pas, Udomljavanje">
		
		<!-- Schema.org markup for Google+ -->
		<meta itemprop="name" content="Azil Landeka">
		<meta itemprop="description" content="Službena stranica azila Landeka za udomljavanje pasa">
		<meta itemprop="image" content="www.azil-landeka.hr"> 
		
		<!-- Open Graph data -->
		<meta property="og:title" content="Azil Landeka">
		<meta property="og:type" content="article">
		<meta property="og:url" content="www.azil-landeka.hr">
		<meta property="og:image" content="www.azil-landeka.hr/image.jpeg">
		<meta property="og:description" content=Službena stranica azila Landeka za udomljavanje pasa">
		<meta property="article:tag" content="Azil, Landeka, Psi, Pas, Udomljavanje">
		
		<!-- Twitter Card data -->
		<meta name="twitter:title" content="Azil Landeka">
		<meta name="twitter:description" content="Službena stranica azila Landeka za udomljavanje pasa">
		
        <meta name="author" content="katarina.landeka@vvg.hr">
		<!-- favicon meta -->
		<link rel="icon" href="favicon.ico" type="image/x-icon"/>
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>
		<!-- end favicon meta -->
		<!-- end meta elements -->
		
		<!-- Google Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet"> 
		<!-- End Google Fonts -->
		<title>Azil Landeka</title>
	</head>
<body>
	<header>
		<div'; if ($menu > 1) { print ' class="hero-subimage"'; } else { print ' class="hero-image"'; }  print '></div>
		<nav>';
			include("menu.php");
		print '</nav>
	</header>
	<main>';
		if (isset($_SESSION['message'])) {
			print $_SESSION['message'];
			unset($_SESSION['message']);
		}
	
	# Homepage
	if (!isset($menu) || $menu == 1) { include("home.php"); }
	
	# News
	else if ($menu == 2) { include("news.php"); }
	
	# Contact
	else if ($menu == 3) { include("contact.php"); }
	
	# About us
	else if ($menu == 4) { include("about-us.php"); }
	
	# Register
	else if ($menu == 5) { include("register.php"); }
	
	# Signin
	else if ($menu == 6) { include("signin.php"); }
	
	# Admin webpage
	else if ($menu == 7) { include("admin.php"); }

	# Gallery
	else if ($menu == 8) { include("gallery.php"); }
	
	#
	else if ($menu == 10) { include("our-dogs.php"); }
	
	
	# API DOG
	else if ($menu == 12) { include("dog.php"); }
	
	# API DOG
	else if ($menu == 13) { include("dog-facts.php"); }
	
	print '
	</main>
	<footer>
		<p>' . date("Y") . ' Katarina Landeka </p>
	</footer>
</body>
</html>';
?>
