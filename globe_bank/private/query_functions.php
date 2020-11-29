<?php

function find_all_subjects($options=[]) {
    global $db;

    $visible = $options['visible'] ?? false;

    $sql = "SELECT * FROM subjects ";
    if($visible) {
        $sql .= "WHERE visible = true ";
    }

    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    //echo $sql;
    confirm_result_set($result);

    return $result;
}



/*SQL injection demonstration*/
//db_escape($db, $id)
//"SELECT * FROM subjects ";
//"WHERE id='" . ' OR 'a'='a . "'";


function find_subject_by_id($id, $options=[]) {
    global $db;

    $visible = $options['visible'] ?? false;

    $sql = "SELECT * FROM subjects ";
    $sql .="WHERE id='" . db_escape($db, $id) . "'";
    if($visible){
        $sql .= "AND visible = true";
    }
    //echo $sql;
    $result = mysqli_query($db, $sql);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);

    return $subject; //returns an assoc array
}


function validate_subject($subject) {
    $errors = [];
    if(is_blank($subject['menu_name'])){
        $errors[] = "Name cannot be blank.";
    } elseif(!has_length($subject['menu_name'], ['min'=>2, 'max' =>255])) {
        $errors[] = "Name must be between 2 and 255 characters.";
    }

    //position
    //Make sure we are working with an integer
    $position_int = (int) $subject['position'];
    if($position_int <= 0){
        $errors[] = "Position must be greater than zero.";

    }
    if($position_int > 999) {
        $errors[] = "Position must be less than 999.";
    }

    //visible
    // Make sure we are working with a string
    $visible_str = (string) $subject['visible'];
    if(!has_inclusion_of($visible_str, ["0", "1"])){
        $errors[] = "Visible must be true or false.";
    }

    return $errors;
}


function update_subject($subject) {
    global $db;




    $errors = validate_subject($subject);
    //If there are errors
    if(!empty($errors)) {
        return $errors;
    }

    $sql = "UPDATE subjects SET ";
    $sql .= "menu_name='" . db_escape($db, $subject['menu_name']) . "', ";
    $sql .= "position='" . db_escape($db,$subject['position']) . "', ";
    $sql .= "visible='" . db_escape($db,$subject['visible']) . "' ";
    $sql .= "WHERE id='" . db_escape($db,$subject['id']) . "' ";
    $sql .= "LIMIT 1";

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) {
        return true;
    } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}


