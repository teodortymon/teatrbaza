<?php get_header(); ?>
<!--<?php get_sidebar(); ?>-->

<div class="col-md-12 omega">	

<?
	$sterm = $_GET['s'];
?>

		<div class="dm_breadcrumbs">
			<span class="breadcrumbs">Wyniki wyszukiwania</span><span class="breadcrumbs"><?= $sterm; ?></span>
			<span class="breadcrumbs"></span>
		</div>
		<ul>
	<?php
		$count =0;
		if (have_posts()) :
			
			$zakazane = array('cytaty', 'przyjaciele', 'sponsorzy', 'wspolpracownicy', 'aktualnosci', 'wydarzenia' /*virtual*/ );
			while (have_posts()) : the_post();
				$post_type = get_post_type();
				$post_status = get_post_status( get_the_ID() );
				
				if ( in_array($post_type,$zakazane) ){
					continue;
				}
				
				if ( !in_array($post_status, array('publish', 'future')  )){
					continue;
				}
				
				$count++;
				
				$title= get_the_title();
				$link = get_permalink();
				$full = get_thumb();
				$thumb = "timthumb.php?src=".$full."&w=130&h=130";	

				$opis= short_opis(500);
			?>
			
				<li class="dm_przedmioty">
										

					<div class="pedagogOpis">
						<div class="col-md-2  alpha thumb ">
							<a href="<?php echo $link; ?>"><img style="display:inline;" src="<?php echo $thumb ?>" /></a>

						

						</div>
						<div class="col-md-6 omega dm_news">
						
												<div>
							<h3 class="title"><a href="<?= $link ?>"><?php echo $title ?></a></h3>
						
							<a href="<?= $link ?>"><?= $opis; ?></a>
							<a href="<?= $link ?>" class="more-link">czytaj więcej »</a>
						</div>
						</div>
					</div>
					
				</li>
				
		<?php endwhile; 
	 endif; 	
		if ($count ==0): ?>
		<span style="font-size: 18px;">Brak wyników.</span>
		<div style="display: block; height: 300px;"></div>
	<?php endif; ?>		
</ul>
	</div>

<?php get_footer(); ?>
