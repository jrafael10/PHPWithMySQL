<?php 
require_once('../../../private/initialize.php');
require_login();
/*
if(isset($_GET['id'])) {
    redirect_to(url_for('/staff/pages/index.php'));

}*/


if(is_post_request()){
    $page = [];
    $page['subject_id'] = $_POST['subject_id'] ?? '';
    $page['menu_name'] = $_POST['menu_name'] ?? '';
    $page['position'] = $_POST['position'] ?? '';
    $page['visible'] = $_POST['visible'] ?? '';
    $page['content'] = $_POST['content'] ?? '';

    $result = insert_page($page);

    if($result === true){
        $new_id = mysqli_insert_id($db);
        $_SESSION['message'] = "The page was created successfully.";
        redirect_to(url_for('/staff/pages/show.php?id=' . $new_id));
    } else {
        $errors = $result;
    }

    

} else {

     // display the blank form
     $page = [];
     $page['subject_id'] = $_GET['subject_id'] ?? '1';
     $page['menu_name'] = '';
     $page['position'] = '';
     $page['visible'] = '';
     $page['content'] = '';
   
}

    $page_set = find_all_pages();
    //print_r($page_set);
    $page_count = mysqli_num_rows($page_set) + 1;
    mysqli_free_result($page_set);

//print_r(mysqli_fetch_assoc($page_set));


$page['position'] = $page_count;
// /$page['subject_id'] = '';







$one_subject = find_subject_id_and_subject();
/*
while($row = mysqli_fetch_assoc($one_subject)) {
    print_r($row['menu_name']);
}
*/


?>

<?php $page_title = 'Create Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
   
    <a class="back-link" href="<?php echo url_for('/staff/subjects/show.php?id=' . h(u($page['subject_id'])))?>">&laquo; Back to Subject Page</a>

    <div class="page new">
      <h1>Create Page</h1>

      <?php echo display_errors($errors); ?>   
      <form action="<?php echo url_for("/staff/pages/new.php"); ?>" method = "post" >
        <dl>
            <dt>Menu Name</dt>
            <dd><input type="text" name="menu_name" value="<?php if(isset($_POST['menu_name'])) echo $_POST['menu_name'];?>"/></dd>
        </dl>
        <dl>
            <dt>Position</dt>
            <dd>
                <select name ="position">
                    <?php
                        $i = 1;
                    while($i <=$page_count) {
                       echo "<option value =\" {$i}\"";
                       if($page['position'] == $i) {
                           echo " selected";    
                       }
                       echo ">{$i}</option>";
                        $i++;
                    }
                    ?>
                </select>
            </dd>
        </dl>
        <dl>
            <dt>Visible</dt>
            <dd>
            <input type="hidden" name="visible" value="0" <?php  ?> />
            <input type="checkbox" name="visible" value="1" <?php  ?>/>
                          
            </dd>
        </dl>

        <dl>
            <dt>Subject Name</dt>

            <dd>
                <select name = "subject_id">
                    <?php

                    $subject_count = mysqli_num_rows($subject_set);
                    $subject_set= find_all_subjects();
                    while($subject = mysqli_fetch_assoc($subject_set)){
                    echo "<option value=\"" . h($subject['id']) . "\"";

                    if($page['subject_id'] == $subject['id']){
                        echo " selected";
                    }

                        echo ">" . h($subject['menu_name']) . "</option>";
                    }
                    mysqli_free_result($subject_set);
                    ?>
                </select>


            </dd>
        </dl>

          <dl>
              <dt>Content</dt>
              <dd><textarea type="text" name="content" value=""><?php if(isset($_POST['content'])) echo $_POST['content'];?></textarea></dd>
          </dl>


        <div id="operations">
            <input type ="submit" value="Create Page" />
        </div>

      </form>



    </div>


</div>

<?php include(SHARED_PATH. '/staff_footer.php'); ?>