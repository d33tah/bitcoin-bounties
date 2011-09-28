<html>

<head>

  <title>
  <?php echo $TITLE ?>
  </title>

  <link rel="icon" href="<?php echo $LINK_PREFIX ?>/favicon.png"
    type="image/png" />

  <link rel="stylesheet" href="<?php echo $LINK_PREFIX ?>/res/style.css" type="text/css">
  <script type="text/javascript" src="<?php echo $LINK_PREFIX ?>/res/js/jquery.js"></script>
  <script type="text/javascript" src="<?php echo $LINK_PREFIX ?>/res/js/superfish.js"></script>
  <!--[if lt IE 7]>
       <link rel="stylesheet" type="text/css" href="<?php echo $LINK_PREFIX ?>/res/css/ie6style.css" />
       <script type="text/javascript" src="<?php echo $LINK_PREFIX ?>/res/js/DD_belatedPNG_0.0.8a-min.js"></script>
       <script type="text/javascript">DD_belatedPNG.fix('img#logo, span.menu_arrow, a#search img, #searchform, .featured-img span.overlay, featured .video-slide, #featured a.join-today, div#contro
<![endif]-->
<!--[if IE 7]>
       <link rel="stylesheet" type="text/css" href="<?php echo $LINK_PREFIX ?>/res/css/ie7style.css" />
<![endif]-->
<!--[if IE 8]>
       <link rel="stylesheet" type="text/css" href="<?php echo $LINK_PREFIX ?>/res/css/ie8style.css" />
<![endif]-->

<script type="text/javascript">
       document.documentElement.className = 'js';
</script>

  <?php if(isset($REFRESH)): ?>
    <meta http-equiv="refresh" content="3; 
      url=<? echo $REFRESH ?>" />
  <?php endif ?>

</head>
	
<body id="home">
<div id="center-highlight">
               <div id="header">
                       <div class="container clearfix">
                               <a href="<?php echo $LINK_PREFIX ?>">
                                       <img src="<?php echo $LINK_PREFIX ?>/res/images/logo.png" alt="Bitcoin Bounties Logo" id="logo"/>
                               </a>
<ul id="top-menu" class="nav">
<li <?php if($VIEWNAME=='listbounties'): ?>class="current_page_item"<?php else: ?>class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home"<?php endif ?>><a href="<?php echo $LINK_PREFIX ?>">Home</a></li>
</ul>

<div id="user-info">


  <?php if($USERNAME): ?>
  
    <?php echo __(MSG_LOGGED_IN_AS,'<strong>'.$USERNAME.'</strong>') ?>
    <br />

    <a href="<?php echo $LINK_PREFIX ?>/login/mode=logout">
      [<?php echo __(MSG_LOGOUT_BUTTON) ?>]
    </a>
  
  <?php else: ?>
  
    <a href="<?php echo $LINK_PREFIX ?>/login/"><?php echo __(MSG_LOGIN_BUTTON) ?></a>
 |
    <a href="<?php echo $LINK_PREFIX ?>/signup/"><?php echo __(MSG_SIGN_UP_BUTTON) ?></a>

  
  <?php endif ?>
               </div> <!-- end #search-form -->
                       </div> <!-- end .container -->
                               </div> <!-- end #header -->
<div id="main-content">

       <div class="container clearfix">
               <div id="entries-area">
                       <div id="entries-area-inner">
                               <div id="entries-area-content" class="clearfix">
                                       <div id="content-area">
  <?php if($VIEWNAME!='listbounties'): ?>
    <!-- <a href="<?php echo $LINK_PREFIX ?>/">
      <?php echo __(MSG_BACK_TO_HOMEPAGE) ?>
    </a>-->
  <?php endif ?>

  <?php if(isset($BREADCRUMBS)): ?>
    <?php foreach ($BREADCRUMBS as $BREADCRUMB): ?>
      &#8656;
      <a href="<?php echo $BREADCRUMB['URL']?> ">
	<?php echo $BREADCRUMB['NAME'] ?>
      </a>
    <?php endforeach; ?>
  <?php endif; ?>
  <h1><?php echo @$SHORT_TITLE ? @$SHORT_TITLE : $TITLE ?></h1>
  <br />
  <?php if(isset($FATAL_ERROR)): ?>
    <?php echo $FATAL_ERROR ?>
  <?php else: ?>
    <?php echo @$ERROR_MESSAGE ?>
  <?php endif ?>

