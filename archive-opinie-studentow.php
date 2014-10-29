<?php get_header(); ?>
<!--<?php get_sidebar(); ?>-->

<div class="col-md-12 omega">	

		<?php if (have_posts()) : the_post(); ?>
		
		<div class="breadcrumbs_new">
			<?php breadcrumbs(); ?>
		</div>

			<?php while (have_posts()) : the_post(); 
				$name= get_the_title();
				$link = get_permalink();				
				$opis= get_field('opis');
			?>

				<div class="col-md-8 alpha omega student">
					<div class="text">
							<blockquote>
								<?php echo strip_tags($opis, "<p>"); ?>
							</blockquote>
							<div class="bq-autor">
								<?php echo $name ?>
							</div>
					</div>
				</div>	


			<?php endwhile; ?>
		


			
	<?php else : ?>
		<h2>Nothing found</h2>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
