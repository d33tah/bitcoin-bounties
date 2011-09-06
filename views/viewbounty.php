<html>

<head>

  <?php echo $ENCODING ?>
  <title>
  <?php echo $TITLE ?>
  </title>

  <?php echo $CSS ?>
</head>
	
<body>

  <?php echo $HEADER ?>
  <br /><?php echo $HOMELINK ?>
  
  <h1><?php echo $SHORT_TITLE ?></h1>
  <h2><?php echo $BOUNTY_DESC ?></h2>
  <table>
    <tr>
      <td>
	<?php echo __(MSG_DONATIONS_COLLECTED) ?>
      </td>
      <td>
	<?php echo $DONATED ?> 
          <a href="<?php echo $LINK_PREFIX.'/donate/id='.$BOUNTY_ID ?>">
            [<?php echo __(MSG_DONATE_BUTTON) ?>]
          </a>
      </td>
    </tr>
    
    <tr>
      <td>
	<?php echo __(MSG_SUBMISSIONS_TO_VOTE) ?>
      </td>
      
      <td>
	<?php echo $SUBMISSIONS ?> 

        <a href="<?php echo $LINK_PREFIX.'/newcommit/id='.$BOUNTY_ID ?>">
          [<?php echo __(MSG_SUBMIT_BUTTON) ?>]
        </a>

	<a href="<?php echo $LINK_PREFIX.'/commits/id='.$BOUNTY_ID?>">
          [<?php echo __(MSG_VIEW_BUTTON) ?>]
        </a>

      </td>
    </tr>
    
    <tr>
      <td>
	<?php echo __(MSG_DESCRIPTION) ?>
      </td>
      
      <td>
	<?php echo $DESCRIPTION ?>
      </td>
    </tr>
  </table>
</body>
</html>