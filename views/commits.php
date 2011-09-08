<?php include('header.php'); if(@!$FATAL_ERROR): ?>

  <h2><?php echo $BOUNTY_DESC ?></h2>

  <?php if (!isset($SUBMITENTRY)): ?>
  
    <?php echo __(MSG_NO_COMMITS_YET) ?>

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
    
    <?php foreach($SUBMITENTRY as $ENTRY): ?>
      <tr>
	<td>
	  <a href="<?php echo $LINK_PREFIX.'/viewcommit/id='
              .$ENTRY['COMMIT_ID'] ?>">
	    <?php echo $ENTRY['AUTHOR'] ?>
	  </a>
	</td>
	
	<td>
	  <?php echo $ENTRY['PERCENT'] ?> 
	    <a href="<?php echo $LINK_PREFIX.'/votecommit/id='.
                $ENTRY['COMMIT_ID'] ?>">
	      [<?php echo __(MSG_VOTE_UP) ?>]
	    </a>
	</td>
      </tr>
    <?php endforeach ?>
  </table>
  
  <?php endif ?>
  
  <p>
    <a href="<?php echo $LINK_PREFIX.'/newcommit/id='.$BOUNTY_ID ?>">
      <?php echo __(MSG_ADDCOMMIT) ?>
    </a>
  </p>

<?php endif; include('footer.php') ?>