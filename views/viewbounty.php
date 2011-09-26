<?php include('header.php'); if(@!$FATAL_ERROR): ?>

  <h2><?php echo __(MSG_BOUNTY_X,$BOUNTY_DESC) ?></h2>
  <?php if($LOCKED): ?>
  <p><?php echo __(MSG_BOUNTY_LOCKED) ?></p>
  <?php endif ?>
  <table>
    <tr>
      <td>
	<?php echo __(MSG_DONATIONS_COLLECTED) ?>
      </td>


      <td>
	<?php echo $DONATED ?> 
          <?php if(!$LOCKED): ?>
          <a href="<?php echo $LINK_PREFIX.'/donate/id='.$BOUNTY_ID ?>">
            [<?php echo __(MSG_DONATE_BUTTON) ?>]
	  <?php endif ?>
          </a>
      </td>


    </tr>
    
    <tr>
      <td>
	<?php echo __(MSG_SOLUTIONS_TO_VOTE) ?>
      </td>
      
      <td>
	<?php echo $SOLUTIONS ?> 

        <?php if(!$LOCKED): ?>
        <a href="<?php echo $LINK_PREFIX.'/newsolution/id='.$BOUNTY_ID ?>">
          [<?php echo __(MSG_SUBMIT_BUTTON) ?>]
        </a>
        <?php endif ?>


	<a href="<?php echo $LINK_PREFIX.'/solutions/id='.$BOUNTY_ID?>">
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