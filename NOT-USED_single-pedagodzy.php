<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post();
	        // Link back up to the page
	        //$content = '<a href="' . get_page_link($pageId) . '">' . get_the_title($pageId) . '</a>';
			?>
			<div class="dbline"></br></div>
			<h1><?php breadcrumbs(); ?></H1>
			<div class="dbline"></br></div>
			<div style="display: block; height: 20px;"></div>
			
			<div class="text">
			<?php
					
			$full = get_field('zdjecie');
			$thumb = "timthumb.php?src=".$full."&w=400&h=300";		
			
			$opis = get_field("opis");
			if (!empty($full))
				echo '<a href="'.$full.'"><img src="'.$thumb.'" style="float:left; margin-right: 12px; margin-bottom: 5px;"/></a>';
			echo $opis;
			echo '<div style="clear:both; display:block; height:48px;"></div>';
		?>
			</div>
			<?php

		endwhile; endif; ?>
<?php get_footer(); ?>