<?php get_header(); ?>
<!--<?php get_sidebar(); ?>-->

<div class="col-md-12 omega">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
		<div class="breadcrumbs_new">
			<?php breadcrumbs(); ?>
		</div>
		
		<div class="text">
		<?php
			$full = get_field('zdjecie');	
			$thumb = site_url().'/resize/290x220x1/r/'. dm_relative($full);
			
			$id = get_the_ID();
			$rel = ' rel="lightbox['.$id.']" ';
			
			
			if (!empty($full))
				echo '<a href="'.$full.'" '.$rel.'><img src="'.$thumb.'" style="float:left; margin-right: 12px; margin-bottom: 5px;"/></a>';				
				print '<h2 class="title">';
				 the_title();
				print '</h2>';
				
			the_content();
		?>
		</div>
<br />


<?php
/*
$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];


 <iframe src="https://www.facebook.com/plugins/like.php?href=<?php echo $url; ?>"
        scrolling="no" frameborder="0"
        style="border:none; width:450px; height:80px"></iframe>
*/ ?>
		<?php endwhile; endif; ?>
		
</div>		
<?php get_footer(); ?>
