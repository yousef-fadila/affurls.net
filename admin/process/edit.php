<?php
/*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
* THE SOFTWARE.
* 
*
* Author: Yousef Fadila 
* Date: Feb 2010
*
*/
if ($_POST["txt"]== "" || $_POST["url"]== "")
{
	exit("empty fields");
}


$query = sprintf("update urls 
						set 
											name = '%s',
											txt = '%s',
											url = '%s',
											active = '%s',
											def = '%d'
											where id = %d
										
						", 
mysql_real_escape_string($_POST["name"]),
mysql_real_escape_string($_POST["txt"]),
mysql_real_escape_string($_POST["url"]),
mysql_real_escape_string($_POST["active"] == "yes"? 1 : 0),
mysql_real_escape_string($_POST["def"]),
mysql_real_escape_string($_POST["id"])
);

$result = mysql_query($query);


echo("edited successfuly");

/*ToDo: if txt changes, rename the image file name */

if ($_FILES["imgfile"]['tmp_name']) 
{
	
	include('simpleimage.php');
	$directory_images = "/home/affurls1/public_html/images";
	$uploadFilename = $directory_images . DS. $_POST["txt"] . ".jpg";
	$tmp_img = $_FILES["imgfile"]['tmp_name'];
	@getimagesize($tmp_img)
	or exit('only image uploads are allowed'); 
	$image = new SimpleImage();
	$image->load($tmp_img);
	$image->resizeToWidth(600);
	// unlink($uploadFilename);
	$image->save($uploadFilename);
	
}   

?>
