<style>
	a{
		font-weight: bold;
	}
</style>

<?php
	/* Check if required software is installed. Issue warning if not. */
 
	if (!$RequiredSoftwareHandler->isPHPCurlIsInstalled()){
		echo $RequiredSoftwareHandler->getNoCurlAdviceBasedOnOperatingSystem();
	}// end if

	if (!$RequiredSoftwareHandler->isPHPJSONIsInstalled()){
		echo $RequiredSoftwareHandler->getNoJSONAdviceBasedOnOperatingSystem();
	}// end if
?>

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
								<?php include_once('./includes/help-button.inc');?>
							</div>
						</div>
						<div class="col">
							<div class="container"style="text-align: center; padding-top: 10%;">
								<select class="form-select form-select-lg mb-3" 
									aria-label=".form-select-lg example" 
									style="color: rgb(78, 80, 80); font-size: large;"
									onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
									<option selected value="./">Other things you may like:</option>
									<option value="1">Bug tracker</option>
									<option value="./index.php?page=./documentation/vulnerabilities.php">List of vulnerabilities</option>
									<option value="./index.php?page=documentation/usage-instructions.php">What should i do?</option>
									<option value="https://twitter.com/webpwnized">Release announcements</option>
									<option value="https://github.com/webpwnized/mutillidae">What's new</option>
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
