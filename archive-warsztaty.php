<? include_once('warsztaty/w-header.php'); ?>


	<?php 
		global $post;
		$args = array( 	'post_type' => 'warsztaty',
						'numberposts'=> '',
						'post_status' => array('publish','future'),
						'orderby'=> 'date',
						'order' => 'DESC'
					);
		$myposts = get_posts( $args );
		$counter =0;
		
		foreach( $myposts as $post ) {
			setup_postdata($post);
			
		
			

			$link = $post->post_type.'/'.$post->post_name;
			//$link = '?post_type=warsztaty&p='.$post->ID;
			//	var_dump($post->guid);
			

			
	
		?>
		
				<div class="big_button">
				
				<a href="<?= $link ?>">
					<img src="<?= get_field('banner_small'); ?>" alt="Studio Teatralne" class="big_img"/>
				</a>
				
				<div class="caption">
					<h2 class="title"><a href="<?= $link ?>"><?= $post->post_title; ?></a></h2>
					<a href="<?= $link ?>"><?= get_field('tagline'); ?>	</a>
				</div>	
			
				
					
				</div>
		
		<? }	?>

	
	
	
	
	
	
<? include_once('warsztaty/w-footer.php'); ?>
