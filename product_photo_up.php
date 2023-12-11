<?php 
include("connect.php");

function compressImage($source, $destination, $quality) { 
    // Get image info 
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
     
    // Create a new image from file 
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
           imagejpeg($image, $destination, $quality);
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            imagepng($image, $destination, $quality);
            break; 
        case 'image/PNG': 
            $image = imagecreatefrompng($source); 
            imagepng($image, $destination, $quality);
            break;
        default: 
            $image = imagecreatefromjpeg($source); 
           imagejpeg($image, $destination, $quality);
    } 
     
     
    // Return compressed image 
    return $destination; 
}
 
 
// File upload path 
$uploadPath = "app/product_img/"; 

 
// If file upload form is submitted 
$status = $statusMsg = ''; 

    $status = 'error'; 

        // File info 
        $fileName = date('ymdHis').'.'.pathinfo($_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION); 
        $imageUploadPath = $uploadPath . $fileName; 
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            // Image temp source 
            $imageTemp = $_FILES["fileToUpload"]["tmp_name"]; 
             
            // Compress size and upload image 
            $compressedImage = compressImage($imageTemp, $imageUploadPath, 60); 
             
            if($compressedImage){ 
                $status = 'success'; 
                $statusMsg = "Image compressed successfully."; 
            }else{ 
                $statusMsg = "Image compress failed!"; 
            } 
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 




$sql = 'UPDATE  products SET img =? WHERE id =? ';
$ql = $db->prepare($sql);
$ql->execute(array($fileName,$_POST['id']));

header("location: product_view.php");

?>