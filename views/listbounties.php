<?php include('header.php'); if(@!$FATAL_ERROR): ?>

  <?php if (!isset($BOUNTYENTRY)): ?>
  
    <?php echo __(MSG_NO_BOUNTIES_YET) ?>

  <?php else: ?>

  <table width="650">
    <tr>
    <td>
      <?php echo __(MSG_DESCRIPTION) ?>
    </td>
    
    <td>
      <?php echo __(MSG_COLLECTED) ?>
    </td>
    </tr>
    
    <?php foreach($BOUNTYENTRY as $ENTRY): extract($ENTRY) ?>
    <tr>
      <td<?php if($LOCKED) echo ' class="locked"' ?>>
        <?php if($LOCKED) echo ' &#10003; ' ?>
	<?php echo $DESC ?>
      </td>
      
      <td>
	<?php echo $COLLECTED ?>
      </td>
    </tr>
    <?php endforeach ?>
  </table>

  <?php endif ?>
  
<div id="featured">
       <a href="<?php echo $LINK_PREFIX ?>/newbounty/" class="join-today"><strong><?php echo __(MSG_ADD_BOUNTY) ?></strong><span><?php echo __(MSG_SUB_ADD_BOUNTY) ?></span></a>
</div>


<?php endif; include('footer.php') ?>