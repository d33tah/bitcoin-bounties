<?php include('header.php'); if(@!$FATAL_ERROR): ?>

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

<?php endif; include('footer.php') ?>