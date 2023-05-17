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
        $errors[] = "Uzantı desteklenmiyor, lütfen JPEG veya PNG dosyası yükleyin.";
    }
    
    if($file_size > 2097152){
        $errors[] = 'Dosya boyutu 2MB\'dan küçük olmalıdır.';
    }
    
    if(empty($errors)){
        move_uploaded_file($file_tmp, "image/".$file_name);
        echo "Resim başarıyla yüklendi: site/siteninadı/image/".$file_name;
    }else{
        print_r($errors);
    }
}
?>