<?php 
ob_start();
session_start();
ini_set('session.gc-maxlifetime', 99*90*90);


/* Add DataBase Host */

define(HOST,'localhost');

/* DATABASE USERNAME */

define(DB_USERNAME,'dimahnan_da3awi');

/* DATABASE PASSWORD */

define(DB_PASSWORD,'da3awi');

/* DATABASE NAME */

define(DB_NAME,'dimahnan_da3awi');

/* Please Do Not Edit anything down */

$inc = 'hloun';

include 'SQL.php';

$SQL = new SQL(DB_USERNAME,DB_PASSWORD,HOST);

$SQL->connect();

$SQL->selectDB(DB_NAME);





function cunter($num){
    return '<span class="counter counter-analog" data-direction="up" data-interval="5" data-format="'.$num.'" data-stop="'.$num.'">0</span>';
}

function isLogin()
{
    if(isset($_SESSION['login']) && $_SESSION['login']==true)
        return true;
    else
        return false;
        
}
function v()
{
    return '1.0.0';
}

function limit_str($text,$limit){
        $m = explode(" ",$text);
        if(count($m) > $limit){
                $y = array();
                for($t=0;$t<=($limit-1);$t++){
                        $y[$t] = $m[$t];
                }
                $b = implode(" ",$y);
                $b .= " ...";
        }else{
                $b = $text;
        }
return $b;
}
function getimg($url){

$contetn = @file_get_contents($url);
	if (empty($contetn)){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_URL, $url);
	$contetn= curl_exec($ch);
	curl_close($ch);
	}
return $contetn;
}

function makeimage($url,$image,$dir=''){
            $data = getimg($url);
                    $img = $dir.$image;
                    $im = @imagecreatefromstring($data);
                            if ($im !== false)
                            {
                                file_put_contents($img, $data);
                            }else
                            {
                                $img = false; 
                               
                            }

                    return $img;
			
}

function getAcess($url)
{
    $url = parse_url($url);
    $query = array();
    parse_str($url['query'], $query);
    return $query['access_token'];
    
}

?>