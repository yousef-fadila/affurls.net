<?php
/*
 * Created on Oct 23, 2010
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
  
if ($_POST["txt"]== "" || $_POST["url"]== "")
{
	exit("empty fields");
}

$_POST["txt"] = strtolower($_POST["txt"]);

$query = sprintf("select id from urls where txt = '%s'", mysql_real_escape_string($_POST["txt"])); 
$result = mysql_query($query);	
			
$number_of_posts = mysql_num_rows($result);
if ($number_of_posts != 0) 
			{
			echo("added failed!!! already exist <br><br>");
			   exit();
	 
			}



// do this only if txt is unique...
	
 $query = sprintf("insert into urls 
	                       set 
											 name = '%s',
											 txt = '%s',
											 url = '%s',
											 active = '%s',
											 hits = 0,
											 def = '%d'		
											 			
										
	                     ", 
											 mysql_real_escape_string($_POST["name"]),
											 mysql_real_escape_string($_POST["txt"]),
											 mysql_real_escape_string($_POST["url"]),
											 mysql_real_escape_string($_POST["active"] == "yes"? 1 : 0),
											  mysql_real_escape_string($_POST["def"])
											 );
		
		$result = mysql_query($query);


echo("added successfuly <br><br>");



if ($_FILES["imgfile"]['tmp_name']) 
{
	$salt = 'sdfkj3+';
    $srv = $_SERVER['SERVER_NAME'];
    $salted = sha1($salt . $srv);
    
    $post_data = array();
    $post_data['srv'] = $salted;
    $post_data['file'] = '@' . $_FILES['imgfile']['tmp_name'];
    $post_data['file_name'] = $_FILES['imgfile']['name'];
    $post_data['file_upload_name'] = $_POST['txt'];
    $url = 'http://yfedora/websites/test/uploadhandler.php';
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

    $res = curl_exec($ch);
    curl_close($ch);
    
    if($res == 'error') exit('image could not be uploaded');
    if($res == 'exists') exit('image already exists on the server');
    echo $res;
	//  include('simpleimage.php');
 //$directory_images = "/home/affurls1/public_html/images";

	// $directory_images = SERVER_ROOT . DS . APP_ROOT . DS . "images";
	// $uploadFilename = $directory_images . DS. $_POST["txt"] . ".jpg";
	// $tmp_img = $_FILES["imgfile"]['tmp_name'];
    //	@getimagesize($tmp_img)
	//    or exit('only image uploads are allowed'); 
	// $image = new SimpleImage();
	// $image->load($tmp_img);
	// $image->resizeToWidth(600);
	// $image->save($uploadFilename);
	 
}   

$link = WEBSITE . "/". $_POST["txt"];
echo $link . "<br><br>";

echo "<a href='$link' target='_blank''> $link </a><br><br>"; 

$txt ="<textarea rows='3' onClick='select()' cols='40' name='aaa'>" . " <a href='". $link ."'>" . "<img alt='מעוניין? לחץ כאן להמשך ' src=" . $res>
       "</a>  </textarea>";

echo $txt;

?>
