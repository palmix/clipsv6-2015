<?php
require 'tweet/I18N/Arabic.php';
require 'tweet/I18N/requires.php';

$settings = array(
	"font" => "tweet/fonts/GD/cocon.ttf",
	"size" => "16",
	"width"=> 350,
	"background" => $_GET['bg']
);
$data = array(
	"text" => $_GET["text"],
	"name" => $_GET["title"]
);
/**
* Define backgrounds and colors for image creation
* $content refer to the text image which we'll use blur filter to create shadow effect
*
* @settings["background"] 	string	background color
* @settings["width"] 		int		text lenght
*
*/
$content = imagecreatetruecolor($settings["width"],200); // create the text image
$white = imagecolorallocate($content,255,255,255); // white color for text image
$black = imagecolorallocate($content,0,0,0); // black color for text image
$image = imagecreatefrompng("tweet/resources/".$settings["background"].".png"); // create background image based on color choise 
if($settings["background"] == "grey"){ // define colors for each background
	$color = imagecolorallocate($image,50,50,50);
	$grey = imagecolorallocate($content,150,150,150);
	$rectangle = imagecolorallocate($image,150,150,150);
	$clear = imagecolorallocate($image,200,200,200);
}elseif($settings["background"] == "green"){
	$color = imagecolorallocate($image,38,62,59);
	$grey = imagecolorallocate($content,124,176,124);
	$rectangle = imagecolorallocate($image,124,176,124);
	$clear = imagecolorallocate($image,187,214,210);
}elseif($settings["background"] == "red"){
	$color = imagecolorallocate($image,62,38,59);
	$grey = imagecolorallocate($content,171,129,129);
	$rectangle = imagecolorallocate($image,171,129,129);
	$clear = imagecolorallocate($image,214,187,210);
}elseif($settings["background"] == "blue"){
	$color = imagecolorallocate($image,38,59,62);
	$grey = imagecolorallocate($content,124,168,167);
	$rectangle = imagecolorallocate($image,124,168,167);
	$clear = imagecolorallocate($image,187,210,214);
}
/** Prepare our text R/L-trim and remove multiple spaces insite the text */
$text = trim(preg_replace("/(\s+)/"," ",$data["text"]));
$words = explode(" ",$text);
/** Fill our text image with grey color */
imagefill($content,0,0,$grey);
/** Define text settings */
$spacing = 10; // spacing between each word
$begin = textbox(arabic("هل"),$settings["font"],$settings["size"]); // a simple word demonsions
$begin["height"] += $begin["top"]-5;
$top = $begin["top"]+10;
$i = 0;
$y = 0;
$x = 0;
$break = false;
$interline = 0;
foreach($words as $word){
	$word = arabic($word);
	$current = textbox($word,$settings["font"],$settings["size"]);
	$will_take = ($current["width"]+$current["left"]+$spacing);
	$break = $x+$will_take>$settings["width"]?true:false;
	$x = $break?$will_take:$x+$will_take;
	$i = $break?$i+1:$i;
	$y = $begin["height"]*$i+$top+($i!=0?$interline:0);
	imagettftext($content, $settings["size"], 0 , $settings["width"]-$x, $y,$black, $settings["font"], $word); // write text
	$first_word = false;
}
/** Apply blur filters to get that smooth shadow */
imagefilter($content,IMG_FILTER_SMOOTH,1);
imagefilter($content,IMG_FILTER_SMOOTH,1);

/** Reinitialize positions with Top -=1 to get the white text more upper */
$top +=-1;
$i = 0;
$y = 0;
$x = 0;
$break = false;
foreach($words as $word){
	$word = arabic($word);
	$current = textbox($word,$settings["font"],$settings["size"]);
	$will_take = ($current["width"]+$current["left"]+$spacing);
	$break = $x+$will_take>$settings["width"]?true:false;
	$x = $break?$will_take:$x+$will_take;
	$i = $break?$i+1:$i;
	$y = $begin["height"]*$i+$top+($i!=0?$interline:0);
	imagettftext($content, $settings["size"], 0 , $settings["width"]-$x, $y,$white, $settings["font"], $word);
	$first_word = false;
}
/** Calculate text height */
$textheight = $y+$begin["height"]-$top/2;
/** Draw background rectangle based on textheight */
$image = rectangle($image,15,(250-$textheight)/2-5,$settings["width"]+25,(250-$textheight)/2+5+$textheight,5,$rectangle);
imagecopy($image,$content,20,(250-$textheight)/2,0,0,$settings["width"],$textheight); // Copy text image to background image
$font = "tweet/fonts/GD/cocon.ttf";
$name = arabic("".$data["name"]);
$current = textbox($name,$font,$settings["size"]+4);
$y = (250-$textheight)/2-$current["height"]-$current["top"]+20;
$x = $current["left"]+$current["width"]+30;
$x = $settings["width"]-$x+10;
imagettftext($image, $settings["size"]+4, 0 ,$x+1 , $y+1,$clear, $font, $name); // write Quote name shadow
imagettftext($image, $settings["size"]+4, 0 ,$x , $y,$color, $font, $name); // write Quote name
$current = textbox("ˮ","tweet/fonts/GD/arial.ttf",70); // write Quote icon
imagettftext($image, 70, 0 ,$settings["width"]+20-$current["width"]+1 , $y+$current["top"]-15,$color+1, "tweet/fonts/GD/arial.ttf", "ˮ");

/** Set headers and print the image */
header("Content-type: image/png"); // set PNG header
imagepng($image); // Print image as PNG

if(isset($_GET['name'])){
$nm = intval($_GET['name']);
imagepng($image,'i_'.$nm.'.png');
}

imagedestroy($image);
?>