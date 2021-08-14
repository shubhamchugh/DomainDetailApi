<?php

/*
* @author Balaji
* @name: Worth My Site PHP Script
* @Theme: Default Style
* @copyright © 2014 ProThemes.Biz
*
*/

// Disable Errors
error_reporting(1);
?>
   
             
<div id="content">
<div class="wrapper">  
<div style="padding-top: 20px;">
<style>
.header {
    padding: 35px 0;
    text-align: center;
    }
    .header h2 {
    font-size: 30px;
    margin: 0;
    }
.contentx {
    margin-left: auto;
    margin-right: auto;
    padding-left: 15px;
    padding-right: 15px;
    width: 87%;
    margin-bottom: 60px;
    }
.box-radius {
    background: none repeat scroll 0 0 #FFFFFF;
    border: 1px solid #E1E1E1;
    border-radius: 5px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
    padding: 70px 30px;
}
.loginme-form label{ 
    display: block !important;
}
.loginme-form .modal-footer{
    padding-top: 20px;
}
</style>  

<div class="header">
<h2>Login System</h2>
</div>
<div class="contentx">
<div class="box-radius">
<div class="row">
<?php 

if (isset($success))
{
echo '<div class="alert alert-success">
<strong>Alert!</strong> '.$success.'
</div>'; 

if (isset($_GET['login']))
{
echo '<br/> <div class="alert alert-info">
<strong>Alert!</strong> '.$lang['40'].'
</div>'; 
header("Location: /index.php");
echo '<meta http-equiv="refresh" content="1;url=/index.php">';
}
if (isset($_GET['register']))
{
echo '<br/> <div class="alert alert-info">
<strong>Alert!</strong> '.$lang['41'].'
</div>'; 
}
}
elseif (isset($error))
{
    echo '<div class="alert alert-error">
<strong>Alert!</strong> '.$error.'
</div>'; 
}
if (isset($_GET['login']))
{
?>
  <form method="POST" action="/login.php?login" class="loginme-form">
			<div class="modal-body">

				<div class="form-group connect-with">
					<div class="info">Sign in using social network</div> <br />
					<a href="/oauth/facebook.php?login" class="connect facebook" title="Sign in using Facebook">Facebook</a>
		        	<a href="/oauth/google.php?login" class="connect google" title="Sign in using Google">Google</a>    			        
			 </div>
				<div class="info">Sign in with your username</div> <br />
				<div class="form-group">
					<label>Username <br />
						<input type="text" name="username" class="form-input" />
					</label>
				</div>	
				<div class="form-group">
					<label>Password <br />
						<input type="password" name="password" class="form-input" />
					</label>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Sign in</button>
				<div class="pull-right align-right">
					<a href="/login.php?forget" ><?php echo $lang['49']; ?></a><br />
					<a href="/login.php?resend" ><?php echo $lang['48']; ?></a>
				</div>
			</div>
			 <input type="hidden" name="signin" value="<?php echo md5($date.$ip); ?>" />
			</form> 
<?php } elseif (isset($_GET['register']))  {?>
<form action="/login.php?register" method="POST" class="loginme-form">
			<div class="modal-body">
				<div class="form-group connect-with">
					<div class="info">Sign up using social network</div> <br />
					<a href="/oauth/facebook.php?login" class="connect facebook" title="Sign up using Facebook">Facebook</a>
		        	<a href="/oauth/google.php?login" class="connect google" title="Sign up using Google">Google</a>   			        
			 </div>
				<div class="info">Sign up with your email address</div><br />
								<div class="form-group">
					<label>Username <br />
						<input type="text" name="username" class="form-input" />
					</label>
				</div>	
								<div class="form-group">
					<label>Email <br />
						<input type="text" name="email" class="form-input" />
					</label>
				</div>
								<div class="form-group">
					<label>Full Name <br />
						<input type="text" name="full" class="form-input" />
					</label>
				</div>
								<div class="form-group">
					<label>Password <br />
						<input type="password" name="password" class="form-input" />
					</label>
				</div>
				</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Sign up</button>	
			</div>
			 <input type="hidden" name="signup" value="<?php echo md5($date.$ip); ?>" />
			</form>
            
<?php } elseif (isset($_GET['forget']))  {?>

<form action="/login.php?forget" method="POST" class="loginme-form">
		
        	<div class="modal-body">

				<div class="info">Enter your email address</div><br />
	
								<div class="form-group">
					<label>Email <br />
						<input type="text" name="email" class="form-input" />
					</label>
				</div>

				</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"><?php echo $lang['49']; ?></button>	
			</div>
			 <input type="hidden" name="forget" value="<?php echo md5($date.$ip); ?>" />
			</form>
            
<?php } elseif (isset($_GET['resend']))  {?>   
   <form action="/login.php?resend" method="POST" class="loginme-form">
		
        	<div class="modal-body">

				<div class="info"><?php echo $lang['47']; ?></div><br />
	
								<div class="form-group">
					<label>Email <br />
						<input type="text" name="email" class="form-input" />
					</label>
				</div>

				</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"><?php echo $lang['48']; ?></button>	
			</div>
			 <input type="hidden" name="resend" value="<?php echo md5($date.$ip); ?>" />
			</form>   
<?php } else  {?> <br />
<?php echo $lang['46']; ?> <br /><br />
<a  style="color: #3C81DE;" href="/login.php?login" ><?php echo $lang['42']; ?></a><br />
<a  style="color: #3C81DE;" href="/login.php?register" ><?php echo $lang['43']; ?></a> <br />     
<a  style="color: #3C81DE;" href="/login.php?forget" ><?php echo $lang['44']; ?></a><br />
<a  style="color: #3C81DE;" href="/login.php?resend" ><?php echo $lang['45']; ?></a><br />
<?php  } ?>
</div>
</div>
 
</div>
 
             <br />     <div class="xxxd"> <center>
<?php echo $ads_1; ?></center>
</div>  <br />
               </div>         </div>        