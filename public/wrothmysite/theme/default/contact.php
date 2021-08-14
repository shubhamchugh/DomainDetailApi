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
 <script>
function contactDoc()
{
var xmlhttp;
var user_name = $('input[name=c_name]').val();
var user_email = $('input[name=c_email]').val();
var user_sub = $('input[name=c_subject]').val();
var user_mes = $('textarea[name=email_message]').val();
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    }
  }
$.post("../core/message.php", {name:user_name,email:user_email,subject:user_sub,message:user_mes}, function(results){
if (results == 1) {
     $("#c_alert1").show();
}
else
{
     $("#c_alert2").show();
     alert(results);
}
});
}
</script>   
 <script>
function contactDocX()
{
var xmlhttp;
var user_name = $('input[name=c_name]').val();
var user_email = $('input[name=c_email]').val();
var user_sub = $('input[name=c_subject]').val();
var user_mes = $('textarea[name=email_message]').val();
var capc = $('input[name=scode]').val();
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    }
  }
$.post("../core/verify.php", {scode:capc}, function(results){
if (results == 1) {
$.post("../core/message.php", {name:user_name,email:user_email,subject:user_sub,message:user_mes}, function(results){
if (results == 1) {
     $("#c_alert1").show();
}
else
{
     $("#c_alert2").show();
     alert(results);
}
});
}
else
{
alert("Captcha code is wrong!");
}
});
}
</script>   
    <div class="wrapper">  
<div class="raino_panel" style="padding-top: 60px;">
<div class="xxxd"> <center>
<?php echo $ads_1; ?></center>
</div>   
<br />

<div  style="padding-left: 15%;padding-right: 15%;">
        <form method="post" action="#">
                        <div class="modal-body">
                        <h3> <?php echo $lang['28']; //We value all the feedbacks received from our customers. ?></h3>

<?php echo $lang['29']; //If you have any queries, comments, suggestions or have anything to talk about. ?>
<br /><br />
                        <div id="c_alert1">
                              <div class="alert alert-success alert-dismissable">
       <i class="fa fa-check"></i>
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
       <b>Alert!!</b> <?php echo $lang['30']; //Message Sent Successfully.?> </div>
                        </div>
                        <div id="c_alert2">
                                <div class="alert alert-danger alert-dismissable">
       <i class="fa fa-ban"></i>
       <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
         <b>Alert!</b> <?php echo $lang['31']; //Error - Try Again (Message Failed) ?> </div>
                        </div>
                        <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><?php echo $lang['32']; ?></span>
                                    <input type="text" placeholder="Enter your full name" class="form-control" id="c_name" name="c_name">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><?php echo $lang['33']; ?></span>
                                    <input type="email" placeholder="Enter your email id" class="form-control" id="c_email" name="c_email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><?php echo $lang['34']; ?></span>
                                    <input type="email" placeholder="Enter your subject" class="form-control" id="c_subject" name="c_subject">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea style="height: 180px;" placeholder="Message" class="form-control" id="email_message" name="email_message"></textarea>
                            </div>
                        </div>
                                     <?php
                        if ($cap_c == "on")
        {
        echo '<center><h4>'.$lang['35'].' </h4><img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA" class="imagever">
        <input type="text" class="form-control input-sm" id="scode" name="scode" style="margin-top:5px; width:14%;"></center>
        ';  
        }
                ?>
                        <div class="modal-footer clearfix">
                        <br />
                        <?php                if ($cap_c == "on")
        { ?> 
                                    <button class="btn btn-primary" onclick="contactDocX()" type="button"><i class="fa fa-envelope"></i> Send Message</button>
        <?php  } else { ?>
                            <button class="btn btn-primary" onclick="contactDoc()" type="button"><i class="fa fa-envelope"></i> Send Message</button>
                       <?php } ?>
                        </div>
                    </form>     </div>
 
             <br />     <div class="xxxd"> <center>
<?php echo $ads_1; ?></center>
</div>  <br />
               </div>         </div>        