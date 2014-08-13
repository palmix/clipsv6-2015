<?php if($inc !='hloun') {header("HTTP/1.0 404 Not Found");  exit();} ?> 
  <table class="table table-striped" style="background-color: #fff;border-radius: 2px;">
      <tr>
          <td colspan="2">
              <div>منشور جديد
              </div>
              <select class="type" style="width:90%;">
                  <option value="0">منشور نصي</option>
                  <option value="1">رابط</option>
                  <option value="2">صورة</option>
              </select>
              
              
              <textarea  class="postText" style="width:90%;height:80px;" placeholder="اكتب النص هنا"></textarea>
              <input type="text" class="linkToshare" style="width:90%;height:30px;display: none;" placeholder="اكتب الرابط هنا"/>
              <div class="btn-group" style="text-align: center">
                  <button class="btnsharenow btn btn-primary">نشر الان <i class="icon-download-alt"></i></button>
                  <button class="btnaddpost btn btn-primary">اضافة الى جدول النشر
                      <i class="icon-time"></i>
                  </button>
              </div>
              <span style="margin-right:5px;display: none;" class="loder"><img src="../img/load.gif" style="width:30px;height:30px;"></span>
          </td>
      </tr>
  </table>
 <div class="msgs" style="display:none;max-height: 500px;overflow: auto;"></div>
 <div class="oldpost">
     
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
    
 </div>
 
 
        <!-- Modal -->
       <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
           <h3 id="myModalLabel">مشاهدة المنشور</h3>
         </div>
         <div class="modal-body">
           <p>One fine body…</p>
         </div>
         <div class="modal-footer">
           <button class="btn" data-dismiss="modal" aria-hidden="true">اخفاء</button>
         </div>
       </div>

        
        <input type="hidden" class="fid" value="<?=$SQL->fUser()?>"/>