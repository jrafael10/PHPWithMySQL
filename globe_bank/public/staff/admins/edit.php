<?php 
require_once('../../../private/initialize.php');

if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/admins/index.php'));

}

$id = $_GET['id']; 

//default values for form 

$first_name = '';
$last_name = '';
$email = '';
$username = '';
$password = '';




if(is_post_request()) {

    $admin = [];
    $admin['id'] = $id;
    $admin['first_name'] = $_POST['first_name'];
    $admin['last_name'] = $_POST['last_name'];
    $admin['email'] = $_POST['email'];
    $admin['username'] = $_POST['username'];
    $admin['password'] = $_POST['password'];
    $admin['confirm_password'] = $_POST['confirm_password'];


   $result =  update_admin($admin);

  if($result === true){
    $_SESSION['message'] = 'This admin has been successfully edited';
    redirect_to(url_for('/staff/admins/show.php?id=' . $id));
  }  else {
      $errors = $result;
  } 
    

} else {
   
    $admin = find_admin_by_id($id);
    
    
    
}

$admin_set = find_all_admins();
$admin_count = mysqli_num_rows($admin_set); 
mysqli_free_result($admin_set);


    


?>


<?php $page_title = 'Edit Admin'; ?> 

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id = "content">

    <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List </a> 

    <div class = "Admin edit">
        <h1>Edit Admin </h1>


        <?php echo display_errors($errors); ?>
        <form action = "<?php echo url_for('/staff/admins/edit.php?id=' .h(u($id))); ?>" method = "post">
            <dl>
                <dt>First Name</dt>
                <dd><input type="text" name="first_name" value="<?php if(isset($admin['first_name'])) echo h($admin['first_name']); ?>" /></dd>
            </dl>

            <dl>
                <dt>Last Name</dt>
                <dd><input type="text" name="last_name" value="<?php if(isset($admin['last_name'])) echo h($admin['last_name']); ?>" /></dd>
            </dl>

            <dl>
                <dt>Email</dt>
                <dd><input type="text" name="email" value="<?php if(isset($admin['email'])) echo h($admin['email']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Username</dt>
                <dd><input type="text" name="username" value="<?php if(isset($admin['username'])) echo h($admin['username']); ?>" /></dd>
            </dl>
            <dl>
                <dt>Password</dt>
                <dd><input type="text" name="password" value="<?php if(isset($admin['password'])) echo h($admin['password']); ?>" /></dd>
            </dl>

            <dl>
                <dt>Confirm Password</dt>
                <dd><input type="text" name="confirm_password" value="<?php if(isset($admin['password'])) echo h($admin['password']); ?>" /></dd>
            </dl>






            <div id="operations">
                <input type="submit" value="Edit Admin" />
            </div>
      
        </form>
    </div>


</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>