<?php
 include('includes/con_open.php');
 include('includes/class.php');
 
 $class = new myClass;
 $folder_list = array(
                   'test' => 'Test',
                   'asset' => 'Asset',
                   'Load Test' => 'Load Test',
                   'Pressure Test' => 'Pressure Test',
                   'Asset/_LOOSE COMPONENTS' => 'Asset/_LOOSE COMPONENTS',
                   'Asset/_NDT' => 'Asset/_NDT',
                   'Asset/CALIBRATION' => 'Asset/CALIBRATION',
                   'Asset/CHECK VALVE' => 'Asset/CHECK VALVE',
                   'Asset/COMPRESSOR & DRYER' => 'Asset/COMPRESSOR & DRYER',
                   'Asset/CONTAINER' => 'Asset/CONTAINER'
                 );
 
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
  <head>
    <title>Fixed Asset File Uploading Page ** V2</title>
    <link rel="stylesheet" href="style/style.css" type="text/css">
  </head>
  <body>
      <div style="padding-top: 100px;">
         <?php if($_GET['status']=='1'){ ?> <div style="background: #cf6628; padding: 10px; font-size: 15px; color: #fff; width:700px;">Succesfully Upload : <b><?php echo $_GET['file']; ?></b> to : <b><?php echo $_GET['folder']; ?></b><br/>
            Link to file : <b style="color:#150C15;">http://fixedasset.mpo-ms.com/<?php echo $_GET['folder']; ?>/<?php echo $_GET['file']; ?></b>
          </div><?php } ?>
    <form id="frm" method="post" enctype="multipart/form-data" action="web_upload.php">
        <table style="padding:10px;">
            <tr><td>Folder</td><td> : </td>
                <td><select name="folder">
                        <?php foreach($folder_list as $key=>$foldername)
                            {
                            echo '<option value="'.$key.'">'.$foldername.'</option>';
                            } ?>
                    </select></td></tr>
            <tr><td>Upload File</td><td> : </td><td><input type="file" id="fileBtn" name="userfile"/></td></tr>
            <tr><td></td><td>  </td><td><input type="submit" id="uploadBtn" value="Upload" /></td></tr>
        </table>
        
    </form>
       </div>   
  </body>
</html>
<?php
if(!empty($_FILES)){  
  include('includes/class.upload.php');
  $path = '/home/mpoms/public_html/fixedasset/'.$_POST['folder'].'/';
  $foo = new Upload($_FILES['userfile']);
    if ($foo->uploaded) { 
      $foo->Process($path);
      if ($foo->processed) {
        //echo 'original file copied to : '.$path;
        //$class->redirect('web_upload.php?status=1&file='.$_FILES['userfile']['name'].'&folder='.$_POST['folder']);
        $class->redirect('web_upload.php?status=1&file='.$foo->file_dst_name.'&folder='.$_POST['folder']);
        
        //if(empty($foo->error)){ echo 'success'; }else{ echo 'error : ' . $foo->error; }
        
        //echo '<a href="web_upload.php?status=1&file="'.$foo->file_dst_name.'"&folder="'.$_POST['folder'].'">Back</a> to upload page'; 
        
      } else {
        echo 'error : ' . $foo->error;
      }
       
    }
  
  
//  $path = '/home/mpoms/public_html/fixedasset/'.$_POST['folder'].'/';
//  $filename = $_FILES['userfile']['tmp_name'];
//  $destination = $_FILES['userfile']['name'];
//  
//  move_uploaded_file ($filename ,$path.$destination );
} ?>
<?php include('includes/head_menu.php'); ?>
<?php include('includes/con_close.php'); ?>