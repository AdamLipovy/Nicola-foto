<?php
    $name = explode('/', basename($_SERVER['PHP_SELF']));
    $name = $name[count($name)-1];
    $name = explode('.', basename($_SERVER['PHP_SELF']));
    $dir = "../images/".strval($name[0]);
    $columns = [0,0,0,0];
    $imgplace = [[],[],[],[]];

    $files = scandir($dir);
    $count = 0;
    foreach ($files as $img) {
        if (((substr_compare($img, '.png', -4, 4)=== 0) or (substr_compare($img, '.jpg', -4, 4)=== 0)) and ($img != 'logo.png')){
        $count = $count + 1;
          }
          else{
            $files = array_diff( $files, [$img] );
          }
    }
    
    foreach ($files as $img) {
      list($width, $height) = getimagesize($dir."/".$img);
      $resolution = $height / $width;
      $col = [0,$columns[0]];
      for($i=0;$i<4;$i++){
        if($columns[$i]<$col[1]){$col = [$i,$columns[$i]];}
      }
      array_push($imgplace[$col[0]], $img);
      $columns[$col[0]] = $columns[$col[0]] + $resolution;
    }
    for($i=0;$i<4;$i++){
            ?>
                <div class="column">
            <?
              foreach($imgplace[$i] as $img){
                ?>
                <img src="/imageslite/<?=$name[0]."/".$img?>" onclick="showimage('<?=$dir."/".$img?>')" style="width:100%">
                <?
              }
            ?>                   
                </div>            
            <?
    }
?>