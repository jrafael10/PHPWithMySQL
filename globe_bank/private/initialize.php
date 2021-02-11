<!--
    Section 3 Movie 3 : Output Buffering
PHP code send data 
then web server receives the output. 

Think of a faucet(php code) pouring water on the glass(web server)
As soon as the web server receives its first drops of data, it creates 
the headers for the data and they can't be changed. Once the php code is complete,
web server takes the accumulated data and send it to the users browser. 

Output buffer: 

output from the php code goes into the output buffer and then when it's full, or 
when the php code is done, we take all of that data in the buffer, and we pour it into
the web server. Then web server returns the data into the user's web browser just like before 

Output Buffering 
-Data in output buffer is editable 
-Headers can be changed. 
-Whitespace can be sent before header edits and redirects. 

use phpinfo to check information about output buffering 

You can turn on and off outout buffering 
through php functions
ob_start() ->starts out with buffering. THis 
has to come before any content. THe same as headers 
You can use it a second time if you've already got it turned on in your PHP file.

ob_end_flush(); -> ends buffering and flushes 
whatever result have accumulated over to the web server. 

-Best to turn output buffering in in php.ini file
-Use ob_start() when code may be ported to other servers 
-


 -->   

<?php

ob_start(); //lets us know that output buffering is turned on
//now it's buffering the page contents and at the end, it's taking those 
//and flushing them to the web server and web server is returning them to the web 
//browser.
session_start(); //turn on sessions

echo "jessel";

//Assign file paths to PHP constants
// __FILE__ returns the current path to this file
// dirname() returns the path to the parent Directory

//Defining constants
define("PRIVATE_PATH", dirname(__FILE__)); //private
define("PROJECT_PATH", dirname(PRIVATE_PATH)); //globe_bank
define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("SHARED_PATH", PRIVATE_PATH . '/shared');

//echo PRIVATE_PATH;


//Assign the root URL to a PHP constant
// * Do not need to include the Domain
// * Use same document root as web server
//* Can set a hardcoded value;
// define("WWW_ROOT", '/globe_bank/public');
//define("WWW_ROOT", '');
// * Can dynamically find everything in URL up to "/public"

$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7; //returns 7

//echo $_SERVER['SCRIPT_NAME'] . "</br>";
//echo $public_end .'</br>';


$doc_root = substr($_SERVER['SCRIPT_NAME'], 0 , $public_end);
//echo "doc root: ". $doc_root;


define("WWW_ROOT", $doc_root);



require_once('functions.php');
require_once('database.php');
require_once('query_functions.php');
require_once('validation_functions.php');
require_once('auth_functions.php');


$db = db_connect();

$errors = [];

function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars) {
    echo $e_number;
    echo $e_message;
    echo "There's an error in the system. Sorry for the inconvenience.";
  }


//set_error_handler('my_error_handler');
//ini_set('display_errors', 1);
//error_reporting(E_USER_WARNING);

?>
