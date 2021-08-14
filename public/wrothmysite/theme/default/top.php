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
<br />

        <div class="more" style="background-color: #FFF;">
                <div class="container">
                    <h2 class="text-center" style=" font-size: 25px;"><?php echo $lang['100']; ?></h2>
                    <center>
                    <?php
$loop = 0;
$first_time =1;
$rsd = getTopSites($con,$offset,$per_page);

//we loop through each records
while($row = mysqli_fetch_array($rsd)) {

$check_loop = $loop % 3;
$csite =  Trim($row['domain']);
$esitmated_worth =  number_format(Trim($row['estimated_worth']));
$no_csite = str_replace('.','',$csite);
$filename = "site_snapshot/$csite.jpg";

    if ($mod_rewrite == '1') {
        $d_url = '/'.$csite;
        }
        else
        {
        $d_url = 'result.php?domain='.$csite;
        }
        
if (file_exists($filename)) {
   $myimage = '/'.$filename;
} else {
    $myimage =  "$default_path/img/no-preview.png";
}
        
if ($check_loop == "0")
{
    if ($first_time == "1")
    {
       $first_time = 0; 
       echo '<div class="row">';
    }
    else
    {
       echo '</div>  <br />   '.$ads_1.'    <br /><br /><div class="row">';
    }
        
echo '            
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <a href="http://'.$csite.'"><img class="image-overlay" src="'.$myimage.'" alt="'.$csite.'" /></a>
                                <div class="caption">
                                    <h4 style=" font-weight: bold;">'.ucfirst($csite).'</h4>
                                    '.$lang['54'].':  $'.$esitmated_worth.'
                                    <p>
                                         <a target="_blank" rel="nofollow" href="http://'.$csite.'" class="btn btn-success" role="button">Visit</a> 
                                         <a href="'.$d_url.'" class="btn btn-primary" role="button">Details</a>
                                          </p>
                                </div>
                            </div>
                        </div>';

}
else
{
    

echo ' 
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <a href="http://'.$csite.'"><img class="image-overlay" src="'.$myimage.'" alt="'.$csite.'" /></a>
                                <div class="caption">
                                    <h4 style=" font-weight: bold;">'.ucfirst($csite).'</h4>
                                     '.$lang['54'].':  $'.$esitmated_worth.'
                                    <p>
                                         <a target="_blank" rel="nofollow" href="http://'.$csite.'" class="btn btn-success" role="button">Visit</a> 
                                         <a href="'.$d_url.'" class="btn btn-primary" role="button">Details</a>
                                          </p>
                                </div>
                            </div>
                        </div>';

}
$loop++;
}
?> <br /> <?php echo $pg->process(); ?></center>

                </div><!-- /.container -->
            </div><!-- /.more --> 
             <br />     
             <div class="raino_panel">
<div class="xxxd"> <center>
<?php echo $ads_1; ?></center>
</div>  
               <br />
                 </div> </div> </div>