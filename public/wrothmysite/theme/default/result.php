<?php

/*
* @author Balaji
* @name: Worth My Site PHP Script
* @Theme: Default Style
* @copyright 2019 ProThemes.Biz
*
*/

// Disable Errors
error_reporting(1);
?>
<style>
.box .box-header{
    border-bottom: 1px solid #eae9e9 !important;
}
</style>
<div id="content">
   <div id="index-content">
        <div id="newcontent1"> <div id="newcontent"> <div class="wrapper"> 
 <div class="home">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <h1 class="animated fadeInDown delay-1" style="text-transform: none;">
                                 How much is <?php echo $domain; ?> worth?   </h1>

                            <p style="color: #fff;">        
                            <?php echo $lang['64']; ?>
                            </p>
                            <br />
                            <div class="animated fadeInUp delay-4"> 
                            <div style="display:table;">
                            <img src="<?php echo $default_path; ?>/img/money.png" alt="" />
                            <span style="color: #fff; vertical-align: middle;display: table-cell; font-size:25px;"><?php echo $lang['54']; ?> <br />$ <?php echo $estimated_worth; ?> <br />
                            <small style="font-size: 13px;">&nbsp;&nbsp; <?php echo $lang['65']; ?> <?php echo $last_date; ?></small>
                            <div>
                            &nbsp;&nbsp;<a class="btn btn-danger" href="index.php?site=<?php echo $domain; ?>&update"> <i class="fa fa-refresh"></i> <?php echo $lang['66']; ?> </a>&nbsp;&nbsp;
                            <a rel="nofollow" target="_blank" class="btn btn-warning" href="http://<?php echo $domain; ?>"> <i class="fa fa-share-square-o"></i> <?php echo $lang['67']; ?> </a>
                            </div></span>
                            </div>

                            </div>
                        </div><!--./col-md-6 -->
                        <div class="col-sm-6 presentation">
                            <div class="animated slideInRight delay-1">
                                <div id="downloads" class="downloads"> <?php echo ucfirst($domain); ?></div>
                                
         
                                <img alt="<?php echo ucfirst($domain); ?>" src="<?php echo $myimage; ?>" class="imagedropshadow" />
                            </div>
                        </div><!--./col-md-6 -->
                    </div><!-- /.row -->
                </div>
            </div>
                    <!--ad -->  
<div class="raino_panel">
        <div class="container">
            <h4 class="page-header"></h4>
                <div class="features-menu">
                    <div class="container">
                
<center>
<?php echo $ads_1; ?>
  <br /> <br /> 
</center>                
                 </div>           
                     </div>
                        </div>
</div><!-- /.ad -->  
<div class="raino_panel"><br /><br />
        <div class="container">
        <div class="box box-primary">
                                <div class="box-header">
                                <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title"><?php echo $lang['68']; ?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered table-striped">
                                        <tbody><tr>
                                            <th>#</th>
                                            <th><?php echo $lang['69']; ?></th>
                                            <th><?php echo $lang['70']; ?></th>
                                            <th><?php echo $lang['71']; ?></th>
                                        </tr>
                                        <tr>
                                            <td><strong><?php echo $lang['72']; ?></strong></td>
                                            <td><span class="badge bg-blue"><?php echo number_format($daily_page_view); ?></span></td>
                                            <td><span class="badge bg-blue"><?php echo number_format($daily_unique_visitors); ?></span></td>
                                            <td><span class="badge bg-blue">$ <?php echo number_format($daily_inc); ?></span></td>
                                        </tr>
                                        <tr>
                                           <td><strong><?php echo $lang['73']; ?></strong></td>
                                            <td><span class="badge bg-red"><?php echo number_format($monthly_page_view); ?></span></td>
                                            <td><span class="badge bg-red"><?php echo number_format($monthly_unique_visitors); ?></span></td>
                                            <td><span class="badge bg-red">$ <?php echo number_format($monthly_inc); ?></span></td>
                                        </tr>
                                        <tr>
                                           <td><strong><?php echo $lang['74']; ?></strong></td>
                                            <td><span class="badge bg-green"><?php echo number_format($yearly_page_view); ?></span></td>
                                            <td><span class="badge bg-green"><?php echo number_format($yearly_unique_visitors); ?></span></td>
                                            <td><span class="badge bg-green">$ <?php echo number_format($yearly_inc); ?></span></td>
                                        </tr>
                                       
                                    </tbody></table>
                                </div><!-- /.box-body -->

