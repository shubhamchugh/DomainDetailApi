<?php
/*
 * @author Balaji
 * @name: Worth My Site PHP Script
 * @Theme: Default Style
 * @copyright © 2017 ProThemes.Biz
 *
 */
?>
 <footer class="footer">
           <div class="container" >
                    <div class="row">
                        <div class="none" style="float:left; margin-top: 14px;">
                            <!-- Powered By ProThemes.Biz --> 
                            <!-- Contact Us: https://prothemes.biz/index.php?route=information/contact --> 
                            <?php echo $copyright; ?>
                        </div>
                        <div class="none" style="float:right;">

		<a class="ultm ultm-facebook ultm-32 ultm-color-to-gray" href="<?php echo $face; ?>" target="_blank" rel="nofollow" data-toggle="tooltip" data-placement="top" title="Facebook Page"></a>
		<a class="ultm ultm-twitter ultm-32 ultm-color-to-gray" href="<?php echo $twit; ?>" target="_blank" rel="nofollow" data-toggle="tooltip" data-placement="top" title="Twitter Account"></a>
		<a class="ultm ultm-google-plus-1 ultm-32 ultm-color-to-gray" href="<?php echo $rgplus; ?>" target="_blank" rel="nofollow" data-toggle="tooltip" data-placement="top" title="Google+ Profile"></a>

                        </div>
                    </div>
                </div>

                <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php echo $ga; ?>', 'auto');
  ga('send', 'pageview');

</script>
            </footer>             

        </div><!--/.wrapper --> 

        <!-- jQuery 1.10.2 -->
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <!-- Latest compiled and minified Bootstrap JavaScript -->
        <script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

        <!-- Bootstrap -->
        <script src="<?php echo $default_path; ?>/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="<?php echo $default_path; ?>/js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="<?php echo $default_path; ?>/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="<?php echo $default_path; ?>/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="<?php echo $default_path; ?>/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo $default_path; ?>/js/AdminLTE/app.js" type="text/javascript"></script>

          </div>  </div></div>

      <!-- Sign in -->
<div class="modal fade loginme" id="signin" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Sign in</h4>
			</div>
            <form method="POST" action="/login.php?login" class="loginme-form">
			<div class="modal-body">
				<div class="alert alert-warning">
					<button type="button" class="close dismiss">&times;</button><span></span>
				</div>
				<div class="form-group connect-with">
					<div class="info">Sign in using social network</div>
					<a href="/oauth/facebook.php?login" class="connect facebook" title="Sign in using Facebook">Facebook</a>
		        	<a href="/oauth/google.php?login" class="connect google" title="Sign in using Google">Google</a>  			        
			 </div>
				<div class="info">Sign in with your username</div>
				<div class="form-group">
					<label>Username <br />
						<input type="text" name="username" class="form-input"  style=" width: 96%;"/>
					</label>
				</div>	
				<div class="form-group">
					<label>Password <br />
						<input type="password" name="password" class="form-input"  style=" width: 96%;" />
					</label>
				</div>
			</div>
			<div class="modal-footer"> <br />
				<button type="submit" class="btn btn-primary  pull-left">Sign in</button>
				<div class="pull-right align-right">
				    <a style="color: #3C81DE;" href="/login.php?forget">Forgot Password</a><br />
					<a style="color: #3C81DE;" href="/login.php?resend">Resend activation email</a>
				</div>
			</div>
			 <input type="hidden" name="signin" value="<?php echo md5($date.$ip); ?>" />
			</form> 
		</div>
	</div>
</div>  
<!-- Sign up -->
<div class="modal fade loginme" id="signup" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Sign up</h4>
			</div>
			<form action="/login.php?register" method="POST" class="loginme-form">
			<div class="modal-body">
				<div class="alert alert-warning">
					<button type="button" class="close dismiss">&times;</button><span></span>
				</div>
				<div class="form-group connect-with">
					<div class="info">Sign up using social network</div>
					<a href="/oauth/facebook.php?login" class="connect facebook" title="Sign up using Facebook">Facebook</a>
		        	<a href="/oauth/google.php?login" class="connect google" title="Sign up using Google">Google</a>  			        
			 </div>
				<div class="info">Sign up with your email address</div>
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
			<div class="modal-footer"> <br />
				<button type="submit" class="btn btn-primary">Sign up</button>	
			</div>
			 <input type="hidden" name="signup" value="<?php echo md5($date.$ip); ?>" />
			</form>
		</div>
	</div>
</div>   </div> 
<?php

if (isset($_GET['site']) && isset($_GET['update']))
{
    $site = Trim(htmlentities($_GET['site']));
    echo "<script>
document.getElementById('url').value='$site';
mloadXMLDoc();
</script>";
}

?>
    </body>
</html>