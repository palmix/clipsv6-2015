<?php if($inc !='hloun') {header("HTTP/1.0 404 Not Found");  exit();} ?> 
  <table class="table table-striped" style="background-color: #fff;border-radius: 2px;">
                        <form method="post" id="usettings">
                            <tr>
                                <td>اسم الموقع</td> 
                                <td><input type="text" name="title" value="<?=$settings->title?>"/></td>
                            </tr>
                            <tr>
                                <td>رابط الموقع</td> 
                                <td>
                                    <input type="text" name="url" style="text-align: left"  dir="ltr" value="<?=$settings->url?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>رقم تطبيق الفيسبوك</td> 
                                <td>
                                    <input type="text" name="app_id" style="text-align: left"  dir="ltr"  value="<?=$settings->app_id?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>مفاتح تطبيق الفيسبوك</td> 
                                <td>
                                    <input type="text" name="app_key" style="text-align: left"  dir="ltr" value="<?=$settings->app_key?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>رابط صفحة الفيسبوك</td> 
                                <td>
                                    <input type="text" name="fb_link" style="text-align: left"  dir="ltr" value="<?=$settings->fb_link?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>رابط توتير</td> 
                                <td>
                                    <input type="text" name="tw_link" style="text-align: left"  dir="ltr"  value="<?=$settings->tw_link?>" />
                                </td>
                            </tr>
                            <tr>
                                <td> النشر التلقائي </td>
                                <td><select name="corn">
                                       
                                        <option value="0">معطل</option>
                                        <option value="1" <?php if($settings->corn==1){ echo 'selected'; } ?> >مفعل</option>
                                    </select></td>
                            </tr>
                            <tr>
                                <td>موعد النشر <span style="color:red">الوقت بالساعات</span></td>
                                <td>
                                    <input type="number" name="corn_time" value="<?=$settings->corn_time?>" />
                                </td>
                            </tr>
                            <tr>
                               <td colspan="2">
                                    <div style="font-weight: 500">وصف الموقع</div>
                                    <textarea name="description" style="width:70%;height:70px;"><?=$settings->description?></textarea>
                                </td>
                            </tr>
                            <tr>
                               <td colspan="2">
                                   <div style="font-weight: 500">كود الاعلان <span style="color:red;"> يفضل 468x60</span></div>
                                    <textarea name="ad" style="text-align: left;width:70%;height:70px;" dir="ltr"><?=stripslashes($settings->ad)?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div style="font-weight: 500">النص الرئيسي</div>
                                    <textarea id="text" name="text"><?=stripslashes($settings->text)?></textarea>
                                    <input type="hidden" name="textb"/>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button type="submit" class="btn btn-primary">تحديث <i class="icon-wrench"></i></button>
                                    <span style="margin-right:5px;display: none;" class="loder"><img src="../img/load.gif" style="width:30px;height:30px;"></span>
                                </td>
                            </tr>
                            </form>
                            </table>
                        <div class="msgs" style="display:none">
                            asdasd
                        </div>
                            