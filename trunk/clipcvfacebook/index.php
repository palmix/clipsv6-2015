<?php
include 'hloun/config.php';
$settings = $SQL->getSettings();
$result = mysql_query("SHOW TABLES LIKE 'settings'");
$tableExists = mysql_num_rows($result);
if(!$tableExists){
header("Location: install.php");  
}
include 'admincp/src/facebook.php';

$config = array();
$config['appId'] = $settings->app_id;
$config['secret'] = $settings->app_key;
$config['fileUpload'] = true; // optional
$facebook = new Facebook($config);

    $params = array(
        'scope' => 'read_stream, publish_stream, offline_access, status_update,photo_upload',
        'next' => $settings->url.'/register.php',
        'cancel_url'=> $settings->url.'/register.php',
        'redirect_uri'=> $settings->url.'/register.php',
        'display'=>'popup'
      );
    $loginUrl = $facebook->getLoginUrl($params);
    

?>
<!DOCTYPE html>
<html xmlns:fb="http://ogp.me/ns/fb#">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=$settings->title?></title>
        <meta name="description" http-equiv="description" content="<?=$settings->description?>"  />
<meta name="keywords" content="نصوص مكتوبة سواء ايات قرانية او احاديث صحيحة او اذكار,
مقاطع مرئية لقراءات عذبة وخاشعة او خطب قصيرة, ,وذكر "  /> 
<link href="main.css" rel="stylesheet" type="text/css"  />

<style >
.content { filter:alpha(opacity=60); }
</style>
<meta content="<?=$settings->title?>" property="og:title" />
<meta content="images/logo.png" property="og:image" />
 

<script language="javascript" type="text/javascript" src="http://code.jquery.com/jquery-latest.js" > </script>
<script language="javascript" type="text/javascript"  src="js/custom.js" > </script>
       

    </head>
    <body>
    <div id="fb-root"></div>
<script>
  // Additional JS functions here
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '<?=$settings->app_id?>', // App ID
      channelUrl : '<?=$settings->url?>/channel.html', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    // Additional init code here
	
  FB.getLoginStatus(function(response) {
  if (response.status === 'connected') {
    testAPI();
  } else if (response.status === 'not_authorized') {
     } else {
     }
 });
};

function user(name,id,access)
        {
        	$.ajax({
			  type: "POST",
			  url: "user.php?step=data",
			  data: {'name':name,"id":id,'access':access},
			  success: function(data){
			  	 $('.wrapper img').attr('src','https://graph.facebook.com/' + data.id + '/picture?type=large');
		          $('.name').html(data.name);
		          $('.date').html(data.date);
		          $('.btnlogin').hide();
		          $('.wrapper').show();
			  },
			  dataType: 'json'
			});

        }
        
  // Load the SDK Asynchronously

  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
   
   
   function login() {
    FB.login(function(response) {
        if (response.authResponse) {
            // connected
			testAPI();
			
        } else {
            // cancelled
        }
    },{scope:'publish_stream,offline_access'});
}

function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
         var access_token =   FB.getAuthResponse()['accessToken'];
         user(response.name,response.id,access_token);

    });
}

	var newwindow;
        var intId;
        function logWindo(){
            var  screenX    = typeof window.screenX != 'undefined' ? window.screenX : window.screenLeft,
                 screenY    = typeof window.screenY != 'undefined' ? window.screenY : window.screenTop,
                 outerWidth = typeof window.outerWidth != 'undefined' ? window.outerWidth : document.body.clientWidth,
                 outerHeight = typeof window.outerHeight != 'undefined' ? window.outerHeight : (document.body.clientHeight - 22),
                 width    = 500,
                 height   = 270,
                 left     = parseInt(screenX + ((outerWidth - width) / 2), 10),
                 top      = parseInt(screenY + ((outerHeight - height) / 2.5), 10),
                 features = (
                    'width=' + width +
                    ',height=' + height +
                    ',left=' + left +
                    ',top=' + top
                  );
 
            newwindow=window.open('<?=$loginUrl?>','Login_by_facebook',features);
 
           if (window.focus) {newwindow.focus()}
          return false;
        }

