<?php if($inc !='hloun') {header("HTTP/1.0 404 Not Found");  exit();} ?> 
<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Connect
 *
 * @author Bahaa
 */


class SQL {
    //put your code here
    private $_SERVER;
    private $_USERNAME;
    private $_PASSWORD;
    
    function __construct($USERNAME, $PASSWORD, $SERVER = 'localhost')
    {
       $this->_SERVER = $SERVER;
       $this->_USERNAME = $USERNAME;
       $this->_PASSWORD = $PASSWORD;
    }
    
    
    function connect()
    {
        mysql_connect($this->_SERVER,$this->_USERNAME,$this->_PASSWORD) or die(mysql_error());
    }
    
    function selectDB($DB)
    {
        mysql_select_db($DB) or die(mysql_error());
    }
    
    function close()
    {
        mysql_close();
    }
    
    function getSettings()
    {
        $SQL = mysql_query("SELECT * FROM settings");
        return mysql_fetch_object($SQL);
    }
    
    function login($username,$password)
    {
       $data = $this->getSettings();
       if($data->admin ==$username && $data->password==$password)
       {
           $_SESSION['login'] = true;
           return array('st'=>'ok','msg'=>'تم تسجيل الدخول بنجاح');
       }else{
           return array('st'=>'error','msg'=>'كلمة السر  او اسم المستخدم غير صحيح');
       }
    }
    
    
   function num($table)
   {
       $sql = mysql_query("select * from $table");
       return mysql_num_rows($sql);
   }
   function fUser()
   {
       $sql=  mysql_query("select * from users order by id asc limit 1");
       $data = mysql_fetch_object($sql);
       return $data->id;
   }
   function nUser($id)
   {
       $sql = mysql_query("select * from users where id>$id limit 1");
       if(mysql_num_rows($sql)>=1)
       {
       $data = mysql_fetch_object($sql);
       
       return $data->id;
       }else{
       return 0;
       }
   }
   function sUpdate($name,$data,$html=false)
   {
       if($html==true)
       {
           $data = addslashes(trim($data));
       }else
       {
           $data = mysql_real_escape_string(htmlspecialchars(trim($data)));
        }   
       $sql=  mysql_query("update settings set $name='$data'");
       if($sql)
           return true;
       else
           return false;
   }
   function UserRemove($id)
   {
       $id=abs(intval($id));
       if(mysql_query("delete from users where id=".$id))
           return true;
       else
           return false;
       
   }
    
    
}
?>