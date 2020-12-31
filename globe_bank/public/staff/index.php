
<!-- navigating to initialize.php-->
<!--".."means backward(going back to the parent directory until reaching the
  initialize.php. We're working with the file system here -->

<!--Can't use PRIVATE_PATH as initialize.php is where all these
constants are defined.-->
<?php require_once('../../private/initialize.php');  ?>

<?php //unset($_SESSION['admin_id']) ?>
<?php require_login(); ?>




<?php $page_title = 'Staff Menu'; ?>
<!--Note: $page_title variable is available to header.php, which means
header.php can access that variable -->
<!--Finding the SHARED_PATH folder-->
<?php include(SHARED_PATH . '/staff_header.php'); ?>
    <div id="content">
      <div id="main-menu">
        <h2>Main Menu</h2>
        <ul>
          <!--using a relative path for the link to make it work-->
          <!--<li><a href="subjects/index.php">Subjects</a> -->
          <li><a href="<?php echo url_for('/staff/subjects/index.php') ?>">Subjects</a>
          </li>
         
          </li>
          <li><a href="<?php echo url_for('/staff/admins/index.php') ?>">Admins</a>
          </li>
        </ul>
      </div>


    </div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