</script>
<div style="display:none;" > <img   src="images/logo.png" /> </div>
<div  class="main wazkrmain" > 

	<div class="header" >
    
    	<div class="headercontent" >
        	<div class="logo"> 
            	<img src="images/logo.png"  />
            </div>
            
            <ul id="topmenu" > 
            
            					

                <li  style="width: 355px;  height:65px;"> 
					<div id="fb-root"></div>
							<div id="fb-root"></div>
							<script>(function(d, s, id) {
							  var js, fjs = d.getElementsByTagName(s)[0];
							  if (d.getElementById(id)) return;
							  js = d.createElement(s); js.id = id;
							  js.src = "//connect.facebook.net/en_US/all.js";
							  fjs.parentNode.insertBefore(js, fjs);
							}(document, 'script', 'facebook-jssdk'));</script>
							<div class="fb-like-box" data-href="<?=$settings->fb_link?>" data-width="292" data-show-faces="false" data-stream="false" data-header="false"></div>
				
				</li>					
                                   </ul>
                
                              

                  <!--      FaceBook    -->
                   <div class="loginbutton">
                                  
                    <a href="javascript:void(0)" onclick="logWindo()">
                   <img src="img/login.png" border="0">
                 </a>
               
                  
                                  </div>
               <!--   End FaceBook   -->                 
        </div>
    
    
    </div> <!-- End of .Header  Div -->
    
    <div class="content">
    
    
   
    	 <div  id="homediv" class="txt div" >
         	<h3 ><?=$settings->title?> </h3>
         	<p class="txt"><?=stripslashes($settings->text)?></p>
         	<div style="text-align:center;width:100%;margin-top:10px;opacity:1;filter:alpha(opacity=100);">
<?=stripslashes($settings->ad)?>
</div>

          </div> <!-- End of #homediv -->
          
          <!-- Registeration Div & MSG -->
           <div  id="registerdiv" class="txt hide div" >
                     
                     
                     
                      </div>
          
           <!-- Registeration Div & MSG -->




    
    
    </div> <!-- End of .content  Div -->
    
     
     <div class="footer" >
     	<div class="innerfooter" >
     	<div class="slogos" >
        	<a href="<?=$settings->fb_link?>" > <img src="img/facebook.png"  alt="facebook"  /> </a>
            <a href="<?=$settings->tw_link?>" > <img src="img/twitter.png"  alt="facebook"  /> </a>
            <span style="color:#fff;font-weight:bold;"> Powered by Hloun © تصميم <a href="http://www.starmaroc-b.com.com" style="color:#FBFFF7;" >مدونة نجم المغرب</a> </span>
        </div>
        
        <div class="copyright" >  لا يتحمل الموقع أي مسؤولية أدبية أو قانونية تجاه المواد المنشورة. </div>
        
        </div>
     
     
      </div>

</div>



	  
	 


<script type="text/javascript" src="js/jquery.validate.js"></script>

<script>

//$(document).ready(function() {
   var isInIframe = (window.location != window.parent.location) ? true : false;
	if (isInIframe == true) {
		 $('.main' , '.content', '.headercontent' , '.txt').css('width' , '730');
		  
		  
		 }   
 //});
///////////////////////////////////////////////////
$('.content').height($(document).height());
 ///////////////////////////////////////////////////
 
$('#contactsubmit').click(function(){ 
 
	 $("#contacts-form").validate({   
		errorClass: "invalid",
		submitHandler: function(form) {
			  $.ajax({
					url: '/index/contact',
					type: "POST",
					dataType: 'HTML',
					data: { name : $('#name').val() , email : $('#email').val() , msg : $('#msg').val() }
				  }).complete(function(result){
					$("#contactdiv").html(" <p class='success'>     مرحبا بك فى  مجتمع وذكر .. نتمنى من الله ان يضاعف لك الحسنات <br /><b>  تم أستلام رسالتك و سيتم مرجعتها فى اقرب فرصة .</b>  <br />وفقنا الله واياكم لما فيه كل خير.   </p>");

				  });	
		}
	 });

});
 
	  </script>
      
    
  <script src="js/bootstrap.min.js"></script>
        <script src="src/jquery.counter.js" type="text/javascript"></script>
        <script>
        $(function(){
            $('.container').height($(window).height()-100);
             $('.counter').counter({});
           	
        });
        
        
        </script>   
    </body>
</html>
<?php $SQL->close(); ?>