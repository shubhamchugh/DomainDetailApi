<?php

/*
* @author Balaji
* @name: Worth My Site PHP Script
* @Theme: Default Style
* @copyright © 2016 ProThemes.Biz
*
*/

// Disable Errors
error_reporting(1);
?>
   
             
             <div id="content">
   <div id="index-content">
        <div id="newcontent1"> <div id="newcontent"> <div class="wrapper">  <center>
            <div class="home">
            
                     <div id="preloader">
         
                              <div class="container">
         <div class="row" style="color: #FFFFFF;">
                            <h1>
                              <?php echo $site_name; ?>
                            </h1>
<h4 style="color: #FFFFFF;"><?php echo $lang['50']; ?>.</h4>
                
                
<br /><?php echo $lang['51']; ?> <br /><br />

<div id="spinningSquaresG">
<div id="spinningSquaresG_1" class="spinningSquaresG">
</div>
<div id="spinningSquaresG_2" class="spinningSquaresG">
</div>
<div id="spinningSquaresG_3" class="spinningSquaresG">
</div>
<div id="spinningSquaresG_4" class="spinningSquaresG">
</div>
<div id="spinningSquaresG_5" class="spinningSquaresG">
</div>
<div id="spinningSquaresG_6" class="spinningSquaresG">
</div>
<div id="spinningSquaresG_7" class="spinningSquaresG">
</div>
<div id="spinningSquaresG_8" class="spinningSquaresG">
</div>
</div> 
<div id="xxd">
<?php echo $text_ads; ?>
</div>
                   
                    </div><!-- /.row -->
                </div>
         
         
         </div>
             <div id="myhome">
                <div class="container">
                    <div class="row" style="color: #FFFFFF;">


                            <h1>
                               <?php echo $site_name; ?>
                            </h1>
<h4 style="color: #FFFFFF;"><?php echo $lang['50']; ?>.</h4>
                

                    <div class="input-group"  style="width:63%;">     <form onsubmit="loadXMLDoc(); return false">                                                         
                  <input type="text" placeholder="<?php echo $lang['52']; ?>" name="url" id="url" class="form-control input-sm" /></form>
                  <div class="input-group-btn">
                   <button class="btn btn-sm btn-default" style="width:40px;height:30px;" onclick="loadXMLDoc()" ><i class="fa fa-search"></i></button>
                   </div>
                   </div>                  


             <b><?php echo $lang['56']; ?>:</b>   <a onclick="document.getElementById('url').value='<?php echo $ex_1; ?>';loadXMLDoc()" href="#" title="Get <?php echo ucfirst($ex_1); ?> details"><?php echo ucfirst($ex_1); ?></a>, <a onclick="document.getElementById('url').value='<?php echo $ex_2; ?>';loadXMLDoc()" href="#" title="Get <?php echo ucfirst($ex_2); ?> details"><?php echo ucfirst($ex_2); ?></a>  and so on ...
                   
                   
<br /><br />
<div id="xxxd">
<?php echo $text_ads; ?>
</div>
                   
                    </div><!-- /.row -->
                </div></div>
                
                             <div id="newhome">
                <div class="container">
                    <div class="row" style="color: #FFFFFF;">


                            <h1>
                               <?php echo $site_name; ?>
                            </h1>
<h4 style="color: #FFFFFF;"><?php echo $lang['50']; ?>.</h4>
                

                    <div class="input-group"  style="width:63%;">     <form onsubmit="cap_loadXMLDoc(); return false">                                                         
                  <input type="text" placeholder="<?php echo $lang['52']; ?>" name="cap_url" id="cap_url" class="form-control input-sm" /></form>
                  <div class="input-group-btn">
                   <button class="btn btn-sm btn-default" style="width:40px;height:30px;" onclick="cap_loadXMLDoc()" ><i class="fa fa-search"></i></button>
                   </div>
                   </div>                  


             <b>Example Searches:</b>   <a onclick="document.getElementById('url').value='<?php echo $ex_1; ?>';loadXMLDoc()" href="#" title="Get <?php echo ucfirst($ex_1); ?> details"><?php echo ucfirst($ex_1); ?></a>, <a onclick="document.getElementById('url').value='<?php echo $ex_2; ?>';loadXMLDoc()" href="#" title="Get <?php echo ucfirst($ex_2); ?> details"><?php echo ucfirst($ex_2); ?></a>  and so on ...
                   
             
                <?php
                        if ($cap_e == "on")
        {
        echo '<br /><br /><h4>'.$lang['35'].' </h4><img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA" class="imagever">
        <input type="text" class="form-control input-sm" id="scode" name="scode" style="margin-top:5px; width:14%;">
        ';  
        }
                ?>
                   
                    </div><!-- /.row -->
                </div></div>
                
            </div><!-- /.home -->

        <!--ad -->  
