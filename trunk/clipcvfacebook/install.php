<?php 
include 'hloun/config.php';
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Post Install</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="css/app.css" rel="stylesheet">
        <link href="css/jquery-te-1.3.3.css" rel="stylesheet">
        <script src="js/jquery.js"></script>
        <style>
            input{
                height: 30px !important;
            }
        </style>
    </head>
    <body>
              <div class="container">
            <div class="data" style="min-height:400px;">
                 <div class="row">
                     <div class="span8">
                         <?php 
                         if(!isset($_GET['step'])){
                             ?>
                         <h2 style="color:#fff;">مرحبا بك في صفحة تركيب السكربت المعدل من قبل كدونة نجم المغرب</h2>
                <a href="?step=install" class="btn-primary btn">تنصيب السكربت</a>
                             <?php
                         }elseif($_GET['step']=="install"){
$result = mysql_query("SHOW TABLES LIKE 'settings'");
$tableExists = mysql_num_rows($result);
if($tableExists){
header("Location: index.php");  
die();
}
                        
                                 $database['post'] = 'CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` longtext NOT NULL,
  `date` text NOT NULL,
  `send` int(11) NOT NULL,
  `link` text NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
';   
                                
                                 $database['settings'] = 'CREATE TABLE IF NOT EXISTS `settings` (
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `app_id` text NOT NULL,
  `app_key` text NOT NULL,
  `fb_link` text NOT NULL,
  `tw_link` text NOT NULL,
  `text` longtext NOT NULL,
  `ad` longtext NOT NULL,
  `admin` text NOT NULL,
  `password` text NOT NULL,
  `url` text NOT NULL,
  `corn` int(11) NOT NULL,
  `corn_time` text NOT NULL,
  `last_share` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;';
                                 $database['users'] = 'CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` text NOT NULL,
  `access` longtext NOT NULL,
  `date` text NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;';
                                 
 mysql_query($database['post']);
 mysql_query($database['users']);
 mysql_query($database['settings']);
 mysql_query("INSERT INTO `settings` (`title`, `description`, `app_id`, `app_key`, `fb_link`, `tw_link`, `text`, `ad`, `admin`, `password`, `url`, `corn`, `corn_time`, `last_share`) VALUES
('title', 'des', '146106128901415', 'c13503eb6d614c4b1e62254186cdf593', 'https://www.facebook.com/starmaroc.blog', 'https://twitter.com/', 'texthere', '<img src=\"img/ads.gif\"/>', 'admin', '25f9e794323b453885f5181f1b624d0b', 'http://starmaro-b.com/', 1, '2', '1')");

                                 

                          
                         ?>
                <form method="post" id="usettings" action="?step=done">
                         <table class="table table-striped" style="background-color: #fff;border-radius: 2px;">
                             <tr>
                             
                                <td colspan="2">
                                    <div>طريقة عمل تطبيق فيسبوك</div>
                                    <div>
                                        <iframe width="560" height="315" src="http://www.youtube.com/embed/T7TqP7_21KQ" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>اسم الموقع</td> 
                                <td><input type="text" name="title" value=""/></td>
                            </tr>
                            <tr>
                                <td>رابط الموقع</td> 
                                <td>
                                    <input type="text" name="url" style="text-align: left"  dir="ltr" value="" />
                                </td>
                            </tr>
                            <tr>
                                <td>رقم تطبيق الفيسبوك</td> 
                                <td>
                                    <input type="text" name="app_id" style="text-align: left"  dir="ltr"  value="" />
                                </td>
                            </tr>
                            <tr>
                                <td>مفاتح تطبيق الفيسبوك</td> 
                                <td>
                                    <input type="text" name="app_key" style="text-align: left"  dir="ltr" value="" />
                                </td>
                            </tr>
                            <tr>
                                <td>رابط صفحة الفيسبوك</td> 
                                <td>
                                    <input type="text" name="fb_link" style="text-align: left"  dir="ltr" value="" />
                                </td>
                            </tr>
                            <tr>
                                <td>رابط توتير</td> 
                                <td>
                                    <input type="text" name="tw_link" style="text-align: left"  dir="ltr"  value="" />
                                </td>
                            </tr>
                            <tr>
                                <td> النشر التلقائي </td>
                                <td><select name="corn">
                                       
                                        <option value="0">معطل</option>
                                        <option value="1">مفعل</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>موعد النشر <span style="color:red">الوقت بالساعات</span></td>
                                <td>
                                    <input type="number" name="corn_time"/>
                                </td>
                            </tr>
                            <tr>
                               <td colspan="2">
                                    <div style="font-weight: 500">وصف الموقع</div>
                                    <textarea name="description" style="width:70%;height:70px;"></textarea>
                                </td>
                            </tr>
                            <tr>
                               <td colspan="2">
                                   <div style="font-weight: 500">كود الاعلان <span style="color:red;"> يفضل 468x60</span></div>
                                    <textarea name="ad" style="text-align: left;width:70%;height:70px;" dir="ltr"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div style="font-weight: 500">النص الرئيسي</div>
                                    <textarea id="text" name="text"></textarea>
                                    <input type="hidden" name="textb"/>
                                </td>
                            </tr>
                            <tr>
                                <td>اسم المدير</td>
                                <td><input type="text" name="admin"/></td>
                            </tr>
                            <tr>
                                <td>كلمة السر</td>
                                <td><input type="password" name="password"/></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="btn btn-primary">تنصيب <i class="icon-wrench"></i></button>
                                    <span style="margin-right:5px;display: none;" class="loder"><img src="img/load.gif" style="width:30px;height:30px;"></span>
                                    <input type="hidden" name="install" value="install"/>
                                </td>
                            </tr>
                           
                            </table>
                       </form>
                              
                      <?php }elseif($_GET['step']=='done'){
                          $msg = null;
            $title         = $_POST['title'];
           
            $description   = $_POST['description'];
            
            $app_id        = $_POST['app_id'];
            
            $app_key       = $_POST['app_key'];
            
            $fb_link       = $_POST['fb_link'];
            
            $tw_link       = $_POST['tw_link'];
            
            $url           = $_POST['url'];
            
            $ad            = $_POST['ad'];
            
            $text          = $_POST['text'];
            
            $corn          = $_POST['corn'];
            
            $corn_time     = $_POST['corn_time'];
            if(!empty($title))
            {
                $title = $SQL->sUpdate('title',$title);
                if($title)
                {
                  $msg .='تم تعديل العنوان بنجاح <br>';  
                }
            }
            if(!empty($description))
            {
                $des = $SQL->sUpdate('description',$description);
                if($des)
                {
                  $msg .='تم تعديل الوصف بنجاح <br>';  
                }
            }
            if(!empty($app_id))
            {
                $app_id = $SQL->sUpdate('app_id',$app_id);
                if($app_id)
                {
                  $msg .='تم تعديل رقم التطبيق بنجاح<br>';  
                }
            }
            if(!empty($app_key))
            {
                $app_key = $SQL->sUpdate('app_key',$app_key);
                if($app_key)
                {
                  $msg .='تم تعديل مفاتح التطبيق بنجاح<br>';  
                }
            }
            if(!empty($fb_link))
            {
                $fb_link = $SQL->sUpdate('fb_link',$fb_link);
                if($fb_link)
                {
                  $msg .='تم تعديل صفحة الفيسبوك بنجاح<br>';  
                }
            }
            if(!empty($tw_link))
            {
                $tw_link = $SQL->sUpdate('tw_link',$tw_link);
                if($tw_link)
                {
                  $msg .='تم تعديل رابط توتير بنجاح<br>';  
                }
            }
            if(!empty($url))
            {
                $url = $SQL->sUpdate('url',$url);
                if($url)
                {
                  $msg .='تم تعديل رابط الموقع بنجاح<br>';  
                }
            }
            
            if(!empty($ad))
            {
                $ad = $SQL->sUpdate('ad',$ad,true);
                if($ad)
                {
                  $msg .='تم تعديل الاعلان بنجاح<br>';  
                }
            }
            
            if(!empty($text))
            {
                $text = $SQL->sUpdate('text',$text,true);
                if($text)
                {
                  $msg .='تم تعديل النص  الرئيسي بنجاح <br>';  
                }
            }
            
            if(!empty($corn))
            {
                $corn = $SQL->sUpdate('corn',$corn);
                if($corn)
                {
                  $msg .='تم تعديل النشر التلقائي بنجاح <br>';  
                }
            }
            
            if(!empty($corn_time))
            {
                $corn_time = $SQL->sUpdate('corn_time',$corn_time);
                if($corn_time)
                {
                  $msg .='تم تعديل وقت النشر التلقائي بنجاح';  
                }
            }
            $name = $SQL->sUpdate('admin',$_POST['admin']);  
            if($name)
            {
                $msg .='تم تعديل الاسم بنجاح <br>';
            }
              $pas = $SQL->sUpdate('password',md5($_POST['password']));  
                        if($pas)
                        {
                            $msg .='تم تعديل كلمة السر بنجاح <br>';
                        } 
            
            echo '<div style="color:#fff">'.$msg.'</div>';
                      } ?>
                     </div>
                     
                  <div class="span3" style="">
                      <center class="affix" style="color:#fff;">  <h3>هذا السكربت </h3>
                      <h3> مقدم مجانا ومعدل </h3>
                      <h3>من موقع</h3>
                      <h3><a href="//dimahna.com">ليون هوست وديماهنا</a></h3
                      </center>
                  </div>
                </div>
              </div>
              </div>
                       <footer class="navbar-fixed-bottom" style="text-align: center;color:#fff;font-family: sans-serif;">
                         Powered by <a href="//dimahna.com">ت وديماهنا</a> © Version 1.0.0
                      </footer>
       
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery-te-1.3.3.min.js"></script>
        <script>
            $(function(){
                $('.affix').width($('.span3').width());
                 $('textarea[id="text"]').jqte();
            });
        
        </script>
    
    </body>
</html>