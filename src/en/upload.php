<?php
if(isset($_FILES['image'])){
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    
    $file_name_parts = explode('.', $file_name);
    $file_ext = strtolower(end($file_name_parts));
    
    $extensions = array("jpeg","jpg","png");
    
    if(!in_array($file_ext, $extensions)){
        $errors[] = "Extension not supported, please upload JPEG or PNG file.";
    }
    
    if($file_size > 2097152){
        $errors[] = 'File size should be smaller than 2MB\.';
    }
    
    if(empty($errors)){
        move_uploaded_file($file_tmp, "image/".$file_name);
        echo "Image uploaded successfully: site/yoursitename/image/".$file_name;
    }else{
        print_r($errors);
    }
}
?>
