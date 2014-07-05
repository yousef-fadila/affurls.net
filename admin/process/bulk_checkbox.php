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

echo " action is " . $_POST["bulk_action"];
echo " <br> new URL ". $_POST["new_url"];
echo "<br> action of these ids<br>";

$box=$_POST['box'];


while (list ($key,$val) = @each ($box)) {

	if ($_POST["bulk_action"] =="edit")
	$query = sprintf("update urls set url='%s' where id = %d", 
	mysql_real_escape_string($_POST["new_url"]),mysql_real_escape_string($val));
	else
	$query = sprintf("delete from urls where id = %d",mysql_real_escape_string($val));

	mysql_query($query);
	echo "$val,";
} 	

   ?>
