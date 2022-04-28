<?php
    $lSecurityLevel = $_SESSION["security-level"];

    switch ($lSecurityLevel){
        case "0": // This code is insecure
            $lSecurityLevelMessage = "Security Level: ".$lSecurityLevel." (Hosed)";
            break;
        case "1": // This code is insecure
            // DO NOTHING: This is equivalent to using client side security
            $lSecurityLevelMessage = "Security Level: ".$lSecurityLevel." (Client-Side Security)";
            break;

        case "2":
        case "3":
        case "4":
        case "5": // This code is fairly secure
            $lSecurityLevelMessage = "Security Level: ".$lSecurityLevel." (Secure)";
            break;
    }// end switch

	if($_SESSION['loggedin'] == "True"){

	    switch ($lSecurityLevel){
	   		case "0": // This code is insecure
	   		case "1": // This code is insecure
	   			// DO NOTHING: This is equivalent to using client side security
				$logged_in_user = $_SESSION['logged_in_user'];
			break;

	   		case "2":
	   		case "3":
	   		case "4":
	   		case "5": // This code is fairly secure
	   			// encode the entire message following OWASP standards
	   			// this is HTML encoding because we are outputting data into HTML
				$logged_in_user = $Encoder->encodeForHTML($_SESSION['logged_in_user']);
			break;
	   	}// end switch

	   	$lUserID = $_SESSION['uid'];

	   	$lUserAuthorizationLevelText = 'User';

	   	if ($_SESSION['is_admin'] == 'TRUE'){
	   		$lUserAuthorizationLevelText = 'Admin';
	   	}// end if

		$lAuthenticationStatusMessage =
			'Logged In ' .
			$lUserAuthorizationLevelText . ": " .
			'<span class="logged-in-user">'.$logged_in_user.'</span>'.
			'<a href="index.php?page=edit-account-profile.php&uid='.$lUserID.'">'.
            '<img src="images/edit-icon-20-20.png" /></a>';
	} else {
		$logged_in_user = "anonymous";
		$lAuthenticationStatusMessage = "Not Logged In";
	}// end if($_SESSION['loggedin'] == "True")

	if ($_SESSION["EnforceSSL"] == "True"){
		$lEnforceSSLLabel = "Drop TLS";
	}else {
		$lEnforceSSLLabel = "Enforce TLS";
	}//end if

	$lHintsMessage = "Hints: ".$_SESSION["hints-enabled"];

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
   
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="styles/masterPage.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>
<body>

<div class="wrapper">

	<!-- Sidebar Holder -->
	<?php require_once 'main-menu.php'; ?>

	<!-- Page Content Holder -->
	<div id="content">
		<nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-bottom: 0%;" >
			<div class="container-fluid">

				<button type="button" id="sidebarCollapse" class="navbar-btn">
					<span></span>
					<span></span>
					<span></span>
				</button>
				<button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<i class="fas fa-align-justify"></i>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<h2 style="color: whitesmoke; background-color: black; font-weight: 800; line-height: 200%;">  MUTILLIDAE  </h2>  
					<img src="images/ant.png" width="80" height="80" />
							<h6 style="color: blue; padding-left: 20%;">  Pwn in Mass Production</h6> 
					<ul class="nav navbar-nav ml-auto">

						<?php
							if ($_SESSION['loggedin'] == 'True'){
								echo '<li class="nav-item"><a class="nav-link" href="index.php?do=logout">Logout</a></li>';
							} else {
								echo '<li class="nav-item"><a class="nav-link" href="index.php?page=login.php">Login/Register</a></li>';
							}// end if
						?>
					</ul>
				</div>
			</div>
		</nav>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid">
				<a class="navbar-brand" href="./index.php?page=home.php&popUpNotificationCode=HPH0">HOME</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<?php
							if ($_SESSION['security-level'] == 0){
								echo '<li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php?do=toggle-hints&page='.$lPage.'">Toggle Hints</a></li>';
							}// end if
						?>
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="index.php?do=toggle-security&page=<?php echo $lPage?>">Toggle Security</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="index.php?do=toggle-enforce-ssl&page=<?php echo $lPage?>"><?php echo $lEnforceSSLLabel; ?></a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="index.php?page=set-up-database.php">Reset DB</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="index.php?page=show-log.php">View Log</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" aria-current="page" href="index.php?page=captured-data.php">View Captured Data</a>
						</li>
					</ul>
					<form class="d-flex">
						<input class="form-control me-2" type="search" placeholder="Search" style= "margin-left: 15%" aria-label="Search">
						<a class="btn btn-outline-success" aria-current="page" href="index.php?page=documentation/usage-instructions.php">Search</a>
					</form>
				</div>
			</div>
		</nav>
	<!--
	<div id="contenedor"> 
		<h2>Video Tutorials</h2> 

		<div class="container">
			<div class="row align-items-start">
				<div class="row">
					<div class="col-12">
					</div>
				</div>
				<div class="col">
					<div class="container">
					    <div class="embed-responsive embed-responsive-16by9">
							<iframe width="560" height="315" src="https://www.youtube.com/embed/TcgeRab7ayM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					    </div>
					</div>
				</div>
				<div class="col">
					<div class="container">
					    <div class="embed-responsive embed-responsive-16by9">
						     <iframe width="560" height="315" src="https://www.youtube.com/embed/Xt3qAlA6gNk?start=121" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
					    </div>
					</div>
				</div>
			</div>
			<div class="line"></div>
				<div class="container">
					<div class="row align-items-start">
						<div class="row">
							<div class="col-12">
							</div>
						</div>
						<div class="col">
							<div class="container" style="text-align: center;">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<h3>tap to rate Mutillidae </h3>
							</div>
							<div class="container" style="text-align: center; padding-top: 10%;">
								<button type="button" class="btn btn-primary">Bug report by email</button>
							</div>
							<div class="container" style="text-align: center; padding-top: 5%;">
								<button type="button" class="btn btn-success">Do you need help?</button>
							</div>
						</div>
						<div class="col">
							<div class="container"style="text-align: center; padding-top: 10%;">
								    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" style="color: rgb(78, 80, 80); font-size: large;">
									<option selected>Other things you may like:</option>
									<option value="1">Bug tracker</option>
									<option value="2">List of vulnerabilities</option>
									<option value="3">What should i do?</option>
									<option value="4">Release announcements</option>
									<option value="5">What's new</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
						-->

