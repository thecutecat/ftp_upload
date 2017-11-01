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
    <title>Fixed Asset File Uploading Page</title>
    <link rel="stylesheet" href="style/style.css" type="text/css">
  </head>
  <body>
      <div style="padding-top: 150px;">   
    <form id="frm" method="post" enctype="multipart/form-data" action="ftp_upload.php">
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
if(!empty($_FILES)){  //  print_r($_FILES);
set_time_limit(300); ///public_html/fixedasset/test/ 

//$paths='public_html/wiki/mscompanion/';
$paths='public_html/fixedasset/'.$_POST['folder'].'/'; //$_POST['serverpath'];
$filep=$_FILES['userfile']['tmp_name'];
$ftp_server='212.242.169.204';  

$ftp_user_name ="yourweb_User123"; 
$ftp_user_pass = "Pass123";

$name=$_FILES['userfile']['name'];
 
$conn_id = ftp_connect($ftp_server); // mencoba konek ke ftp server
 
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass); // login dengan username and password yang telah diinput
 
// turn passive mode on
ftp_pasv($conn_id, true);
// cek koneksi dan tampilkan hasilnya
if ((!$conn_id) || (!$login_result)) {
       echo "FTP connection has encountered an error!".$conn_id;
       echo "Attempted to connect to $ftp_server for user $ftp_user_name....";
       exit;
} else {
   echo "Connected to $ftp_server, for user $ftp_user_name".".....";
}
 
$upload = ftp_put($conn_id, $paths.'/'.$name, $filep, FTP_BINARY); //FTP_BINARY); // upload the file to the folder yang telah ditentukan
//$upload = ftp_put($conn,"target.txt","source.txt",FTP_ASCII); 
// check apakah upload berhasil atau tidak?
if (!$upload) {
    echo "FTP upload has encountered an error!".$upload.' = '.$filep.'<br/> Path = '.$paths;
    $class->my_print_r($_FILES);
} else {
    echo "Uploaded file with name $name to $ftp_server ";
    echo '<br><br>Click here to download : <a target="_blank" href="http://fixedasset.mpo-ms.com/'.$_POST['folder'].'/'.$name.'">'.$name.'</a>';
}
 
ftp_close($conn_id); // tutup koneksi FTP 
} ?>
<?php include('includes/head_menu.php'); ?>
<?php include('includes/con_close.php'); ?>