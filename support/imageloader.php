<?php
    $name = explode('/', basename($_SERVER['PHP_SELF']));
    $name = $name[count($name)-1];
    $name = explode('.', basename($_SERVER['PHP_SELF']));
    $dir = "../images/".strval($name[0]);
    $columns = [0,0,0,0];
    $imgplace = [[],[],[],[]];

    $files = scandir($dir);
    $count = 0;
    
    $files = array_diff($files, array('.', '..'));
    
    foreach ($files as $img) {
      if($img != 'logo.jpg'){
        list($width, $height) = getimagesize($dir."/".$img);
        $resolution = $height / $width;
        for($i=0;$i<4;$i++){
          if($columns[$i]<$col[1]){$col = [$i,$columns[$i]];}
        }
        $col = array_search(min($columns), $columns);
        array_push($imgplace[$col], $img);
        $columns[$col] = $columns[$col] + $resolution;
      }
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