<?php
include '../hloun/config.php';
include 'src/facebook.php';
$config = array();
$config['appId'] = $settings->app_id;
$config['secret'] = $settings->app_key;
$config['fileUpload'] = false; // optional
$facebook = new Facebook($config);
$settings = $SQL->getSettings();
   $data = array();
   if($settings->corn==1)
    {
       $time = time();
       $corn_time = $settings->corn_time;
       $corn_time = $corn_time*60*60;
       $last_share = $settings->last_share;
       $next =$last_share + $corn_time;
       if($time>=$next)
       { 
            $sql = mysql_query("select * from posts where send='0'") or die(mysql_error());
            if(mysql_num_rows($sql)>=1)
            {
              $users=  mysql_query("select * from users") or die(mysql_error());
                  if(mysql_num_rows($users)>=1){

                        $data['success'] = 1;
                        $data['next'] = $time  + $corn_time;
                        $SQL->sUpdate('last_share',$time);  
                        $post = mysql_query("select * from posts where send='0' ORDER BY RAND() LIMIT 0,1") or die(mysql_error());
                        $datab = mysql_fetch_object($post);
                        $postid = $datab->id;
                        mysql_query("update posts set send='1' where id='$postid'") or die(mysql_error());
                        $postb['message'] = stripslashes($datab->text);
                        $toshow['message'] = stripslashes($datab->text);
                        if($datab->type==1)
                        {
                        $postb['link'] = stripslashes($datab->link);
                        $toshow['link'] = stripslashes($datab->link);
                        }
                        
                        while($userb=mysql_fetch_assoc($users))
                        {
                            $userid = $userb['user_id'];
                            $postb['access_token'] = $userb['access'];
                             try {
                              $facebook->api('/'.$userid.'/feed','post',$postb);
                                
                             } catch (FacebookApiException $e) { 
                                 error_log('Could not post image to Facebook.'); 

                                 }
                        }
                        $data['info'] = $toshow;
                }else{
                   $data['success'] = 0; 
                   $data['msg'] = 'no users';
                }
            }else{
             $data['success'] = 0;  
             $data['msg']='no post to share';
            }
      }else{
       $data['success'] = 0; 
       $data['next']  = $next;
       $data['msg'] = 'not in time';
      }      
   }else{
   $data['success'] = 0; 
   $data['msg']  = 'Corn disabled by admin';
   }
   header('Content-Type: application/json');
   echo json_encode($data);
?>
