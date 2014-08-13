<?php
include '../hloun/config.php';
$settings = $SQL->getSettings();
if(isLogin())
{
    if(isset($_GET['step']))
    {
        if($_GET['step']=='setting')
        {
            $msg = null;
            $title         = $_POST['title'];
           
            $description   = $_POST['description'];
            
            $app_id        = $_POST['app_id'];
            
            $app_key       = $_POST['app_key'];
            
            $fb_link       = $_POST['fb_link'];
            
            $tw_link       = $_POST['tw_link'];
            
            $url           = $_POST['url'];
            
            $ad            = $_POST['ad'];
            
            $text          = $_POST['textb'];
            
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
            
            
            echo json_encode(array('st'=>'done','msg'=>$msg));
        }elseif($_GET['step']=='logout')
        {   
            $_SESSION['login'] = false;
            unset($_SESSION['login']);
            echo json_encode(array('st'=>'done','msg'=>'تم تسجيل الخروج بنحاج'));
        }elseif($_GET['step']=='admin')
        {
           if(isset($_POST['admin']) && $_POST['admin'] !='')
           {
            $name = $SQL->sUpdate('admin',$_POST['admin']);  
            if($name)
            {
                $msg .='تم تعديل الاسم بنجاح <br>';
            }
           }
           if(isset($_POST['oldpassword']) && isset($_POST['npassword']) && isset($_POST['renpassword']) && $_POST['oldpassword'] !="")
           {
           $o = md5($_POST['oldpassword']);
           $op = $settings->password;
               if($op==$o)
               {
                   if(($_POST['npassword']==$_POST['renpassword']) && $_POST['renpassword'] !='')
                   {
                      $pas = $SQL->sUpdate('password',md5($_POST['npassword']));  
                        if($pas)
                        {
                            $msg .='تم تعديل كلمة السر بنجاح <br>';
                        }  
                   }else{
                        $msg .='<span style="color:red">كلمة السر الجديدة غير متطابقة</span><br>';   
                   }
               }else{
                $msg .='<span style="color:red">كلمة السر القديمة غير صحيحة</span>';   
               }
           }
           
           echo json_encode(array('st'=>'done','msg'=>$msg));
        }elseif($_GET['step']=='userRemove')
        {
         if($SQL->UserRemove($_POST['userid']))
             echo 'done';
          else
             echo 'error';  
        }elseif($_GET['step']=='addPost')
        {
            if(trim($_POST['text']) !='' && !empty($_POST['text']))
            {
                $text = addslashes($_POST['text']);
                $type = intval($_POST['type']);
                $date = time();
                
                if($type==0){
                $sql=  mysql_query("insert into posts (text,date)values('$text','$date')");
                }elseif($type==1){
                $link = addslashes($_POST['link']);
                
                if(!empty($link))
                {
                $sql = mysql_query("insert into posts (text,date,type,link)values('$text','$date','$type','$link')") or die(mysql_error());    
                }
                
                }elseif($type==2)
                {
                  $timeb = time();  
                  $link = $_POST['link'];
                  $img = makeimage($link,'img'.time().".png",'tmp/');
                  $sql = mysql_query("insert into posts (text,date,type,link)values('$text','$date','$type','$img')") or die(mysql_error());    
               
               }
                if($sql)
                {
                    
                    if($type==2){
                     echo json_encode(array('st'=>'done',
                         'msg'=>'تم اضافة المنشور الى القاعدة','postId'=>mysql_insert_id()));  
                                         
                    }else{
                        
                    echo json_encode(array('st'=>'done','msg'=>'تم اضافة المنشور الى القاعدة','postId'=>mysql_insert_id()));  
                    }

                
                  
                }else{
                  echo json_encode(array('st'=>'error','msg'=>'نعتذر هنالك خطا ما'.$link));  
                }
            }else{
                 echo json_encode(array('st'=>'error','msg'=>'الرجاء اضافة نص ما'));
            }
        }elseif($_GET['step']=='oldPOST')
        {
            ?>
  <table class="table table-striped" style="background-color: #fff;border-radius: 2px;">
           <tr>
               <td>#</td>
               <td>المنشور</td>
               <td>تاريخ الاضافة</td>
               <td>الحالة</td>
               <td>الاختيارات</td>
           </tr>
           
            <?php 
            $old=  mysql_query("select * from posts order by id desc") or die(mysql_error());
            while($row=  mysql_fetch_object($old))
            {
                ?>
           <tr id="t<?=$row->id?>">
               <td><?=$row->id?>-<? if ($row->type==1){ echo 'رابط'; }elseif($row->type==2){ echo 'صورة';}else{ echo 'نص'; }?></td>
               <td><?=limit_str(stripslashes($row->text),12)?></td>
               <td><?=date("h:i - d/m/y",$row->date)?></td>
               <td><?php if($row->send==1) {echo 'تم النشر' ;} else{ echo 'لم يتم النشر '; } ?></td>
               <td>
                   <a href="#" class="see" title="مشاهدة" id="<?=$row->id?>"><i class="icon-eye-open"></i></a>
                   <a href="#" class="send" title="نشر الان" id="<?=$row->id?>"><i class="icon-download-alt"></i></a>
                   <a href="#" class="delete" title="حذف" id="<?=$row->id?>"><i class="icon-remove"></i></a>
               </td>
           </tr>
                <?php
            }
            ?>
         </table>
    

            <?php
        }elseif($_GET['step']=='postget')
        {   $id=abs(intval($_GET['id']));
        
            $postb = mysql_query("select * from posts where id=".$id) or die(mysql_error());
            $data = mysql_fetch_object($postb);
            if($data->type==1)
            {
            echo '<div><pre class="class="well">'.stripslashes($data->text).'</pre><br><input type="text" value="'.$data->link.'"><div>';
            }elseif($data->type==2){
             echo '<div><pre class="class="well">'.stripslashes($data->text).'</pre><br><img src="'.$data->link.'" /><div>';
            }else{
            echo '<div><pre class="class="well">'.stripslashes($data->text).'</pre><div>';
            }
        }elseif($_GET['step']=='postRemove')
        {   $id=abs(intval($_POST['id']));
            $sremove = mysql_query("delete from posts where id=".$id);
        }
    }
    
}
?>