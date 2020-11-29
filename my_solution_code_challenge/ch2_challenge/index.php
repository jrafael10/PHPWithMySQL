<?php require_once('../private/initialize.php'); ?>

<?php
if(isset($_GET['id'])){
  $page_id = $_GET['id'];
  $page = find_page_by_id($page_id);
  
  if(!$page){
    redirect_to(url_for('/index.php'));
  }

  $subject_id = $page['subject_id'];
  

}else {
  // nothing selected; Show the homepage
}


?>


<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">


<?php include(SHARED_PATH . '/public_navigation.php'); ?>


<div id="page">

  <?php

    if(isset($page)){
      //Show the page from the database
      //  TODO add html escaping back in
      echo $page['content'];
      //<!--if the query paramerter is $_GET['subject_id']-->
    }elseif(isset($nav_subject_id)){
        //Post the page of first page of each subject
      $pages = find_pages_by_subject_id($nav_subject_id);
        while($page = mysqli_fetch_assoc($pages)) {
          if($page['position'] == 1){
            echo $page['content'];
          }
          
        }
     
    } else {
    //Show the homepage
    //The homepage content could
    //*be static content (here or in a shared file)
    //*Show the first page from the nav
    //* be in the database but add code to hide in the nav


    include(SHARED_PATH . '/static_homepage.php');
    } 
  
  ?> 

</div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
