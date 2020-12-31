<!-- Section 3 movie 1
    HTTP Header

We can use php to give instruction 
to web server on how to construct this header. 
We do that using the header function 
header($string);
$string can be any line added to the header 
ex: 
header("Content-Type: application/pdf");
->THis tells the content-type should not be html 
but they're about to send a pdf file. 
ex:
header("HTTP/1.1 404 Not Found");
or
header("HTTP/1.1 500 Internal Server Error");
->Responding to browser with an error message 

Notes: 
-Headers are sent before page data
-Changes must be made before any HTML output
    Before a single space or line return 
    Before whitespace in included files 
    Can come after whitespace inside PHP tags


Section3 Movie 2 Page Redirection 

-302 redirect 
 2 parts of 302 redirection 

1: HTTP 1.1/302 Found 
2: Location: path ->indicating the new url 
that the browser should tru y instead

-header("Location: login.php");

Example 
-User submits username/password on a log in page 
-PHP code checks the user credentials 

-If correct, user is sent to a success page.
-If incorrect, user sent to a failure page.

Caveat: 
-Page redirects are sent in headers information
-Headers are sent before page data. 
-THerefore, changes must be made before any HTML output.
-Page redirects must be sent before any HTML output. 

    
-->

<?php
 require_once('../../../private/initialize.php');
 require_login();
 if(is_post_request()) {

  // Handle form values sent by new.php

 $subject = [];
 $subject['menu_name'] = $_POST['menu_name'] ?? '';
$subject['position'] = $_POST['position'] ?? '';
$subject['visible'] = $_POST['visible'] ?? '';

$result = insert_subject($subject);

if($result === true) {
  $new_id = mysqli_insert_id($db);
  $_SESSION['message'] = 'The subject was created successfully.';
  redirect_to(url_for('/staff/subjects/show.php?id=' . $new_id));


  } else {
   $errors = $result;
}

} else {

  // display the blank form
}




$subject_set = find_all_subjects();

$subject_count = mysqli_num_rows($subject_set) + 1;
//$subject_count = mysqli_num_rows($subject_set) + 1;
mysqli_free_result($subject_set);
$subject = [];
$subject["position"] = $subject_count;

?>

<?php $page_title = 'Create Subject'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/subjects/index.php'); ?>">&laquo; Back to List</a>

  <div class="subject new">
    <h1>Create Subject</h1>

    <?php echo display_errors($errors); ?>
    <form action="<?php echo url_for("/staff/subjects/new.php"); ?>" method="post">
      <dl>
        <dt>Menu Name</dt>
        <dd><input type="text" name="menu_name" value="" /></dd>
      </dl>
      <dl>
        <dt>Position</dt>
        <dd>
          <select name="position">
              <?php

              for($i = 1; $i <= $subject_count; $i++) {
              echo "<option value=\"{$i}\"";
              if($subject['position'] == $i) {
              echo " selected";
              }
              echo ">{$i}</option>";
              }
              ?>

          </select>
        </dd>
      </dl>
      <dl>
        <dt>Visible</dt>
        <dd>
          <input type="hidden" name="visible" value="0" />
          <input type="checkbox" name="visible" value="1" />
        </dd>
      </dl>
      <div id="operations">
        <input type="submit" value="Create Subject" />
      </div>
    </form> 

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>


