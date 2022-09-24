 <?php 
session_start(); /* Starts the session */

$files = scandir("../pages");
$files = array_merge(array_diff($files, array(".", "..")));
$count = count($files);

if(!isset($_SESSION['UserData']['Username'])){
        header("location:login.php");
        exit;
}
if(isset($_POST['Submit'])){
  
  $album = isset($_POST['Album']) ? $_POST['Album'] : '';

  $filePath = "../pages/".$album.".php";
  
  if(!is_file($filePath) and !in_array($album, ['css','imageslite','indexpage','javascripts','login','pages','support'])){
    $file = fopen($filePath, "w");
    $txt = '<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/rows.css" media="screen">
  <link rel="stylesheet" href="../css/index.css" media="screen">
  <script src="../javascripts/showimage.js"></script>
  <title>Document</title>
</head>

<body>
  <div id="fullImg"></div>
  <div id="all">
  <?php include("../indexpage/header.php")?>
  <div class="images">
    <div class="row">
      <?php include("../support/imageloader.php")?>
    </div>
  </div>
  </div>
</body>

</html>';
    fwrite($file, $txt);
    fclose($file);
    if (!is_dir("../images/".$album)){
      mkdir("../images/".$album);
      mkdir("../imageslite/".$album);
      // header("Refresh:0");
    }    
  }
  else {$msg = ("That album already exists!");}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css" media="screen">
  <title>Upload</title>
</head>
<body>
  <td style="padding-left:30%"><button onclick="location.href='logout.php';">Logout</button></td>
  <form action="upload.php" method="post" enctype="multipart/form-data">
    <table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
      <tr>
        <td colspan="2" align="left" valign="top"><h3>File sending</h3></td>
      </tr>
      <tr>
        <td colspan="2" align="right" valign="top">Select Image File:</td>
        <td><input type="file" name="image[]" multiple="multiple"></td>
      </tr>
      <?
        for ($i = 1; $i<=$count;$i++){
          $album = substr($files[$i-1],0,-4);
      ?><tr>
        <td><input type="radio" id="<?=$album?>" name="pageTo" value="<?=$album?>"required></td>        
        <td><label for="<?=$album?>"><?=$album?></label></td>
      </tr><?
      }
      ?>
    <tr>
      <td colspan="3" align="center"><input type="submit" name="submit" value="Upload"></td>
    </tr>
    </table>
  </form>
<form action="" method="post" name="Login_Form">
  <table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
    <?php if(isset($msg)){?>
    <tr>
      <td colspan="2" align="center" valign="top"><?php echo $msg;?></td>
    </tr>
    <?php } ?>
    <tr>
      <td colspan="2" align="left" valign="top"><h3>Create album</h3></td>
    </tr>
    <tr>
      <td align="right" valign="top">album name</td>
      <td><input name="Album" type="text" class="Input"></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input name="Submit" type="submit" value="Create" class="Button3"></td>
    </tr>
  </table>
</form>
<table width="400" border="0" align="center" cellpadding="5" cellspacing="1" class="Table">
  <tr>
      <td colspan="2" align="left" valign="top"><h3>Remove album/photo</h3></td>
  </tr>
  <tr>
    <td align="center"><button onclick="window.location.href='remover.php'">Proceed</a></td>
  </tr>
</table>
</body>
</html>