<hr /> <br />
    <div class="row">  <br />
         <div class="col-md-6" style="text-align: center; border-right:1px solid #F3F4F5;">
          <p><?php echo $lang['75']; ?></p>
        <div style="padding-left: 31%;">
        <script type="text/javascript" src="<?php echo (isset($_SERVER["HTTPS"]) ? 'https://' : 'http://'). $_SERVER['HTTP_HOST']; ?>/widget.php?site=<?php echo $domain;?>"></script>
        </div> <br />
        <button class="btn btn-success" data-target="#widget_code" data-toggle="modal"><i class="fa fa-share-square"></i> <?php echo $lang['75']; ?></button>

         </div>    

    <div class="col-md-6" style="text-align: center;">
                 <?php if(isset($_SESSION['token']))
          { ?>
               <p><?php echo $lang['76']; ?></p>
          <?php } else { ?>
     <p><?php echo $lang['77']; ?></p>
     <?php } ?> 
     <img src="<?php echo $default_path; ?>/img/pdf.png" alt="" title=""/> <br /><br />
             <?php if(isset($_SESSION['token']))
          { ?>
     <form method="POST" action="core/gen_pdf.php">
     <input type="hidden" name="site_name" value="<?php echo $site_name; ?>" />
     <input type="hidden" name="domain" value="<?php echo $domain; ?>" />
     <input type="hidden" name="last_date" value="<?php echo $last_date; ?>" />
     <input type="hidden" name="estimated_worth" value="<?php echo $estimated_worth; ?>" />
     <input type="hidden" name="site_title" value="<?php echo $site_title; ?>" />
     <input type="hidden" name="site_des" value="<?php echo $site_des; ?>" />
     <input type="hidden" name="site_keyword" value="<?php echo $site_keyword; ?>" />
     <input type="hidden" name="domain_age" value="<?php echo $domain_age; ?>" />
     <input type="hidden" name="response_time" value="<?php echo $response_time; ?>" />
     <input type="hidden" name="global_rank" value="<?php echo $global_rank; ?>" />
     <input type="hidden" name="alexa_pop" value="<?php echo $alexa_pop; ?>" />
     <input type="hidden" name="regional_rank" value="<?php echo $regional_rank; ?>" />
     <input type="hidden" name="alexa_back" value="<?php echo $alexa_back; ?>" />
     <input type="hidden" name="g_page_rank" value="<?php echo $g_page_rank; ?>" />
     <input type="hidden" name="g_indexed_page" value="<?php echo $g_indexed_page; ?>" />
     <input type="hidden" name="y_indexed_page" value="<?php echo $y_indexed_page; ?>" />
     <input type="hidden" name="b_indexed_page" value="<?php echo $b_indexed_page; ?>" />
     <input type="hidden" name="g_back" value="<?php echo $alexa_back; ?>" />
     <input type="hidden" name="b_back" value="<?php echo $b_back; ?>" />
     <input type="hidden" name="dmoz" value="<?php echo $dmoz; ?>" />
     <input type="hidden" name="moz_rank" value="<?php echo $moz_rank; ?>" />
     <input type="hidden" name="da" value="<?php echo $da; ?>" />
     <input type="hidden" name="pa" value="<?php echo $pa; ?>" />
     <input type="hidden" name="face_like" value="<?php echo $face_like; ?>" />
     <input type="hidden" name="face_share" value="<?php echo $face_share; ?>" />
     <input type="hidden" name="face_comment" value="<?php echo $face_comment; ?>" />
     <input type="hidden" name="tweet" value="<?php echo $tweet; ?>" />
     <input type="hidden" name="gplus" value="<?php echo $gplus; ?>" />
     <input type="hidden" name="pinterest" value="<?php echo $pinterest; ?>" />
     <input type="hidden" name="linkedin" value="<?php echo $linkedin; ?>" />
     <input type="hidden" name="stumbleupon" value="<?php echo $stumbleupon; ?>" />
     <input type="hidden" name="domain_ip" value="<?php echo $domain_ip; ?>" />
     <input type="hidden" name="country" value="<?php echo $country; ?>" />
     <input type="hidden" name="isp" value="<?php echo $isp; ?>" />
     <input type="hidden" name="blacklist" value="<?php echo $blacklist; ?>" />
     <input type="hidden" name="safe_browsing" value="<?php echo $safe_browsing; ?>" />
     <input type="hidden" name="antivirus" value="<?php echo $antivirus; ?>" />
     <input type="hidden" name="monthly_page_view" value="<?php echo $monthly_page_view; ?>" />
     <input type="hidden" name="daily_page_view" value="<?php echo $daily_page_view; ?>" />
     <input type="hidden" name="yearly_page_view" value="<?php echo $yearly_page_view; ?>" />
     <input type="hidden" name="monthly_unique_visitors" value="<?php echo $monthly_unique_visitors; ?>" />
     <input type="hidden" name="daily_unique_visitors" value="<?php echo $daily_unique_visitors; ?>" />
     <input type="hidden" name="yearly_unique_visitors" value="<?php echo $yearly_unique_visitors; ?>" />
     <input type="hidden" name="monthly_inc" value="<?php echo $monthly_inc; ?>" />
     <input type="hidden" name="daily_inc" value="<?php echo $daily_inc; ?>" />
     <input type="hidden" name="yearly_inc" value="<?php echo $yearly_inc; ?>" />
     <input type="hidden" name="myimage" value="<?php echo $myimage; ?>" />
     <button type="submit" class="btn btn-primary"><i class="fa fa-cloud-download"></i> <?php echo $lang['78']; ?></button>
     </form>
     <?php } else { ?>
     <button data-target="#signin" data-toggle="modal" class="btn btn-primary"><i class="fa fa-cloud-download"></i> <?php echo $lang['78']; ?></button>
     <?php } ?>
     <br />   <br />
         </div>
     </div>
                            </div>
     </div>
