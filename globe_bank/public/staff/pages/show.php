<?php
require_once('../../../private/initialize.php');

?>

<!--
    u ->urlencode
    h ->htmlspecialchars
-->

<?php
    $id = isset($_GET['id']) ? $_GET['id'] : '1';
    $page = find_page_by_id($id);
    $page_subject_id = $page['subject_id'];
    $subject = find_subject_by_page_subject_id($page_subject_id);

     //print_r($result['menu_name']);







?>
<?php $page_title = 'Show Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    
<!--&laquo is the back arrow html entity -->
    <a class="back-link" href="<?php echo url_for('/staff/pages/index.php')?>">&laquo; Back to List</a>


    <div class="page show">
        <div class="attributes">

            <dl>
                <dt>
                   Preview
                </dt>
                <dd>
                <div class="actions">
                     <a class="action" target="_blank" href="<?php echo url_for('/index.php?preview=true&&id=' .h(u($page['id'])));?>">Preview</a>
                </div>
                </dd>
            </dl>
            <dl>
                <dt>
                    Page ID:
                </dt>
                <dd>
                    <?php echo h($page['id']); ?>
                </dd>
            </dl>
            <dl>
                <dt>
                    Menu Name:
                </dt>
                <dd>
                    <?php echo h($page['menu_name']) ?>
                </dd>
            </dl>
            <dl>
                <dt>Subject ID</dt>
                <dd><?php echo h($page['subject_id'])?></dd>
            </dl>
            <dl>
                <dt>Visible</dt>
                <dd><?php echo h($page['visible'] == '1' ? 'true' : 'false')?></dd>
            </dl>
            <dl>
                <dt>Subject name: </dt>
                <dd><?php echo h($subject['menu_name']) ?></dd>
            </dl>

            <dl>
                <dt>Position: </dt>
                <dd><?php echo h($page['position']) ?></dd>
            </dl>


           
            <dl>
                <dt>
                    Content
                </dt>
                <dd>
                    <?php echo h($page['content']) ?>
                </dd>
            </dl>
        </div>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
<!---
<a href="show.php?name=<?php echo u('Jesse Rafael'); ?>">Link</a> <br />
<a href="show.php?name=<?php echo u('Widgets&More'); ?>">Link</a> <br />
<a href="show.php?name=<?php echo u('!#*?'); ?>">Link</a> <br />
-->