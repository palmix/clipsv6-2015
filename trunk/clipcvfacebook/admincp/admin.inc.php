<?php if($inc !='hloun') {header("HTTP/1.0 404 Not Found");  exit();} ?>  <form method="post" id="adminUpdate">
 <table class="table table-striped" style="background-color: #fff;border-radius: 2px;">
     <tr>
         <td>اسم المدير</td>
         <td> <input type="text" name="admin" value="<?=$settings->admin?>"></td>
    </tr>
     <tr>
         <td>كلمة السر القديمة</td>
         <td> <input type="password" name="oldpassword" value=""></td>
    </tr>
    <tr>
         <td>كلمة السر الجديدة</td>
         <td> <input type="password" name="npassword" value=""></td>
    </tr>
    <tr>
         <td>كلمة السر القديمة</td>
         <td> <input type="password" name="renpassword" value=""></td>
    </tr>
    <tr>
        <td colspan="2"> <button class="btn btn-primary " >تعديل  <i class="icon-edit"></i></button>
         <span style="margin-right:5px;display: none;" class="loder"><img src="../img/load.gif" style="width:30px;height:30px;"></span>
        </td> 
    </tr>
 </table> 
 </form> 
<div class="msgs" style="display: none;">
    
</div>
