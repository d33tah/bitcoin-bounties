<?php include('header.php'); if(@!$FATAL_ERROR): ?>

    <?php 
      //A NOTE TO THE FRONTEND DEVELOPER:
      //please see functions.php in the main script directory for form html.
      //it's in the login_form function
      echo $LOGIN_FORM 
    ?>

<?php endif; include('footer.php') ?>