</div>

<div class="raino_panel"><br /><br />
        <div class="container">
        <div class="box box-success">
                                <div class="box-header">
                                <i class="fa fa-desktop"></i>
                                    <h3 class="box-title"><?php echo $lang['79']; ?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered table-striped">
                                        <tbody><tr>
                                            <th><?php echo $lang['80']; ?></th>
                                            <th><?php echo $lang['81']; ?></th>
                                        </tr>
                                        <tr>
                                            <td><strong><?php echo $lang['82']; ?></strong></td>
                                            <td><?php echo $site_title; ?></td>

                                        </tr>
                                        <tr>
                                           <td><strong><?php echo $lang['83']; ?></strong></td>
                                            <td><?php echo $site_des; ?></td>
                                        </tr>
                                        <tr>
                                           <td><strong><?php echo $lang['84']; ?></strong></td>
                                            <td><?php echo $site_keyword; ?></td>
                                        </tr>
                                       
                                    </tbody>
                              <tbody><tr><td style="background-color: #FFF;" colspan="2">&nbsp;</td></tr>
                                        </tbody>
                                     <tbody>
                                        <tr>
                                            <td><strong><?php echo $lang['85']; ?></strong></td>
                                            <td><?php echo $domain_age; ?></td>

                                        </tr>
                                        <tr>
                                           <td><strong><?php echo $lang['86']; ?></strong></td>
                                            <td><?php echo $response_time; ?> Sec</td>
                                        </tr>
                                       
                                    </tbody>
                                    
                                    </table>
                                </div><!-- /.box-body -->

                            </div>
                            
     </div>
</div>


<div class="raino_panel"><br /><br />
        <div class="container">
        <div class="box box-danger">
                                <div class="box-header">
                                <i class="fa fa-bar-chart-o"></i>
                                    <h3 class="box-title"><?php echo $lang['87']; ?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                    <table class="table table-bordered table-hover">
                                        <tbody><tr>
                                            <th style="width: 200px;">#</th>
                                            <th><?php echo $lang['88']; ?></th>
                                        </tr>
                                        <tr>
                                            <td><strong>Global Rank</strong></td>
                                            <td><?php echo $global_rank; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Popularity at</strong></td>
                                            <td><?php echo $alexa_pop; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Regional Rank</strong></td>
                                            <td><?php echo $regional_rank; ?></td>
                                        </tr>
                                                                              
                                    </tbody></table>
                                    <br />
                                    <div class="row">
                                        <div class="col-md-4">
                                        <h3 class="box-title">Traffic Rank</h3>
                                        <img style="margin-top: 20px; height: 190px; width: 350px; overflow: hidden;" src="https://traffic.alexa.com/graph?w=300&h=230&o=f&c=1&y=t&b=ffffff&n=666666&r=2y&u=<?php echo $domain; ?>" />
                                        </div>
                                        <div class="col-md-4">
                                         <h3 class="box-title">Search Engine Traffic</h3>
                                        <img style="margin-top: 20px; height: 190px; width: 350px; overflow: hidden;" src= "https://traffic.alexa.com/graph?w=300&h=230&o=f&c=1&y=q&b=ffffff&n=666666&r=2y&u=<?php echo $domain; ?>"/>
                                        </div>
                                        <div class="col-md-4"> <br />
                                        <?php echo $ads_2; ?>
                                        </div>
                                    </div>
                                </div><!-- /.box-body -->

                            </div>
     </div>
