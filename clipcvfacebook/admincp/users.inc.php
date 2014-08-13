<?php if($inc !='hloun') {header("HTTP/1.0 404 Not Found");  exit();} ?> 
  <table class="table table-striped" style="background-color: #fff;border-radius: 2px;">
      <thead>
      <td>#</td>
      <td>الصورة</td>
      <td>اسم المستخدم</td>
      <td>تاريخ الاشتراك</td>
      <td>ادوات</td>
      </thead>
      
      <?php
      $SQL=mysql_query("select * from users order by id desc");
      while($data=mysql_fetch_object($SQL))
      {
          ?>
       <tr uid="t<?=$data->id?>">
          <td><?=$data->id?></td>
          <td><img src="https://graph.facebook.com/<?=$data->user_id?>/picture"  style="width:30px;height:30px;"></td>
          <td><?=stripslashes($data->name)?></td>
          <td><?=date("h:i - d/m/y",$data->date)?></td>
          <td>
              <a href="#" style="padding:3px" class="uremove" uid="<?=$data->id?>"><i class="icon-remove"></i></a>
              <a href="//facebook.com/<?=$data->user_id?>" target="_blank" style="padding:3px"><i class="icon-facebook">fb</i></a>
          </td>   
      </tr>
          <?php
      }
      
      ?>
  </table>