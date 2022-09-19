<?php session_start(); 
if(!isset($_SESSION['UserData']['Username'])){
        header("location:login.php");
        exit;
}

$files = scandir("../pages");
$files = array_merge(array_diff($files, array(".", "..")));
$count = count($files);

if(isset($_POST['deleteGallery'])){
  $album = isset($_POST['selected']) ? $_POST['selected'] : '';
  array_map('unlink', glob("../images/".$album."/*.*"));
  rmdir("../images/".$album);
  array_map('unlink', glob("../imageslite/".$album."/*.*"));
  rmdir("../imageslite/".$album);
  unlink("../pages/".$album.".php");
  header("Refresh:0");
  $msg = "album deleted";
}
if(isset($_POST['deleteImage'])){
  $imagePath = isset($_POST['selectedImg']) ? $_POST['selectedImg'] : '';
  unlink("../images/".$imagePath);
  unlink("../imageslite/".$imagePath);
  header("Refresh:0");
  $msg = "image deleted";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remover</title>
    <link rel="stylesheet" href="style.css" media="screen">
  </head>
  <body>
    <button right="0" onclick="location.href='send.php';">go back</button>
    <button right="0" onclick="location.href='logout.php';">Logout</button>
    <form action="" method="post" name="remove">
      <table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
        <tr>
          <td colspan="3" align="left" valign="top"><h3>Select album</h3></td>
        </tr>
        <?php if(isset($msg)){?>
        <tr>
          <td colspan="3" align="center" valign="top"><?php echo $msg;?></td>
        </tr>
        <?php } 
  for($i = 0; $i<$count; $i++){
    $album = substr($files[$i], 0, -4);
    ?>
      <tr>
        <td><input type="radio" id=<?=$album?>="selection" name="selected" value=<?=$album?>></td>        
        <td><label for=<?=$album?>><?=$album?></label></td>
      </tr>
    <?
  }
  
  ?>
        <tr>
          <td colspan="2"><input name="showPictures" type="submit" value="delete picture in selected gallery" class="Button3"></td>
          <td><input name="deleteGallery" type="submit" value="delete selected gallery" class="Button3"></td>
        </tr>
      </table>
    </form>
    <?php if(isset($_POST['showPictures'])){?>
    <form action="" method="post" name="object">
      <table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
        <tr>
          <td colspan="3" align="left" valign="top"><h3>Select image</h3></td>
        </tr>
        <?
          $album = isset($_POST['selected']) ? $_POST['selected'] : '';
          $album = trim($album,'$');
          foreach(array_diff(scandir("../images/".$album."/"), array(".", "..")) as $img){?>
            <tr>
        <td><input type="radio" id="<?=$img?>" name="selectedImg" value=<?=$album."/".$img?>></td>
        <td><label for=<?=$img?>><?=$img?></label></td>
        </tr><?
          }
                 
          ?>
  
        <tr>
          <td> </td>
          <td><input name="deleteImage" type="submit" value="delete image" class="Button3"></td>
        </tr>
      </table>
    </form>
    <?}?>
  </body>
</html>