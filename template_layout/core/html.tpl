<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
	<meta charset="UTF-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title><?=$OMPage->getVar("News")?></title>
	<meta name="description" content="<?=$OMPage->getVar("window_description")?>" />
	<meta name="keywords" content="<?=$OMPage->getVar("window_keywords")?>" />
	<link rel="shortcut icon" href="<?=WEB_META_BASE_URL?>favicon.ico" />
	<link href="<?=WEB_META_BASE_URL?>css/comp.css<?=$OMPage->merge_media("css")?>" rel="stylesheet" type="text/css" />
	<link rel="canonical" href="<?=$OMPage->omroute("current_url")?>" />

	<!-- <link rel="stylesheet" href="<?=WEB_META_BASE_URL?>css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="<?=WEB_META_BASE_URL?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=WEB_META_BASE_URL?>css/material-kit.css">
	<link rel="stylesheet" href="<?=WEB_META_BASE_URL?>css/toastr.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="<?=WEB_META_BASE_URL?>css/demo.css">

	<!--     Fonts and icons     -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<meta property="fb:app_id" content="<?=$OMPage->getVar("fb_app_id")?>"/>
	<meta property="og:site_name" content="<?=$OMPage->getVar("og_site_name")?>"/>
	<meta property="og:type" content="<?=$OMPage->getVar("og_type")?>"/>
    <meta property="og:title" content="<?=$OMPage->getVar("og_title")?>"/>
    <meta property="og:description" content="<?=$OMPage->getVar("og_description")?>"/>
    <meta property="og:url" content="<?=$OMPage->omroute("current_url")?>"/>

	<?php
		if(isset($OMPage->sharedImage) && $OMPage->sharedImage != ""){
			if(count($OMPage->sharedImage) > 1){
				foreach ($OMPage->sharedImage as $path) {
	?>
    <meta property="og:image" content="<?=$OMPage->stocks($path)?>" ref="asarray" >
	<?php
				}
			}else{
	?>
    <meta property="og:image" content="<?=$OMPage->stocks($OMPage->sharedImage[0])?>" >
	<?php
			}
		}else{
	?>
	    <meta property="og:image" content="<?=$OMPage->stocks('images/layout/logo.jpg')?>" >
	<?php
		}
	?>

	<base href="<?=WEB_META_BASE_URL?>" />
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script type="text/javascript" src="<?=WEB_META_BASE_URL?>js/jquery.min.js"></script>
	<script type="text/javascript" src="<?=WEB_META_BASE_URL?>js/bootstrap.min.js"></script>

	<!-- twbsPagination -->
	<script type="text/javascript" src="<?=WEB_META_BASE_URL?>js/jquery.twbsPagination.min.js"></script>

	<script type="text/javascript" src="<?=WEB_META_BASE_URL?>js/material.min.js"></script>

	<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
	<script type="text/javascript" src="<?=WEB_META_BASE_URL?>js/nouislider.min.js"></script>

	<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
	<script type="text/javascript" src="<?=WEB_META_BASE_URL?>js/bootstrap-datepicker.js"></script>

	<!-- Lib Other -->
	<script type="text/javascript" src="<?=WEB_META_BASE_URL?>js/toastr.min.js"></script>
	<script type="text/javascript" src="<?=WEB_META_BASE_URL?>js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="<?=WEB_META_BASE_URL?>js/jquery.validate.min.js"></script>

	<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
	<script type="text/javascript" src="<?=WEB_META_BASE_URL?>js/material-kit.js"></script>


	<!--
	<script type="text/javascript">

		$().ready(function(){
			// the body of this function is in assets/material-kit.js
			materialKit.initSliders();
            window_width = $(window).width();

            if (window_width >= 992){
                big_image = $('.wrapper > .header');

				$(window).on('scroll', materialKitDemo.checkScrollForParallax);
			}
		});
	</script>
	-->
</head>
<body>

	<?php include $theme_dir . "body.tpl"; ?>

<script type="text/javascript">
	var LANG = '<?=LANG?>';
	// var BASE_URL = '<?=WEB_META_BASE_URL?>';
	var BASE_URL = '<?=WEB_META_BASE_URL?>';
	var BASE_LANG = '<?=WEB_META_BASE_LANG?>';
</script>
<script type="text/javascript" src="<?=WEB_META_BASE_URL?>js/comp.js<?=$OMPage->merge_media("js")?>"></script>
</body>
</html>