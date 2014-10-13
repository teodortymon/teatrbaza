<?php get_header(); ?>
<!--<?php get_sidebar(); ?>-->

<div class="col-md-12">

		<div class="dm_breadcrumbs"><span class="breadcrumbs first">Aktualności - archiwum</span><span class="breadcrumbsBold last"></span></div>

<ul>

	<?php 
		global $post;
		$args = array( 	'post_type' => 'any',
						'numberposts'=> '',
						'meta_key' => 'pokaz_w_aktualnosciach',
						'meta_value' => '1',
						'post_status' => array('publish','future'),
						'orderby'=> 'date',
						'order' => 'DESC'
					);
		$myposts = get_posts( $args );
		$counter =0;
		
		//slider z aktualnosciami
		foreach( $myposts as $post ) {
			setup_postdata($post);
			
			/*echo get_the_title();
			 $meta_values = get_post_meta($post->ID, 'pokaz_w_aktualnosciach' );
			print_r($meta_values);
			echo '<div style="display: block; height: 48px; clear:both;"></br></div>';
			continue;*/

			$opis= short_opis(200);	
			
			$title = get_the_title();
			//$img = 'timthumb.php?src='.get_field("zdjecie").'&w=210&h=210';
			$full = get_thumb();
			$thumb = site_url().'/resize/138x144x1/r/'. dm_relative($full);	
					
			
			$postType = get_post_type();
			$postTypeObj = get_post_type_object($postType);
			$cat = $postTypeObj->labels->name;
			$catUrl = get_post_type_archive_link($postType);
			$data = get_the_date("d.m.Y");
			$link = get_permalink();
			
		//	the_4col_item($thumb, $tytul, $data,  $catUrl, $cat, $opis, $link);		
		?>
		
				<li class="dm_przedmioty">
				<div class="row">
                    <div class="col-md-3  alpha thumb ">
                         <a href="<?= $link; ?>">  <img src="<?php echo $thumb ?>" />   </a> 
                    </div>	

                        <div class="col-md-9 omega dm_news">
                            <div>
                                <h3 class="title"><a href="<?= $link ?>"><?php echo $title ?></a></h3>

                                <a href="<?= $link ?>"><?= $opis; ?></a>
                                <a href="<?= $link ?>" class="more-link">czytaj więcej »</a>
                            </div>
                        </div>
                </div>
				</li>
		
		<?
			
			//$counter++;
			//if ( ($counter % 4)==0 )
			//	echo '<div style="display: block; height: 48px; clear:both;"></br></div>';			
			
		}	
	?>
	</ul>
	</div>
<?php get_footer(); ?>