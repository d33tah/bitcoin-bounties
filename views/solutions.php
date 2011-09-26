<?php include('header.php'); if(@!$FATAL_ERROR): ?>

  <h2><?php echo $BOUNTY_DESC ?></h2>

  <?php if (!isset($SUBMITENTRY)): ?>
  
    <?php echo __(MSG_NO_SOLUTIONS_YET) ?>

  <?php else: ?>

  <table>
    <tr>
      <td>
	      <?php echo __(MSG_AUTHOR) ?>
      </td>
      
      <td>
	      % <?php echo __(MSG_VOTES) ?>
      </td>
    </tr>
    
    <?php foreach($SUBMITENTRY as $ENTRY): extract($ENTRY) ?>
      <tr>
	<td>
	  <a href="<?php echo $LINK_PREFIX.'/viewsolution/id='.$SOLUTION_ID ?>">
	    <?php echo $AUTHOR ?>
	  </a>
	</td>
	
	<td>
	  <?php echo $PERCENT ?>
            <?php if($CAN_VOTE): ?> 
	    <a href="<?php echo $LINK_PREFIX.'/votesolution/id='.$SOLUTION_ID ?>">
	      [<?php echo __(MSG_VOTE_UP) ?>]
            <?php endif ?>

            <?php if($CAN_UNDO): ?> 
	    <a href="<?php echo $LINK_PREFIX.'/votesolution/id='.$SOLUTION_ID.
                "&mode=undo" ?>">
	      [<?php echo __(MSG_UNDO_VOTE) ?>]
            <?php endif ?>

	    </a>
	</td>
      </tr>
    <?php endforeach ?>
  </table>
  
  <?php endif ?>

<?php if(!$LOCKED): ?>
  <p>
    <a href="<?php echo $LINK_PREFIX.'/newsolution/id='.$BOUNTY_ID ?>">
      <?php echo __(MSG_ADDSOLUTION) ?>
    </a>
  </p>
<?php endif ?>


<?php endif; include('footer.php') ?>