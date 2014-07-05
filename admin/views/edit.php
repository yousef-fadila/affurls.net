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

$sql = "";

if (isset($_GET["id"]) && $_GET["id"]!="")
	$sql .= " id = '" . $_GET["id"] . "' AND";
	
if (isset($_GET["url"]) && $_GET["url"]!="")
	$sql .= " url = '" . $_GET["url"] . "' AND";

if (isset($_GET["txt"]) && $_GET["txt"]!="")
	$sql .= " txt = '" . $_GET["txt"] . "' AND";

if (isset($_GET["name"]) && $_GET["name"]!="")
	$sql .= " name = '" . $_GET["name"] . "' AND";	
	
 $query = sprintf("select id, url,name, active,txt, def,hits from urls where %s 1", $sql); 
			$result = mysql_query($query);	
		
			$row = mysql_fetch_array($result);
			$number_of_posts = mysql_num_rows($result);
			if ($number_of_posts == 0) 
			echo "no result";
			
?>			
<form action="admin.php" method="post" enctype="multipart/form-data">

          
       		   <input name="action"  type="hidden" value="edit" />
       		    <input name="id"  type="hidden" value="<?php echo $_GET["id"]; ?>" />
       <fieldset>
	   <legend>edit Link Post</legend>
   
		 <div>
		   <label> name </label>
		   <input name="name" size="25" value="<?php echo $row["name"]; ?>" type="text"  />
       		</div>
		 
	     	<div>
		   <label> txt </label>
		   <input name="txt" size="16" type="text" value="<?php echo $row["txt"]; ?>" />
       		</div>
		 
		 <div>
		   <label> url </label>
		   <input name="url" size="150" type="text" value="<?php echo $row["url"]; ?>" />
       		</div>
       		
		    <div>
		   <label> default </label>
		   <input name="def" size="10" value= "0" value="<?php echo $row["def"]; ?>" type="text"  />
       		</div>
       		
       		  <div>
		   <label> active is <?php echo $row["active"]; ?></label>
		
			<br> yes 
			    <input type="radio"  value="yes" <?php echo $row["active"]==1? "checked": "" ?>  name="active">
			<br> no 
				<input type="radio" value="no" <?php echo $row["active"]==0? "checked": "" ?> name="active">
	  		</div>
		 
		
		   
			 
		 <input type="hidden" name="MAX_FILE_SIZE" value="5000000">  Upload Image: <input type="file" name="imgfile">
		 
		
		 
		 </div>	 <br><br>
		  <input type="submit" value="save" />

	 </fieldset>

</form>		
<br>
   <div>
		     <label>hits = <?php echo $row["hits"]; ?>  </label>
		     
<br><br>
<p><a href="admin.php?action=stat&id=<?php echo $_GET["id"]; ?>">view statistics </a></p>

<br><img src="<?php echo  WEBSITE .'/images/' . $row["txt"] .".jpg"; ?>"><br>

<?php

$link = WEBSITE . "/". $row["txt"];


echo "<a href='$link' target='_blank''> $link </a>" . "<br><br>"; 
echo $link ;

?>
