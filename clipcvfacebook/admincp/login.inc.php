<?php if($inc !='hloun') {header("HTTP/1.0 404 Not Found");  exit();} ?> 
  <form class="form-horizontal " style="margin-right:25%;" id="login" method="post">
                    <div class="control-group">
                      <label class="control-label" for="inputAdmin">اسم المدير</label>
                      <div class="controls">
                        <input type="text" name="username" id="inputAdmin" placeholder="اسم المدير">
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label" for="inputPassword">كلمة السر</label>
                      <div class="controls">
                        <input type="password" name="password" id="inputPassword" placeholder="كلمة السر">
                      </div>
                    </div>
                    <div class="control-group">
                      <div class="controls">
                        <button type="submit" class="btn">دخول
                        <i class="icon-user"></i>
                        </button>
                          <div style="margin-top:15px;display: none;" class="clearfix loading">
                              <div id="ajaxloader1"></div>
                          </div>
                      </div>
                    </div>
                        
                   </form>
                          <div class="msg" style="color:#fff;display: none;">asad</div>
                