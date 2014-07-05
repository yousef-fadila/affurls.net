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
	include("nav.php");
	$per_page = 150;
  $start	= (isset($_GET["start"])) ? intval($_GET["start"]) : 0;
	
	$query = "select id from urls"; 
			$result = mysql_query($query);	
	$number_of_posts = mysql_num_rows($result);

  $query = "select id, url,name, active,txt, def,hits from urls ORDER BY id DESC LIMIT $start, $per_page"; 
			$result = mysql_query($query);	
?>
<form method=post action="admin.php" target="local_frame">
<input name="action"  type="hidden" value="bulk_checkbox" />
<?php		
			
$nav	= "<TABLE WIDTH=\"100%\"><TR><TD>" . GeneratePages("?action=view_all", $number_of_posts,$per_page, $start) . "</TD></TR></TABLE>\n";
	echo "<br> $nav";
?>			

<br><br>
	<TABLE WIDTH=\"100%\" >
				<TR > <TD>Name</TD><TD>HTML</TD><TD>txt</TD><TD>active</TD><TD>Total hits</TD><TD></TD><TD>Edit</TD></TR>
		

<?php

/*
<textarea rows="1" onClick="select()" cols="20" name="aaa"><form method="POST" action="--WEBBOT-SELF--">
	<!--webbot bot="SaveResults" U-File="fpweb:///_private/form_results.csv" S-Format="TEXT/CSV" S-Label-Fields="TRUE" -->
	<p><input type="submit" value="Submit" name="B3"><input type="reset" value="Reset" name="B4"></p></textarea>
<BS> "<img src=" . WEBSITE .'/images/' . $row["txt"] .".jpg>" 
*/


//<a href="../">Home</a> 
while($row = mysql_fetch_array($result))
  {
  $link = WEBSITE . "/". $row["txt"];
  $txt = "<TD> <input type=checkbox name=box[] value='". $row["id"] ."'>  <a href='". $row["url"] ."'>" . $row["name"] . " </a> </TD>";
  $txt .="<TD> <textarea rows='3' onClick='select()' cols='40' name='aaa'>" . " <a href='". $link ."'>" . "<img alt='מעוניין? לחץ כאן להמשך ' src=" . WEBSITE .'/images/' .  $row["txt"] .".jpg>" 
  . "</a>
       </textarea></TD>";
  $txt .= "<TD> <a href='". $link ."'>" . $row["txt"] . " </a> </TD>";
  $txt .= "<TD>". $row["active"] . "</TD>";
  $txt .= "<TD>". $row["hits"] . "</TD>";
  $txt .= "<TD></TD>";
  $action = "<a href='?action=edit&id=". $row["id"] ."'>Edit</a>";
  $txt .= "<TD>$action</TD></TR>";
  echo $txt;
  }

?>


</table>
<br>

	<p dir="ltr">
	<input type="radio" value="delete" checked name="bulk_action">Delete 
	selected<br>
	<input type="radio" name="bulk_action" value="edit">Edit URL to :<input type="text" name="new_url" size="46"></p>
	<p dir="ltr">
	<input type="submit" value="Submit" name="B1">  <input type="reset" value="Reset" name="B2"> </p>
	</p>
</form>
<iframe name="local_frame" width="520" align="left">
Your browser does not support inline frames or is currently configured not to display inline frames.
</iframe>


<?php
echo "<br> $nav";
?>
					
