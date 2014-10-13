<div class="col-md-4 dm_alpha">
		<div class="dm_events ">
			<h2>Nadchodzące wydarzenia</h2>
			<ul>
			
			
			
				
	<?php 
		//Wydarzenia
		
		$args = array( 	'numberposts' => 4,
						'post_type' => 'any',
						'meta_key' => 'pokaz_w_wiadomosciach',
						'meta_value' => 1,
						'post_status' => array('future', 'publish'),
						'orderby'=> 'title',
						'order' => 'DESC'
					);
		$myposts = get_posts( $args );
		
		foreach( $myposts as $post ) {
			setup_postdata($post);

			$opis= short_opis(200); //425
			
			$tytul = get_the_title();
			$data = get_the_date("d.m.Y");
			$link = get_permalink();
			
			?>
			
			<li>
				<a href="<?= $link; ?>"><?= $tytul; ?></a> 
			</li>
			
			 
			<?
		//	the_4col_item($thumb, $tytul, $data,  $catUrl, $cat, $opis, $link);
		}	
	?>
			</ul>
			
			 <a href="?post_type=wydarzenia" class="dm_archive_link">+ archiwum wydarzeń</a>
		</div>
		<div class="clear"></div>
	
	<div class="col-md-4 dm_cytat dm_center">
	
					<?php
				
			$args = array( 'orderby' => 'rand', 'post_type' => 'cytaty', 'showposts' => 1 );
				
			//cytaty, porywajace hasla
	/*		global $post;
			
			$posts = get_posts($args);
			foreach($posts as $post) {
			var_dump($post);
				$tresc = get_the_title();//  
				$tresc = preg_replace('/%(.*?)%/', '<a class="color">$1</a>', $tresc);
			
			
				echo '<span class="tresc">';
					echo $tresc;
				echo '</span>';

			}
			
	*/
	
	$query= new WP_Query($args);

// Loop
while($query->have_posts()):
     $query->next_post();
     $id = $query->post->ID;



    	
     
    $tresc = get_the_title($id);
	$tresc = preg_replace('/%(.*?)%/', '<em class="color">$1</em>', $tresc);
	
	print '<div class="dm_middle"><div class="dm_inner"><span class="tresc">'.$tresc.'</span>';
	print '<span class="autor">';
	print get_field("Autor", $id);			
	print '</span></div></div>';
     
endwhile;
?>	
	
	</div>
	
		
	</div>
