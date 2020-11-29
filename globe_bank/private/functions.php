    <?php

function url_for($script_path){
  //add the leading '/' if not present

if($script_path[0] != '/'){
  
  $script_path = "/" . $script_path;
}

//echo WWW_ROOT .$script_path;


return WWW_ROOT . $script_path;

}

//function that encodes special characters
 function u($string=""){
    return urlencode($string);
 }

 function raw_u($string=""){
  return rawurlencode($string);
}

//
function h($string=""){
  return htmlspecialchars($string);
}

function error_404(){
  //asking  what the current server protocol is
  header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
  //saying "don't do any additional PHP, we're done."
  //Just send what you got to the browser
  exit();

}

function error_500(){
  header($_SERVER["SERVER_PROTOCOL"] . " 500 Internal Server Error");
  //saying "don't do any additional PHP, we're done."
  //Just send what you got to the browser
  exit();

}

function redirect_to($location) {
  header("Location: " . $location);
    //making sure that no php code is executed
    //after page redirection
    exit;
}


//functions that check whether if form submitted is a POST or GET request
function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function is_get_request() {
  return $_SERVER['REQUEST_METHOD'] === 'GET'; 
}

function display_errors($errors=array()){
  $output = '';

  if(!empty($errors)){
    $output .= "<div class=\"errors\">";
    $output .= "Please fix the following errors:";
    $output .= "<ul>";
    foreach($errors as $error){
      $output .= "<li>" . h($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  }
  return $output;
}


/*function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars) {
  echo $e_number;
  echo $e_message;
  echo "There's an error in the system. Sorry for the inconvenience.";
}*/

function get_and_clear_session_message(){
  if(isset($_SESSION['message']) && $_SESSION['message'] != ''){
    $msg = $_SESSION['message'];
    unset($_SESSION['message']);
    return $msg;
  }

  
}


function display_session_message(){
  $msg = get_and_clear_session_message();
  if(!is_blank($msg)){
    return '<div id="message">' . h($msg) . '</div>';
  }
}

 



?>
