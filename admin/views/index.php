

<?php if($posts['result']):  ?>

  <?php foreach($posts['result'] as $post): 

      include('_post.php');

      endforeach; ?>
			
<?php endif; ?>


<div id="pagination">

<?php if(($page - 1) <= $total_pages && $page !=1): ?>

  <a href="<?php echo '/'.APP_ROOT.'/'; ?>page/<?php echo $page - 1; ?>">previous</a>

<?php endif; ?>


<?php if(($page + 1) <= $total_pages): ?>

  <a href="<?php echo '/'.APP_ROOT.'/'; ?>page/<?php echo $page + 1; ?>">next</a>

<?php endif; ?>

</div>

