<?php get_header(); ?>
<!--<?php get_sidebar(); ?>-->

<div class="col-md-12 omega">		
		<?php
		wp_reset_query();
		
		wp_reset_postdata();
		
		 if (have_posts()) : the_post();?>
		
		<div class="breadcrumbs_new">
			<?php 
	
				breadcrumbs('', true);
				
				$cat = get_field("kategoria_galerii");
				$catUrl = "?post_type=galeria-zdjec&gal=$cat";
				$title = get_the_title();
				
				echo "<a href='$catUrl' class='breadcrumbs'> $cat</a>";
				print '<span class="breadcrumbs sep"> &gt; </span>';
				echo "<a class='breadcrumbsBold'>". dm_more($title, 60, '') ."</a>";
			?>
		</div>
		
				
		<div class="text">
			<?php echo short_opis(); ?>
		</div>
		
		
		<ul class="dm_gallery">
			<?php 
					$counter = 0;
					$id = get_the_ID();
					$rel = ' rel="lightbox['.$id.']" ';
					
					while(the_repeater_field('zdjecia')){
						$counter++;
						$thumb = get_sub_field('zdjecie_galerii');
						$link = $thumb;
					
					
						$thumb = site_url().'/resize/138x140x1/r/'. dm_relative($thumb);
						$opis = get_sub_field('opis-zdjecia');
						
			?>
						
	<li><a class="gallery-item" href="<?= $link; ?>" <?= $rel; echo ' title="'.$opis.'"';?> >
		<img src="<?= $thumb; ?>"  alt="<?= $opis; ?>" />
	</a></li>
						
						
			<?php }?>
			
			</ul>
			
			
			<div style="display: block; height: 48px;"></div>		
	<?php else : ?>
		<h2>---</h2>
	<?php endif; 
	wp_reset_query();
	?>
	
</div>	
	

<?php get_footer(); ?>
