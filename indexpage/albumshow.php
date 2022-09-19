<?php
    $files = scandir("pages");
    $files = array_merge(array_diff($files, array(".", "..")));
    $count = count($files);
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {box-sizing: border-box}
body {font-family: Verdana, sans-serif; margin:0}
.mySlides {display: none}
img {vertical-align: middle; height: 100%;}

.slideshow-container {
  width:50%;
  height: 100%;
  overflow:hidden;
  position: relative;
  margin: auto;
  float:right;
}

.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

.prev {
  left: 0;
  border-radius: 3px 0 0 3px;
}

.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

.fade {
  animation-name: fade;
  animation-duration: 1.5s;
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
</style>
</head>
<body>

<div class="slideshow-container">

<?
  for ($i = 1; $i<=$count;$i++){
    $album = "images/".substr($files[$i-1],0,-4);
    $logoPath = "";
    if (file_exists($album."/logo.jpg")){
      $logoPath = $album."/logo.jpg";
    }
    if (file_exists($album."/logo.png")){
      $logoPath = $album."/logo.png";
    }
    else{
      $logos = scandir($album);
      $logoPath = $album."/".$logos[2];
    }
    ?>
    <div class="mySlides fade">
      <div class="numbertext"><?= $i." / ".$count;?></div>
      <img onclick="window.location.href='<?="pages/".$files[$i-1];?>'" src="<?=$logoPath;?>" style="width:100%">
      <div class="text"><?=substr($album,7);?></div>
    </div>
    <?
  }
?>

<a class="prev" onclick="plusSlides(-1)">❮</a>
<a class="next" onclick="plusSlides(1)">❯</a>

</div>
  
<script>
let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}


function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slides[slideIndex-1].style.display = "block"; 
}
</script>

</body>
</html> 
