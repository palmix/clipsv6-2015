<?php
include 'hloun/config.php';

if(isset($_GET['step']))
{
	if($_GET['step']=='data')
	{
		/*$name = mysql_real_escape_string(htmlspecialchars($_POST['name']));
		
		$access = mysql_real_escape_string(htmlspecialchars($_POST['access']));
		$date   = time();
		$sql = mysql_query("select * from users where user_id='$id'");
		if(mysql_num_rows($sql))
		{
                           $update = mysql_query("update users set access='$access',date='$date' where user_id='$id'");
		}else{
			   $register = mysql_query("insert into users (name,user_id,access,date) values ('$name','$id','$access','$date')");
		}
		*/
		$id   =  mysql_real_escape_string(htmlspecialchars($_POST['id']));
                $select = mysql_query("select * from users where user_id='$id'");
		if(mysql_num_rows($select)>=1)
                {
                    $data = mysql_fetch_object($select);

                    echo json_encode(array(
                    'st'=>'done',
                    'name'=>$data->name,
                    'date'=>date("h:i - d/m/y",$data->date),
                    'id'=>$data->user_id
                    ));
		}else
                    {
                     echo json_encode(array(
                    'st'=>'done',
                    'name'=>'يبدو ان حسابك قد مسح من قبل الادارة',
                    'date'=>date("h:i - d/m/y",time()),
                    'id'=>'1'
                    ));
                    }
	}
}
?>