<!-- <table class="main-table-frame">
	<tr class="main-table-frame-dark">
		<td class="main-table-frame-first-bar" colspan="2">
			<img src="images/coykillericon-50-38.png"/>
			OWASPkjdskjdskjdskjdskjdd Pwn On
		</td>
	</tr>
	<tr class="main-table-frame-dark">
		<td class="main-table-frame-second-bar" colspan="2">
			<?php /* Note: $C_VERSION_STRING in index.php */
			    echo $C_VERSION_STRING;
			?>
			<span><?php echo $lSecurityLevelMessage; ?></span>
			<span><?php echo $lHintsMessage; ?></span>
			<span><?php echo $lAuthenticationStatusMessage ?></span>
		</td>
	</tr>
	<tr class="main-table-frame-menu-bar">
		<td class="main-table-frame-menu-bar" colspan="2">
			<a href="index.php?page=home.php&popUpNotificationCode=HPH0">Home</a>
			|
			<?php
				if ($_SESSION['loggedin'] == 'True'){
					echo '<a href="index.php?do=logout">Logout</a>';
				} else {
					echo '<a href="index.php?page=login.php">Login/Register</a>';
				}// end if
			?>
			|
			<?php
				if ($_SESSION['security-level'] == 0){
					echo '<a href="index.php?do=toggle-hints&page='.$lPage.'">Toggle Hints</a> |';
				}// end if
			?>
			<a href="index.php?do=toggle-security&page=<?php echo $lPage?>">Toggle Security</a>
			|
			<a href="index.php?do=toggle-enforce-ssl&page=<?php echo $lPage?>"><?php echo $lEnforceSSLLabel; ?></a>
			|
			<a href="set-up-database.php">Reset DB</a>
			|
			<a href="index.php?page=show-log.php">View Log</a>
			|
			<a href="index.php?page=captured-data.php">View Captured Data</a>
		</td>
	</tr>
	<tr>
		<td class="main-table-frame-left">
			<?php require_once 'main-menu.php'; ?>
			<div>&nbsp;</div>
			<div>
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="45R3YEXENU97S">
					<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" name="submit" alt="Donate Today!">
					<img alt="" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
				</form>
				Want to Help?
			</div>
			<div>&nbsp;</div>
			<div>
				<a href="http://www.youtube.com/user/webpwnized" target="_blank">
					<img alt="Webpwnized YouTube Channel" src="./images/youtube-play-icon-40-40.png" />
					<br/>
					Video Tutorials
				</a>
			</div>
			<div>&nbsp;</div>
			<div>
				<a href="https://twitter.com/webpwnized" target="_blank">
					<img alt="Webpwnized Twitter Channel" src="./images/twitter-bird-48-48.png" />
					<br/>
					Announcements
				</a>
			</div>
			<div>&nbsp;</div>
			<div>
				<a
					href="https://www.sans.org/reading-room/whitepapers/application/introduction-owasp-mutillidae-ii-web-pen-test-training-environment-34380"
					target="_blank"
					title="Whitepaper: Introduction to OWASP Mutillidae II Web Pen Test Training Environment"
				>
					<img align="middle" alt="Webpwnized Twitter Channel" src="./images/pdf-icon-48-48.png" />
					<br/>
					Getting Started
				</a>
			</div>
			<div>&nbsp;</div>
		</td>
		<td class="main-table-frame-right">
			
		</td>
				</tr>
				</table>
 -->

<!-- jQuery CDN - Slim version (=without AJAX) -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="javascript/hints/hints-menu.js"></script>
<script src="javascript/inline-initializers/populate-web-storage.js"></script>
<script src="javascript/inline-initializers/hints-menu-init.js"></script>

<style>
.checked {
	color: orange;
}
</style>

<script type="text/javascript">
	$(document).ready(function () {
		$('#sidebarCollapse').on('click', function () {
			$('#sidebar').toggleClass('active');
			$(this).toggleClass('active');
		});
	});
	
</script>