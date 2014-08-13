<?php if($inc !='hloun') {header("HTTP/1.0 404 Not Found");  exit();} ?>  
 <table class="table table-striped" style="background-color: #fff;border-radius: 2px;">
                          
<tr>
                                <td>اسم الموقع :</td>
                                <td><?=$settings->title?></td>
                            </tr>
                            <tr>
                                <td>عدد المشتركين :</td>
                                <td><?=$SQL->num('users')?> مشتركين</td>
                            </tr>
                            <tr>
                                <td>عدد المنشورات :</td>
                                <td><?=$SQL->num('posts')?></td>
                            </tr>
                            <tr>
                                <td>تم نشرها</td>
                                <td><?=$SQL->num('posts where send=\'1\'')?></td>
                            </tr>
                            <tr>
                                <td>لم تنشر بعد</td>
                                <td><?=$SQL->num('posts where send=\'0\'')?></td>
                            </tr>
                            <tr>
                                <td>رابط الكورن</td>
                                <td><input type="text" dir="ltr" value="<?=$settings->url.'/admincp/corn.php'?>"/></td>
                            </tr>
                            <tr>
                                <td>نسخة السكربت</td>
                                <td><?=v()?></td>
                            </tr>
                              <tr>
                                <td>نشر وتعديل ديماهنا</td>
                                <td><a href="//starmaro-b.com" target="_blank"> مدونة نجم المغرب</a></td>
                            </tr>
                            <tr>
                                <td>الموقع الرسمي</td>
                                <td><a href="#" target="_blank">ليون هوست</a></td>
                            </tr>
                            <tr>
                                <td>برمجة</td>
                                <td><a href="#" target="_blank">بهاء عودة</a></td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div>طريقة عمل تطبيق فيسبوك</div>
                                    <div>
                                        <iframe width="560" height="315" src="http://www.youtube.com/embed/T7TqP7_21KQ" frameborder="0" allowfullscreen></iframe>
                                    </div>
                                </td>
                            </tr>
         </table>                   