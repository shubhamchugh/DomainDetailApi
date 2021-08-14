<?php
/*
 * @author Balaji
 */
 
error_reporting(1);

require_once('../config.php');
require_once('../mail/mail.php');

    $user_email = htmlspecialchars(trim($_POST['email']));
    $name = htmlspecialchars(trim($_POST['name']));
    $sub = htmlspecialchars(trim($_POST['subject']));   
    
    $con = mysqli_connect($mysql_host,$mysql_user,$mysql_pass,$mysql_database);

  if (mysqli_connect_errno())
  {
  echo "<br>Failed to connect to MySQL: " . mysqli_connect_error();
  }
    $query =  "SELECT * FROM site_info";
    $result = mysqli_query($con,$query);
        
    while($row = mysqli_fetch_array($result)) {
    $admin_email =   Trim($row['email']);
    $site_name =   Trim($row['site_name']);
    }
    
// SMTP information 
$query =  "SELECT * FROM mail WHERE id='1'";
$result = mysqli_query($con,$query);
        
while($row = mysqli_fetch_array($result)) {
        $smtp_host =   Trim($row['smtp_host']);
        $smtp_user =  Trim($row['smtp_username']);
        $smtp_pass =  Trim($row['smtp_password']);
        $smtp_port =  Trim($row['smtp_port']);
        $protocol =  Trim($row['protocol']);
        $smtp_auth =  Trim($row['auth']);
        $smtp_sec =  Trim($row['socket']);
}
$mail_type = $protocol;
    
$emailTo = $admin_email;

	// Do not edit anything from here unless you know what you are doing
	$contactErrors = array();

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{	
		if(trim($_POST['subject']) === '')
		{
			$contactErrors['subject'] = 'Subject is required.';
            goto me;
		}
		else
		{
 		$subject = htmlspecialchars(trim($_POST['subject']));
		}
		
        $name =  htmlspecialchars(trim($_POST['name']));
        
		if(trim($_POST['email']) === '')
		{
			$contactErrors['email'] = 'Your email address is required.';
		}
		else if (!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$^", htmlspecialchars(trim($_POST['email']))))
		{
			$contactErrors['email'] = 'Your email address seems to be invalid.';
            goto me;
		}
		else
		{
			$email = htmlspecialchars(trim($_POST['email']));
		}
		
		if(trim($_POST['message']) === '')
		{
			$contactErrors['message'] = 'Your message is required.';
            goto me;
		}
		else
		{
			if (function_exists('stripslashes'))
			{
				$message = stripslashes(trim($_POST['message']));
			}
			else
			{
				$message = htmlspecialchars(trim($_POST['message']));
			}
		}
		
		if (empty($contactErrors) && trim($emailTo) !== '')
		{			
			$body = "Name: $name \n\nEmail: $email \n\nMessage: $message";
			$subject_name = "Enquiry $name";
             
        if ($mail_type == '1')
        {
          default_mail ($email,$subject_name,$emailTo,$subject,$body);
        }
        else
        {
          smtp_mail($smtp_host,$smtp_port,$smtp_auth,$smtp_user,$smtp_pass,$smtp_sec,$email,$subject_name,$emailTo,$subject,$body);
        }
        
			$emailSent = true;
		}
        
me:
  if (isset($emailSent))
    {
       echo '1';
    }
    else
    {
        echo "Something went wrong";
    } 
    }
?>