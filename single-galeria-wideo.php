<?php get_header(); ?>
<!--<?php get_sidebar(); ?>-->

<div class="col-md-12 omega">

<?php
	function convert_videos($string) {
		$rules = array(
			'#http://(www\.)?youtube\.com/watch\?v=([^ &\n]+)(&.*?(\n|\s))?#i' => '<object width="600" height="400"><param name="movie" value="http://www.youtube.com/v/$2"></param><embed src="http://www.youtube.com/v/$2" type="application/x-shockwave-flash" width="600" height="400"></embed></object>',
	 
			'#http://(www\.)?vimeo\.com/([^ ?\n/]+)((\?|/).*?(\n|\s))?#i' => '<object width="600" height="400"><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id=$2&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=&amp;fullscreen=1" /><embed src="http://vimeo.com/moogaloop.swf?clip_id=$2&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="600" height="400"></embed></object>'
		);
	 
		foreach ($rules as $link => $player)
			$string = preg_replace($link, $player, $string);
	 
		return $string;
	}
?>



		<?php if (have_posts()) : the_post();?>

		<div class="breadcrumbs_new"><?php breadcrumbs(); ?></div>

		
		<div class="text">
			<p><?php echo short_opis(); ?></p>
		
			<?php 
					while(the_repeater_field('linki_do_filmow')){
						$link = get_sub_field('link');
						
						echo convert_videos($link);
						echo '<div style="display: block; height: 30px;"></div>';
			
					}
			?>
		</div>
			
			
			
	<?php else : ?>
		<h2>---</h2>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