</div>

<div class="raino_panel"><br /><br />
        <div class="container">
        <div class="box box-primary">
                                <div class="box-header">
                                <i class="fa fa-dashboard"></i>
                                    <h3 class="box-title"><?php echo $lang['89']; ?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">
                                   <div class="row">
                                        <div class="col-md-6">
                               <table class="table table-bordered table-striped">
                                        <tbody><tr>
                                            <th><?php echo $lang['90']; ?></th>
                                            <th><?php echo $lang['91']; ?></th>
                                        </tr>
                                        <tr>
                                            <td><strong>Google Indexed Pages</strong></td>
                                            <td><span class="badge bg-aqua"><?php echo $g_indexed_page; ?></span></td>

                                        </tr>
                                        <tr>
                                           <td><strong>Yahoo Indexed Pages</strong></td>
                                            <td><span class="badge bg-green"><?php echo $y_indexed_page; ?></span></td>
                                        </tr>
                                        <tr>
                                           <td><strong>Bing Indexed Pages</strong></td>
                                           <td><span class="badge bg-orange"><?php echo $b_indexed_page; ?></span></td>
                                        </tr>
                                        <tr>
                                           <td><strong>DMOZ Directory</strong></td>
                                            <td><span class="badge bg-blue"><?php echo $dmoz; ?></span></td>
                                        </tr>

                                    </tbody></table>
                                        </div>
                                        
                                        <div class="col-md-6">
                                <table class="table table-bordered table-striped">
                                        <tbody><tr>
                                            <th><?php echo $lang['90']; ?></th>
                                            <th><?php echo $lang['91']; ?></th>
                                        </tr>
                                        <tr>
                                           <td><strong>Backlinks</strong></td>
                                            <td><span class="badge bg-red"><?php echo $alexa_back; ?></span></td>
                                        </tr>
                                        <tr>
                                           <td><strong>Mozrank Checker</strong></td>
                                           <td><span class="badge bg-olive"><?php echo $moz_rank;?></span></td>
                                        </tr>
                                        <tr>
                                           <td><strong>Page Authority Score</strong></td>
                                           <td><span class="badge bg-aqua"><?php echo $pa;?></span></td>
                                        </tr>
                                        <tr>
                                           <td><strong>Domain Authority Score</strong></td>
                                           <td><span class="badge bg-purple"><?php echo $da;?></span></td>
                                        </tr>
                                    </tbody></table>
                                        </div>
                                        
                                        </div>
                                        
            
                                </div><!-- /.box-body -->

                            </div>
     </div>
</div>

<div class="raino_panel"> <br /><br />
        <div class="container">
        
                <div class="box box-info">
                                <div class="box-header">
                                <i class="fa fa-users"></i>
                                    <h3 class="box-title"><?php echo $lang['92']; ?></h3>
                                </div><!-- /.box-header -->
                                <div class="box-body">

                                </div><!-- /.box-body -->
<div class="row" style="padding: 40px; margin-top: -30px; ">
                            <div class="col-md-4 col-sm-6">
                                <div class="panel">
                                    <div class="panel-heading bg-facebook text-center">
                                        <a>
                                            <i class="fa fa-facebook fa-3x"></i>
                                        </a>
                                    </div>
                                    <div class="padder-v text-center clearfix">                            
                                        <div class="h3 font-bold"><?php echo $face_like; ?></div>
                                        <small class="text-muted">Facebook</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="panel">
                                    <div class="panel-heading bg-twitter text-center">
                                        <a>
                                            <i class="fa fa-twitter fa-3x"></i>
                                        </a>
                                    </div>
                                       <div class="padder-v text-center clearfix">                            
                                        <div class="h3 font-bold"><?php echo $tweet; ?></div>
                                           <br>
                                        <small class="text-muted">Tweets</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="panel">
                                    <div class="panel-heading text-center" style="background-color: #FF6C44;">
                                        <a>
                                            <i class="fa fa-instagram fa-3x"></i>
                                            
                                        </a>
                                    </div>
                                    <div class="padder-v text-center clearfix">                            
                                        <div class="h3 font-bold"><?php echo $face_share; ?></div>
                                        <br>
                                        <small class="text-muted">Instagram</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        
    </div>                    
     </div>
