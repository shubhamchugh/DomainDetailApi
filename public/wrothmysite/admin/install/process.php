<?php
/*
 * @author Balaji
 */
error_reporting(1);

$data_host = htmlspecialchars(Trim($_POST['data_host']));
$data_name = htmlspecialchars(Trim($_POST['data_name']));
$data_user = htmlspecialchars(Trim($_POST['data_user']));
$data_pass = htmlspecialchars(Trim($_POST['data_pass']));
$data_sec = htmlspecialchars(Trim($_POST['data_sec']));
$domain = Trim($_SERVER['HTTP_HOST']);

$con = mysqli_connect($data_host,$data_user,$data_pass,$data_name);

if (mysqli_connect_errno())
{
echo "Database Connection failed";
die();
}

$stats = Trim(file_get_contents("http://lic.prothemes.biz/worthmysite.php?code=$data_sec&domain=$domain"));

if ($stats == '1') {
    //Fine
}
elseif ($stats == '0') {
    echo 'Item purchase code not valid';
    die();
}
elseif ($stats == '2') {
    echo 'Already code used on another domain! Contact Support';
    die();
}
elseif ($stats == '') {
    echo 'Unable Connect to Server!';
    die();
}
else {
    echo 'Item purchase code not valid / banned';
    die();
}

$data = '<?php
/*
 * @author Balaji
 * @name: Worth My Site PHP Script
 * @copyright 2018 ProThemes.Biz
 *
 */
error_reporting(1);

// MySQL Hostname
$mysql_host = \''.$data_host.'\';

// MySQL Username
$mysql_user = \''.$data_user.'\';

// MySQL Password
$mysql_pass = \''.$data_pass.'\';

// MySQL Database Name
$mysql_database = \''.$data_name.'\';

//Item Purchase Code
$item_purchase_code = \''.$data_sec.'\';

//mod_rewrite
$mod_rewrite = \'1\';


//Oauth Services

// Facebook
define(\'FB_APP_ID\', \' \');   // Enter your facebook application id
define(\'FB_APP_SECRET\', \' \');    // Enter your facebook application secret code
define(\'FB_Redirect_Uri\', \'http://' . $_SERVER['HTTP_HOST'] .'/oauth/facebook.php\');

// Google 
define(\'G_Client_ID\', \' \');  // Enter your google api application id
define(\'G_Client_Secret\', \' \'); // Enter your google api application secret code
define(\'G_Redirect_Uri\', \'http://' . $_SERVER['HTTP_HOST'] .'/oauth/google.php\');
define(\'G_Application_Name\', \'Worth_My_Site\');

//Moz API
define(\'MOZ_ACCESS_ID\', \'\'); // Enter your moz api access code
define(\'MOZ_SECRET_KEY\', \'\'); // Enter your moz api secret key
?>';

file_put_contents('../../config.php',$data);

echo "1";
die();
?>