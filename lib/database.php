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
/**
	* connects to database server and selects database
	* @return (bool) resource
	*/
function db_connect()
{
	$connection = @mysql_connect(HOST,USERNAME,PASSWORD);
	if (!$connection)
	{
		return false;
	} 
	if(!mysql_select_db(DATABASE, $connection)) 
	{
		return false;
	}
	
	return $connection;
}

/**
	* turns mysql resource into array
	* @param resource $result
	* @return array 
	*/
function result_to_array($result)
{
	$result_array = array();
	for ($i=0; $row = mysql_fetch_array($result); $i++)
	{
		$result_array[$i] = $row; 
	}
	
	return $result_array;
}

function getURL($text)
{
	$query = sprintf("select id, url, active, def from urls where txt = '%s'", mysql_real_escape_string($text)); 
	$result = mysql_query($query);	
	
	$number_of_posts = mysql_num_rows($result);
	if ($number_of_posts == 0) 
	{
		throw new exception("no rows");
	}
	
	$row = mysql_fetch_array($result);
	
	if ($row["active"] == 0)
	{
		$query = sprintf("select url from def 
				where id = %s", $row["def"]); 
		$result = mysql_query($query);	
		$row1 = mysql_fetch_array($result);
		$row["url"] = $row1["url"];
		
	}
	return $row;
}

function add_statistics($id)
{
	$query = sprintf("update urls set hits = hits +1 where id = %s ", mysql_real_escape_string($id)); 
	mysql_query($query);
	if (isset($_GET["ref"]))
	{
		$query =  sprintf("insert into traffic (id, ref, hits) values 
					('%d','%s','%d') ON DUPLICATE KEY UPDATE hits = hits + 1", 
		$id,
		mysql_real_escape_string($_GET["ref"]),
		1); 
		mysql_query($query);
		
	}

}

db_connect();

function redirect($url)
{
	
	Header( "HTTP/1.1 301 Moved Permanently" );
	Header( "Location: " . $url );

}

function gotoindex()

{
	$ra = rand  (1,6);
	if ($ra == 1){
		redirect("http://www.facebook.com/pages/tr-hmbzym-whhnhwt-sl-hmdynh/113113535423433?v=app_4949752878");
	}else if($ra == 2)
	{
		redirect("http://discounts4israel.com/notfound40/");
	}else
	{
		redirect("http://feeds.feedburner.com/discounts4israel/zGpK");

	}
	// want to earn from each email you read? from each click?...join us
} 

function myException($exception)
{
	gotoindex();
}

set_exception_handler('myException');

?>
