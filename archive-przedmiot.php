<?php get_header(); ?>
<!--<?php get_sidebar(); ?>-->

<div class="col-md-12 omega">

		<?php if (have_posts()) : ?>
		
		<div class="dm_breadcrumbs"><?php breadcrumbs(); ?></div>
		<ul>
			<?php while (have_posts()) : the_post(); 
				$title= get_the_title();
				$link = get_permalink();
				$full = get_field('zdjecie');
				$thumb = site_url().'/resize/138x144x1/r/'. dm_relative($full);
				if (empty($full)){
					$thumb = site_url().'/resize/138x144x1/r/'. dm_relative(get_bloginfo('template_directory')."/images/null.gif");
					$full = '';
				}
				
				$opis= get_field('opis'); //short_opis();
				//$opis = strip_tags($opis);
				
				$url = str_ireplace('http://', '' , $url);
				?>
				
				<li class="dm_przedmioty">
				<div class="col-md-3  alpha thumb ">
					<!-- <a href="<?php echo $full; ?>"> --> <img src="<?php echo $thumb ?>" />  <!-- </a> -->
				</div>	

					<div class="col-md-9 omega dm_news">
						<div>
							<h3 class="title"><?php echo $title ?></h3>
						
							<?= $opis; ?>
						
						</div>
					</div>
					
				</li>
			<?php endwhile; ?>
		</ul>
			
	<?php else : ?>
		<h2>Nothing found</h2>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
