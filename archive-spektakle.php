<?php get_header(); ?>
<!--<?php get_sidebar(); ?>-->

<div class="col-md-12">


		<?php if (have_posts()) : ?>
		

		<div class="breadcrumbs_new">
			<?php breadcrumbs(); ?>
		</div>
<ul>
		
			<?php 
				global $post;
				
				$old = $_GET['archiwum']==1;
				
				//if ($old)
				$args = array( 	'numberposts'=> '', 'post_type' => 'spektakle', 'post_status' => array('publish', 'future')); //'future'
				//else
				//	$args = array( 	'numberposts'=> '', 'post_type' => 'spektakle', 'post_status' => 'future', 'orderby'=> 'date', 'order' => 'ASC');

					
				$myposts = get_posts( $args );
				//$now = strtotime( date("j-m-Y") );
				
				foreach( $myposts as $post ) {						
						/*$isFuture = false;
						while(the_repeater_field('daty_spektakli')){
							if ($isFuture)
								continue;
								
							$data = get_sub_field('data_spektaklu');
							$data = strtotime( $data );
							if ($data >= $now)
								$isFuture=true;
						}*/
						$tab=get_field('wyswietlaj_w');
						$isFuture=true;
						
						if(!$tab){
			
							continue;
						}
						
							$inOld= in_array('archiwum',  $tab);
							$inNew= in_array('repertuar', $tab);
						
						
						
						if ( ($old) && (!$inOld))
							continue;
							
						if ( (!$old) && (!$inNew))
							continue;
						//if ( !$isFuture && !$old )
							//continue;
						//if ($old )
							
									
				
						$opis= short_opis(200);
						
						$title = get_the_title();
						$full = get_thumb();
					//	$thumb = "timthumb.php?src=".$full."&w=210&h=210";
						$thumb = site_url().'/resize/138x144x1/r/'. dm_relative($full);	
								
						
						$postType = get_post_type();
						$postTypeObj = get_post_type_object($postType);
						$cat = $postTypeObj->labels->name;
						$catUrl = get_post_type_archive_link($postType);
						$data = get_the_date("d.m.Y");
						$link = get_permalink();
			
						//the_4col_item($thumb, $tytul, $data,  $catUrl, $cat, $opis, $link);	
						?>
						
				<li class="dm_przedmioty">
				<div class="col-md-2  alpha thumb ">
					 <a href="<?= $link; ?>">  <img src="<?php echo $thumb ?>" />   </a> 
				</div>	

					<div class="col-md-6 omega dm_news">
						<div>
							<h3 class="title"><a href="<?= $link ?>"><?php echo $title ?></a></h3>
						
							<a href="<?= $link ?>"><?= $opis; ?></a>
							<a href="<?= $link ?>" class="more-link">czytaj więcej »</a>
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

			
	<?php else : ?>
		<h2>---</h2>
	<?php endif; ?>
	
	</div>

<?php get_footer(); ?>
