<?php get_header(); ?>
<!--<?php get_sidebar(); ?>-->

<div class="col-md-12 omega">	

		<?php if (have_posts()) : ?>
		

		<div class="dm_breadcrumbs">
			<?php breadcrumbs(); ?>
		</div>

<ul>
			<?php while (have_posts()) : the_post(); 
				$title= get_the_title();
				$link = get_permalink();
				$full = get_field('zdjecie');
				$thumb = site_url().'/resize/138x145x1/r/'. dm_relative($full);

				
				if (empty($full)){
					
					$thumb = site_url().'/resize/138x145x1/r/'. get_bloginfo('template_directory').'/images/null.gif';
					$full = '';
				}
				
				$opis= short_opis();
				

				?>
			
				<li class="dm_pedagog_item">
					<a href="<?= $link ?>" class="title"><img src="<?php echo $thumb ?>" alt="<?php echo $title ?>"/>
					<?php echo $title ?></a>
				</li>
				
			<?php endwhile; ?>
		
</ul>
			
	<?php else : ?>
		<h2>Nothing found</h2>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
