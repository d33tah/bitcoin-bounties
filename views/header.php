<html>

<head>

  <title>
  <?php echo $TITLE ?>
  </title>

  <link rel="stylesheet" href="<?php echo $LINK_PREFIX ?>/style.css"
    type="text/css">

  <?php if(isset($REFRESH)): ?>
    <meta http-equiv="refresh" content="3; 
      url=<? echo $REFRESH ?>" />
  <?php endif ?>

</head>
	
<body>

  <?php if($USERNAME): ?>
  
    <?php echo __(MSG_LOGGED_IN_AS,$USERNAME) ?>

    <a href="<?php echo $LINK_PREFIX ?>/login/mode=logout">
      [<?php echo __(MSG_LOGOUT_BUTTON) ?> ]
    </a>
  
  <?php else: ?>
  
    <a href="<?php echo $LINK_PREFIX ?>/login/">
      <?php echo __(MSG_LOGIN_BUTTON) ?>
    </a>

    <a href="<?php echo $LINK_PREFIX ?>/signup/">
      <?php echo __(MSG_SIGN_UP_BUTTON) ?>
    </a>
  
  <?php endif ?>

  <br />

  <?php if($VIEWNAME!='listbounties'): ?>
    <a href="<?php echo $LINK_PREFIX ?>/">
      <?php echo __(MSG_BACK_TO_HOMEPAGE) ?>
    </a>
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
  
  <?php if(isset($FATAL_ERROR)): ?>
    <?php echo $FATAL_ERROR ?>
  <?php else: ?>
    <?php echo @$ERROR_MESSAGE ?>
  <?php endif ?>

