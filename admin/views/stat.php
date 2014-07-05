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
 $query = sprintf("select hits from urls where id = %s", $_GET["id"]); 
			$result = mysql_query($query);	
		
			$row = mysql_fetch_array($result);
			$number_of_posts = mysql_num_rows($result);
			if ($number_of_posts == 0) 
			echo "no result";
echo "Total hits = " . $row['hits'] ;		
echo "<br><br>   Top 200 referring <br>";

$query = sprintf("select ref,hits from traffic where id = %s order by hits DESC", $_GET["id"]); 
			$result = mysql_query($query);	
		
?>			

<table align="center" width="400">
<tr> 
<td width="50%"><b><u> ref </b></u></td>
<td width="50%"><u> <b>hits</b> </u></td>
</tr>
<?php


while($row = mysql_fetch_array($result))
  {
  echo " <tr> <td > " . $row["ref"] . "</td>";
 echo  " <td > " . $row["hits"] . "</td></tr>";
  }

?>


</table>
					
