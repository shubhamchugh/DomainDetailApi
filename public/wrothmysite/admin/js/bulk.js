var myArr = new Array();
var domainArr = new Array();
var myURL= "";

function uploadMe(domainID)
{ 
	if(domainID >= domainArr.length)
	{
		jQuery(".percentimg").fadeOut();
		return;
	}
    var c_link = domainArr[domainID];
    var rgx = /^(http(s)?:\/\/)?(www\.)?[a-z0-9\-]{2,100}(\.[a-z]{2,100})(\.[a-z]{2,2})?$/i; 
    if (c_link==null || c_link=="" || !rgx.test(c_link)) {
	jQuery("#status-"+domainID).html('<b style="color:red">Not a vaild domain name</b>');
    jQuery("#view-"+domainID).html('-');
    window.setTimeout("uploadMe("+(domainID+1)+")", 1000);
    }
    else
    {
	//do the post load
	jQuery("#status-"+domainID).html('<img src="img/small1.gif" />');
	jQuery.post('../core/bulk.php',{sitelink:c_link},function(data){
		if(data == '1')
		{
			jQuery("#status-"+domainID).html('<b style="color:green">Success</b>');
            jQuery("#view-"+domainID).html('<a href="../'+c_link+'" title="View">View</a>');
		}
		else if(data == '2')
        {
			jQuery("#status-"+domainID).html('<b style="color:orange">Already Exists</b>');
            jQuery("#view-"+domainID).html('<a href="../'+c_link+'" title="View">View</a>');
		}
		else if(data == '0')
        {
			jQuery("#status-"+domainID).html('<b style="color:red">Error</b>');
            jQuery("#view-"+domainID).html('-');
		}
		else
        {
			jQuery("#status-"+domainID).html('<b style="color:red">'+data+'</b>');
            jQuery("#view-"+domainID).html('-');
		}
        window.setTimeout("uploadMe("+(domainID+1)+")", 1000);
	});
    }
}
jQuery(document).ready(function(){
    jQuery("#checkButton").click(function()
    {
    var data=jQuery("#sitebox").val();    
    myArr = data.split('\n');
    if(myArr.length < 2)
    {
    alert('Error. Please refresh this page');
    return;
    }
    for(i=0; i < myArr.length; i++)
    {
    myURL= myArr[i];
    myURL=jQuery.trim(myURL);
	if (myURL.indexOf("https://") == 0){myURL=myURL.substring(8);}
    if (myURL.indexOf("http://") == 0){myURL=myURL.substring(7);}
	if (myURL.indexOf("/") != -1){var scs=myURL.indexOf("/");myURL=myURL.substring(0,scs);}
	if (myURL.indexOf(".") == -1 ){myURL+=".com";}
	if (myURL.indexOf(".") == (myURL.length-1)){myURL+="com";}
    myURL = myURL.replace("www.", ""); 
    domainArr[i]=myURL;
    }
    jQuery("#mainbox").fadeOut();
   	jQuery(".percentimg").css({"display":"block"});
   	jQuery(".percentimg").show();
   	jQuery(".percentimg").fadeIn();
    var listHTML = '<table class="table table-bordered"><thead><tr><th>#</th><th>Site</th><th>View</th><th>Status</th></tr></thead><tbody>';
    for(i=0; i < domainArr.length; i++)
    {
    var classTr = i % 2 == 0?'even':'odd';
    listHTML+= '<tr class="'+classTr+'"><td align="center">'+(i+1)+'</td><td id="link-'+i+'"><a href="http://'+domainArr[i]+'" target="_blank">'+domainArr[i]+'</a></td><td align="center" id="view-'+i+'">&nbsp;</td><td align="center" id="status-'+i+'">&nbsp;</td></tr>';
    }
    listHTML+= '</tbody></table>';
   	jQuery("#contentbox").css({"display":"block"});
   	jQuery("#contentbox").show();
    jQuery("#contentbox").html(listHTML);
    jQuery("#contentbox").slideDown();
    setTimeout(function(){
    var pos = $('.percentimg').offset();
    $('body,html').animate({ scrollTop: pos.top });
    }, 1500);
	window.setTimeout("uploadMe(0)", 2000);
    });
});