<?php get_header(); ?>
<!--<?php get_sidebar(); ?>-->

<div class="col-md-12 omega">

<?

/*<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/lista-galerii.css">
*/
?>


		<?php if (have_posts()) : ?>
		

		<div class="dm_breadcrumbs"><?php breadcrumbs(); ?></div>


			<?php 				
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
			$title= get_the_title();
			$link = get_permalink();			
			$thumb = get_thumb();
			$thumb = "timthumb.php?src=".$thumb."&w=138&h=144"; //w "timthumb.php" trzeba dodac do listy stron vimeo !
		//	$thumb = site_url().'/resize/138x144x1/r/'. dm_relative($thumb);	
			
								if ( ( ($i+1) % 2)==0 ){
									$marginZero = 'style="margin-right:0px;"';
								}else{
									$marginZero = '';
								}
			
			?>			
					<div class="gallery-item half" <?= $marginZero; ?> >
						<a href="<?php echo $link; ?>">
							<img src="<?php echo $thumb; ?>" />
								<div class="middle">
													<div class="inner">
														<?php echo $title; ?>
													</div>
												</div>
						</a>
					</div>
			<?			}						
						echo '</div>';
						
						//if ($eop)
						//	break; //while
				}
				echo "</div>";
			?>
			
	<?		
			
	/*	<script type="text/javascript">
		    $(window).load(function() {
			
					var max=0;
					$('.dm_strona-galerii').each(
						function () {
							$this = $(this);
							if ( $this.outerHeight() > max ) {
								max=$this.outerHeight();
							}
						}
					); 
			 
			        $('#lista-galerii').orbit({
						animation: 'horizontal-push', //'horizontal-push',
			            bullets: true,
						bulletNav: true,
						directionalNav: false,
						timer: false	  
			        });
			 
					$('.dm_strona-galerii').css('height', max+'px');
					$('#lista-galerii').css('height', max+'px');
					//$('.orbit div:only-child').css('height', max+'px');
			});
		</script>  */
	
	?>


		

			
	<?php else : ?>
		<h2>---</h2>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
