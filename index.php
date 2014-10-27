
<?php remove_filter( 'the_content', 'wpautop' );?>
<? if($_SERVER['HTTP_HOST'] == 'warsztatyteatralne.pl'):?>

	<? include_once('archive-warsztaty.php'); ?>

<? else: ?>

<?php get_header(); ?>

<div class="container omega post">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
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
        foreach( $myposts as $key=>$post ) {
            print ("<li data-target=\"#carousel-example-generic\" data-slide-to=\"$key\"");
            if ($key == 0){
		      print ('class="active">');}
            print('</li>');
        }
    ?>
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

		
	
<div class="container container-a2 omega">
	<ul id="posts" class="caption-style-2" data-columns >
             
        
        <div class="post">
		<div class=" ">
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
			
			 <a href="?post_type=wydarzenia" class="">+ archiwum wydarzeń</a>
            </div></div>

        
        
        <?php 
		
		$args = array( 	'numberposts' => 10,
						'post_type' => 'any', //spektakle
						'meta_key' => 'pokaz_w_aktualnosciach',
						'meta_value' => 1,
						'post_status' => array('future', 'publish'),
						'orderby'=> 'date',
						'order' => 'DESC'
					);
		$myposts = get_posts( $args );
		
		foreach( $myposts as $key=>$post ) {
            
            if($key == 5){
               print '<div class="post dm_cytat">';
                    $args2 = array( 'orderby' => 'rand', 'post_type' => 'cytaty', 'showposts' => 1 );
            $query2= new WP_Query($args2);

        // Loop
        while($query2->have_posts()):
             $query2->next_post();
             $id2 = $query2->post->ID;
            $tresc2 = get_the_title($id2);
            $tresc2 = preg_replace('/%(.*?)%/', '<em class="color">$1</em>', $tresc2);

            print '<div class="dm_middle"><div class="dm_inner"><span class="tresc">'.$tresc2.'</span>';
            print '<span class="autor">';
            print get_field("Autor", $id2);			
            print '</span></div></div>';

        endwhile;
        print '</div>';
            }
			setup_postdata($post);

			$opis= short_opis(200); //425
			
			$tytul = get_the_title();
			$full = get_thumb();
			$thumb = $full;
            //$thumb = site_url().'/resize/218x120x1/r/'. dm_relative($full);
			
			
			$postType = get_post_type();
			$postTypeObj = get_post_type_object($postType);
			$cat = $postTypeObj->labels->name;
			$catUrl = get_post_type_archive_link($postType);
			$data = get_the_date("d.m.Y");
			$link = get_permalink();
			
            ?>
			
        
		  <li class="post">
              <a href="<?= $link; ?>"> <img src="<?=$thumb; ?>" alt="<?= $tytul; ?>"></a>
					<div class="caption">
                        <div class="blur"></div>
                        <div class="caption-text">
                            <h3> <a href="<?= $link; ?>"><?= $tytul; ?></a> </h3>
<!--
                             <a href="<?= $link; ?>">
                                <?= $opis; ?> 
                              </a>	
-->
                        </div>
			  		</div>
			 </li> 
<!--
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
-->
			
			 
			<?
		//	the_4col_item($thumb, $tytul, $data,  $catUrl, $cat, $opis, $link);
		}	
	?>
<!--
    <div class="post">
        <a href="?post_type=aktualnosci" class="dm_archive_link">archiwum aktualności</a>
    </div>
-->
    </ul>




 

</div>



<?php get_footer(); ?>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/salvattore.min.js"></script>


<? endif; ?>
