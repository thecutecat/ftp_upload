<?php
 include('includes/con_open.php');
 include('includes/class.php');
 
 $class = new myClass;
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
  <head>
    <title>Fixed Asset File Uploading Page ** V2</title>
    <link rel="stylesheet" href="style/style.css" type="text/css">
  </head>
  <body>
      <div style="padding-top: 100px;">
<?php

$directory = '/home/mpoms/public_html/fixedasset/';

$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

echo '<ol class="list">';
while($it->valid()) {

    if (!$it->isDot()) {  
        echo '<li>Name : <b>' . $class->getFilename($it->getSubPathName()) . "</b><br/>";
        echo '&nbsp;&nbsp;Directory :     ' . $it->getSubPath() . "\n<br/>";
        echo '&nbsp;&nbsp;Url : <b><a target="_blank" href="http://fixedasset.mpo-ms.com/'.$it->getSubPathName().'">http://fixedasset.mpo-ms.com/' . str_replace("\\",'/',$it->getSubPathName()) . "</a></b></li>";
        
        //echo '&nbsp;&nbsp;Server Location :         ' . str_replace('/home/mpoms/public_html/fixedasset','',$it->key()) . "</li>"; ==> this will show the same with : getSubPathName()
        
    }

    $it->next();
}
echo '</ol>';
?>
</div>
</body>
</html>
<?php include('includes/head_menu.php'); ?>
<?php include('includes/con_close.php'); ?>