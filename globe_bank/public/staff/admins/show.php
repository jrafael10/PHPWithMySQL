<?php


require_once('../../../private/initialize.php');
echo $_SESSION['message'];
require_login();

?>

<!--
    u ->urlencode
    h ->htmlspecialchars
-->

<?php
    $id = isset($_GET['id']) ? $_GET['id'] : '1';
    $admin = find_admin_by_id($id);
    

     //print_r($result['menu_name']);







?>
<?php $page_title = 'Show Admin'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    
<!--&laquo is the back arrow html entity -->
    <a class="back-link" href="<?php echo url_for('/staff/admins/index.php')?>">&laquo; Back to List</a>


    <div class="admin show">
        <div class="attributes">

           
            <dl>
                <dt>
                    Admin ID:
                </dt>
                <dd>
                    <?php echo h($admin['id']); ?>
                </dd>
            </dl>
            <dl>
                <dt>
                    First name:
                </dt>
                <dd>
                    <?php echo h($admin['first_name']) ?>
                </dd>
            </dl>
            <dl>
                <dt>Last name:</dt>
                <dd><?php echo h($admin['last_name'])?></dd>
            </dl>
            <dl>
                <dt>Email</dt>
                <dd><?php echo h($admin['email'])?></dd>
            </dl>
            <dl>
                <dt>Username</dt>
                <dd><?php echo h($admin['username']) ?></dd>
            </dl>

            <!--<dl>
                <dt>Password </dt>
                <dd><?php echo h($admin['password']) ?></dd>
            </dl>-->

        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
<!---
<a href="show.php?name=<?php echo u('Jesse Rafael'); ?>">Link</a> <br />
<a href="show.php?name=<?php echo u('Widgets&More'); ?>">Link</a> <br />
<a href="show.php?name=<?php echo u('!#*?'); ?>">Link</a> <br />
-->