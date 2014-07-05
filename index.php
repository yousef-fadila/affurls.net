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
 *
 */
	include('config.php');
	include ("lib/database.php");
	
	  $url = $_SERVER['REQUEST_URI'];

          $url = str_replace(APP_ROOT, '', $url);

	  $url = strtok($url, "?");

	  if ($url == "") gotoindex();
	  else {
	  	
	  	//get URL from DB
	    //if not found throw exception	  	
	  	$row = getURL(strtolower($url));

	  	//add to statistics and traffic
	  	add_statistics($row["id"]);
	  	
	  	redirect($row["url"]);
	    	
	  }

	// strips out escape characters
	function stripslashes_deep($value)
	{
	  $value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
		return $value;
	}
	
?>
