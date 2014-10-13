
<?php remove_filter( 'the_content', 'wpautop' );?>
<? if($_SERVER['HTTP_HOST'] == 'warsztatyteatralne.pl'):?>

	<? include_once('archive-warsztaty.php'); ?>

<? else: ?>

<?php get_header(); ?>
</script>
<div class="col-md-12 omega">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
<!--
      <div class="item active">
        <p>dfsdf</p>
      </div>
-->
	<?php 
	global $post;
	$args = array( 	'numberposts' => 5,
					'post_type' => 'any',
					'meta_key' => 'pokaz_w_karuzeli',
					'meta_value' => 1,
					'post_status' => array('publish','future'),
					'orderby'=> 'date',
					'order' => 'DESC'
				);
	$myposts = get_posts( $args );
	
	//slider z aktualnosciami
	foreach( $myposts as $key=>$post ) {
		setup_postdata($post);
		$opis= short_opis(425);
		$trim=$opis;
		
		if (strlen(get_the_title()) >30){
			$lines = strlen(get_the_title()) / 30;
			$x = ($lines * 60);
			$trim = neat_trim($opis, 425-$x, '...');
		}
		
		//$full = get_field('zdjecie');
		$full = get_thumb();
//		$thumb = $full;
        $thumb = site_url().'/resize/1200x300x1/r/'.dm_relative($full);	
		
		
		if ($key == 0){
		  print ('<div class="item active">');
        }else{
            print ('<div class="item">');
        }
        ?>
            <a href="<?php echo get_permalink(); ?>"><img src="<?php echo $thumb; ?>"></a>
          <div class="carousel-caption">
<!--            <h3>...</h3>-->
            <p><?php the_title(); ?>.</p>
          </div>
        </div>
<!--
            <a href="<?php echo get_permalink(); ?>"><img src="<?php echo $thumb; ?>"></a>
			<a href="<?php echo get_permalink(); ?>" style="background-image: url(<?php echo $thumb; ?>);">
				
				<span><?php the_title(); ?></span>
			</a>
-->
		<?php
	}
	?>
        </div>
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>

	<script type="text/javascript">
         jQuery(window).load(function() {
             $('#carousel-example-generic').carousel({
                interval: 2000
             });
         });
    </script>
       
		</div>		
		</div><!-- slider end -->
<!--<?php get_sidebar(); ?>-->

		
	
<div class="col-md-12 omega">
		<ul id="dm_aktualnosci">
	<?php 
		
		$args = array( 	'numberposts' => 5,
						'post_type' => 'any', //spektakle
						'meta_key' => 'pokaz_w_aktualnosciach',
						'meta_value' => 1,
						'post_status' => array('future', 'publish'),
						'orderby'=> 'date',
						'order' => 'DESC'
					);
		$myposts = get_posts( $args );
		
		foreach( $myposts as $post ) {
			setup_postdata($post);

			$opis= short_opis(200); //425
			
			$tytul = get_the_title();
			$full = get_thumb();
			$thumb = site_url().'/resize/218x120x1/r/'. dm_relative($full);
			
			
			$postType = get_post_type();
			$postTypeObj = get_post_type_object($postType);
			$cat = $postTypeObj->labels->name;
			$catUrl = get_post_type_archive_link($postType);
			$data = get_the_date("d.m.Y");
			$link = get_permalink();
			
			?>
			
			<li class="row alpha omega">
				
                <div class="col-md-4 alpha omega">	
					<a href="<?= $link; ?>"> <img src="<?=$thumb; ?>" alt="<?= $tytul; ?>"></a>
			 	</div>
			 	<div class="col-md-8 dm_news">
					<div>
						<h3> <a href="<?= $link; ?>"><?= $tytul; ?></a> </h3>
			 			 <a href="<?= $link; ?>">
			 			 	<?= $opis; ?> 
			 			  </a>	
			 			 	<a href="<?= $link; ?>" class="more-link">czytaj więcej »</a>
			  		</div>
			 	</div> 
			</li>
			
			 
			<?
		//	the_4col_item($thumb, $tytul, $data,  $catUrl, $cat, $opis, $link);
		}	
	?>



</ul>

 <a href="?post_type=aktualnosci" class="dm_archive_link">+ archiwum aktualności</a>

</div>


<?php get_footer(); ?>


<? endif; ?>
