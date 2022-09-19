<!DOCTYPE html>
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

</html>