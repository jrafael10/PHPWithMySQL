<?php 

require_once('../../../private/initialize.php');

require_login();


if(!isset($_GET['id'])) {
    redirect_to(url_for('/staff/admins/index.php'));
}

$id = $_GET['id'];

if(is_post_request()) {
    echo "delete";
    $result = delete_admin($id);
    $_SESSION['message'] = 'An admin has been successfully deleted';
    redirect_to(url_for('/staff/admins/index.php'));
} else {
    $admin = find_admin_by_id($id);
}




?>


<div id="content">

    <a class="back-link" href="<?php echo url_for('/staff/admins/index.php'); ?>">&laquo; Back to List</a>

    <div class="Admin delete">
        <h1>Delete Admin</h1>
        <p>Are you sure you want to delete this Admin?</p>
        <p class="item"><?php echo h($admin['first_name']) . " " . h($admin['last_name']); ?></p>

        <form action="<?php echo url_for('/staff/admins/delete.php?id=' . h(u($admin['id']))); ?>" method="post">
            <div id="operations">
                <input type="submit" name="commit" value="Delete Admin" />
            </div>
        </form>
    </div>

</div>