function update_page($page) {
    global $db;

    $errors = validate_page($page);

    /*if(!has_unique_page_menu_name($page['position'])){
      $errors[] =  "This menu name already exists";
    }*/

    if(!empty($errors)){
        return $errors;
    }

    $sql = "UPDATE pages SET ";
    $sql .= "menu_name='" .db_escape($db, $page['menu_name']) . "', ";
    $sql .= "position='" .db_escape($db, $page['position']) . "', ";
    $sql .= "visible='" .db_escape($db, $page['visible']) . "', ";
    $sql .= "content='" .db_escape($db, $page['content']) . "', ";
    $sql .= "subject_id='" .db_escape($db, $page['subject_id']) . "' ";

    $sql .= "WHERE id='" . db_escape($db, $page['id']). "' ";
    $sql .= "LIMIT 1";



    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) {

        return true;

    } else {
        //INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}


function find_all_pages() {
    global $db;
    $sql = "SELECT * FROM pages ";

    $sql .= "ORDER BY id ASC ";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;

}

function delete_subject($id) {


    global $db;
    $sql = "DELETE FROM subjects ";
    $sql .= "WHERE id='" . db_escape($db,$id) . "' ";
    $sql .="LIMIT 1";

    $result = mysqli_query($db, $sql);
    //For DELETE statements, $result is true/false

    if($result) {
       return true;
    } else {
        //DELETE FAILED
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}


function delete_page($id){
    global $db;

    $sql = "DELETE FROM pages ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    $sql .="LIMIT 1";
    $result = mysqli_query($db, $sql);
    if($result) {
        return true;
    } else {
        //DELETE FAILED
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }


}

function insert_subject($subject) {
    global $db;


    $errors = validate_subject($subject);
    if(!empty($errors)) {
        return $errors;
    }


    $sql = 'INSERT INTO subjects ';
    $sql .= "(menu_name, position, visible) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db,$subject['menu_name']) . "', ";
    $sql .= "'" . db_escape($db,$subject['position']) . "', ";
    $sql .= "'" . db_escape($db,$subject['visible']) . "'";
    $sql .= ")";

    $result = mysqli_query($db, $sql);
    //For INSERT statements, $result is true/false

    if($result) {

      return true;

    } else {
        //INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }


}


function insert_page($page) {
    global $db;

    $errors = validate_page($page);

    if(!empty($errors)){
        return $errors;
    }


    $sql =  'INSERT INTO pages ';
    $sql .= "(menu_name, position, visible, content, subject_id) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db, $page['menu_name']) . "', ";
    $sql .= "'" . db_escape($db, $page['position']) . "', ";
    $sql .= "'" . db_escape($db, $page['visible']) . "', ";
    $sql .= "'" . db_escape($db, $page['content']) . "', ";
    $sql .= "'" . db_escape($db, $page['subject_id']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);

    if($result) {
        return true;
    } else {
        echo $sql;
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }



}

function find_page_by_id($id, $options=[]) {
    global $db;
    $visible = $options['visible'] ?? false;


    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
    if($visible){
        $sql.= "AND visible = true";
    }
     $result = mysqli_query($db, $sql);
    $page = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
     return $page;

}

function find_subject_by_page_subject_id($page_subject_id) {
  global $db;
  $sql = "SELECT pages.menu_name, pages.subject_id, subjects.menu_name ";
  $sql .= "FROM pages, subjects ";
  $sql .= "WHERE " . db_escape($db, $page_subject_id) . " = subjects.id ";
  $result = mysqli_query($db, $sql);

  $subject_name = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
   return $subject_name;


}

function find_subject_id_and_subject() {
    global $db;
    $sql = "SELECT DISTINCT subjects.menu_name, pages.subject_id \n"
        . "FROM subjects, pages\n"
        . "WHERE pages.subject_id = subjects.id";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return  $result;
}

function validate_page($page){
    $errors = [];

    if(is_blank($page['menu_name'])){
        $errors[] = "Name cannot be blank.";
    } elseif(!has_length($page['menu_name'], ['min'=>2, 'max' =>255])){
        $errors[] = "Name must be between 2 and 255 characters.";

    } 
    
    
    //position. Make sure we are working with an integer
    $position_int = (int) $page['position'];
    if($position_int <= 0){
        $errors[] = "Position must be greater than zero.";
    }
    if($position_int > 999){
        $errors[] = "Position must be less than 999.";
    }

    //visible
    //Make sure we are working with a string
    $visible_str = (string) $page['visible'];
    if(!has_inclusion_of($visible_str, ["0","1"])) {
        $errors[] = "Visible must be true or false.";
    }

       /* 
    $content_str = (string) $page['content'];
    if(!has_length_less_than($content_str , 100)){
        $errors[] = "Your content's length is greater than 100";
    }*/

    //content
    if(is_blank($page['content'])) {
        $errors[] = "Content cannot be blank.";
    }


    $current_id = $page['id'] ?? '0';
    if(!has_unique_page_menu_name($page['menu_name'], $current_id)){
        $errors[] = "Menu name must be unique.";
    }

    return $errors;

}


function find_pages_by_subject_id($subject_id, $options=[]) {
    global $db;

    $visible = $options['visible'] ?? false;
    $sql = "SELECT * FROM pages ";
    $sql .= "WHERE subject_id='" . db_escape($db, $subject_id) . "' ";
    if($visible) {
        $sql .="AND visible = true ";
    }
    $sql .= "ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
     return $result;

}

function find_all_admins() {
    global $db;
    $sql = "SELECT * FROM admins ";

    $sql .= "ORDER BY id ASC ";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;

}




function validate_admin($admin){
    $errors = [];

    if(is_blank($admin['first_name'])){
        $errors[] = "First name cannot be blank.";
    } elseif(!has_length($admin['first_name'], ['min'=>2, 'max' =>255])){
        $errors[] = "Name must be between 2 and 255 characters.";

    } 


    if(is_blank($admin['last_name'])){
        $errors[] = "Last name cannot be blank.";
    } elseif(!has_length($admin['last_name'], ['min'=>2, 'max' =>255])){
        $errors[] = "Name must be between 2 and 255 characters.";

    } 

    if(is_blank($admin['email'])){
        $errors[] = "Email can't be blank.";
    }elseif(!has_length($admin['email'], ['max' => 255])){
        $errors[] = "Email should have a maximum 255 characters.";
    }elseif(!has_valid_email_format($admin['email'])){
        $errors[] = "Please write your email in a valid format.";
    }

    if(!has_length($admin['username'], ['min' => 8, 'max' => 255])){
        $errors[] = "Username must be between 8 and 255 characters.";
    }

    $current_id = $admin['id'] ?? '0';
    if(!has_unique_username($admin['username'], $current_id)){
        $errors[] = "username name must be unique.";
    }

    if(!has_length($admin['hashed_password'], ['min' => 12])) {
        $errors[] = "Password should be at least 12 characters long.";
    }elseif(!has_valid_password_format($admin['hashed_password'])){
        $errors[] = "Password must have 1 uppercase, 1 lowercase, 1 number, and 1 symbol.";

    }
    
     return $errors;

}





?>