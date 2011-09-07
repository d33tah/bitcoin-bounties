<html>

<head>

	<?php echo $ENCODING ?>
	<title>
	<?php echo $TITLE ?>
	</title>

      <?php if(isset($REFRESH)): ?>
	<meta http-equiv="refresh" content="3; 
          url=<? echo $REFRESH ?>" />
      <?php endif ?>

      <?php echo $CSS ?>

</head>
	
<body>

	<?php echo $HEADER ?>
	<br /><?php echo $HOMELINK ?>
	
	<h1><?php echo $SHORT_TITLE ?></h1>
	<p><?php echo $MESSAGE ?></p>
</body>
</html>