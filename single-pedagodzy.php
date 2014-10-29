<?php get_header(); ?>
<!--<?php get_sidebar(); ?>-->

<div class="col-md-12 omega">	

	<?php if (have_posts()) : while (have_posts()) : the_post(); 
			?>
		<div class="breadcrumbs_new">
			<?php breadcrumbs(); ?>
		</div>
		<?php
			$title= get_the_title();
			$link = get_permalink();
			$full = get_field('zdjecie');
				$thumb = site_url().'/resize/138x145x1/r/'. dm_relative($full);
			if (empty($full)){
				$thumb = site_url().'/resize/138x145x1/r/'. dm_relative(get_bloginfo('template_directory')."/images/null.gif");
				$full = '';
			}
			
			$opis= get_field('opis');
			
			$mail = get_field("e-mail");
			$url = get_field("www");
			$url = str_ireplace('http://', '' , $url);
			$fb = get_field("profil_facebook");
			$li = get_field("profil_linked_in");
			$tw = get_field("profil_twitter");
			$hasSocial = (!empty($fb)) || (!empty($tw)) || (!empty($li));
		?>
        <div class="row">
            <div class="col-md-3 alpha thumb">
                <img src="<?php echo $thumb ?>" />
            </div>

            <div class="col-md-9 omega">
                <div class="text dm_fixFont">
                    <h4><?= $title;?></h4>
                    <?php echo $opis; ?>
                </div>	
            </div>
        </div>
		
		
<?php endwhile; endif; ?>
		</div>
<?php get_footer(); ?>