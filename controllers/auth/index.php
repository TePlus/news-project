<?php
use OMCore\OMDb;
$DB = OMDb::singleton();

$PAGE_VAR["css"][] = "auth";
$PAGE_VAR["js"][] = "auth";

// var_dump($user);
// exit();

if(!empty($user)){
  header("Location: " . WEB_META_BASE_URL . "news");
}

?>

<body class="signup-page">
	<nav class="navbar navbar-transparent navbar-absolute">
    	<div class="container">
        	<!-- Brand and toggle get grouped for better mobile display -->
        	<div class="navbar-header">
        		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
            		<span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
        		</button>
            <a href="http://www.creative-tim.com">
                <div class="logo-container">
                      <div class="logo">
                          <img src="<?=WEB_META_BASE_URL?>img/logo.png" alt="Creative Tim Logo">
                      </div>
                      <div class="brand">
                          Creative TePlus
                      </div>
                  </div>
            </a>
        	</div>

        	<!--<div class="collapse navbar-collapse" id="navigation-example">
        		<ul class="nav navbar-nav navbar-right">
					<li>
    					<a href="../components-documentation.html" target="_blank">
    						Components
    					</a>
    				</li>
    				<li>
						<a href="http://www.creative-tim.com/product/material-kit" target="_blank">
							<i class="material-icons">cloud_download</i> Download
						</a>
    				</li>
		            <li>
		                <a href="https://twitter.com/CreativeTim" target="_blank" class="btn btn-simple btn-white btn-just-icon">
							<i class="fa fa-twitter"></i>
						</a>
		            </li>
		            <li>
		                <a href="https://www.facebook.com/CreativeTim" target="_blank" class="btn btn-simple btn-white btn-just-icon">
							<i class="fa fa-facebook-square"></i>
						</a>
		            </li>
					<li>
		                <a href="https://www.instagram.com/CreativeTimOfficial" target="_blank" class="btn btn-simple btn-white btn-just-icon">
							<i class="fa fa-instagram"></i>
						</a>
		            </li>
        		</ul>
        	</div>-->
    	</div>
    </nav>

    <div class="wrapper">
		<div class="header header-filter" style="background-image: url('<?=WEB_META_BASE_URL?>img/city.jpg'); background-size: cover; background-position: top center;">
			<div class="container container-table">
				<div class="row vertical-center-row">

					<!--<div class="text-center col-md-4 col-md-offset-4" style="background:red">TEXT</div>-->

					<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
						<div class="card card-signup">
							<form class="form" id="form" data-toggle="validator" novalidate="novalidate" method="POST"  enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
								<div class="content">

									<!--<div class="input-group">
										<img id="img-logo-login" src="<?=WEB_META_BASE_URL?>img/logo.png" alt="Circle Image" class="img-circle img-responsive">
									</div>-->

									<?php if ( isset($errMSG) ) { ?>
										<div class="form-group">
											<div class="alert alert-danger">
												<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
											</div>
										</div>
									<?php } ?>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="material-icons">face</i></span>
											<input type="email" name="username" class="form-control" placeholder="Your Username"  maxlength="40" />
										</div>
										<span class="text-danger"><?php echo $usernameError; ?></span>
									</div>

									<div class="input-group">
										<span class="input-group-addon">
											<i class="material-icons">lock_outline</i>
										</span>
										<input type="password" name="password" class="form-control" placeholder="Password" />
										 <span class="text-danger"><?php echo $passError; ?></span>
									</div>

								  <!-- If you want to add a checkbox to this form, uncomment this code -->

									<div class="checkbox">
										<label>
											<input type="checkbox" name="optionsCheckboxes" checked>
											Remember
										</label>
									</div>
								</div>
								<div class="footer text-center">
                  					<button class="btn btn-primary" type="submit" id="btn-login">LOGIN<div class="ripple-container"></div></button>
								</div>
							</form>
						</div>
					</div>
			
				</div>
			</div>

		<footer class="footer">
	    <div class="container">
	        <div class="copyright pull-right">
	            &copy; 2017, made with by TePlus
	        </div>
	    </div>
	</footer>

		</div>
	</div>
</body>