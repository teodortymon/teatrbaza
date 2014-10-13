<?php get_header(); ?>
<!--<?php get_sidebar(); ?>-->

<div class="col-md-12 omega">

	<?php if (have_posts()) : while (have_posts()) : the_post(); 
			?>
			<div class="dm_breadcrumbs">
				<?php 
					$tab=get_field('wyswietlaj_w');
					$inOld= in_array('archiwum',  $tab);
					$inNew= in_array('repertuar', $tab);
					
					// uwaga na slesha 
					
					if ( $inOld && !$inNew ){
						$url=site_url()."/?post_type=spektakle&archiwum=1";
						
						breadcrumbs($url, true);
						$title = get_the_title();
						echo "<span class='breadcrumbs'>".dm_more($title, 60, '')."</span><span class='breadcrumbs'></span>";
						
					}else{
						
						breadcrumbs();
					}
				?>
			</div>
						
			<div class="text">
		<?php
			$full = get_field('zdjecie');
			$thumb = site_url().'/resize/290x220x1/r/'. dm_relative($full);	
			$opis = get_field("opis");
			$id = get_the_ID();
			$rel = ' rel="lightbox['.$id.']" ';
			
			
			
			if (!empty($full))
				echo '<a href="'.$full.'" '.$rel. '><img src="'.$thumb.'" style="float:left; margin-right: 12px; margin-bottom: 5px;"/></a>';
				
								print '<h2 class="title">';
				 the_title();
				print '</h2>';
				
			echo $opis;
			
			echo '<div style="clear:both; display:block; height:32px;"></div>';
			echo '<strong>Daty spektakli:</strong></br>';
				
				$now = strtotime( date("j-m-Y") );
				while(the_repeater_field('daty_spektakli')){					
					$data = get_sub_field('data_spektaklu');
					$data = strtotime( $data );
					$old = ($data < $now);
					$data = datePL('j f Y', $data); //'j F Y, (l)'
					
					if ($old)
						echo "<span style='color: #C0C0C0; font-style: italic;'>$data</span></br>";
					else
						echo "$data</br>";
				}
		?>
			</div>
			<?php

		endwhile; endif; ?>
		</div>
<?php get_footer(); ?>