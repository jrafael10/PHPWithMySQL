<?php  require_once('../../../private/initialize.php');

if(is_post_request()){
    $admin = [];
    $admin['first_name'] = $_POST['first_name'];
    $admin['last_name'] = $_POST['last_name'];
    $admin['email'] = $_POST['email'];
    $admin['username'] = $_POST['username'];
    $admin['password'] = $_POST['password'];
    $admin['confirm_password'] = $_POST['confirm_password'];
}



?>


<?php $page_title = 'Create Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <a class = "back-link" href = "<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List </a>

    <div class="admin new">
      <h1>Create Admin</h1>

      <?php echo display_errors($errors); ?>   
      <form action="<?php echo url_for("/staff/admins/new.php"); ?>" method = "post" >
        <dl>
            <dt>First Name</dt>
            <dd><input type="text" name="first_name" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name'];?>"/></dd>
        </dl>
        <dl>
            <dt>Last Name</dt>
            <dd><input type="text" name="last_name" value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name'];?>"/></dd>

        </dl>
        <dl>
            <dt>Email</dt>
            <dd><input type="text" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>"/></dd>
        </dl>
        <dl>

             <dt>Username</dt>
            <dd><input type="text" name="username" value="<?php if(isset($_POST['username'])) echo $_POST['username'];?>"/></dd>

            
        </dl>

        <dl>

            <dt>Password</dt>
            <dd><input type="text" name="password" value="<?php if(isset($_POST['password'])) echo $_POST['password'];?>"/></dd>


        </dl>

        <dl>

            <dt>Confirm Password</dt>
            <dd><input type="text" name="confirm_password" value="<?php if(isset($_POST['password'])) echo $_POST['password'];?>"/></dd>


        </dl>
        
         


        <div id="operations">
            <input type ="submit" value="Create Admin" />
        </div>

      </form>



    </div>


</div>

<?php include(SHARED_PATH. '/staff_footer.php'); ?>