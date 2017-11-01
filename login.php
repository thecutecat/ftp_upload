<?php if(isset($_POST['log'])){
       include('includes/con_open.php');
       include('includes/class.php');
       $class = new myClass;
       $class->loginprocess(); 
       include('includes/con_close.php');
} ?>
<?php if($_GET['action'] == 'logout'){
    include('includes/class.php');
    $class = new myClass;
    $class->logout();
} ?>
<!DOCTYPE html>
	<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>FTP Upload  ##  Log In</title>
	<link rel='stylesheet' id='wp-admin-css'  href='http://wordpress.com/wp-admin/css/wp-admin.min.css?ver=3.5.1' type='text/css' media='all' />
<link rel='stylesheet' id='buttons-css'  href='http://wordpress.com/wp-includes/css/buttons.min.css?ver=3.5.1' type='text/css' media='all' />
<link rel='stylesheet' id='colors-fresh-css'  href='http://wordpress.com/wp-admin/css/colors-fresh.min.css?ver=3.5.1' type='text/css' media='all' />
<meta name='robots' content='noindex,nofollow' />
	</head>
	<body class="login login-action-login wp-core-ui">
	<div id="login">
		<h1><img src="style/mpo-logo.png" style="padding-left: 20%; padding-bottom: 20px;"></h1>
	
<form name="loginform" id="loginform" action="login.php" method="post">
	<p>
		<label for="user_login">Username<br />
		<input type="text" name="log" id="user_login" class="input" value="" size="20" /></label>
	</p>
	<p>
		<label for="user_pass">Password<br />
		<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" /></label>
	</p>
	<p class="forgetmenot"><!--label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever"  /> Remember Me</label--></p>
	<p class="submit">
		<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Log In" />
		
	</p>
</form>

<?php if(isset($_GET['info'])){ 
   $alert = 'Login failed'; 
   switch($_GET['info'])
    {
       // case 'group_rejected' : $alert = 'Sorry. \r\n This page is restricted';  break;
        case 'logout' : $alert = 'Logout success';  break;
        default:break;
    }
    ?>
<script type="text/javascript">
  alert("<?php echo $alert; ?>");
</script>
<?php } ?>                
</div>

<div class="clear"></div>
</body>
</html>