<div class="raino_panel">
        <div class="container">
            <h4 class="page-header"></h4>
                <div class="features-menu">
                    <div class="container">
                
<center>
<div >
<?php echo $ads_1; ?>
</div>  <br /> <br /> 
</center>                
                 </div>           
                     </div>
                        </div>
</div><!-- /.ad -->  
            

            <div class="more" style="background-color: #FFF;">
                <div class="container">
                    <h2 class="text-center" style=" font-size: 25px;"><?php echo $lang['53']; ?></h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="thumbnail">
                                <a href="http://<?php echo $ps_1; ?>"><img class="image-overlay" src="/site_snapshot/<?php echo $ps_1; ?>.jpg" alt="<?php echo $ps_1; ?>" /></a>
                                <div class="caption">
                                    <h4 style=" font-weight: bold;"><?php echo ucfirst($ps_1); ?></h4>
                                     <?php echo $lang['54']; ?>: $<?php echo number_format($ps_1_worth); ?>
                                    <p>
                                         <a target="_blank" rel="nofollow" href="http://<?php echo $ps_1; ?>" class="btn btn-success" role="button">Visit</a> 
                                          <a href="<?php echo $ps_1_url; ?>" class="btn btn-primary" role="button">Details</a>
                                          </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="thumbnail">
                                <a href="http://<?php echo $ps_2; ?>"><img class="image-overlay" src="/site_snapshot/<?php echo $ps_2; ?>.jpg" alt="<?php echo $ps_2; ?>" /></a>
                                <div class="caption">
                                    <h4 style=" font-weight: bold;"><?php echo ucfirst($ps_2); ?></h4>
                                    <?php echo $lang['54']; ?>: $<?php echo number_format($ps_2_worth); ?>
                                    <p>
                                         <a target="_blank" rel="nofollow" href="http://<?php echo $ps_2; ?>" class="btn btn-success" role="button">Visit</a> 
                                          <a href="<?php echo $ps_2_url; ?>" class="btn btn-primary" role="button">Details</a>
                                          </p>
                                </div>
                            </div>
                        </div>

                          <div class="col-md-4">
                            <div class="thumbnail">
                                <a href="http://<?php echo $ps_3; ?>"><img class="image-overlay" src="/site_snapshot/<?php echo $ps_3; ?>.jpg" alt="<?php echo $ps_3; ?>" /></a>
                                <div class="caption">
                                    <h4 style=" font-weight: bold;"><?php echo ucfirst($ps_3); ?></h4>
                                     <?php echo $lang['54']; ?>: $<?php echo number_format($ps_3_worth); ?>
                                    <p>
                                         <a target="_blank" rel="nofollow" href="http://<?php echo $ps_3; ?>" class="btn btn-success" role="button">Visit</a> 
                                          <a href="<?php echo $ps_3_url; ?>" class="btn btn-primary" role="button">Details</a>
                                          </p>
                                </div>
                            </div>
                        </div>
                        
                    </div><!-- /.row -->
                </div><!-- /.container -->
            </div><!-- /.more -->   
             
<div class="raino_panel" style="border-top: 1px solid #e1e1e1;">
            <div class="container">
<h4 class="page-header">

</h4>
                              <div class="features-menu">
                <div class="container">
                
<center>
<?php echo $ads_1; ?>

  <br /> <br /> </center>                
                 </div>           
                     </div>
 </div> 
            </div>           
            
            <div class="more" style="background-color: #FFF;">
                <div class="container">
                    <h2 class="text-center" style=" font-size: 25px;"><?php echo $lang['55']; ?></h2>
                    
                    <?php
$loop = 0;
$first_time =1;
$sql= "SELECT * FROM site_history WHERE id IN (SELECT max(id)FROM site_history GROUP BY site)ORDER BY id DESC LIMIT 0, 6";
$rsd = mysqli_query($con,$sql);

//we loop through each records
while($row = mysqli_fetch_array($rsd)) {

$check_loop = $loop % 3;
$csite =  Trim($row['site']);
$esitmated_worth =  Trim($row['worth']);
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
       echo '</div>  <br />       <br /><div class="row">';
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
?>

                </div><!-- /.container -->
            </div><!-- /.more --> 
             <br />       <br />
                  