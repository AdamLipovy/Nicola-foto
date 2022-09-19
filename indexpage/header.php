<?php
$names = basename($_SERVER['PHP_SELF']);
$goback = false;
if ($names !== 'index.php'){$files = scandir("../pages");$goback = true;}
else{$files = scandir("pages");}
$files = array_merge(array_diff($files, array(".", "..")));
$count = count($files);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <style>
    #desktop {}
    @media (min-width:0px) {
      body {
        margin: 0;
        position: relative;
        text-align: center;
        min-height: 30vh;
      }
      .logo{
        position: absolute;
        width: 100vw;
        left:0;
        top:5%;
        pointer-events:none;
      }
      .logo img{
        max-width:30%;
        pointer-events:all;
      }
    }

    @media (min-width:1025px) {

      #mobile {
        pointer-events:none;
        visibility: hidden;
        width: 0%;
      }

      #desktop {
        width: 100%;
        visibility: visible;
        pointer-events:all;
      }

      #desktop .leftpanel li {
        
        float: left;
        list-style: none;
        padding-right: 2vw;
      }
      
      #desktop .rightpanel li {
        float: right;
        list-style: none;
        padding-right: 2vw;
      }

      #desktop .leftpanel{
        position:absolute;
        top: 2%;
        left: 5vw;
        padding:2%;
      }
      #desktop .rightpanel{
        position: absolute;
        top: 2%;
        right: 5vw;
        padding:2%;
      }
      
      a {

        color: white;
      }
    }

    @media (max-width:1024px) {
      #mobile {
        position: absolute;
        right: 1.5vw;
        top: 15px;
        float: right;
        visibility: visible;
        width: 100%;
        pointer-events:all;
      }

      #desktop {
        width: 0;
        height: 0;
        visibility: hidden;
        pointer-events:none;
      }
      
      .overlay { 
        height: 0;
        width: 100%;
        position: fixed; 
        z-index: 1; 
        left: 0;
        top: 0;
        background-color: rgb(0,0,0); 
        background-color: rgba(0,0,0, 0.9); 
        overflow-x: hidden; 
        transition: 0.5s; 
      }
      
      /* Position the content inside the overlay */
      .overlay-content {
        position: relative;
        top: 25%; /* 25% from the top */
        width: 100%; /* 100% width */
        text-align: center; /* Centered text/links */
        margin-top: 30px; /* 30px top margin to avoid conflict with the close button on smaller screens */
      }
      
      /* The navigation links inside the overlay */
      .overlay a {
        padding: 8px;
        text-decoration: none;
        font-size: 36px;
        color: #818181;
        display: block; /* Display block instead of inline */
        transition: 0.3s; /* Transition effects on hover (color) */
      }
      
      /* When you mouse over the navigation links, change their color */
      .overlay a:hover, .overlay a:focus {
        color: #f1f1f1;
      }
      
      /* Position the close button (top right corner) */
      .overlay .closebtn {
        position: absolute;
        top: 20px;
        right: 45px;
        font-size: 60px;
      }
      
      /* When the height of the screen is less than 450 pixels, change the font-size of the links and position the close button again, so they don't overlap */
      @media screen and (max-height: 450px) {
        .overlay a {font-size: 20px}
        .overlay .closebtn {
          font-size: 40px;
          top: 15px;
          right: 35px;
        }
      }
      .menubtn{
        position:absolute;
        top:5%;
        right:5%;
        background: white;
        padding: 5px;
        border-style: solid;
        border-radius: 3px 0 0 3px;
      }
      .menubtn div{
        width: 60px;
        height: 8px;
        background-color: black;
        margin: 8px 0;
      }
    }
  </style>
  <script>
    function openNav() {
      document.getElementById("myNav").style.height = "100%";
    }
    
    function closeNav() {
      document.getElementById("myNav").style.height = "0%";
    }
  </script>
</head>

<body>
  <div class="container">
  <img src="https://images.pexels.com/photos/2253870/pexels-photo-2253870.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" style="width:100%;height: auto;">
</div>
  <div class="logo">
    <a href="/">
    <img src="/images/logo.png"></a>
  </div>  
  <div id="desktop">
    <div class="leftpanel">
      <ul>
        <?
          for ($i=0;$i<$count and $i<3;$i++){
            echo "<li> <a href=/pages/$files[$i]>".substr($files[$i],0,-4)."</a></li>";
          }
        ?>
      </ul>
    </div>

    <div class="rightpanel">
      <ul>
        <li> <a href="/support/contacts.php">contacts</a></li>
        <li> <a href="/support/faq.phpl">FAQ</a></li>
        <li> <a href="/support/workshop.php">workshop</a></li>
      </ul>
    </div>
  </div>
  <div id="mobile">
    <div class="menubtn" onclick="openNav()">
      <div></div>
      <div></div>
      <div></div>
    </div>
    <div id="myNav" class="overlay">
  
    <!-- Button to close the overlay navigation -->
      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    
      <!-- Overlay content -->
      <div class="overlay-content">
        <a href="/support/contacts.php">contacts</a>
        <a href="/support/faq">FAQ</a>
        <a href="/support/workshops.php">workshops</a>
        <?
          for ($i=0;$i<$count and $i<3;$i++){
            echo "<a href=/pages/$files[$i]>".substr($files[$i],0,-4)."</a>";
          }
        ?>
      </div>
    </div>    
  </div>
</body>

</html>