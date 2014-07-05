<form action="admin.php" method="post" enctype="multipart/form-data">

          
       		   <input name="action"  type="hidden" value="new" />
       <fieldset>
	   <legend>Add Link Post</legend>
   
		 <div>
		   <label> name </label>
		   <input name="name" size="25" type="text"  />
       		</div>
		 
	     	<div>
		   <label> txt </label>
		   <input name="txt" size="16" type="text"  />
       		</div>
		 
		 <div>
		   <label> url </label>
		   <input name="url" size="150" type="text"  />
       		</div>
       		
		    <div>
		   <label> default </label>
		   <input name="def" size="10" value= "0" type="text"  />
       		</div>
       		
       		  <div>
		   <label> active </label>
		
			<br> yes 
			    <input type="radio"  value="yes" checked name="active">
			<br> no 
				<input type="radio" value="no" name="active">
	  		</div>
		 
		   <div>
		   <label> Image </label>
		 
		 <input type="hidden" name="MAX_FILE_SIZE" value="5000000">  Upload Image: <input type="file" name="imgfile">
		 
		 </div>	 
		  <input type="submit" value="save" />

	 </fieldset>

</form>
