<?php
	try {
    	switch ($_SESSION["security-level"]){
    		case "0": // This code is insecure.
				$lEnableJavaScriptValidation = FALSE;
				$lEnableHTMLControls = FALSE;
			break;

    		case "1": // This code is insecure.
	   		case "2":
	   		case "3":
	   		case "4":
    		case "5": // This code is fairly secure
    			$lEnableJavaScriptValidation = TRUE;
				$lEnableHTMLControls = TRUE;
    		break;
    	}// end switch

	} catch(Exception $e){
		echo $CustomErrorHandler->FormatError($e, "Error setting up configuration.");
	}// end try
?>

<script type="text/javascript">
<!--
	<?php
		if ($_SESSION["loggedin"]=="True") {
			echo "var l_loggedIn = true;" . PHP_EOL;
		}else {
			echo "var l_loggedIn = false;" . PHP_EOL;
		}// end if

		if (isset($lAuthenticationAttemptResult)){
			echo "var lAuthenticationAttemptResultFlag = {$lAuthenticationAttemptResult};" . PHP_EOL;
		}else{
			echo "var lAuthenticationAttemptResultFlag = -1;".PHP_EOL;
		}// end if

		if($lEnableJavaScriptValidation){
			echo "var lValidateInput = \"TRUE\"" . PHP_EOL;
		}else{
			echo "var lValidateInput = \"FALSE\"" . PHP_EOL;
		}// end if
	?>

	function onSubmitOfLoginForm(/*HTMLFormElement*/ theForm){
		try{
			if(lValidateInput == "TRUE"){
				var lUnsafeCharacters = /[`~!@#$%^&*()-_=+\[\]{}\\|;':",./<>?]/;
				if (theForm.username.value.length > 15 ||
					theForm.password.value.length > 15){
						alert('Username too long. We dont want to allow too many characters.\n\nSomeone might have enough room to enter a hack attempt.');
						return false;
				};// end if

				if (theForm.username.value.search(lUnsafeCharacters) > -1 ||
					theForm.password.value.search(lUnsafeCharacters) > -1){
						alert('Dangerous characters detected. We can\'t allow these. This all powerful blacklist will stop such attempts.\n\nMuch like padlocks, filtering cannot be defeated.\n\nBlacklisting is l33t like l33tspeak.');
						return false;
				};// end if
			};// end if(lValidateInput)

			return true;
		}catch(e){
			alert("Error: " + e.message);
		};// end catch
	};// end function onSubmitOfLoginForm(/*HTMLFormElement*/ theForm)
//-->
</script>

<div class="jumbotron">Login</div>

<?php include_once (__ROOT__.'/includes/back-button.inc');?>
<?php include_once (__ROOT__.'/includes/hints/hints-menu-wrapper.inc'); ?>

<div class="col-lg-7">
	<div class="card2 card border-0 px-4 py-5">
		<div id="id-authentication-failed-tr" style="display: none;">
			<span id="id-authentication-failed-td" colspan="2" class="error-message"></span>
		</div>
		<form id="idLoginForm" class="form" action="index.php?page=login.php" 
			method="post" 
			style="padding-inline: 20%; border-style:solid; border-color: gray;"
			enctype="application/x-www-form-urlencoded"
			onsubmit="return onSubmitOfLoginForm(this);">
			<h3 class="text-center">LOGIN/REGISTER</h3>
			<div class="form-group">
				<label for="useremail" class="text">Username:</label><br />
				<input type="text" name="username" id="username" maxlength="20" class="form-control" autofocus="autofocus"
				<?php
					if ($lEnableHTMLControls) {
					echo('minlength="1" maxlength="15" required="required"');
					}// end if
				?>
				/>
			</div>
			<div class="form-group">
				<label for="password" class="text">Password:</label><br />
				<input type="password" name="password" id="password" maxlength="20" class="form-control" autofocus="autofocus"
				<?php
						if ($lEnableHTMLControls) {
							echo('minlength="1" maxlength="15" required="required"');
						}// end if
					?>
				/>
			</div>
			<div class="form-group text-center">
				<button name="login-php-submit-button" type="submit" value="Login" class="btn btn">LOGIN</button>                             
			</div>
			<div class="form-group text-center">
				<label for="remember-me" class="text">
					<span>Aren't you registered? <a href="index.php?page=register.php" class="text">Register here</a></span>
				</label>
			</div>
		</form>
	</div>
</div>		


<div id="id-log-out-div" style="text-align: center; display: none;">
	<table>
		<tr>
			<td colspan="2" class="hint-header">You are logged in as <?php echo $_SESSION['logged_in_user']; ?></td>
		</tr>
		<tr><td></td></tr>
		<tr><td></td></tr>
		<tr>
			<td colspan="2" style="text-align:center;">
				<input class="button" type="button" value="Logout" onclick="document.location='index.php?do=logout'" />
			</td>
		</tr>
	</table>
</div>

<script type="text/javascript">
	var cUNSURE = -1;
   	var cACCOUNT_DOES_NOT_EXIST = 0;
   	var cPASSWORD_INCORRECT = 1;
   	var cNO_RESULTS_FOUND = 2;
   	var cAUTHENTICATION_SUCCESSFUL = 3;
   	var cAUTHENTICATION_EXCEPTION_OCCURED = 4;
   	var cUSERNAME_OR_PASSWORD_INCORRECT = 5;

   	var lMessage = "";
   	var lAuthenticationFailed = "FALSE";

	switch(lAuthenticationAttemptResultFlag){
   		case cACCOUNT_DOES_NOT_EXIST:
   	   		lMessage="Account does not exist"; lAuthenticationFailed = "TRUE";
   	   		break;
   		case cPASSWORD_INCORRECT:
   	   		lMessage="Password incorrect"; lAuthenticationFailed = "TRUE";
   	   		break;
   		case cNO_RESULTS_FOUND:
   	   		lMessage="No results found"; lAuthenticationFailed = "TRUE";
   	   		break;
   		case cAUTHENTICATION_EXCEPTION_OCCURED:
   	   		lMessage="Exception occurred"; lAuthenticationFailed = "TRUE";
   		break;
   		case cUSERNAME_OR_PASSWORD_INCORRECT:
   	   		lMessage="Username or password incorrect"; lAuthenticationFailed = "TRUE";
   		break;
   	};

	if(lAuthenticationFailed=="TRUE"){
		document.getElementById("id-authentication-failed-tr").style.display="";
		document.getElementById("id-authentication-failed-td").innerHTML=lMessage;
	}// end if AuthenticationAttemptResultFlag

	if (!l_loggedIn){
		document.getElementById("id-log-in-form-div").style.display="";
		document.getElementById("id-log-out-div").style.display="none";
	}else{
		document.getElementById("id-log-in-form-div").style.display="none";
		document.getElementById("id-log-out-div").style.display="";
	}// end if l_loggedIn
</script>