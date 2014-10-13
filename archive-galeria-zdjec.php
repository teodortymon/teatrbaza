<?php get_header(); ?>
<!--<?php get_sidebar(); ?>-->

<div class="col-md-12 omega">

<? /*

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/lista-galerii.css">

*/

?>

		<?php 		
			if (empty($_GET['gal'])) :		?>
					
					<div class="dm_breadcrumbs">
						<?php 
							breadcrumbs($forcedUrl, true);
							
							if($gal != ''){
								echo "<span class='breadcrumbsBold'>$gal</span>";
							}
							
							
						?>
					</div>
					
					
					<?php
					
					//dm_galeria 
					
					$dm_galerie = array(
						'Spektakle' => 'Spektakle',
						'Projekty' => 'Projekty',
						'Warsztaty' => 'Warsztaty',
						'Inne' => 'Inne'
					);
					
					foreach($dm_galerie as $k => $v ){
						
						$full = get_option('galcatObrazek'.$k);
					?>
					
					<div class="dm_gal_item">
						<a href="?post_type=galeria-zdjec&gal=<?= $k; ?>">
						<span class="imgthumbs">
						
<?php 
		query_posts($query_string."&showposts=3&meta_value=".$v );
 		if ( have_posts() ) : while ( have_posts() ) : the_post(); 
		$thumb = get_thumb();
		$thumb = site_url().'/resize/138x144x1/r/'. dm_relative($thumb);		

		print '<img src="'.$thumb.'" >';

 endwhile; else: ?>


 <p>no Image</p>


 <?php endif; ?>
 	</span>
 	
	<span class="middle">
	 <span class="inner">					
<?= $v; ?>
		</span>
	</span>
	
	</a>
					</div>
				
					<? } ?>
					
				

		<?php else :
			
					$forcedUrl = "http://".$_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
					$forcedUrl = preg_replace('#&gal=.*#', '', $forcedUrl);
					$gal = $_GET['gal'];
				?>	
					
					<div class="dm_breadcrumbs">
						<?php 
							breadcrumbs($forcedUrl, true);
							echo "<a class='breadcrumbsBold'>$gal</a>";
						?>
					</div>
					
					
				<?php 	
					
							
					global $query_string;
					query_posts($query_string."&meta_value=$gal");

					$strona=0;
					$postsPerPage=8;
					$eop=false;
					
					echo '<div id="lista-galerii">';
					while (!$eop){
							$strona++;
							echo '<div class="dm_strona-galerii">';
							for ($i=0; $i<$postsPerPage;  $i++){
								if (!have_posts()){
									$eop=true;
									break;
								}				

								the_post();
								setup_postdata($post);
								
								$title= get_the_title();
								$link = get_permalink();
								$thumb = get_thumb();
								$thumb = site_url().'/resize/138x144x1/r/'. dm_relative($thumb);
								
								if ( ( ($i+1) % 2)==0 ){
									$marginZero = 'style="margin-right:0px;"';
								}else{
									$marginZero = '';
								}
								
								?>			
										<div class="gallery-item half" <?= $marginZero; ?>>
											<a href="<?php echo $link; ?>">
												<img src="<?php echo $thumb; ?>"  />
												<div class="middle">
													<div class="inner">
														<?php echo $title; ?>
													</div>
												</div>
											</a>
										</div>
								<?php
								

									
							}//for
							echo '</div>';//strona galerii
					}
					echo "</div>";
					wp_reset_query();
			?>
				
			
			<?php endif; ?>
			
</div>

<?php get_footer(); ?>
