<?php


/**
	 * creates a post
	 * @param array $params
	 * @return bool
	 */
	function create_post()
	{
	  $connection = db_connect();
		
	  $query = sprintf("insert into posts 
	                       set 
											 title = '%s',
											 body = '%s',
											 created_at = NOW(),
											 user_id = '%s'
	                     ", 
											 mysql_real_escape_string($params['title']),
											 mysql_real_escape_string($params['body']),
											 mysql_real_escape_string($params['user_id']));
		
		$result = mysql_query($query);
		if (!$result)
		{
		  return false;
		}
		else
		{
		  return true;
		}
		
	}
	
	
	//create_post(array('title' => 'This is the title', 'body' => 'This is the body', 'user_id' => 1));

	


	/**
	 * updates a post
	 * @param array $params
	 * @return bool
	 */
	function update_post($params)
	{
	  $connection = db_connect();
		
	  $query = sprintf("update posts 
	                       set 
											    title = '%s',
											    body = '%s',
											    user_id = '%s'
											 where id = %s
	                     ", 
											 mysql_real_escape_string($params['title']),
											 mysql_real_escape_string($params['body']),
											 mysql_real_escape_string($params['user_id']),
											 mysql_real_escape_string($params['id'])
											);
		
		$result = mysql_query($query);
		if (!$result)
		{
		  return false;
		}
		else
		{
		  return true;
		}
		
	}	
	
	// update_post(array('title' => 'This is the updated title', 'body' => 'This is the updated body', 'user_id' => 1, 'id' => 8));

	
	
		/**
	 * updates a post
	 * @param int $id
	 * @return bool
	 */
	function delete_post($id)
	{
	  $connection = db_connect();
		
	  $query = sprintf("delete from posts where id = %s", 
											 mysql_real_escape_string($id)
										 );
		
		$result = mysql_query($query);
		if (!$result)
		{
		  return false;
		}
		else
		{
		  return true;
		}
		
	}	
	
	
  // delete_post(8);

	
	
	
	/**
	 * returns array of posts from database
	 * @return array
	 */
	function find_posts($start = null, $per_page = null)
	{
		  $connection = db_connect();
			
	    $query = "select posts.created_at, posts.id as id, posts.title, posts.body, posts.user_id, users.username 
	              from 
								  posts, users
							  where 
									 posts.user_id = users.id
								 order
								    by posts.id desc
								 "; 
			$result = mysql_query($query);		
			
			$number_of_posts = mysql_num_rows($result);
			
			if ($number_of_posts == 0) 
			{
			  return false;	
			}
			
			
			if(isset($start) && isset($per_page))
			{
				$query .= " LIMIT $start, $per_page";		
			}
			
			$result = mysql_query($query);	
			
			$result = result_to_array($result);
			
			return array('result' => $result, 'num_posts' => $number_of_posts);
			
	}
	
	
 

	
	
		/**
	 * returns array of posts from database
	 * @return array
	 */
	function find_post($id)
	{
		  $connection = db_connect();
			
	    $query = sprintf("select posts.created_at, posts.id as id, posts.title, posts.body, posts.user_id, users.username 
	              from 
								  posts, users
							  where 
									 posts.user_id = users.id and posts.id = %s",
									 
									 mysql_real_escape_string($id)
								
									 ); 
			
			$result = mysql_query($query);		
			
			$number_of_posts = mysql_num_rows($result);
			if ($number_of_posts == 0) 
			{
			  return false;	
			}
			
			$row = mysql_fetch_array($result);
			
			return $row;
			
	}
	
	?>
