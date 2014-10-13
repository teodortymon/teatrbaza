<?php get_header(); ?>
<!--<?php get_sidebar(); ?>-->

<div class="col-md-12 omega">	

				

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div class="dm_breadcrumbs"><?php breadcrumbs(); ?></div>


			<?php
				$name= get_the_title();
				$link = get_permalink();				
				$opis= get_field('opis');
			?>
				<div class="pedagogItem">
						<div class="text">
							<span style="font-style: italic; font-size:120%;">
								<?php echo strip_tags($opis); ?>
							</span>
							<div style="display:block; text-align: right; padding-right: 100px; font-weight: bold;">
								<?php echo $name ?>
							</div>
						</div>	
				</div>

		


			
			<?php

		endwhile; endif; ?>
</div>
<?php get_footer(); ?>
