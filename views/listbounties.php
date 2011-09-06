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
  
  <h1><?php echo $SHORT_TITLE ?></h1>

  <?php if (!isset($BOUNTYENTRY)): ?>
  
    <?php echo __(MSG_NO_BOUNTIES_YET) ?>

  <?php else: ?>

  <table>
    <tr>
    <td>
      <?php echo __(MSG_DESCRIPTION) ?>
    </td>
    
    <td>
      <?php echo __(MSG_COLLECTED) ?>
    </td>
    </tr>
    
    <?php foreach($BOUNTYENTRY as $ENTRY): ?>
    <tr>
      <td>
	<?php echo $ENTRY['DESC'] ?>
      </td>
      
      <td>
	<?php echo $ENTRY['COLLECTED'] ?>
      </td>
    </tr>
    <?php endforeach ?>
  </table>

  <?php endif ?>
  
  <p>
    <a href="<?php echo $LINK_PREFIX ?>/newbounty/">
      <?php echo __(MSG_ADD_BOUNTY) ?>
    </a>
  </p>
</html>
</body>