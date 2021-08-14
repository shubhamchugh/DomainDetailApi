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
}</style>  

<div class="header">
<h2>
<?php echo $lang['57']; ?></h2>
</div>
<div class="contentx">
<div class="box-radius">
<div class="row">
<?php 

if (isset($success))
{
echo '<div class="alert alert-success">
<strong>Alert!</strong> '.$success.' <br /> '.$lang['40'].'
</div>'; 
header("Location: index.php");
echo '<meta http-equiv="refresh" content="1;url=index.php">'; 
}
elseif (isset($error))
{
    echo '<div class="alert alert-error">
<strong>Alert!</strong> '.$error.'
</div>'; 
}
if (isset($old_user))
{
echo '<br/> <div class="alert alert-info">
<strong>Alert!</strong> Login Success.. '.$lang['40'].'
</div>'; 
header("Location: index.php");
echo '<meta http-equiv="refresh" content="1;url=index.php">'; 
}
else
{
?>
<div class="alert alert-success">
<strong>Alert!</strong> <?php echo $lang['58']; ?>
</div>

<br />
  <form method="POST" action="/oauth.php?newuser" class="loginme-form">
			<div class="modal-body">
				<div class="info"><?php echo $lang['59']; ?></div> <br />
				
                <div class="form-group">
					<label><?php echo $lang['60']; ?><br />
						<input readonly="" style="cursor:not-allowed;" type="text" name="autoname" class="form-input" value="<?php echo $username; ?>"/>
					</label>
				</div>	
                
				<div class="form-group">
					<label><?php echo $lang['61']; ?> <br />
						<input type="text" name="new_username" class="form-input" />
					</label>
				</div>	
			</div>
			 <input type="hidden" name="user_change" value="<?php echo md5($date.$ip); ?>" />
 			<div class="modal-footer">
				<button type="submit" class="btn btn-primary"><?php echo $lang['63']; ?></button>	
   	            <a href="/index.php" class="btn btn-primary"><?php echo $lang['62']; ?></a>	
			</div>
<?php } ?>
</div>
</div>
 
</div>
 
             <br />     <div class="xxxd"> <center>
<?php echo $ads_1; ?></center>
</div>  <br />
               </div>         </div>      