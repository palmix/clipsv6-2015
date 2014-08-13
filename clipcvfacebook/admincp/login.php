<?php 
include '../hloun/config.php';
if(isset($_GET['step']))
{
    if($_GET['step']=='login' && !isset($_SESSION['login']))
    {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        if(empty($username)||empty($password))
        {
         echo json_encode(array('st'=>'error','msg'=>'جميع الحقول مطلوبة !'));   
        }else
        {
            $username = mysql_real_escape_string(htmlentities($username));
            $password = md5($password);
            $b = $SQL->login($username,$password);
            echo json_encode($b);
        }
    }else{
           echo json_encode(array('wt'=>'login','msg'=>'لقد قمت بتسجيل الدخول من قبل !'));
    }
}
?>