<?php
class myClass{
  //_self->init();
    
   function __construct() {
      session_start(); 
      if(empty($_SESSION['paging_limit'])){ $_SESSION['paging_limit'] = 50; }
      if(isset($_POST['perpage'])){ $_SESSION['paging_limit'] = $_POST['perpage']; }  
      if(isset($_POST['all'])){ $_SESSION['paging_limit'] = 3000; }
      
      if(empty($_SESSION['user_id']) && !isset($_POST['log'])){
         /// $_SESSION['back'] = $_SERVER['REQUEST_URI'];
          $this->redirect('login.php');
      }
   }
   
         
   function loginprocess()
   { 
       $q = mysql_query("SELECT `user_id`, `username`, `group_id`, `Block_user` FROM `cms_user` 
             WHERE `username` = '".$_POST['log']."' and `password` = MD5('".$_POST['pwd']."');");
       
       if(!mysql_num_rows($q))
       {
          $this->redirect('login.php?info=login_failed'); 
       }else{
           $b = mysql_fetch_array($q);                 
         
           $_SESSION['user_id'] = $b['user_id'];
           $_SESSION['username'] = $b['username'];
           $_SESSION['group_id'] = $b['group_id']; $this->redirect(); //$this->my_print_r($b); die; 
           //if(!empty($_SESSION['back'])){ $this->redirect(); }else{ $this->redirect($_SESSION['back']);  } die;
       }
   }
           
    function logout ()
	{
		session_destroy();
		$this->redirect('login.php?info=logout');
	}
    
         
 
 function my_print_r($arr)
 {
  echo '<pre>';
  print_r($arr);
  echo '</pre>';
 }   
 
         
 
 function convertMonthName($x)
 {
     switch($x)
     {
         case '1' : return 'January'; break;
         case '2' : return 'February'; break;
         case '3' : return 'March'; break;
         case '4' : return 'April'; break;
         case '5' : return 'May'; break;
         case '6' : return 'June'; break;
         case '7' : return 'July'; break;
         case '8' : return 'August'; break;
         case '9' : return 'September'; break;
         case '10' : return 'October'; break;
         case '11' : return 'November'; break;
         case '12' : return 'December'; break;
     }
 }
 
 function redirect($url='index.php')
 {
     echo '<meta http-equiv="refresh" content="0; url='.$url.'">';
     unset($_SESSION['back']);
     die;
 }
 
 function getFilename($name='')
 {
     $filename='';
     
     if(strlen($name) > 1){ 
         $arr = explode('/',$name); //print_r($arr); die; 
         //$count=count($arr);
         $filename = end($arr); //[$count-1];
     }
     return $filename;
 }
 
         
}


?>
