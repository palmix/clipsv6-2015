<?php 
include '../hloun/config.php';
include 'src/facebook.php';
$settings = $SQL->getSettings();
$config = array();
$config['appId'] = $settings->app_id;
$config['secret'] = $settings->app_key;
$config['fileUpload'] = true; // optional
$facebook = new Facebook($config);
if(isLogin()){
    if(isset($_POST['id']) && $_POST['id'] !='')
    {
        $id = abs(intval($_POST['id']));
        $sql = mysql_query("select * from posts where id=".$id);
        $data = mysql_fetch_object($sql);
        $text = stripslashes($data->text);
        $idb   = $data->id;
        mysql_query("update posts set send='1' where id=".$idb);
        $uid = abs(intval($_POST['uid']));
        
        $users=  mysql_query("select * from users where id='$uid'");
        if(mysql_num_rows($users)>0)
        {   $send = false;  
            $post['message'] = $text;
            if($data->type==1)
            {
            $post['link'] = stripslashes($data->link);
            }elseif($data->type==2)
            {
            $post['source'] = '@'.$data->link;
            }
            $names = '';
            $row=  mysql_fetch_array($users);
            
                $userid = $row['user_id'];
                $post['access_token'] = $row['access'];
                $name = $row['name'];
                
                try {
                if($data->type==2)
                    {
                        $add= $facebook->api('/'.$userid.'/photos/','post',$post);
                    }else{
                        $add= $facebook->api('/'.$userid.'/feed','post',$post);
                    }   
                
                $send = true;
                
             } catch (FacebookApiException $e) { 
                 error_log('Could not post image to Facebook.'); 
                 
                 }
            $nuser = $SQL->nUser($row['id']);
            
            if($send==true)
            {
            echo json_encode(array(
                'st'=>'done',
                'msg'=>'تم النشر بنجاح'. $name .' <a href="//facebook.com/'.$add['id'].'">شاهد المنشور من هنا</a>',
                'nid'=>$nuser,
                'pid'=>$data->id
                ));    
            }else{
            echo json_encode(array(
                'st'=>'done1',
                'msg'=>'لم يتم النشر على '.$name,
                'nid'=>$nuser,
                'pid'=>$idb
                ));
            }
            
        }else{
            echo json_encode(array('st'=>'error','msg'=>'لا يوجد لديك اعضاء !'));
        }
        
    }
}else{
    header("HTTP/1.0 404 Not Found");
}    
?>