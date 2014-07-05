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

include('../../config.php');
include ("../../lib/database.php");

function writemenu(){
	$menu = "<html><head><meta http-equiv='Content-Type' content='text/html; charset=UTF-8'></head></html>";
	$menu .= "<center><div >";
	
	$menu .= "<a style='text-decoration: none' href ='?action=new'> new </a> | ";
	$menu .= "<a style='text-decoration: none' href ='?action=view_all'> view all </a> | ";
	$menu .= "<a style='text-decoration: none' href ='?action=search'> search </a> | ";
	/* $menu .= "<a style='text-decoration: none' href ='aaa'> - </a> | ";
	$menu .= "<a style='text-decoration: none' href ='aaa'> new </a> | ";
	$menu .= "<a style='text-decoration: none' href ='aaa'> new </a> | ";
	$menu .= "<a style='text-decoration: none' href ='aaa'> new </a> | ";
	*/
	$menu.= "</div></center>";
	
	echo $menu;
	
}

if ($_SERVER['REQUEST_METHOD'] != 'POST'){ 

	writemenu();

	if (isset($_GET["action"]))
	switch ($_GET["action"]) {
		
	case "new":
		include("views/new.php");
		break;
		
	case "search":
		include("views/search.php");
		
		break;		
		
	case "edit":
		include("views/edit.php");  

		break;			
		
	case "stat";
		include("views/stat.php");  
		
		break;
		
	case "view_all";
		include("views/view_all.php");  
		
		break;
	}

} 
else
{ // request method = action
	writemenu();
	switch ($_POST["action"]) {
		
	case "new":
		include("process/new.php");
		break;
		
	case "edit":
		include("process/edit.php");
		break;

	case "bulk_checkbox":
		include("process/bulk_checkbox.php");
		break;
	}
	
}

?>