</div>

<!--ad -->  
<div class="raino_panel">
        <div class="container">
            <h4 class="page-header"></h4>
                <div class="features-menu">
                    <div class="container">
                
<center>
<?php echo $ads_1; ?>
 <br /> <br /> 
</center>                
                 </div>           
                     </div>
                        </div>
</div><!-- /.ad -->  

<div class="raino_panel"><br /><br />
        <div class="container">
            
            <div class="row">
                        <div class="col-md-6">

              
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">
                                     <i class="fa fa-unlink"></i>
                                   <?php echo $lang['93']; ?></h3>
                                </div>
                                <div class="box-body">

  <table class="table table-striped">
                                        <tbody>
                                        <tr>
                                            <td>Domain IP</td>
                                            <td> <span class="badge bg-green"><?php echo $domain_ip; ?></span></td>

                                        </tr>
                                         <tr>
                                            <td>Country</td>
                                            <td><b><span class="badge bg-light-blue"><?php echo $country; ?></span></b></td>

                                        </tr>
                                            <tr>
                                            <td>ISP</td>
                                            <td><span class="badge bg-red"><?php echo $isp; ?></span></td>
                                        </tr>
                                     <tr>
              <td></td>          <td></td>
                                        </tr>
                                    </tbody></table>                          
                                    
                                    
                                    <br />
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title">
                                    <i class="fa fa-ban"></i>
                                    <?php echo $lang['94']; ?> </h3>
                                </div>
                                <div class="box-body">
 Your server IP(<?php echo $domain_ip; ?>) is <?php echo $blacklist; ?>. <br /><br />
 <?php echo $lang['95']; ?><br /><br />
                              </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            
                                          <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title">
                                   <i class="fa fa-bug"></i>
                                    <?php echo $lang['96']; ?></h3>
                                </div>
                                <div class="box-body">
                    <div class="box-body no-padding">
                                    <table class="table table-striped">
                                        <tbody><tr>
                                            <th><?php echo $lang['90']; ?></th>
                                            <th><?php echo $lang['97']; ?></th>
                                        </tr>
                                        <tr>
                                            <td>Safe Browsing</td>
                                                 <td><?php echo $safe_browsing; ?></td>
                                     </tr>

                                        <tr>
                                            <td>Antivirus Check</td>
                                                <td><?php echo $antivirus; ?></td>   
                                        </tr>

                                    </tbody></table>
                                </div><br />

                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                            
                        </div><!-- /.col (LEFT) -->
                        <div class="col-md-6">

                            <div class="box box-info">
                                <div class="box-header">
                                    <h3 class="box-title">
                                    <i class="fa fa-user"></i>
                                    <?php echo $lang['98']; ?></h3>
                                </div>
                                <div class="box-body chart-responsive">
<div class="form-group">
<textarea readonly="" class="form-control" rows="29" placeholder="WHOIS Information..."><?php echo $whois_info; ?></textarea>
                                        </div>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->


                        </div><!-- /.col (RIGHT) -->
                    </div>
     </div>
     
<!-- Get Widget Code -->
<div class="modal fade loginme" id="widget_code" role="dialog" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?php echo $lang['99']; ?></h4>
			</div>
		
			<div class="modal-body">
				<div class="alert alert-warning">
					<button type="button" class="close dismiss">&times;</button><span></span>
				</div>

				<div class="form-group">
                <br />    <br />
				<textarea style="    height: 70px;
    width: 99%;"><script type="text/javascript" src="<?php echo (isset($_SERVER["HTTPS"]) ? 'https://' : 'http://'). $_SERVER['HTTP_HOST']; ?>/widget.php?site=<?php echo $domain;?>"></script></textarea>
				</div>	

				</div>
			<div class="modal-footer">
			
			</div>
		</div>
	</div>
</div>
</div>