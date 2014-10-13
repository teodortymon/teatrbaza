<?php get_header(); ?>

		<?php if (have_posts()) : ?>
		
		<div class="dbline"></br></div>
		<h1>NEWS</H1>
		<div class="dbline"></br></div>
		<div style="display: block; height: 20px;"></div>
		
			<?php 
				global $post;
				
				$args = array( 	'post_type' => 'news',
								'numberposts'=> '',
								'post_status' => array('publish','future'),
								'orderby'=> 'date',
								'order' => 'DESC'
							);

					
				$myposts = get_posts( $args );
				
				foreach( $myposts as $post ) {
				//while (have_posts()) : the_post(); 
						$opis= short_opis(200);
						
						$tytul = get_the_title();
						$full = get_thumb();
						$thumb = "timthumb.php?src=".$full."&w=210&h=210";
								
						
						$postType = get_post_type();
						$postTypeObj = get_post_type_object($postType);
						$cat = $postTypeObj->labels->name;
						$catUrl = get_post_type_archive_link($postType);
						$data = get_the_date("d.m.Y");
						$link = get_permalink();
			
						the_4col_item($thumb, $tytul, $data,  $catUrl, $cat, $opis, $link);	
						
						$counter++;
						if ( ($counter % 4)==0 )
							echo '<div style="display: block; height: 48px; clear:both;"></br></div>';		
			//endwhile;
				}
			?>
		
			<div style="display: block; height: 48px;"></div>

			
	<?php else : ?>
		<h2>---</h2>
	<?php endif; ?>

<?php get_footer(); ?>
