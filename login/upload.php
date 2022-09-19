<?php session_start(); /* Starts the session */

if(!isset($_SESSION['UserData']['Username'])){
        header("location:login.php");
        exit;
}

/* 
 * Custom function to compress image size and 
 * upload to the server using PHP 
 */ 
function compressImage($source, $destinationLite, $destination, $quality) { 
    // Get image info 
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
    // Create a new image from file 
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            break; 
        default: 
            $image = imagecreatefromjpeg($source); 
    }

    imagejpeg($image, $destinationLite, $quality);
    imagejpeg($image, $destination, 100); 
  
    return $destination; 
} 

$errors = [];
$status = $statusMsg = '';
if(isset($_POST["submit"])){ 
    $status = 'success'; 
    $total = count($_FILES['image']['name']);
  
  for( $i=0 ; $i < $total ; $i++ ) {
  
    $fileName = basename($_FILES["image"]['name'][$i]);
    $album = basename($_POST["pageTo"]);
    $uploadPath = "../images/".$album."/";
    $uploadLitePath = "../imageslite/".$album."/";
    
    $imageUploadPath = strtolower($uploadPath . $fileName);
    
    $imageLiteUploadPath = strtolower($uploadLitePath . $fileName);
    
    $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
    
    // Allow certain file formats 
    $allowTypes = array('jpg','png','jpeg','gif'); 
    if(in_array($fileType, $allowTypes)){ 
        // Image temp source 
        $imageTemp = $_FILES["image"]["tmp_name"][$i];
        // Compress size and upload image 
        $compressedImage = compressImage($imageTemp, $imageLiteUploadPath, $imageUploadPath, 25); 
         
        if($compressedImage){

            $title = 'image uploaded';
            $statusMsg = 'image uploaded succesfully'; 
        }else{ 
          $statusMsg = "Image compress failed!";
          array_push($errors, [$fileName,'compression faill']);
          $status = 'fail';
        } 
    }
    else{ 
        array_push($errors, [$fileName,'wrong format']);
        $status = 'fail';
    } 
  }
  if ( $status == 'success'){
    $title = 'images uploaded';
    $statusMsg = 'images uploaded succesfully'; 
  }
  else{
    echo print_r($errors);
    $statusMsg = 'something went wrong';
    $title = 'ERROR';
  }
}
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>login</title>
  <link rel="stylesheet" href="style.css" media="screen">
  <title><?php echo $title; ?></title>
</head>

<body>
  <table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
    <tr>
      <td colspan="2" align="left" valign="top"><h3><?php echo $statusMsg; ?></h3></td>
    </tr>
    <tr>
      <td><button onclick="location.href='send.php';">go back</td>
      <td><button onclick="location.href='logout.php';">Logout</td>
    </tr>
</body>

</html>