<?php 
 //Default values to prevent errors

 $page_id = $page_id ?? '';

if(isset($_GET['subject_id'])){
    $nav_subject_id = $_GET['subject_id'];
}

 $subject_id = $subject_id ?? '';

?>

<navigation>

    <?php $nav_subjects = find_all_subjects(); ?>
    <ul class="subjects">
        <?php while($nav_subject = mysqli_fetch_assoc($nav_subjects)){ ?>

            <!--if the query paramerter is $_GET['subject_id']-->
            <?php if(isset($nav_subject_id)) { ?>
            <li class="<?php if($nav_subject['id'] == $nav_subject_id){ echo "selected";} ?>">
            <!--if the query parameter is $_GET['id']-->
            <?php }elseif(isset($page['id'])) { ?>
                <li class="<?php if($nav_subject['id'] == $subject_id){ echo "selected";} ?>">
            <?php } ?>    
<!--$subject_id-->
                <a href="<?php echo url_for('index.php?subject_id='. h(u($nav_subject['id']))) ?>">
                    <?php echo h($nav_subject['menu_name']); ?>
                
                </a>

                <?php 
                
                 if(isset($nav_subject_id) ){
                    $nav_pages = find_pages_by_subject_id($nav_subject_id); 
                    if($nav_subject_id == $nav_subject['id']){
                        $display = '';
                    }else {
                        $display = 'none';
                    }
                 }elseif(isset($page_id)){
                    $nav_pages = find_pages_by_subject_id($nav_subject['id']); 
                    if($subject_id ==  $nav_subject['id']){
                    $display = '';
                   } else {
                    $display = 'none';
                   }
                }  else {
                    $display = 'none';
                
                }   
                
                
                ?>
                      <ul class="pages" style="display:<?php echo $display;  ?>" >
                        <?php while($nav_page = mysqli_fetch_assoc($nav_pages)){ ?>
                         <!--if the query paramerter is $_GET['subject_id']-->
                       
                        <?php if(isset($nav_subject_id)) { ?>       
                        <li class="<?php if($nav_page['position'] == 1){ echo "selected";} ?>">

                        <?php }elseif(isset($page)){ ?>
                            <li class="<?php if($nav_page['id'] == $page['id']){ echo "selected";} ?>">
                        <?php }?>   
                            <a href="<?php echo url_for('index.php?id='. h(u($nav_page['id']))); ?>">
                                <?php echo h($nav_page['menu_name']); ?>
                            
                            </a>
                        </li>
                     <?php } // while $nav_pages ?>

                </ul>
                    <?php mysqli_free_result($nav_pages); ?>
                


            </li> 
        <?php } // while $nav_subjects ?>

    </ul>
    <?php mysqli_free_result($nav_subjects); ?>

</navigation>