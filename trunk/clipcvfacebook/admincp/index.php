<?php
include '../hloun/config.php';
$settings = $SQL->getSettings(); 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>لوحة التحكم - <?=$settings->title?></title>
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="../css/app.css" rel="stylesheet">
        <link href="../css/jquery-te-1.3.3.css" rel="stylesheet">
        <script src="../js/jquery.js"></script>

    </head>
    <body>
        <div class="container">
            <div class="data" style="min-height:400px;">
            <?php
            if(isLogin()){
                
                  ?>
                <div class="row">
                    <div class="span8">
                       <?php
                          if(!isset($_GET['step']))
                          {
                              include 'home.inc.php';
                          }elseif(isset($_GET['step']))
                          {
                              if($_GET['step']=='setting')
                              {
                                include 'setting.inc.php';
                                
                              }elseif($_GET['step']=='admin')
                              {
                               include 'admin.inc.php';
                              }elseif($_GET['step']=='users')
                              {
                               include 'users.inc.php';
                              }elseif($_GET['step']=='posts')
                              {
                                  include 'posts.inc.php';
                              }
                          }
                          ?>
                        
                    </div>
                    <div class="span3">
                       <?php include 'menu.inc.php'; ?>
                    </div>
                </div>

                
                
                
                <?php
                }else{
                include 'login.inc.php'; 
                } 
                ?>
            </div>
        </div>
         <footer class="navbar-fixed-bottom" style="text-align: center;color:#fff;font-family: sans-serif;">
Powered by Hloun © تصميم <a href="http://www.starmaroc-b.com" target="_blank" style="color:#FBFFF7;">مدونة نجم المغرب</a>  
                     </footer>
       
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/jquery-te-1.3.3.min.js"></script>
        <script src="admin.js"></script>
    </body>
</html>