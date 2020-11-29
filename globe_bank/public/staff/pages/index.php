

<?php require_once('../../../private/initialize.php')?>

<?php

        //confirm_db_connect();
        $page_set = find_all_pages();


        $subject_set = find_subject_id_and_subject();


       $subject = mysqli_fetch_assoc($subject_set);

?>

<?php $page_title = 'Pages'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
    <div class="pages listing">    
     

        <h1>Pages</h1>

       <div class="actions">
           <a class="action" href="<?php echo url_for('/staff/pages/new.php') ?>">Create New Page</a>
        </div>
         <table class="list">
        
          <tr>
            <th>Page ID</th>
            <th>Subject ID</th>
            <th>Subject Name</th>
            <th>Page Position</th>
            <th>Page Visible</th>
  	        <th>Page Name</th>
            <th>&nbsp;</th>
  	        <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>

          <?php while($page = mysqli_fetch_assoc($page_set)) {

              $pageSubjectName = find_subject_by_page_subject_id($page['subject_id']);
              ?>
          <tr>
          
            <td><?php echo h($page['id']);?></td>

            <td><?php echo h($page['subject_id'])?></td>
              <td><?php echo $pageSubjectName['menu_name']?></td>
            <td><?php echo h($page['position']); ?> </td>
            <td><?php echo $page['visible'] == 1 ? 'true': 'false'; ?></td>
            <td><?php echo h($page['menu_name']);?> </td>
            <td><a class="action" href="<?php echo url_for('/staff/pages/show.php?id=' . h(u($page['id'])));?>">View</a></td>
            <td><a class="action" href="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($page['id']))); ?>">Edit</a></td>
            <td><a class="action" href="<?php echo url_for('/staff/pages/delete.php?id=' . h(u($page['id'])));?>">Delete</a></td>
           </tr> 
          <?php } ?>
        </table>

          <?php
            mysqli_free_result($page_set);
          ?> 
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>

<script>
let footer = document.querySelector('footer'); 
footer.style.backgroundC3olor=  "black";

console.log(footer);


</script>


<?php 
/*
Challenge: Validations
-Write validate_page() function 
-validate data before creating a page
-validate data before update a page
-Display errors on /staff/pages/new.php
-Display errors on /staff/pages/edit.php
-Submitted values are redisplayed
-All form options render correctly
-Bonus: Validate has_unique_page_menu_name();
-Advanced: What validation could be useful before deleting a subject record

*/

?>
