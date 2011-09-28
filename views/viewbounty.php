<?php include('header.php'); if(@!$FATAL_ERROR): ?>

  <h2 class="title"><?php echo __(MSG_BOUNTY_X,$BOUNTY_DESC) ?></h2>

  <br />

  <?php if($LOCKED): ?>
  <p><?php echo __(MSG_BOUNTY_LOCKED) ?></p>
  <?php endif ?>

       <h4><?php echo __(MSG_DONATIONS_COLLECTED) ?></h4>
       <p> <?php echo $DONATED ?>

       <?php if(!$LOCKED): ?> <a href="<?php echo $LINK_PREFIX.'/donate/id='.$BOUNTY_ID ?>">
               [<?php echo __(MSG_DONATE_BUTTON) ?>]
       </a>
       <?php endif ?></p>


       <h4><?php echo __(MSG_SOLUTIONS_TO_VOTE) ?></h4>


       <p> <?php echo $SOLUTIONS ?>

        <?php if(!$LOCKED): ?>
        <a href="<?php echo $LINK_PREFIX.'/newsolution/id='.$BOUNTY_ID ?>">
          [<?php echo __(MSG_SUBMIT_BUTTON) ?>]
        </a>
        <?php endif ?>


	<a href="<?php echo $LINK_PREFIX.'/solutions/id='.$BOUNTY_ID?>">
          [<?php echo __(MSG_VIEW_BUTTON) ?>]
        </a>

    </p>
    

       <h4><?php echo __(MSG_DESCRIPTION_COLON) ?></h4>


       <p> <?php echo $DESCRIPTION ?></p>


<?php endif; include('footer.php') ?>